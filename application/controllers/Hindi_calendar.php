<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// NOTE: this controller inherits from MY_Controller instead of home_Controller,
// since no authentication is required

class Hindi_calendar extends MY_Controller
{

    public $userInfo = null;
    public $login_party_id = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model('adminmodel');
        $this->load->helper(array('url'));

        $this->userInfo = $this->session->admin_login_data;
    }


    public function index()
    {
        $this->mPagetitle = 'Account';
        $this->mViewData['data'] = array(
            'admin_id' => $this->userInfo['admin_id'],
            'pageName' => 'ACCOUNT',
            'active' => "",
            'adminBasicInfo' => $this->adminmodel->getUserBasicInfo($this->userInfo['admin_id']),
            'rate' => $this->adminmodel->getRate()
        );
        $this->render('calendar/calendar');  
    }

    public function updateDataWithDate()
    {
        $date = $this->input->post('date');
        $date = str_replace("00:00:00 GMT+0530 (India Standard Time)","",$date);
        $date = date('y-m-d',strtotime($date));

        $hindi_date = array( 
                            'tithi_name'   => $this->input->post('tithi_name'),
                            'count'   => $this->input->post('count'),
                            'date'   => $date,
                        );

        $this->hindi_calendar_model->updateUserInfo($hindi_date);
        echo json_encode(true);
    }

}

?>
