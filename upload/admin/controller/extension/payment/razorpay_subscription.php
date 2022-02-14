<?php

class ControllerExtensionPaymentRazorpaySubscription extends Controller
{
    private $error = array();

    public function index()
    {
        $this->load->language('extension/payment/razorpay_subscription');

        $this->load->model('extension/payment/razorpay_subscription');
        $this->load->model('setting/setting');

        //$this->load->library('razorpay_subscription');
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('payment_razorpay_subscription', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true));
        }
     
        $this->document->setTitle($this->language->get('heading_title'));

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/payment/razorpay_subscription', 'user_token=' . $this->session->data['user_token'], true)
        );

        
        $this->load->model('localisation/language');
        $data['languages'] = array();
        foreach ($this->model_localisation_language->getLanguages() as $language) {
            $data['languages'][] = array(
                'language_id' => $language['language_id'],
                'name' => $language['name'] . ($language['code'] == $this->config->get('config_language') ? $this->language->get('text_default') : ''),
                'image' => 'language/' . $language['code'] . '/'. $language['code'] . '.png'
            );
        }

       

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');


        $this->response->setOutput($this->load->view('extension/payment/razorpay_subscription', $data));
    }

    public function plan_list()
    {
        $this->load->language('extension/payment/razorpay_subscription');
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('extension/payment/razorpay_plan_list', $data));
    }

    public function install()
    {
        $this->load->model('extension/payment/razorpay_subscription');
        
        $this->model_extension_payment_razorpay_subscription->createTables();
    }

    public function uninstall()
    {
        $this->load->model('extension/payment/razorpay_subscription');

        $this->model_extension_payment_razorpay_subscription->dropTables();
    }


    protected function validate()
    {
        if (!$this->user->hasPermission('modify', 'extension/payment/razorpay_subscription')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }


        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
    

   
}
?>