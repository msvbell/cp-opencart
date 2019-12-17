<?php

class ControllerExtensionPaymentCompassplus extends Controller
{
    private $logMessagePrefix = '[Compassplus]';
    private $template = "compassplus";

    /**
     * Установка данных для страницы оплаты и ее генерация
     */
    public function index()
    {

        $this->load->language('extension/payment/compassplus');
        $this->load->model('checkout/order');
        $this->load->model('extension/payment/compassplus');

        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
        $data = array();
        $data['order_id'] = $order_info['order_id'];
        $data['total'] = $order_info['total'];
        $data['currency_code'] = $order_info['currency_code'];
        $data['language_code'] = $order_info['language_code'];
        $data['email'] = $order_info['email'];
        $data['telephone'] = $order_info['telephone'];
        $data['ip'] = $order_info['ip'];

        $response = $this->model_extension_payment_compassplus->createOrder($data);
        if ($response->getStatus() == '00') {
            $template_data = array();
            $template_data["compassplus_order_id"] = $response->getOrderId();
            $template_data["session_id"] = $response->getSessionID();
            $template_data["host"] = $response->getURL();

            $this->log->write($response->getURL());

            $template_data['button_confirm'] = $this->language->get('button_confirm');

            return $this->load->view('extension/payment/' . $this->template, $template_data);
        } else {
            $this->session->data['error'] = 'Ошибка создания оплаты';
            $this->log->write(sprintf("%s ERROR: create order code %s", $this->logMessagePrefix, $response->getStatus()));
            $this->response->redirect($this->url->link('checkout/checkout', '', true));
        }
    }

    public function callback()
    {
        $this->load->language('extension/payment/compassplus_hosted');
        $this->load->model('checkout/order');
        $this->load->model('extension/payment/compassplus_hosted');

        $response_data = $this->request->post;

        $response_data = html_entity_decode($response_data['xmlmsg'], ENT_QUOTES, "utf-8");
        try {
            $orderInfo = new Compassplus\Sdk\OrderInfo($response_data);
        } catch (Exception $e) {
            $this->log->write(sprintf("%s ERROR. Response: %s", $this->logMessagePrefix, $e->getMessage()));
        }
        $orderStatus = $orderInfo->getOrderStatus();

        if (isset($this->session->data['order_id']) && $orderInfo->getOrderId() != '') {
            $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
            // If APPROVED
            if ($orderStatus == 'APPROVED') {
                $this->model_checkout_order->addOrderHistory($this->session->data['order_id'],
                    $this->config->get('payment_compassplus_hosted_order_status_id'));
                $this->response->redirect($this->url->link('checkout/success', '', true));
            } else {
                $this->session->data['error'] = 'Message : ' . $orderInfo->getResponseDescription() . '. Code : ' . $orderInfo->getResponseCode();
                $this->response->redirect($this->url->link('checkout/checkout', '', true));
            }
        } else {
            $this->session->data['error'] = 'Message : ' . $orderInfo->getResponseDescription() . $orderInfo->getOrderStatus() . $this->session->data['order_id'] . $orderInfo->getOrderId() . '. Code : ' . $orderInfo->getResponseCode();
            $this->response->redirect($this->url->link('account/login', '', true));
        }

    }
}