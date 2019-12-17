<?php


namespace Compassplus\Sdk\Request;

use Compassplus\Sdk\Operation\Operation;

/**
 * Class Data
 *
 * @package Compassplus\DataProvider
 */
abstract class DataOperationStrategy
{
    abstract public function getRequestPayload();

    /**
     * @param $operationType
     * @param Operation $operation
     * @return mixed
     */
    abstract protected function loadOperationProvider($operationType, Operation $operation);
}
