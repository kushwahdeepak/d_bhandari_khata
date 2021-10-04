<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Main Controller
 */
class Admin extends Main_Controller
{
    public $userInfo = null;
    public $login_party_id = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model('adminmodel');
        $this->load->model('tarnsaction_model');
        $this->load->helper(array('url'));

        $this->userInfo = $this->session->admin_login_data;
        $this->checkAuthentication();
    }

    public function updateCronJobForChart()
    {
        $loans = $this->adminmodel->getAllLoans();


        $chart_array = array();
        if(isset($loans) && !empty($loans))
        {
            foreach ($loans as $loan) 
            {
                $created_date_list = $this->loanmodel->getLoansByDate($loan->admin_id, $loan->created_date, "created_date");
                $completed_date_list = $this->loanmodel->getLoansByDate($loan->admin_id, $loan->created_date, "completed_date");
                $created_amount = 0;
                $completed_amount = 0;
                if(isset($created_date_list) && !empty($created_date_list))
                {
                    foreach($created_date_list as $created_date_data)
                    {
                        if(isset($created_date_data->amount) && !empty($created_date_data->amount))
                        {
                            $created_amount = $created_amount + $created_date_data->amount;
                        }
                    }
                }
                if(isset($completed_date_list) && !empty($completed_date_list))
                {
                    foreach($completed_date_list as $completed_date_data)
                    {
                        if(isset($completed_date_data->amount) && !empty($completed_date_data->amount))
                        {
                            $completed_amount = $completed_amount + $completed_date_data->completed_amount;
                        }
                    }
                }
                $chart_array = array(
                    'admin_id' => $loan->admin_id,
                    'created_date' => $loan->created_date,
                    'number_of_loan' => count($created_date_list),
                    'number_of_completed_loan' => count($completed_date_list),
                    'initial_amount' => $created_amount,
                    'completed_amount' => $completed_amount,
                );
                $chart_date_status = $this->adminmodel->getChartInfoOnDate($loan->created_date);
                if(isset($chart_date_status) && !empty($chart_date_status))
                {
                    $this->db->where('created_date',$loan->created_date);
                    $this->db->update('chart_info',$chart_array);
                }
                else
                {
                    $this->db->insert('chart_info',$chart_array);
                }
            }
        }
    }

    public function getLoanChartInfo()
    {
        $admin_id =  $this->userInfo['admin_id'];

        $chartList = $this->adminmodel->getAllChartInfo($admin_id);

        $chart_array = array();
        if(isset($chartList) && !empty($chartList))
        {
            foreach ($chartList as $chartInfo) 
            {
                $chart_array[] = array(
                    'created_date' => $chartInfo->created_date,
                    'total_loan_on_date' => $chartInfo->number_of_loan,
                    'total_completed_loan_on_date' => $chartInfo->number_of_completed_loan,
                    'created_amount' => $chartInfo->initial_amount,
                    'completed_amount' => $chartInfo->completed_amount,
                );
            }
        }
        echo json_encode($chart_array);
    }


    
    // account page
    public function index($call = " " , $active = "basic_info")
    {
        $id =  $this->userInfo['admin_id'];
        $this->mPagetitle = 'Account';
        $this->mViewData['data'] = array(
            'admin_id' => $this->userInfo['admin_id'],
            'pageName' => 'ACCOUNT',
            'active' => $active,
            'adminBasicInfo' => $this->adminmodel->getUserBasicInfo($this->userInfo['admin_id']),
            'rate' => $this->adminmodel->getRate(),
            'bank_details' => $this->bankmodel->BankDetails(),
        );
        if($call == 'ajax')
        {
            $this->ajaxRender('admin/account');
        }
        else
        {
            $this->render('admin/account');
        }
    }

    // Dashboard page
    public function dashboard($call = " " , $active = "basic_info")
    {
        $id =  $this->userInfo['admin_id'];
        $this->mPagetitle = 'Dashboard';
        $this->mViewData['data'] = array(
            'admin_id' => $this->userInfo['admin_id'],
            'pageName' => 'DASHBOARD',
            'active' => $active,
            'id' => $id,
            'adminBasicInfo' => $this->adminmodel->getUserBasicInfo($this->userInfo['admin_id']),
            'rate' => $this->adminmodel->getRate(),
            'bank_details' => $this->bankmodel->BankDetails(),
            'loans' => $this->loanmodel->getAdminLoans($id),
            'transactions' => $this->tarnsaction_model->getAdminTransactions($id),
        );
        if($call == 'ajax')
        {
            $this->ajaxRender('admin/dashboard');
        }
        else
        {
            $this->render('admin/dashboard');
        }
    }
    

    // Update Admin Basic Info
    public function updateUserInfo()
    {
        $admin_id = $this->input->post('admin_id');
        
        $model_data = array(
            'admin_id' => $admin_id,
            'e_mail' => $this->input->post('e_mail'),
            'f_name' => $this->input->post('f_name'),
            'l_name' => $this->input->post('l_name'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city'),
            'postal_code' => $this->input->post('postal_code'),
            'state' => $this->input->post('state'),
            'name_of_organisation' => $this->input->post('name_of_organisation'),
            'establish_year' => $this->input->post('establish_year'),
            'registration_no' => $this->input->post('registration_no'),
            'aadhar_no' => $this->input->post('aadhar_no')

        );
        if($this->adminmodel->updateUserInfo($model_data))
        {
            echo json_encode(true);
        }
        // $this->session->set_flashdata('success_msg', 'Basic info updated');
        // redirect('admin/account/basic_info');
    }

    public function updateIntialInvestmentInfo()
    {

        $admin_id = $this->input->post('admin_id');
        
        $model_data = array(
            'admin_id' => $admin_id,
            'intial_investment' => $this->input->post('intial_investment'),

        );
        if($this->adminmodel->updateUserInfo($model_data)){
            echo json_encode(true);
        }
        // $this->session->set_flashdata('success_msg', 'Basic info updated');
        // redirect('admin/account/basic_info'); 
    }

    


   public function updateUserPasswordInfo()
    {
        $party_id = $this->input->post('party_id');
        $model_data = array(
                            'party_id' => $party_id,
                            'new_password' => $this->input->post('new_password'),
                            'con_new_password' => $this->input->post('con_new_password'),
                            );
        if ($model_data['new_password'] == $model_data['con_new_password']) 
           {
                $this->adminmodel->updateUserPasswordInfo($model_data);
                echo json_encode(true);
            } 
         
    }

    public function updateRateTable()
    {  
        $model_data = array(
            'gold' => $this->input->post('gold'),
            'silver' => $this->input->post('silver'),
        );
        if($this->adminmodel->updateRate($model_data))
        {
             echo json_encode(true);
        }
    }

    public function getBankDetails()
    {  
        $model_data = array(
            'gold' => $this->input->post('gold'),
            'silver' => $this->input->post('silver')
        );
        $this->adminmodel->updateRate($model_data);
        $this->session->set_flashdata('success_msg', 'Rate Table Updated');
        redirect('admin/index/rate_table');
    }


    public function userProfilePicture()
    {
        
        $fileName = $this->image_resize_model->resizeCustomImage('images/profile/', 600);
        $fileName = $this->image_resize_model->resizeCustomImage('images/profile/', 400);
        $data = array(
            'admin_id' => $this->userInfo['admin_id'],
            'admin_img' => $fileName,
        );
        if($this->adminmodel->updateAdminProfilePicture($data))
        {
            echo json_encode(true, $fileName);
        }
    }

    public function getRate()
    {
        $rate = $this->adminmodel->getRate();
        echo json_encode($rate);
    }
// ==========-----------------------Sub Admin ---------------------============================= 
    public function subadmin($call = "")
    {
        $this->mPagetitle = 'Sub_admin';
        $this->mViewData['data'] = array(
            'pageName' => 'SUBADMIN'
        );
        if($call == 'ajax' ){
             $this->ajaxRender('admin/sub_admin');
        }
        else{
             $this->render('admin/sub_admin');
        }
    }

    
    public function addSubAdminInfo($call = "")
    {
        $userInfo = $this->session->admin_login_data;
        $password  = $this->input->post('password');

         $CURRENT_PASSWORD = password_hash($password, PASSWORD_BCRYPT);
        $fileName = $this->image_resize_model->resizeCustomImage('images/profile/', 300);
        $sub_Admin_data = array(
            'admin_img'     => $fileName,
            'f_name'     => $this->input->post('first_name'),
            'l_name'     => $this->input->post('last_name'),
            'e_mail'     => $this->input->post('email'),
            'phone'      => $this->input->post('phone'),
            'name_of_organisation'     => $this->input->post('name_oraganisation'),
            'establish_year'     => $this->input->post('establish_year'),
            'intial_investment'     => $this->input->post('intial_investment'),
            'initial_investment_by_admin'     => $this->input->post('intial_investment'),
            'registration_no'     => $this->input->post('ragistration_no'),
            'city'       => $this->input->post('city'),
            'state'      => $this->input->post('state'),
            'address'    => $this->input->post('address'),
            'postal_code'=> $this->input->post('postal_code'),
            'aadhar_no'  => $this->input->post('aadhar_no'),
            'password'   => $CURRENT_PASSWORD,
            'admin_type'  => 'admin',
            'status' => 0,
            'created_date'=>date('Y-m-d'),  
            'deleted_date'=>0000-00-00,  

        );
        if($this->adminmodel->addSubAdminDetails($sub_Admin_data))
        {
            echo json_encode(true);
        }
    }

    function fetch_details()
    {   
        $fetch_data = $this->adminmodel->make_datatables();
        $data = array();
        foreach($fetch_data as $subadmin)  
        { 
            $sub_array = array();
            $admin_id = $subadmin->admin_id;

            $admin_num_of_loan = 0;
            $admin_total_loan_amount = 0;
            $loan_amount_with_intrest = 0;
            $completed_loan = 0;
            $recived_amount = 0;
            $admin_loans = $this->loanmodel->getAdminLoans($admin_id);
            if(isset($admin_loans) && !empty($admin_loans))
            {
                foreach ($admin_loans as $loan) 
                {
                    if($loan->completed_date != '0000-00-00')
                    {
                        $completed_loan = $completed_loan + 1;                        
                    }
                    
                    if(isset($loan->completed_amount) && !empty($loan->completed_amount))
                    {
                        $recived_amount = $recived_amount + $loan->completed_amount_with_interst;
                    }

                    $admin_num_of_loan = $admin_num_of_loan + 1;
                    $admin_total_loan_amount = $admin_total_loan_amount + $loan->amount;




                    $loan_intrest_per_month =  $loan->amount / $loan->percentage;
                    $loan_intrest_per_day =  ($loan_intrest_per_month / 30);
                    // $customer_intrest_day = $this->loanmodel->customer_intrest_day($loan->created_date);
                    if($loan->completed_date == '0000-00-00')
                    {
                        $last_date = date('Y-m-d');
                    }
                    else
                    {
                        $last_date = $loan->completed_date;
                    }

                    $customer_intrest_day = $this->loanmodel->customer_dashboard_intrest_day($loan->created_date, $last_date);

                    if ($customer_intrest_day >= 365) 
                    {
                        $loan_intrest = 365 * $loan_intrest_per_day;
                        $amount_with_interst = $loan_intrest + $loan->amount;

                        $loan_intrest_per_month =  $amount_with_interst / $loan->percentage;
                        $loan_intrest_per_day =  ($loan_intrest_per_month / 30);
                        $customer_intrest_day = $customer_intrest_day - 365;
                        $loan_intrest = $customer_intrest_day * $loan_intrest_per_day;
                        $loan_amount_with_interst = $loan_intrest + $amount_with_interst;
                    }
                    else
                    {
                        $loan_intrest_per_month =  $loan->amount / $loan->percentage;
                        $loan_intrest_per_day =  ($loan_intrest_per_month / 30);
                        $loan_intrest = $customer_intrest_day * $loan_intrest_per_day;
                        $loan_amount_with_interst = $loan_intrest + $loan->amount;

                    }

                    $loan_amount_with_intrest = round($loan_amount_with_intrest + $loan_amount_with_interst);


                }
            }
            $admin_name = ucfirst($subadmin->f_name).' '.ucfirst($subadmin->l_name);
            $email = $subadmin->e_mail;
            $phone = $subadmin->phone;
            $aadhar = $subadmin->aadhar_no;
            $city = ucfirst($subadmin->city);
            $state = strtoupper($subadmin->state);
            $address = $subadmin->address;
            $postal_code = $subadmin->postal_code;
            $status = $subadmin->status;
            $name_of_organisation = $subadmin->name_of_organisation;
            if(isset($subadmin->registration_no) && !empty($subadmin->registration_no))
                $registration_no = $subadmin->registration_no;
            else
                $registration_no = "N/A";
            
            if(!empty($subadmin->admin_img))
            {
                $profile='<img src='.base_url().'images/profile/'.$subadmin->admin_img.' width="70" height="70" style="border-radius:50px;" onerror="this.onerror=null;this.src='.base_url().'assets/images/profile_img.jpg">';
            }
            else
            {
                $profile='<img src='.base_url().'assets/images/profile_img.jpg width="70" height="70" style="border-radius:50px;">';
            }
            

            if($status==1){
                $status ='<a href="javascript:void(0);" onclick="disableCustomerStatus('.$admin_id.');"><img src="'.base_url().'assets/images/true.png" width="30" height="30" title="Active"></a>';
            }
            else
            {
                $status='<a  href="javascript:void(0);" onclick="enableCustomerStatus('.$admin_id.');"><img src="'.base_url().'assets/images/false.png" width="30" height="30"></a>';
            }
            
            $personal="";
            $contact="";

            if(!empty($admin_name))  
                $personal.="<span class='user_name'>".$admin_name." </span>";

            if(!empty($email))  
                $contact.="<strong>Email:</strong> ".$email."<br>";

            if(!empty($phone))  
                $contact.="<img src=".base_url()."assets/images/mobile.png> ".$phone."<br>";

            if(!empty($aadhar)) 
                $contact.= "<span style='background: aqua;padding: 2px 8px;color: black;border-radius:50px;display: inline-table;margin-top: 5px;'><strong>Aadhar No: </strong>".$aadhar."</span><br>";


            $location="";

             if(!empty($address))
                $location.=$address."<br>";

            if(!empty($city))
                $location.=$city."<span> (".$postal_code.") </span>";

            if(!empty($state))
                $location.=$state."<br>";

            $sub_array = array(
                $profile,
                $personal,
                $contact,
                $location,
                $name_of_organisation,
                $registration_no,

                '<span class="yellow-cir">'.$admin_num_of_loan.'<span></span></span>',
                '<span class="yellow-cir" style="background:#00ffff !important">₹ '.$admin_total_loan_amount.'<span></span></span>',
                '<span class="yellow-cir" style="background:#00ffff !important">₹ '.$loan_amount_with_intrest.'<span></span></span>',
                '<span class="yellow-cir">'.$completed_loan.'<span></span></span>',
                '<span class="yellow-cir" style="background:#00ffff !important">₹ '.$recived_amount.'<span></span></span>',

                $status,
                $user_action ='<a href="javascript:void(0);" onclick=editsubadminDetails('.$admin_id.') class="btn btn-primary"><i class="fa fa-pencil"></i></a>',
            );

            $data[] = $sub_array; 
        }  
        $output = array(  
            "draw"            =>   intval($_POST["draw"]),  
            "recordsTotal"    =>   $this->adminmodel->get_all_data(),  
            "recordsFiltered" =>   $this->adminmodel->get_filtered_data(),  
            "data"            =>   $data  
        );  
        echo json_encode($output);  
    }

    function editsubadminDetails()
    {
      $id = $this->input->post('id');

        $details = $this->adminmodel->make_subadmindatatables($id);
        $form = '<h4>Personal Info:</h4>
                    <div class="row">
                       <input type="hidden" class="form-control" name="admin_id"  value = "'.$details->admin_id.'">
                       <input type="hidden" class="form-control" name="transection_id"  value = "'.$details->transection_id.'">
                        <div class="form-group col-sm-4 col-md-4">
                            <label class="control-label asterisk">First Name: </label>
                            <input type="text" class="form-control" name="first_name"  value = "'.$details->f_name.'">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label asterisk">Last Name: </label>
                            <input autocomplete="off" type="text" class="form-control"  name="last_name" value = "'.$details->l_name.'" >
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label asterisk">Initial Investment: </label>
                            <input autocomplete="off" type="text" class="form-control"  name="intial_investment" value = "'.$details->initial_investment_by_admin.'" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label ">Email: </label>
                            <input type="email" class="form-control"  name="email" value = "'.$details->e_mail.'">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label ">Phone: </label>
                            <input type="text" class="form-control"  name="phone" value = "'.$details->phone.'">
                        </div>
                         <div class="form-group col-md-4">
                            <label class="control-label k">Aadhar No: </label>
                            <input type="text" class="form-control" name="aadhar_no" value = "'.$details->aadhar_no.'">
                        </div>
                      
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="control-label asterisk">Address: </label>
                            <textarea type="text" class="form-control" name="address">'.$details->address.'</textarea>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label asterisk">City: </label>
                            <input type="text" class="form-control" name="city"  value = "'.$details->city.'" >
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label asterisk">State: </label>
                            <input type="text" class="form-control" name="state"  value = "'.$details->state.'" >
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label ">Postal Code: </label>
                            <input type="number" class="form-control" name="postal_code" value = "'.$details->postal_code.'">
                        </div>
                    </div>
                    <h4>Other Info:</h4>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label ">Name Of Organisation:</label>
                            <input type="text" class="form-control" name="name_oraganisation" value = "'.$details->name_of_organisation.'">
                        </div>
                         <div class="form-group col-md-4">
                            <label class="control-label ">Establish Year: </label>
                            <input type="date" class="form-control" name="establish_year" value = "'.$details->establish_year.'">
                        </div> 
                        <div class="form-group col-md-4">
                            <label class="control-label ">Registration No: </label>
                            <input type="number" class="form-control" name="ragistration_no" value = "'.$details->registration_no.'">
                        </div>
                    </div>                     
                    <div class="row">
                        <div class="form-group col-md-12">
                            <input type="submit" class="btn btn-primary bg_green pull-right" value="Update"/>
                        </div>
                    </div>' ;
        echo $form;            
    }

    public function editSubadminForm ()
    {
        $userInfo = $this->session->admin_login_data;
        $admin_id = $userInfo['admin_id'];
        $password  = $this->input->post('password');
        $date = array(
            'transection_id'   => $this->input->post('transection_id'),
            'admin_id'   => $this->input->post('admin_id'),
            'f_name'     => $this->input->post('first_name'),
            'l_name'     => $this->input->post('last_name'),
            'e_mail'     => $this->input->post('email'),
            'phone'      => $this->input->post('phone'),
            'name_of_organisation'     => $this->input->post('name_oraganisation'),
            'establish_year'     => $this->input->post('establish_year'),
            'intial_investment'     => $this->input->post('intial_investment'),
            'registration_no'     => $this->input->post('ragistration_no'),
            'city'       => $this->input->post('city'),
            'state'      => $this->input->post('state'),
            'address'    => $this->input->post('address'),
            'postal_code'=> $this->input->post('postal_code'),
            'aadhar_no'  => $this->input->post('aadhar_no'),
        );

        if(!empty($password))
        {
            $CURRENT_PASSWORD = password_hash($password, PASSWORD_BCRYPT); 

            $date['password'] = $CURRENT_PASSWORD;
        }

        $this->adminmodel->editsubadmin($date);
        echo json_encode(true);
    }

    public function addInitialAmount()
    {
        $userInfo = $this->session->admin_login_data;
        $admin_id = $userInfo['admin_id'];

        $date = array(
            'amount_add' => $this->input->post('amount_add'),
            'created_date'  => $this->input->post('created_date'), 
            'payable_type'  => $this->input->post('payable_type'),
            'Cheque_Number' => $this->input->post('Cheque_Number'),
            'region'        => $this->input->post('region'), 
            'admin_id'      => $admin_id,   
        );
        $total_amount = $this->adminmodel->addInitialAmount($date);
        echo json_encode($total_amount);
    }

}