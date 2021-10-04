<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// NOTE: this controller inherits from MY_Controller instead of home_Controller,
// since no authentication is required

class Login extends MY_Controller
{

    public function index()
    {
        $this->load->model('loginmodel');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $result = $this->loginmodel->verify_login($email, $password);
      

        if (!$result) {
            $this->session->set_flashdata('error_msg', 'Incorrect credentials');
            redirect('login/loginPage');
        } else if ($result == 'NO_USER_FOUND') {
            $this->session->set_flashdata('error_msg', 'User not found');
            redirect('login/loginPage');
        } else if ($result->status == '1') 
        {
            $this->session->set_flashdata('error_msg', 'User deactivated');
            redirect('login/loginPage');

        }  else {
            $sess_array = array(
                'admin_id' => $result->admin_id,
                'admin_type' => $result->admin_type
            );
            $this->session->set_userdata('admin_login_data', $sess_array);
            $this->checkdashboard();
        }
    }

    // Dashboard page
    public function checkdashboard()
    {       

        $this->userInfo = $this->session->admin_login_data; 

        if ( $this->userInfo['admin_type'] == "admin" || $this->userInfo['admin_type'] == "super_admin") 
        {   
            redirect('admin');
        } 
        else {
            redirect('login/logout');
        }
    }

    // Logout function
    public function logout()
    {
        $this->session->unset_userdata('admin_login_data');
        redirect('login/loginPage');
    }

    /* function for opening login page
    used by logout function of login controller and
    MY_CONTROLLER is_logged_in method
    */
    public function loginPage()
    {
        $this->mViewData['data'] = array(
            'pageName' => "LOGIN",
        );
        $this->render('common/login');
    }

}

?>
