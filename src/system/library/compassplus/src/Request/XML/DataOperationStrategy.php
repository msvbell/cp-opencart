<?php


namespace Compassplus\Sdk\Request\XML;

use Compassplus\Sdk\Operation\Operation;
use Compassplus\Sdk\Operation\OperationType;
use Compassplus\Sdk\Request;

/**
 * Class Data
 *
 * @package Compassplus\DataProvider\XML
 */
class DataOperationStrategy extends Request\DataOperationStrategy
{
    /**
     * @var Request\DataProvider
     */
    private $dataProvider;

    /**
     * Data constructor.
     *
     * @param OperationType $operationType
     * @param Operation $operation
     */
    public function __construct($operationType, Operation $operation)
    {
        $this->dataProvider = $this->loadOperationProvider($operationType, $operation);
    }

    /**
     * @param $operationType
     * @param Operation $operation
     * @return \Compassplus\Request\DataProvider
     */
    protected function loadOperationProvider($operationType, Operation $operation)
    {
        $dataProvider = null;
        switch ($operationType) {
            case OperationType::PURCHASE:
                $dataProvider = new Purchase($operation);
                break;
            case OperationType::REVERSE:
                $dataProvider = new Reverse($operation);
                break;
            case OperationType::ORDERSTATUS:
                $dataProvider = new OrderStatus($operation);
                break;
            case OperationType::ORDER_INFORMATION:
                $dataProvider = new OrderInformation($operation);
                break;
            case OperationType::REFUND:
                $dataProvider = new Refund($operation);
                break;
            case OperationType::ORDER_PREAUTHORISATION:
                $dataProvider = new OrderPreAuthorization($operation);
                break;
            case OperationType::COMPLETION:
                $dataProvider = new Completion($operation);
                break;
            case OperationType::PAYMENT:
                $dataProvider = new Payment($operation);
                break;
            default:
                throw new \InvalidArgumentException("Unknown operation type");
        }
        return $dataProvider;
    }

    /**
     * @return mixed
     */
    public function getRequestPayload()
    {
        return $this->dataProvider->getRequestData();
    }
}
