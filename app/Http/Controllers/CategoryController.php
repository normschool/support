<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Response;

class CategoryController extends AppBaseController
{
    /** @var CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     *  Display a listing of the Category.
     *
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        return view('categories.index');
    }

    /**
     * Store a newly created Category in storage.
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCategoryRequest $request)
    {
        $input = $request->all();

        $category = $this->categoryRepository->create($input);

        return $this->sendResponse($category, __('messages.success_message.category_save'));
    }

    /**
     * Display the specified Category.
     *
     *
     * @return Application|Factory|JsonResponse|View
     */
    public function show(Category $category)
    {
        $users = $assignees = User::whereHas('roles', function (Builder $query) {
            $query->where('id', '!=', getCustomerRoleId());
        })->pluck('name', 'id');

        return view('categories.show', compact('category', 'users', 'assignees'));
    }

    /**
     * Show the form for editing the specified Category.
     *
     *
     * @return Response
     */
    public function edit(Category $category)
    {
        return $this->sendResponse($category, 'Category Retrieved Successfully.');
    }

    /**
     * Update the specified Category in storage.
     *
     *
     * @return Response
     */
    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $input = $request->all();

        $this->categoryRepository->update($input, $category->id);

        return $this->sendSuccess(__('messages.success_message.category_update'));
    }

    /**
     * @return Response
     */
    public function destroy(Category $category)
    {
        $Models = [
            Ticket::class,
        ];
        $result = canDelete($Models, 'category_id', $category->id);
        if ($result) {
            return $this->sendError(__('messages.error_message.category_delete'));
        }
        $category->delete();

        return $this->sendSuccess(__('messages.success_message.category_delete'));
    }

    public function showAllCategories()
    {
        return view('web.category_list');
    }
}
