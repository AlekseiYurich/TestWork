<?php

namespace App\UseCase;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;

class ShowOrderUseCase
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function show():array
    {
        $this->em->beginTransaction();
        $qb = $this->em->createQueryBuilder();
        $findDB = $qb->select('o')
            ->from(Order::class,'o')
            ->getQuery()
            ->getArrayResult();
        if(count($findDB) <= 0){
            $this->em->rollback();
            throw new \Exception('the search yielded no results');
        }
        $this->em->commit();
        return $findDB;
    }

}