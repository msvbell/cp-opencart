<?php


namespace Compassplus\Sdk\Request\XML;

use Compassplus\Sdk\Operation\Operation;
use Compassplus\Sdk\OrderPayment;
use Compassplus\Sdk\Request\DataProvider;
use Compassplus\Sdk\Service;
use function str_replace;

/**
 * Class Payment
 * @package Compassplus\Request\XML
 */
class Payment extends DataProvider
{

    /**
     * Payment constructor.
     * @param Operation $operation
     */
    public function __construct(Operation $operation)
    {
        parent::__construct($operation);
    }

    /**
     * @return mixed|string
     */
    public function getRequestData()
    {
        $service = new Service();
        $requestBody = [
            "Request" => [
                "Operation" => "CreateOrder",
                "Language" => "",
                "Order" => [
                    "OrderType" => "Payment",
                    "Merchant" => $this->operation->merchant->getId(),
                    "Amount" => $this->operation->order->getAmount(),
                    "Currency" => $this->operation->order->getCurrency(),
                    "Description" => $this->operation->order->getDescription(),
                    "ApproveURL" => $this->operation->merchant->getApproveUrl(),
                    "CancelURL" => $this->operation->merchant->getCancelUrl(),
                    "DeclineURL" => $this->operation->merchant->getDeclineUrl()
                ]
            ]
        ];

        if (!empty($this->operation->customer->getEmail())) {
            $requestBody["Request"]["Order"]["email"] = $this->operation->customer->getEmail();
        }
        if (!empty($this->operation->customer->getPhone())) {
            $requestBody["Request"]["Order"]["phone"] = $this->operation->customer->getPhone();
        }
        $requestBody["Request"]["Order"]["AddParams"] = array();
        $requestBody["Request"]["Order"]["AddParams"] = $this->getAddParams($this->operation->order);

        $xml = $service->write("TKKPG", $requestBody);

        if ($xml) {
            return $xml;
        } else {
            throw new \UnexpectedValueException("XML is not generated");
        }
    }

    /**
     * @param OrderPayment $orderExt
     * @return array
     */
    public function getAddParams(OrderPayment $orderExt)
    {
        $addParams = array();
        $addParams["VendorID"] = $orderExt->getVendorId();
        $addPaymentParams = $orderExt->getPaymentParams();
        $addPaymentParams = str_replace("/", "\/", $addPaymentParams);
        $addPaymentParams = str_replace("\\", "\\\\", $addPaymentParams);
        if (!empty($addPaymentParams)) {
            $addParamList = "";
            foreach ($addPaymentParams as $paramData) {
                if (!empty($addParamList)) {
                    $addParamList .= "/";
                }
                $addParamList .= $paramData;
            }
            $addParams["PaymentParams"] = $addParamList;
        }
        return $addParams;
    }
}
