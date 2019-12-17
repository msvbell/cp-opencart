<?php


namespace Compassplus\Sdk;

/**
 * Class OrderExt
 * @package Compassplus
 */
class OrderPayment extends Order
{
    /**
     * @var mixed
     */
    private $vendorId;
    /**
     * @var array
     */
    private $paymentParams;

    /**
     * @return mixed
     */
    public function getVendorId()
    {
        return $this->vendorId;
    }

    /**
     * @param $vendorId
     */
    public function setVendorId($vendorId)
    {
        $this->vendorId = $vendorId;
    }

    /**
     * @return array
     */
    public function getPaymentParams()
    {
        return $this->paymentParams;
    }

    /**
     * @param $paymentParams
     */
    public function setPaymentParams($paymentParams)
    {
        $this->paymentParams = $paymentParams;
    }
}
