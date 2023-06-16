<?php

namespace App\UseCase;

use App\DTO\OrderDTO\ResponseOrderDTO;
use App\Entity\LineOrder;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateOrderUseCase
{
    private EntityManagerInterface $entityManager;
    private ValidatorInterface $validator;


    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    public function createOrder(object $DTO): ResponseOrderDTO
    {
        $errors = $this->validator->validate($DTO);
        if($errors->count() > 0){
            throw new \Exception(implode(",", $errors));
        }

        $order = new Order($DTO->getCustomer(),$DTO->getStatus());

        try {
            $this->entityManager->beginTransaction();
            $this->entityManager->persist($order);

            $this->entityManager->flush();
        } catch (ORMException $e) {
            $this->entityManager->rollback();
            throw new \Exception($e->getMessage());

        }
        $this->entityManager->commit();
        return new ResponseOrderDTO($order->getId());
    }

}