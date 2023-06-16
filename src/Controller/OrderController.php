<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\Annotation\Route;

class OrderController
{
    #[Route('/create',name: 'create',methods: 'POST')]
    public function create(EntityManager $entityManager)
    {

    }
}