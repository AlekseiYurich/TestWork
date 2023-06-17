<?php

namespace App\Controller;

use App\DTO\OrderDTO\OrderDTO;
use App\Events\ExceptionEvents;
use App\Subscriber\ExceptionSubscriber;
use App\UseCase\CreateOrderUseCase;
use App\UseCase\DeleteOrderUseCase;
use App\UseCase\ShowOrderUseCase;
use App\UseCase\SuccessfulOrderConfirmationUseCase;
use App\UseCase\UpdateOrderUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class OrderController extends AbstractController
{
    #[Route('/create', name: 'app_order', methods: 'POST')]
    public function create(
        CreateOrderUseCase       $createOrderUseCase,
        OrderDTO                 $orderDTO,
        ExceptionSubscriber      $subscriber,
        EventDispatcherInterface $eventDispatcher
    ): Response
    {
        $eventDispatcher->addSubscriber($subscriber);
        try {
            $id = $createOrderUseCase->createOrder($orderDTO);

            return new JsonResponse($id);

        } catch (\Exception $e) {

            return new Response($eventDispatcher->dispatch(new ExceptionEvents($e->getMessage())));
        }
    }

    #[Route('/order/update/{arg}', name: 'update_order', methods: 'POST')]
    public function update(
        Request                  $request,
        OrderDTO                 $DTO,
        ExceptionSubscriber      $subscriber,
        EventDispatcherInterface $eventDispatcher,
        UpdateOrderUseCase       $case
    ): Response
    {
        $eventDispatcher->addSubscriber($subscriber);
        try {
            $case->updateOrder($DTO, $request->getPathInfo());

            return new JsonResponse('update successfully', 201);
        } catch (\Exception $e) {

            return new Response($eventDispatcher->dispatch(new ExceptionEvents($e->getMessage())));
        }

    }

    #[Route("/show/order", name: 'show_order', methods: 'GET')]
    public function show(ShowOrderUseCase $case): Response
    {
        try {
            $orders = $case->show();
            return new JsonResponse($orders);
        } catch (\Exception $e) {
            return new JsonResponse($e->getMessage());
        }

    }

    #[Route('/delete/order/{arg}', name: 'delete_order', methods: 'GET')]
    public function delete(Request $request, DeleteOrderUseCase $deleteOrderUseCase): Response
    {
        try {
            $id = $deleteOrderUseCase->delete($request->getPathInfo());

            return new JsonResponse($id);
        } catch (\Exception $e) {
            return new JsonResponse($e->getMessage());
        }

    }
    #[Route('/successful',name: 'successful_order',methods: 'POST')]
    public function successfulOrderConfirmation(Request $request,SuccessfulOrderConfirmationUseCase $confirmationUseCase) : Response
    {
        try {
            $confirmationUseCase->sucOrder($request['status'],$request->getPathInfo());
            return new JsonResponse('update successfully', 201);
        } catch (\Exception $e) {
            return new JsonResponse($e->getMessage());
        }
    }

}
