<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Service;
use App\Entity\User\User;
use App\Entity\WorkerAvailableTime;
use App\Form\OrderFormType;
use App\Repository\OrderRepository;
use App\Service\CustomDataFormatter;
use App\Service\Notifier\TelegramSender;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Notifier\ChatterInterface;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route(path: 'api/orders', name: 'app_orders', methods: ['GET'])]
    public function getAllOrders(
        OrderRepository $orderRepository
    ): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $orders = $orderRepository->findAll();
        return $this->json($orders, Response::HTTP_OK, [], ['groups' => [
            'orderShort',
            'order_client',
            'order_worker',
            'userShort'
        ]]);
    }

    #[Route(path: 'api/orders', name: 'app_orders_post', methods: ['POST'])]
    public function addOrder(
        EntityManagerInterface $em,
        Request $request,
        TelegramSender $telegramSender,
        CustomDataFormatter $customDataFormatter,
        ChatterInterface $chatter
    ): Response
    {
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(OrderFormType::class, null, ['csrf_protection' => false]);
        $form->submit($data);

        if ($form->isValid()) {
            $worker = $em->getRepository(User::class)->findOneBy(['id' => $data['master_id']]);
            $service = $em->getRepository(Service::class)->findOneBy(['id' => $data['service_id']]);
            $time = $em->getRepository(WorkerAvailableTime::class)->findOneBy(['id' => $data['time_id']]);

            $order = new Order();
            $order->setClientName($data['client_name']);
            $order->setClientEmail($data['email']);
            $order->setClientPhone($data['phone']);
            $order->setClientTelegram($data['telegram']);
            $order->setClientContactType($data['notification_type']);

            $order->setWorker($worker);
            $order->setService($service);
            $order->addTime($time);
            $time->setIsTimeFree(false);

            $order->setStatus(1);

            $em->persist($order);
            $em->flush();

            $serviceStartTime = $customDataFormatter->getConvertedWorkerAvailableExactTime($time->getExactTimeInMinutes());
            $serviceEndTime = $customDataFormatter->getConvertedWorkerAvailableExactTime(
                $time->getExactTimeInMinutes() + $service->getDuration() * 30
            );
            $serviceDate = date_format($time->getExactDate(), 'Y-m-d');
            if ($worker->getTelegram()) {
                $message = <<<STR
                ?? ?????? ?????????????????? {$data['client_name']} (tg: {$data['telegram']}) ???? $serviceDate $serviceStartTime-$serviceEndTime.
                ???????????? - {$service->getName()}.
                STR;
                $telegramSender->sendMessage($message, $worker->getTelegram(), $chatter);
            }
            if (isset($data['telegram'])) {
                $message = <<<STR
                ???? ???????????????????? ?? {$worker->getName()} (??.??.: {$worker->getMobilePhoneNumber()}) ???? $serviceDate $serviceStartTime-$serviceEndTime.
                ???????????? - {$service->getName()}, ?????????????????? - {$service->getPrice()} ????????????.
                STR;
                $telegramSender->sendMessage($message, $data['telegram'], $chatter);
            }

            return $this->json($order, Response::HTTP_CREATED, [], ['groups' => [
                'orderShort'
            ]]);
        }

        return $this->json($form, Response::HTTP_BAD_REQUEST);
    }
}
