<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends Main_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->checkAuthentication();
    }


    public function index($call = ""){
    	$this->mPagetitle = 'Customer';
        $this->mViewData['data'] = array(
            'pageName' => 'CUSTOMER'
        );
        if($call=="ajax"){
             $this->ajaxRender('customer/customer');
        }
        else{
             $this->render('customer/customer');
        }
       
    }

    public function superAdminCustomer($call = ""){
        $this->mPagetitle = 'Customer';
        $this->mViewData['data'] = array(
            'pageName' => 'CUSTOMER',
            'sub_admins' => $this->adminmodel->getAllSubAdmin()
        );
        if($call=="ajax"){
             $this->ajaxRender('customer/superAdminCustomer');
        }
        else{
             $this->render('customer/superAdminCustomer');
        }
       
    }

    public function addCustomerDetailsPage($call = ""){
        $this->mPagetitle = 'Customer';
        $this->mViewData['data'] = array(
            'pageName' => 'CUSTOMER'
        );
        if($call=="ajax"){
             $this->ajaxRender('customer/addCustomer');
        }
        else{
             $this->render('customer/addCustomer');
        }
       
    }

    /*Here in this function i have swapped the variables because from edit button the id was coming and from loadwithoutrefresh function ajax was coming so there places gets swapped so i also swapped here*/

    public function editCustomerDetailsPage($customer_id="",$call = ""){
        $this->mPagetitle = 'Customer';
        $this->mViewData['data'] = array(
            'pageName' => 'CUSTOMER',
            'details' => $this->customermodel->getCustomerDetails($customer_id)
        );
        if($call=="ajax"){
             $this->ajaxRender('customer/editCustomer');
        }
        else{
             $this->render('customer/editCustomer');
        }
       
    }


    function fetch_details()
    {   
        $fetch_data = $this->customermodel->make_datatables();
        $data = array();
        foreach($fetch_data as $customer)  
        { 
            $sub_array = array();
            $customer_id = $customer->customer_id;
            $customer_name = ucfirst($customer->f_name).' '.ucfirst($customer->l_name);
            $parent = ucfirst($customer->p_name);
            $email = $customer->e_mail;
            $phone = $customer->phone;
            $whatsapp = $customer->whatsapp;
            $aadhar = $customer->aadhar_no;
            $city = ucfirst($customer->city);
            $state = strtoupper($customer->state);
            $address = $customer->address;
            $postal_code = $customer->postal_code;
            $status = $customer->user_status;
            $gender = $customer->gender;
            $id = $customer->admin_id;
            $details = $this->adminmodel->make_subadmindatatables($id);

            $admin_name  ="<span class='user_name'>".$details->f_name." ".$details->l_name."<br>";
            

            if(!empty($customer->usr_img))
            {    
                $profile='<img src='.base_url().'images/profile/'.$customer->usr_img.' width="70" height="70" style="border-radius:50px;" onerror="this.onerror=null;this.src='.base_url().'assets/images/profile_img.jpg">';
            }
            else
            {
                $profile='<img src='.base_url().'assets/images/profile_img.jpg width="70" height="70" style="border-radius:50px;">';
            }
            

            if($status==1){
                $status ='<a href="javascript:void(0);" onclick="disableCustomerStatus('.$customer_id.');"><img src="'.base_url().'assets/images/true.png" width="30" height="30" title="Active"></a>';
            }
            else
            {
                $status='<a  href="javascript:void(0);" onclick="enableCustomerStatus('.$customer_id.');"><img src="'.base_url().'assets/images/false.png" width="30" height="30"></a>';
            }
            
            $personal="";
            $contact="";

            if(!empty($customer_name))	
                $personal.="<span class='user_name'>".$customer_name."</span> S/O ".$parent."<br>";

            if(!empty($email))	
                $contact.="<strong>Email:</strong> ".$email."<br>";

            if(!empty($whatsapp))	
                $contact.="<img src=".base_url()."assets/images/whatsapp.png> ".$whatsapp."&nbsp&nbsp";

            if(!empty($phone))	
                $contact.="<img src=".base_url()."assets/images/mobile.png> ".$phone."<br>";

            if(!empty($aadhar))	
                $contact.= "<span style='background: aqua;padding: 2px 8px;color: black;border-radius:50px;display: inline-table;margin-top: 5px;'><strong>Aadhar No: </strong>".$aadhar."</span><br>";

            // if(!empty($gender))	
            //     $personal.="<strong>Gender:</strong> ".$gender."<br>";

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
                "<span class='yellow-cir'>".$customer->no_of_loan."<span>",
                "<span class='yellow-cir' style='background:#00ffff !important'>₹ ".$customer->total_loan."<span>",
                // $admin_name,
                $status,
                $user_action='<a href="javascript:void(0);" onclick=loadPageWithoutRefresh("'.site_url().'/customer/editCustomerDetailsPage/'.$customer_id.'") class="btn btn-primary"><i class="fa fa-pencil"></i></a>',
            );

            $data[] = $sub_array; 
        }  
        $output = array(  
            "draw"            =>   intval($_POST["draw"]),  
            "recordsTotal"    =>   $this->customermodel->get_all_data(),  
            "recordsFiltered" =>   $this->customermodel->get_filtered_data(),  
            "data"            =>   $data  
        );  
        echo json_encode($output);  
    }


    function fetch_super_admin_details()
    {   
        $fetch_data = $this->customermodel->make_super_admin_datatables();
        $data = array();
        foreach($fetch_data as $customer)  
        { 
            $sub_array = array();
            $customer_id = $customer->customer_id;
            $customer_name = ucfirst($customer->f_name).' '.ucfirst($customer->l_name);
            $parent = ucfirst($customer->p_name);
            $email = $customer->e_mail;
            $phone = $customer->phone;
            $whatsapp = $customer->whatsapp;
            $aadhar = $customer->aadhar_no;
            $city = ucfirst($customer->city);
            $state = strtoupper($customer->state);
            $address = $customer->address;
            $postal_code = $customer->postal_code;
            $status = $customer->user_status;
            $gender = $customer->gender;
            $id = $customer->admin_id;
            $details = $this->adminmodel->make_subadmindatatables($id);
              
              $admin_name ="";
            if (!empty($details->f_name))
             {
              $admin_name  ="<span class='user_name' style='background:#00ff8c !important;color: #000 !important;'>".$details->f_name." ".$details->l_name."<br>";
             }

            if(!empty($customer->usr_img))
            {
                $profile='<img src='.base_url().'images/profile/'.$customer->usr_img.' width="70" height="70" style="border-radius:50px;" onerror="this.onerror=null;this.src='.base_url().'assets/images/profile_img.jpg">';
            }
            else
            {
                $profile='<img src='.base_url().'assets/images/profile_img.jpg width="70" height="70" style="border-radius:50px;">';
            }
            

            if($status==1){
                $status ='<a href="javascript:void(0);" onclick="disableCustomerStatus('.$customer_id.');"><img src="'.base_url().'assets/images/true.png" width="30" height="30" title="Active"></a>';
            }
            else
            {
                $status='<a  href="javascript:void(0);" onclick="enableCustomerStatus('.$customer_id.');"><img src="'.base_url().'assets/images/false.png" width="30" height="30"></a>';
            }
            
            $personal="";
            $contact="";

            if(!empty($customer_name))  
                $personal.="<span class='user_name'>".$customer_name."</span> S/O ".$parent."<br>";

            if(!empty($email))  
                $contact.="<strong>Email:</strong> ".$email."<br>";

            if(!empty($whatsapp))   
                $contact.="<img src=".base_url()."assets/images/whatsapp.png> ".$whatsapp."&nbsp&nbsp";

            if(!empty($phone))  
                $contact.="<img src=".base_url()."assets/images/mobile.png> ".$phone."<br>";

            if(!empty($aadhar)) 
                $contact.= "<span style='background: aqua;padding: 2px 8px;color: black;border-radius:50px;display: inline-table;margin-top: 5px;'><strong>Aadhar No: </strong>".$aadhar."</span><br>";

            // if(!empty($gender))  
            //     $personal.="<strong>Gender:</strong> ".$gender."<br>";

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
                "<span class='yellow-cir'>".$customer->no_of_loan."<span>",
                "<span class='yellow-cir' style='background:#00ffff'>₹ ".$customer->total_loan."<span>",
                $admin_name,
                $status,
                // $user_action='<a href="javascript:void(0);" onclick=loadPageWithoutRefresh("'.site_url().'/customer/editCustomerDetailsPage/'.$customer_id.'") class="btn btn-primary"><i class="fa fa-pencil"></i></a>',
            );

            $data[] = $sub_array; 
        }  
        $output = array(  
            "draw"            =>   intval($_POST["draw"]),  
            "recordsTotal"    =>   $this->customermodel->get_all_super_admin_data(),  
            "recordsFiltered" =>   $this->customermodel->get_filtered_super_admin_data(),  
            "data"            =>   $data  
        );  
        echo json_encode($output);  
    }


    public function addCustomerInfo()
    {
        $userInfo = $this->session->admin_login_data;
        $fileName = $this->image_resize_model->resizeCustomImage('images/profile/', 300);
        $model_data = array(
            'admin_id' => $userInfo['admin_id'],
            'f_name' => $this->input->post('first_name'),
            'l_name' => $this->input->post('last_name'),
            'p_name' => $this->input->post('parent_name'),
            'e_mail' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'whatsapp' =>$this->input->post('whatsapp') ,
            'gender'=>$this->input->post('gender'),
            'city'=>$this->input->post('city'),
            'state'=>$this->input->post('state'),
            'address'=>$this->input->post('address'),
            'postal_code'=>$this->input->post('postal_code'),
            'aadhar_no'=>$this->input->post('aadhar_no'),
            'description'=>$this->input->post('description'),
            'user_type'=>'user',
            'user_status'=>1,
            'created_date'=>date('Y-m-d'),  
            'deleted_date'=>0000-00-00,  
            'no_of_loan'=>0,
            'usr_img'=>$fileName,

        );
        if($this->customermodel->addCustomerDetails($model_data))
        {
            echo json_encode(true);
        }
        
    }

    public function getCustomerDetails()
    { 
        if(!empty($this->input->post('customer_id')))
        {
            $details=$this->customermodel->getCustomerDetails($this->input->post('customer_id'));
                echo json_encode($details);
        }
    }

    public function updateCustomerInfo()
    {
        $fileName = $this->image_resize_model->resizeCustomImage('images/profile/', 300);
        $model_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'f_name' => $this->input->post('first_name'),
            'l_name' => $this->input->post('last_name'),
            'p_name' => $this->input->post('parent_name'),
            'e_mail' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'whatsapp' =>$this->input->post('whatsapp') ,
            'gender'=>$this->input->post('gender'),
            'city'=>$this->input->post('city'),
            'state'=>$this->input->post('state'),
            'address'=>$this->input->post('address'),
            'postal_code'=>$this->input->post('postal_code'),
            'aadhar_no'=>$this->input->post('aadhar_no'),
            'description'=>$this->input->post('description'),
        );

        if(!empty($fileName))
            $model_data['usr_img'] = $fileName;

        if($this->customermodel->updateCustomerDetails($model_data))
        {
            echo json_encode(true);
        }

    }

    function getSelectedCustomerHtml()
    {
        $customer_id = $this->input->post('customer_id');

        if(!empty($customer_id))
        {
            $customer_data = $this->customermodel->getCustomerDetails($customer_id);

            $html = '<table class="table table-bordered table-hover dataTable no-footer" style="background: #f4f4f4;">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 39.7667px;">Image</th>
                                <th class="text-center" style="width: 207.767px;">
                                    Personal Details
                                </th>
                                <th class="text-center" style="width: 223.767px;">
                                    Contact Details
                                </th>
                                <th class="text-center" style="width: 131.767px;">
                                    Address
                                </th>
                                <th class="text-center" style="width: 90.7667px;">
                                    No. of Loan
                                </th>
                                <th class="text-center" style="width: 83.7667px;">
                                    Total Loan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td class="text-center">';


                        if(!empty($customer_data->usr_img))
                        {
                            $html .= '<img src='.base_url().'images/profile/'.$customer_data->usr_img.' width="55" height="55" style="border-radius:50px;" onerror="this.onerror=null;this.src='.base_url().'assets/images/profile_img.jpg">';
                        }
                        else
                        {
                            $html .= '<img src='.base_url().'assets/images/profile_img.jpg width="80" height="80" style="border-radius:50px;">';
                        }


                        $html .= '</td><td>
                                    <span class="user_name">'.$customer_data->f_name.' '.$customer_data->l_name.'</span> S/O Kalesh Jain
                                </td><td>';


                        if(!empty($customer_data->e_mail))
                        {       
                            $html .= '<strong>Email:</strong> '.$customer_data->e_mail;
                        }

                        if(!empty($customer_data->e_mail) && !empty($customer_data->whatsapp))
                        {       
                            $html .= '<br>';
                        }

                        if(!empty($customer_data->whatsapp))
                        {       
                            $html .= '<img src="http://localhost/bhandari_khata/assets/images/whatsapp.png"> '.$customer_data->whatsapp;
                        }

                        if(!empty($customer_data->phone))
                        {       
                            $html .= '&nbsp;&nbsp;<img src="http://localhost/bhandari_khata/assets/images/mobile.png"> '.$customer_data->phone;
                        }

                        if(!empty($customer_data->phone) && !empty($customer_data->aadhar_no))
                        {       
                            $html .= '<br>';
                        }

                        if(!empty($customer_data->aadhar_no))
                        {       
                            $html .= '<hr style="margin-top: 3px;margin-bottom: 3px;border: none"><span style="background: aqua;padding: 2px 8px;color: black;border-radius:50px;display: inline-table;margin-top: 5px;"><strong>Aadhar No: </strong> '.$customer_data->aadhar_no.'</span>';
                        }                                                         
                                  
                        $html .= '</td><td>';

                        if(!empty($customer_data->address))
                        {
                            $html .= $customer_data->address."<br>";
                        }

                        if(!empty($customer_data->city)) 
                        {
                            $html .= $customer_data->city;
                        }

                        if(!empty($customer_data->postal_code))
                        {
                            $html .= ", (".$customer_data->postal_code.")";
                        }

                        if(!empty($customer_data->state))
                        {
                            $html .= " ,".$customer_data->state;
                        }
                         
                        $html .= '</td><td class="text-center">
                                    <span class="yellow-cir">'.$customer_data->no_of_loan.'<span></span></span>
                                </td>
                                <td class="text-center"><span class="yellow-cir">'.$customer_data->total_loan.'<span></span></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>';
            echo $html;
        }
        else
        {
            echo "";
        }
    }
}