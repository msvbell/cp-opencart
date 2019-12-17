<?php


namespace Compassplus\Sdk;

use Compassplus\Sdk\Response\Response;

/**
 * Class OrderInfo
 * @package Compassplus
 */
class OrderInfo extends Response
{

    /**
     * @return string
     */
    public function getOrderStatus()
    {
        return $this->getString('OrderStatus');
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->getString('OrderID');
    }

    /**
     * @return string
     */
    public function getResponseDescription()
    {
        return $this->getString('ResponseDescription');
    }

    /**
     * @return string
     */
    public function getResponseCode()
    {
        return $this->getString('ResponseCode');
    }
}
