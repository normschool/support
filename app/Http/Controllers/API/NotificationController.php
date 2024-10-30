<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Notification;
use App\Repositories\NotificationRepository;
use Illuminate\Http\JsonResponse;

/**
 * Class NotificationController
 */
class NotificationController extends AppBaseController
{
    /** @var NotificationRepository */
    private $notificationRepo;

    /**
     * Create a new controller instance.
     */
    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepo = $notificationRepository;
    }

    /**
     * @return JsonResponse
     */
    public function readNotification(Notification $notification)
    {
        $this->notificationRepo->readNotification($notification->id);

        return $this->sendResponse($notification, 'Notification read successfully.');
    }

    /**
     * @return JsonResponse
     */
    public function readAllNotification()
    {
        $messageSenderIds = $this->notificationRepo->readAllNotification();

        return $this->sendResponse(['sender_ids' => $messageSenderIds], 'Read all notifications successfully.');
    }
}
