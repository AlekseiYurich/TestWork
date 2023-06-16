<?php

namespace App\UseCase;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateOrderUseCase
{
    private EntityManagerInterface $em;
    private ValidatorInterface $validator;

    public function __construct(EntityManagerInterface $em, ValidatorInterface $validator)
    {
        $this->em = $em;
        $this->validator = $validator;
    }

    public function updateOrder(object $DTO, string $url)
    {
        $errors = $this->validator->validate($DTO);
        if ($errors->count() > 0) {
            throw new \Exception(implode(",", $errors));
        }
        $this->em->beginTransaction();
        $expUrl = explode('/', $url);
        $order = $this->em->getRepository(Order::class)->find($expUrl[count($expUrl) - 1]);

        if (!$order) {
            $this->em->rollback();
            throw new \Exception('No order found for id');
        }
        $order
            ->setStatus($DTO->getStatus())
            ->setCustomer($DTO->getCustomer());
        $this->em->flush();
        $this->em->commit();

    }

}