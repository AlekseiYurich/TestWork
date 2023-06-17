<?php

namespace App\Tests\src\UseCase;

use App\DTO\OrderDTO\OrderDTO;
use App\UseCase\CreateOrderUseCase;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderUseCaseTest extends KernelTestCase
{
    /**
     * @dataProvider AddNewProvider
     */
    public function testAddOrder(string $status, string $customer)
    {
        $em = $this->createMock(EntityManager::class);
        $validato = $this->createMock(ValidatorInterface::class);
        if(empty($status) || empty($customer)){
            $this->expectException(\Exception::class);
        } else {
            $em->expects(self::once())->method('persist')->willReturn(null);
            $em->expects(self::once())->method('flush')->willReturn(null);
        }

        $useCase = new CreateOrderUseCase($em,$validato);
        $dto = new OrderDTO();
        $dto->setCustomer($customer)
            ->setStatus($status);

        $useCase->createOrder($dto);
        $this->assertTrue(true);
    }

    public function addNewProvider()
    {
        yield  'test one' => [
            'customer' =>'Dima',
            'status' => 'delivery',
        ];

        yield  'test two' => [
            'customer' =>'Dasha',
            'status' => '',
        ];

    }

}