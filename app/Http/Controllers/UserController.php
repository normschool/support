<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use App\Repositories\UserRepository;
use Auth;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use Spatie\Permission\Models\Role;

/**
 * Class UserController
 */
class UserController extends AppBaseController
{
    /** @var UserRepository */
    private $userRepository;

    /**
     * UserController constructor.
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index(Request $request): View
    {
        return view('users.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View
    {
        $isAgent = str_contains(url()->current(), 'agents');
        $roleName = $isAgent ? 'Customer' : 'Agent';
        $role = Role::where('name', '!=', 'Admin')->when(! empty($roleName), function (Builder $q) use ($roleName) {
            $q->where('name', '!=', $roleName);
        })->pluck('name', 'id');

        return view('users.create', compact('role', 'isAgent'));
    }

    /**
     * @return RedirectResponse
     *
     * @throws \Throwable
     */
    public function store(CreateUserRequest $request): RedirectResponse
    {
        $input = $request->all();
        $isAgent = str_contains(url()->previous(), 'agents');
        $input['role'] = $isAgent ? getAgentRoleId() : getCustomerRoleId();
        $user = $this->userRepository->store($input);
        if ($request->ajax()) {
            return $this->sendResponse($user, __('messages.success_message.customer_create'));
        }
        if ($isAgent) {
            Flash::success(__('messages.success_message.agent_create'));

            return redirect()->route('agent.index');
        } else {
            Flash::success(__('messages.success_message.customer_create'));

            return redirect()->route('customer.index');
        }
    }

    /**
     * @param  User  $id
     * @return Application|Factory|View
     */
    public function show(User $id): View
    {
        $user = User::with(['ticket', 'media'])->findOrFail($id);
        $isAgent = str_contains(url()->current(), 'agents');
        $statusArray = Ticket::STATUS;
        $categories = Category::orderBy('name')->pluck('name', 'id')->toArray();
        $statusColorArray = Ticket::STATUS_COLOR;

        return view('users.show', compact('user', 'statusArray', 'statusColorArray', 'isAgent', 'categories'));
    }

    /**
     * @return Factory|View
     */
    public function edit(User $user): View
    {
        $user->media;
        $user->load('roles');
        $isAgent = str_contains(url()->current(), 'agents');
        $roleName = $isAgent ? 'Customer' : 'Agent';
        $role = Role::where('name', '!=', 'Admin')->when(! empty($roleName), function (Builder $q) use ($roleName) {
            $q->where('name', '!=', $roleName);
        })->pluck('name', 'id');

        return view('users.edit', compact('user', 'role', 'isAgent'));
    }

    /**
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $input = $request->all();
        $isAgent = str_contains(url()->previous(), 'agents');
        $this->userRepository->update($input, $user->id);
        if (isset($input['role'])) {
            $user->syncRoles($input['role']);
        }

        if ($isAgent) {
            Flash::success(__('messages.success_message.agent_update'));

            return redirect()->route('agent.index');
        } else {
            Flash::success(__('messages.success_message.customer_update'));

            return redirect()->route('customer.index');
        }
    }

    /**
     * @return mixed
     *
     * @throws Exception
     */
    public function destroy(User $user)
    {
        // Delete created ticket of user and assigned ticket of user
        Ticket::whereCreatedBy($user->id)->delete();
        DB::table('ticket_user')->where('user_id', '=', $user->id)->delete();
        $user->delete();

        return $this->sendSuccess(__('messages.success_message.user_delete'));
    }

    /**
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $input = $request->all();

        try {
            $user = $this->userRepository->changePassword($input);

            return $this->sendSuccess(__('messages.success_message.password_update'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }
    }

    /**
     * @return mixed
     */
    public function changeLanguage(Request $request)
    {
        $defaultLanguage = $request->get('default_language');

        try {
            $user = getLoggedInUser();
            $user->update(['default_language' => $defaultLanguage]);

            return $this->sendSuccess(__('messages.success_message.language_update'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }
    }

    /**
     * @return JsonResponse
     */
    public function profileUpdate(UpdateUserProfileRequest $request): JsonResponse
    {
        $input = $request->all();

        try {
            $user = $this->userRepository->profileUpdate($input);

            return $this->sendResponse($user, __('messages.success_message.profile_update'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }
    }

    /**
     * @return JsonResponse
     */
    public function editProfile(): JsonResponse
    {
        $user = Auth::user();

        return $this->sendResponse($user, 'User retrieved successfully.');
    }

    /**
     * @return Application|Factory|View
     */
    public function customers(): View
    {
        return view('users.customers');
    }

    public function getEmailUpdateSetting()
    {
        $emailSetting = Auth::user()->email_update;

        return $this->sendResponse($emailSetting, 'Email setting retrieved successfully');
    }

    public function setEmailUpdateSetting(Request $request)
    {
        $emailSetting = is_null($request->input('email_setting')) ? 0 : 1;
        /** @var User $user */
        $user = $request->user();
        $user->update([
            'email_update' => $emailSetting,
        ]);

        return $this->sendSuccess(__('messages.success_message.email_setting_update'));
    }
}
