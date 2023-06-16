<?php

namespace App\UseCase;

use App\DTO\OrderDTO\ResponseOrderDTO;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;

class DeleteOrderUseCase
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function delete(string $url): ResponseOrderDTO
    {
        $this->entityManager->beginTransaction();
        $findIdInUrl = explode('/', $url);
        $order = $this->entityManager->getRepository(Order::class)->find($findIdInUrl[count($findIdInUrl) - 1]);
        if (!$order) {
            $this->entityManager->rollback();
            throw new \Exception("No order found for id");
        }
        $this->entityManager->remove($order);
        $this->entityManager->flush();

        return new ResponseOrderDTO($findIdInUrl[count($findIdInUrl) - 1]);
    }


}