<?php

namespace App\Console\Commands;

use App\DTO\Order;
use App\Models\Sellasist\SellasistOrder;
use App\Repositories\Cosdlazdrowia\CosdlazdrowiaOrderRepository;
use App\Repositories\Hurt\HurtOrderRepository;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\Sellasist\SellasistOrderRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CopyOrdersCommand extends Command
{
    const CDZ_REPOSITORY = 'cdz';
    const HURT_REPOSITORY = 'hurt';

    const SYSTEM_ARG = 'system';
    const ORDER_ID_ARG = 'order_id';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:copy-orders-command {'.self::SYSTEM_ARG.'?} {'.self::ORDER_ID_ARG.'?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private SellasistOrderRepository $sellasistOrderRepository;

    public function __construct(SellasistOrderRepository $sellasistOrderRepository)
    {
        parent::__construct();
        $this->sellasistOrderRepository = $sellasistOrderRepository;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orders = [];
        if ($this->hasArgument(self::SYSTEM_ARG) || $this->hasArgument(self::ORDER_ID_ARG))
        {
            $selectedSystem = $this->argument(self::SYSTEM_ARG);
            $selectedOrderId = $this->argument(self::ORDER_ID_ARG);

            if (!in_array($selectedSystem, [self::CDZ_REPOSITORY, self::HURT_REPOSITORY])) {
                $this->error('Selected system is not allowed');
                return null;
            }
            if (strlen($selectedOrderId) === 0) {
                $this->error('Order id cant be empty');
                return null;
            }

            $orderRepositories = $this->getOrderRepositories();
            $orderRepository = $orderRepositories[$this->argument(self::SYSTEM_ARG)];
            $orders = $orderRepository->findById($selectedOrderId);
        } else {
            $orders = $this->getOrders();
        }

        /** @var Order $order */
        foreach ($orders as $order) {
            $this->storeOrder($order);
            dd();
        }
    }

    private function storeOrder(Order $order)
    {
        $sellasistOrder = $this->sellasistOrderRepository->findBySystemAndExternalOrderId(
            $order->getSystemName(),
            $order->getExternalId()
        );

        if ($sellasistOrder instanceof SellasistOrder === false) {
            $sellasistOrderId = $this->sellasistOrderRepository->createOrder($order);
            $order->getConnectedModel()->setSellasistOrderId($sellasistOrderId);
            $order->getConnectedModel()->save();
            dd($sellasistOrderId);
        }
    }

    private function getOrders()
    {
        $orderRepositories = $this->getOrderRepositories();

        $start = Carbon::now()->subDays(4);
        $orders = [];
        foreach ($orderRepositories as $orderRepository) {
            if ($orderRepository instanceof OrderRepositoryInterface) {
                $orders = array_merge($orders, $orderRepository->getOrdersFromDate($start));
            }
        }

        return $orders;
    }

    private function getOrderRepositories(): array
    {
        return [
            self::CDZ_REPOSITORY => new CosdlazdrowiaOrderRepository(),
            self::HURT_REPOSITORY => new HurtOrderRepository(),
        ];
    }
}
