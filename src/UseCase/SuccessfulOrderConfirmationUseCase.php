<?php

namespace App\UseCase;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;

class SuccessfulOrderConfirmationUseCase
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function sucOrder(string $status,string $url)
    {

        $this->entityManager->beginTransaction();
        $findId = explode('/', $url);
        $order = $this->entityManager->getRepository(Order::class)->find($findId[count($findId) - 1]);

        if (!$order) {
            $this->entityManager->rollback();
            throw new \Exception('No order found for id');
        }
        $order->setStatus($status);
        $this->entityManager->flush();
        $this->entityManager->commit();
    }


}