<?php
 namespace Compassplus\Sdk; use Compassplus\Sdk\Operation\OperationType; use Exception; use Psr\Http\Message\ResponseInterface; class Payment { private $operation; private $connector; public function __construct(Order $order, Merchant $merchant, Customer $customer, Connector $connector) { $this->operation = new Operation\Operation($order, $customer, $merchant); $this->connector = $connector; } public function purchase() { $response = $this->send(OperationType::PURCHASE); return new Response\Order($response); } private function send($operationType) { $data = $this->payload($operationType); error_log(print_r($data, 1)); $this->connector->orderData = $data; return $this->connector->sendRequest(); } public function debug() { $this->connector->debug(); return $this; } private function payload($operationType) { $data = new Request\DataProviderStrategy($operationType, $this->operation); return $data->getPayload(); } public function reverse() { $response = $this->send(OperationType::REVERSE); return new Response\Reverse($response); } public function orderStatus() { $response = $this->send(OperationType::ORDERSTATUS); return new Response\OrderStatus($response); } public function orderInformation() { $response = $this->send(OperationType::ORDER_INFORMATION); return new Response\OrderInformation($response); } public function preAuthorisation() { $response = $this->send(OperationType::ORDER_PREAUTHORISATION); return new Response\Order($response); } public function completion() { $response = $this->send(OperationType::COMPLETION); return new Response\Completion($response); } public function payment() { $response = $this->send(OperationType::PAYMENT); return new Response\Order($response); } public function refund($amount, $currency) { $this->operation->setRefundAmount($amount); $this->operation->setRefundCurrency($currency); $response = $this->send(OperationType::REFUND); return new Response\Refund($response); } } 