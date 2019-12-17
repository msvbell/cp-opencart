<?php


namespace Compassplus\Sdk\Response;

/**
 * Class Order
 *
 * @package Compassplus\Response
 */
class Order extends Response
{
    /**
     * @return string
     */
    public function getPaymentUrl()
    {
        return $this->getURL() . '?SESSIONID=' . $this->getSessionID() . '&ORDERID=' . $this->getOrderId();
    }

    /**
     * @return string
     */
    public function getURL()
    {
        return $this->getString('URL');
    }

    /**
     * @return string
     */
    public function getSessionID()
    {
        return $this->getString('SessionID');
    }

    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->getInteger('OrderID');
    }
}
