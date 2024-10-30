<?php

namespace App\Http\Controllers\API;

use App\Events\PublicUserEvent;
use App\Events\UpdatesEvent;
use App\Http\Controllers\AppBaseController;
use App\Models\ArchivedUser;
use App\Models\AssignedChat;
use App\Models\BlockedUser;
use App\Models\Conversation;
use App\Models\User;
use App\Repositories\UserRepository;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class UserAPIController
 */
class UserAPIController extends AppBaseController
{
    /** @var UserRepository */
    private $userRepository;

    /**
     * Create a new controller instance.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsersList(): JsonResponse
    {
        $userIds = BlockedUser::orwhere('blocked_by', getLoggedInUserId())
            ->orWhere('blocked_to', getLoggedInUserId())
            ->pluck('blocked_by', 'blocked_to')
            ->toArray();

        $userIds = array_unique(array_merge($userIds, array_keys($userIds)));

        $users = User::whereNotIn('id', $userIds)
            ->orderBy('name', 'asc')
            ->select(['id', 'is_online', 'gender', 'photo_url', 'name'])
            ->limit(50)
            ->get()
            ->except(getLoggedInUserId());

        return $this->sendResponse(['users' => $users], 'Users retrieved successfully.');
    }

    public function getUsers(): JsonResponse
    {
        $users = User::orderBy('name', 'asc')->get()->except(getLoggedInUserId());

        return $this->sendResponse(['users' => $users], 'Users retrieved successfully.');
    }

    public function getProfile(): JsonResponse
    {
        /** @var User $authUser * */
        $authUser = getLoggedInUser();
        $authUser->roles;
        $authUser = $authUser->apiObj();

        return $this->sendResponse(['user' => $authUser], 'Users retrieved successfully.');
    }

    public function updateLastSeen(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = ($request->user()) ? $request->user() : User::find($request->get('userId'));

        $lastSeen = ($request->has('status') && $request->get('status') > 0) ? null : Carbon::now();

        $user->update(['last_seen' => $lastSeen, 'is_online' => $request->get('status')]);

        if ($request->get('userId')) {
            broadcast(new UpdatesEvent([
                'user_id' => $user->id,
                'type' => User::FRONT_USER_ONLINE,
                'status' => $request->get('status'),
            ]))->toOthers();
        }

        return $this->sendResponse(['user' => $user], 'Last seen updated successfully.');
    }

    public function removeProfileImage(): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $user->deleteImage();

        return $this->sendSuccess('Profile image deleted successfully.');
    }

    /**
     * @throws Exception
     */
    public function archiveChat($ownerId): JsonResponse
    {
        $archivedUser = ArchivedUser::whereOwnerId($ownerId)->whereArchivedBy(getLoggedInUserId())->first();
        $ownerType = User::class;

        if (empty($archivedUser)) {
            ArchivedUser::create([
                'owner_id' => $ownerId,
                'owner_type' => $ownerType,
                'archived_by' => getLoggedInUserId(),
            ]);
        } else {
            $archivedUser->delete();

            return $this->sendResponse(['archived' => false], 'Chat unarchived successfully.');
        }

        return $this->sendResponse(['archived' => true], 'Chat archived successfully.');
    }

    /**
     * @return mixed
     */
    public function assignAgent(Request $request)
    {
        $agentId = $request->get('agentId');
        $userId = $request->get('userId');
        /** @var AssignedChat $assignChat */
        $assignChat = AssignedChat::create([
            'customer_id' => $userId,
            'user_id' => $agentId,
        ]);
        Conversation::whereFromId(getAdminUserId())->whereToId($userId)->update(['from_id' => $agentId]);
        Conversation::whereFromId($userId)->whereToId(getAdminUserId())->update(['to_id' => $agentId]);

        broadcast(new PublicUserEvent([
            'type' => User::PUBLIC_CHAT_ASSIGNED,
            'assignedTo' => $agentId,
        ], $userId))->toOthers();

        $name = $assignChat->agent->name;

        return $this->sendResponse($name, 'Agent Assigned successfully.');
    }
}
