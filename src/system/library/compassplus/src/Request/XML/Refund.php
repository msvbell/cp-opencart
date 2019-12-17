<?php


namespace Compassplus\Sdk\Request\XML;

use Compassplus\Sdk\Request\DataProvider;
use Compassplus\Sdk\Service;

/**
 * Class Refund
 *
 * @package Compassplus\DataProvider\XML
 */
class Refund extends DataProvider
{
    /**
     *
     */
    public function getRequestData()
    {
        $service = new Service();
        $xml = $service->write("TKKPG", [
            "Request" => [
                "Operation" => "Refund",
                "Language" => "",
                "Order" => [
                    "Merchant" => $this->operation->merchant->getId(),
                    "OrderID" => $this->operation->order->getOrderId(),
                ],
                "SessionID" => $this->operation->order->getSessionId(),
                "Refund" => [
                    "Amount" => $this->operation->getRefundAmount(),
                    "Currency" => $this->operation->getRefundCurrency()
                ],
                "PAN" => $this->operation->card->getPan(),
                "CardUID" => "",
                "TranId" => ""
            ]
        ]);

        if ($xml) {
            return $xml;
        } else {
            throw new \UnexpectedValueException("XML is not generated");
        }
    }
}
