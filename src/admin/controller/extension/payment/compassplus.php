<?php

require_once DIR_SYSTEM . 'library/compassplus/vendor/autoload.php';

class ControllerExtensionPaymentCompassplus extends Controller
{
    private $error = array();

    public function index()
    {
        $this->load->language('extension/payment/compassplus');
        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');
        $this->load->model('extension/payment/compassplus');


        $clientCert = $this->model_extension_payment_compassplus->getClientCert();

        if (($this->request->server['REQUEST_METHOD'] === 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('compassplus', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');
            $clientCert = $this->request->post['compassplus_client_cert'];
            if (!empty($clientCert)) {
                $this->model_extension_payment_compassplus->saveClientCertToFile($clientCert);
            } else {
                $this->error['error_client_cert'] = $this->language->get('error_client_cert');
            }

            $this->response->redirect($this->url->link('extension/extension', 'token='.$this->session->data['token'] . '&type=payment', true));
        }

        if (empty($clientCert)) {
            $this->error['error_client_cert'] = $this->language->get('error_client_cert');
        }

        /**********
         * Inputs *
         **********/

        // Host
        if (isset($this->request->post['compassplus_host'])) {
            $data['compassplus_host'] = $this->request->post['compassplus_host'];
        } else {
            $data['compassplus_host'] = $this->config->get('compassplus_host');
            if (empty($data['compassplus_host'])) {
                $this->error['error_compassplus_host'] = $this->language->get('error_compassplus_host');
            }
        }

        if (!empty($data['compassplus_host'])) {
            $urlParse = parse_url($data['compassplus_host']);
            $data['compassplus_host'] = sprintf("%s:%s", $urlParse['host'], $urlParse['port']);
            if (!empty($urlParse['path'])) {
                $data['compassplus_host'] .= $urlParse['path'];
            }
        }

        // Merchant ID
        if (isset($this->request->post['compassplus_merchant_account_id'])) {
            $data['compassplus_merchant_account_id'] = $this->request->post['compassplus_merchant_account_id'];
        } else {
            $data['compassplus_merchant_account_id'] = $this->config->get('compassplus_merchant_account_id');
            if (empty($data['compassplus_merchant_account_id'])) {
                $this->error['error_merchant_id'] = $this->language->get('error_merchant_id');
            }
        }

        // Client cert
        if (isset($this->request->post['compassplus_client_cert'])) {
            $data['compassplus_client_cert'] = $this->request->post['compassplus_client_cert'];
        } else {
            $data['compassplus_client_cert'] = $clientCert;
        }

        //Secret key
        if (isset($this->request->post['compassplus_secret_key'])) {
            $data['compassplus_secret_key'] = $this->request->post['compassplus_secret_key'];
        } else {
            $data['compassplus_secret_key'] = $this->config->get('compassplus_secret_key');
            if (empty($data['compassplus_secret_key'])) {
                $this->error['error_secret_key'] = $this->language->get('error_secret_key');
            }
        }

        // Secret key passphrase
        if (isset($this->request->post['compassplus_secret_key_passphrase'])) {
            $data['compassplus_secret_key_passphrase'] = $this->request->post['compassplus_secret_key_passphrase'];
        } else {
            $data['compassplus_secret_key_passphrase'] = $this->config->get('compassplus_secret_key_passphrase');
        }

        // Total
        if (isset($this->request->post['compassplus_total'])) {
            $data['compassplus_total'] = $this->request->post['compassplus_total'];
        } else {
            $data['compassplus_total'] = $this->config->get('compassplus_total');
        }

        // Order status
        if (isset($this->request->post['compassplus_order_status_id'])) {
            $data['compassplus_order_status_id'] = $this->request->post['compassplus_order_status_id'];
        } elseif ($this->config->get('compassplus_order_status_id')) {
            $data['compassplus_order_status_id'] = $this->config->get('compassplus_order_status_id');
        } else {
            $data['compassplus_order_status_id'] = '2';
        }

        $this->load->model('localisation/order_status');

        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        // Status

        if (isset($this->request->post['compassplus_status'])) {
            $data['compassplus_status'] = $this->request->post['compassplus_status'];
        } elseif ($this->config->get('compassplus_status')) {
            $data['compassplus_status'] = $this->config->get('compassplus_status');
        } else {
            $data['compassplus_status'] = 2;
        }

        if (isset($this->request->post['compassplus_sort_order'])) {
            $data['compassplus_sort_order'] = $this->request->post['compassplus_sort_order'];
        } else {
            $data['compassplus_sort_order'] = $this->config->get('compassplus_sort_order');
        }

        $texts = [
            'heading_title',
            'button_save',
            'button_cancel',
            'text_edit',
            'text_enabled',
            'text_disabled',
            'entry_host',
            'entry_merchant_id',
            'entry_secret_key',
            'entry_secret_key_passphrase',
            'entry_geo_zone',
            'entry_total',
            'entry_order_status',
            'text_all_zones',
            'entry_order_status',
            'entry_client_cert',
            'entry_status',
            'entry_debug',
            'help_debug',
            'help_total'
        ];

        foreach ($texts as $text) {
            $data[$text] = $this->language->get($text);
        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['error_compassplus_host'])) {
            $data['error_compassplus_host'] = $this->error['error_compassplus_host'];
        } else {
            $data['error_compassplus_host'] = '';
        }

        if (isset($this->error['error_merchant_id'])) {
            $data['error_merchant_id'] = $this->error['error_merchant_id'];
        } else {
            $data['error_merchant_id'] = '';
        }

        if (isset($this->error['error_client_cert'])) {
            $data['error_client_cert'] = $this->error['error_client_cert'];
        } else {
            $data['error_client_cert'] = '';
        }

        if (isset($this->error['error_secret_key'])) {
            $data['error_secret_key'] = $this->error['error_secret_key'];
        } else {
            $data['error_secret_key'] = '';
        }

        if (isset($this->error['error_secret_key_passphrase'])) {
            $data['error_secret_key_passphrase'] = $this->error['error_secret_key_passphrase'];
        } else {
            $data['error_secret_key_passphrase'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token='.$this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('extension/extension', 'token='.$this->session->data['token'] . '&type=payment', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/payment/compassplus', 'token='.$this->session->data['token'], true)
        );

        if (isset($this->request->post['compassplus_geo_zone_id'])) {
            $data['compassplus_geo_zone_id'] = $this->request->post['compassplus_geo_zone_id'];
        } else {
            $data['compassplus_geo_zone_id'] = $this->config->get('compassplus_geo_zone_id');
        }

        if (isset($this->request->post['compassplus_client_cert'])) {
            $data['compassplus_client_cert'] = $this->request->post['compassplus_client_cert'];
        } else {
            $data['compassplus_client_cert'] = $this->model_extension_payment_compassplus->getClientCert();
        }

        $this->load->model('localisation/geo_zone');

        $data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        $data['action'] = $this->url->link('extension/payment/compassplus', 'token='.$this->session->data['token'], true);
        $data['cancel'] = $this->url->link('marketplace/extension', 'token='.$this->session->data['token'] . '&type=payment', true);

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/payment/compassplus', $data));
    }

    protected function validate()
    {
        if (!$this->user->hasPermission('modify', 'extension/payment/compassplus')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->request->post['compassplus_merchant_account_id']) {
            $this->error['merchant_id'] = $this->language->get('error_merchant_id');
        }

        return !$this->error;
    }

    public function order()
    {
        $compassplus_order = $this->model_extension_payment_compassplus->getOrder($this->request->get['order_id']);
        $data['token'] = $this->session->data['token'];
        $data['order_id'] = $this->request->get['order_id'];
        $data['date'] = $compassplus_order['date_added'];
        $data['order_id'] = $compassplus_order['order_id'];
        $data['order_id_compassplus'] = $compassplus_order['compassplus_order_id'];
        $data['amount'] = $compassplus_order['total'];
        $data['currency'] = $compassplus_order['currency_code'];
        return $this->load->view('extension/payment/compassplus_order', $data);
    }

    /**
     * Возврат товара
     */
    public function refund()
    {
        $this->load->model('setting/setting');
        $this->load->model('extension/payment/compassplus');

        $data = array();
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $data['orderId'] = $this->request->get['order_id']; // compassplus order id
            $data['amount'] = $this->request->get['total'];


            $order_info = $this->model_extension_payment_compassplus->getOrder($data['orderId']);
            $data['sessionId'] = $order_info['session_id'];
            $data['merchantId'] = $this->config->get('compassplus_merchant_account_id');
            /** @var \Compassplus\Sdk\Response\Refund|boolean $refund */
            $refund = $this->model_extension_payment_compassplus->refund($data);
            if ($refund->getStatus() == '00') {
                return true;
            }
            return false;
        }
    }

    public function install()
    {
        $this->load->model('extension/payment/compassplus');

        $this->model_extension_payment_compassplus->install();
    }

    public function uninstall()
    {
        $this->load->model('extension/payment/compassplus');
        $this->model_extension_payment_compassplus->uninstall();
    }
}