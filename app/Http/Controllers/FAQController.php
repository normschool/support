<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFAQRequest;
use App\Http\Requests\UpdateFAQRequest;
use App\Models\FAQ;
use App\Queries\FAQDataTable;
use App\Repositories\FAQRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class FAQController extends AppBaseController
{
    /** @var FAQRepository */
    private $FAQRepository;

    public function __construct(FAQRepository $FAQRepository)
    {
        $this->FAQRepository = $FAQRepository;
    }

    /**
     * Display a listing of the FAQ.
     *
     *
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new FAQDataTable)->get())->make(true);
        }

        return view('faqs.index');
    }

    /**
     * Store a newly created FAQ in storage.
     */
    public function store(CreateFAQRequest $request): JsonResource
    {
        $input = $request->all();
        $this->FAQRepository->create($input);

        return $this->sendSuccess(__('messages.success_message.faq_save'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FAQ $faq): JsonResponse
    {
        return $this->sendResponse($faq, 'FAQ Retrieved Successfully.');
    }

    /**
     * Show the form for editing the specified FAQ.
     */
    public function show(FAQ $faq): JsonResource
    {
        return $this->sendResponse($faq, 'FAQ Retrieved Successfully.');
    }

    /**
     * Update the specified FAQ in storage.
     */
    public function update(UpdateFAQRequest $request, FAQ $faq): JsonResource
    {
        $input = $request->all();
        $this->FAQRepository->update($input, $faq->id);

        return $this->sendSuccess(__('messages.success_message.faq_update'));
    }

    /**
     * Remove the specified FAQ from storage.
     *
     *
     *
     * @throws Exception
     */
    public function destroy(FAQ $faq): JsonResource
    {
        $faq->delete();

        return $this->sendSuccess('messages.success_message.faq_delete');
    }

    public function upload(Request $request)
    {
        $input = $request->all();
        $user = getLoggedInUser();

        $imageCheck = Media::where('collection_name', FAQ::FaqImg)->where('file_name',
            $input['image']->getClientOriginalName())->exists();
        if (! $imageCheck) {
            if ((! empty($input['image']))) {
                $media = $user->addMedia($input['image'])->toMediaCollection(FAQ::FaqImg);
            }
            $data['url'] = $media->getFullUrl();
            $data['mediaId'] = $media->id;

            return $this->sendResponse($data, __('messages.success_message.image_upload'));
        } else {
            $imageCheck = Media::where('collection_name', FAQ::FaqImg)->where('file_name',
                $input['image']->getClientOriginalName())->first();

            $data['url'] = $imageCheck->getFullUrl();
            $data['mediaId'] = $imageCheck->id;

            return $this->sendResponse($data, __('messages.success_message.image_upload'));
        }
    }
}
