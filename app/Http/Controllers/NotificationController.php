<?php

namespace App\Http\Controllers;

use App\Entity\PendingNotification;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
class NotificationController extends Controller
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(Request $request): JsonResponse
    {
        try {
            // Validación de formato
            $validated = $request->validate([
                'customerId' => 'required|string',
                'operatorId' => 'required|integer',
                'orderNumber' => 'required|string',
                'messageType' => 'required|string',
                'createdDate' => 'required|date',
            ]);

            $notification = new PendingNotification();
            $notification->setCustomerId($validated['customerId']);
            $notification->setOperatorId($validated['operatorId']);
            $notification->setOrderNumber($validated['orderNumber']);
            $notification->setMessageType($validated['messageType']);
            $notification->setCreatedDate(new \DateTime($validated['createdDate']));
            $this->entityManager->persist($notification);
            $this->entityManager->flush();
            return response()->json(['message' => 'Pending notification added successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to add pending notification.'], 500);
//            return response()->json($e->getMessage(), 500);
        }
    }
}
