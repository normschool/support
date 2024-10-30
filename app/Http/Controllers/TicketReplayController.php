<?php

namespace App\Http\Controllers;

use App\Models\TicketReplay;
use App\Repositories\TicketReplayRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TicketReplayController extends AppBaseController
{
    private $ticketReplayRepository;

    /**
     * TicketReplayController constructor.
     */
    public function __construct(TicketReplayRepository $ticketReplayRepository)
    {
        $this->ticketReplayRepository = $ticketReplayRepository;
    }

    /**
     * @throws \Throwable
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        /** @var TicketReplay $replay */
        $replay = $this->ticketReplayRepository->store($input);

        $replay->load('media');
        $replay->load('user');
        $replay->load('ticket');

        $adminRoleId = getAdminRoleId();
        $isAction = checkLoggedInUserRole();
        $ticket = $replay->ticket;

        $data['html'] = view('tickets.ticket_reply', compact('replay', 'adminRoleId', 'isAction', 'ticket'))->render();
        $data['id'] = $replay->id;

        return $this->sendResponse($data, __('messages.success_message.reply_create'));
    }

    public function update(TicketReplay $ticketReplay, Request $request): JsonResponse
    {
        $input = $request->all();
        $ticketReply = $this->ticketReplayRepository->update($input, $ticketReplay->id);

        return $this->sendResponse($ticketReply, __('messages.success_message.reply_update'));
    }

    /**
     * @throws Exception
     */
    public function destroy($id): JsonResponse
    {
        $ticketReply = TicketReplay::find($id)->delete();

        return $this->sendResponse($ticketReply, __('messages.success_message.reply_delete'));
    }

    /**
     * @throws Exception
     */
    public function deleteAttachment(Media $media): JsonResponse
    {
        $media->delete();

        return $this->sendSuccess(__('messages.success_message.attachment_has_delete'));
    }

    /**
     * @throws \Throwable
     */
    public function addAttachment(Request $request): JsonResponse
    {
        $input = $request->all();
        $attachment = $this->ticketReplayRepository->updateReplyWithAttachment($input, $input['replyId']);

        return $this->sendResponse($attachment, __('messages.success_message.ticket_reply'));
    }
}
