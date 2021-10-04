<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Loan extends Main_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->checkAuthentication();
    }


    public function index($call = "")
    {
    	$this->mPagetitle = 'Loan';
        $this->mViewData['data'] = array(
            'pageName' => 'LOAN'
        );
        if($call=="ajax")
        {
             $this->ajaxRender('loan/loan');
        }
        else
        {
             $this->render('loan/loan');
        }
     }

    public function superAdminLoan($call = "")
    {
        $this->mPagetitle = 'Loan';
        $this->mViewData['data'] = array(
            'pageName' => 'LOAN',
            'sub_admins' => $this->adminmodel->getAllSubAdmin()
        );
        if($call=="ajax")
        {
             $this->ajaxRender('loan/superAdminLoan');
        }
        else
        {
             $this->render('loan/superAdminLoan');
        }
    }
       
    public function addLoanDetailsPage($call = ""){
       $userInfo = $this->session->admin_login_data;
        $this->mPagetitle = 'Loan';
        $this->mViewData['data'] = array(
            'pageName' => 'LOAN',
            'details' => $this->customermodel->getAllCustomerDetails($userInfo['admin_id']),
            'bank_details' => $this->bankmodel->BankDetails(),
            'rate' => $this->adminmodel->getRate(),
        );
        if($call=="ajax"){
             $this->ajaxRender('loan/addLoan');
        }
        else{
             $this->render('loan/addLoan');
        }
       
    }


    public function loanOverView($loan_id = "",$call = "")
    {

        $id = $loan_id;
        // $userInfo = $this->session->admin_login_data;
        // $this->mPagetitle = 'Loanoverview';
        // $this->mViewData['data'] = array(
        //     'pageName' => 'LOANOVERVIEW',
        //     'id' => $id,
        // );


        $loan = $this->loanmodel->loan_overview_date($id);
        $customer_data = $this->loanmodel->customer_datatables($loan->customer_id);
        $loan_security = $this->loanmodel->loan_security_data($loan->loan_id);
        $userInfo = $this->session->admin_login_data;
        $this->mPagetitle = 'Loanoverview';
        $this->mViewData = array(
            'pageName'           => 'LOANOVERVIEW',
            'loan'                 =>  $loan,
            'customer_data'        =>  $customer_data,
            'loan_security'        =>  $loan_security,
            'id' => $id,
        );   

        if($call=="ajax"){
            $this->ajaxRender('loan/loan_overview');
        }
        else{
            $this->render('loan/loan_overview');
        }
        // $this->loan_overview_fetch_details($id);
        // if($call=="ajax"){
        //      $this->ajaxRender('loan/loan_overview');
        // }
        // else{
        //      $this->render('loan/loan_overview');
        // }
       
    }

    public function addLoanDetails()
    { 
        $userInfo = $this->session->admin_login_data;
        $admin_id = $userInfo['admin_id'];
        
        $security = $this->input->post('security');
        $payable_type = $this->input->post('trasactionType');

        $loan_data = array(
            'admin_id'    => $admin_id,
            'customer_id' => $this->input->post('customer_id'),
            'security'    => $this->input->post('security'),
            'amount'      => $this->input->post('amount'),
            'percentage'  => $this->input->post('percentage'),
            'note'        => $this->input->post('note'),
            'loan_date'   => $this->input->post('loan_date'),

        );

        if($payable_type != "cash")
        {  
            $loan_data['payable_type']         = "bank";  
            $loan_data['account_id']           = $this->input->post('trasactionType');          
            $loan_data['cheque']            = $this->input->post('cheque');         
        }
        else
        {
            $loan_data['payable_type']         = "cash";
        }
        $gold_item_photo = array();
        $silver_item_photo = array();

        if(isset($_FILES['gold_item_photo']['name']))
        {
            $goldFilesCount = count($_FILES['gold_item_photo']['name']);
            if ($goldFilesCount > 0) 
            {
                for($i = 0; $i < $goldFilesCount; $i++)
                {  
                    $fileName = $this->image_resize_model->resizeCustomMultipleImages1('images/', 600, $i);
                    
                    if(isset($fileName) && !empty($fileName))
                    {
                        $image_path = base_url()."/images/".$fileName;
                        $gold_item_photo[] = $image_path;
                    }
                }
            }
            $loan_data['gold_item_photo'] = $gold_item_photo;
        }

        if(isset($_FILES['silver_item_photo']['name']))
        {
            $silverFilesCount = count($_FILES['silver_item_photo']['name']);

            if ($silverFilesCount > 0) 
            {
                for($i = 0; $i < $silverFilesCount; $i++)
                {  
                    $silverFileName = $this->image_resize_model->resizeCustomMultipleImages2('images/', 600, $i);
                    
                    if(isset($silverFileName) && !empty($silverFileName))
                    {
                        $silver_image_path = base_url()."/images/".$silverFileName;
                        $silver_item_photo[] = $silver_image_path;
                    }
                }
            }
            $loan_data['silver_item_photo'] = $silver_item_photo;
        }
        
        if($security == "gold")
        {           
            $loan_data['gold_current_rate']    = $this->input->post('gold');
            $loan_data['gold_item_name']       = $this->input->post('gold_item_name[]');
            $loan_data['gold_item_weight']     = $this->input->post('gold_item_weight[]');
            $loan_data['gold_item_purity']     = $this->input->post('gold_item_purity[]');
            $loan_data['gold_item_value']      = $this->input->post('gold_item_value[]');
            $loan_data['gold_item_quantity']   = $this->input->post('gold_item_quantity[]');
            // $loan_data['gold_item_photo']      = $this->input->post('gold_item_photo[]');

        }
        else if ($security == "silver") 
        {
            $loan_data['silver_current_rate']  = $this->input->post('silver');
            $loan_data['silver_item_name']     = $this->input->post('silver_item_name[]');
            $loan_data['silver_item_weight']   = $this->input->post('silver_item_weight[]');
            $loan_data['silver_item_purity']   = $this->input->post('silver_item_purity[]');
            $loan_data['silver_item_value']    = $this->input->post('silver_item_value[]');
            $loan_data['silver_item_quantity'] = $this->input->post('silver_item_quantity[]');

            // $loan_data['silver_item_photo']    = $this->input->post('silver_item_photo[]');
        }
        else if ($security == "gold_silver") 
        {
            $loan_data['gold_current_rate']    = $this->input->post('gold');
            $loan_data['gold_item_name']       = $this->input->post('gold_item_name[]');
            $loan_data['gold_item_weight']     = $this->input->post('gold_item_weight[]');
            $loan_data['gold_item_purity']     = $this->input->post('gold_item_purity[]');
            $loan_data['gold_item_value']      = $this->input->post('gold_item_value[]');
            $loan_data['gold_item_quantity']   = $this->input->post('gold_item_quantity[]');
            // $loan_data['gold_item_photo']      = $this->input->post('gold_item_photo[]');
            $loan_data['silver_current_rate']  = $this->input->post('silver');
            $loan_data['silver_item_name']     = $this->input->post('silver_item_name[]');
            $loan_data['silver_item_weight']   = $this->input->post('silver_item_weight[]');
            $loan_data['silver_item_purity']   = $this->input->post('silver_item_purity[]');
            $loan_data['silver_item_value']    = $this->input->post('silver_item_value[]');
            $loan_data['silver_item_quantity'] = $this->input->post('silver_item_quantity[]');
            // $loan_data['silver_item_photo']    = $this->input->post('silver_item_photo[]');
        }

        $adminInfo = $this->adminmodel->getUserBasicInfo($admin_id);
        if($adminInfo->intial_investment >= $loan_data['amount'] && $payable_type == "cash")
        {
            $this->loanmodel->addLoanDetails($loan_data);
            $this->updateCronJobForChart();
            echo json_encode("true");
        }
        else if($payable_type != "cash")
        {
            $this->loanmodel->addLoanDetails($loan_data);
            $this->updateCronJobForChart();
            echo json_encode("true");
        }
        else
        {
            echo json_encode("false");
        }

        // $this->loanmodel->addLoanDetails($loan_data);
        // echo json_encode(true);
    }


    /*Here in this function i have swapped the variables because from edit button the id was coming and from loadwithoutrefresh function ajax was coming so there places gets swapped so i also swapped here*/
    public function editLoanDetailsPage($customer_id="",$call = "")
    {
        $this->mPagetitle = 'Loan';
        $this->mViewData['data'] = array(
            'pageName' => 'LOAN',
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
        $fetch_data = $this->loanmodel->make_datatables();
        $data = array();
        $no=0;
        foreach($fetch_data as $loan)  
        {  

            $no+=1;
            $sub_array = array();
            $loan_id=$loan->loan_id;
            if (!empty($loan_id))
            {
                $loan_securitydata = $this->loanmodel->loan_Securitydata($loan_id);
                // if (!empty('item_name')) 
                // {
                //   $item_name = $loan_securitydata->item_name;               
                // }
                // if (!empty('item_weight')) 
                // {
                //   $item_weight = $loan_securitydata->item_weight;
                // }
                // if (!empty('item_value')) 
                // {
                //   $item_value = $loan_securitydata->item_value;
                // }
                // if (!empty('item_purity'))
                // {
                //   $item_purity = $loan_securitydata->item_purity;
                // }
                // if (!empty('item_photo')) 
                // {
                // $item_photo = $loan_securitydata->item_photo;
                // }
                // if (!empty('item_quantity'))
                // {
                // $item_quantity = $loan_securitydata->item_quantity;
                // }
           
                $amount= $loan->amount;
                $gold_current_rate= $loan->gold_current_rate;
                $silver_current_rate= $loan->silver_current_rate;
                $receipt_img= $loan->receipt_img;
                $percentage= $loan->percentage;
                $payable_type= $loan->payable_type;
                $note= $loan->note;
                $completed_date= $loan->completed_date;
                $created_date= date('D M d, Y', strtotime($loan->created_date));
                $security= $loan->security;
                $customer_id = $loan->customer_id;
                $customer_data = $this->loanmodel->customer_datatables($customer_id);
                $id = $loan->admin_id;
                $details = $this->adminmodel->make_subadmindatatables($id);


                $admin_name  ="<span class='user_name'>".$details->f_name." ".$details->l_name."<br>";
                
                if ($security == "gold") 
                {
                  
                  $security = '<img src="'.base_url().'assets/images/icons8-gold.png" width="40" height="40" style="margin-left: 7px;"><span style="background: #FFD700;padding: 2px 8px;color: black;border-radius:50px ;">'.$loan_securitydata->item_weight.'gm - '.$loan_securitydata->item_purity.' %</span>';
                  $current_rate = $gold_current_rate;
                }

                else if ($security =="silver") 
                {
                  $security = '<img src="'.base_url().'assets/images/icons8-silver.png"   width="40" height="40" style="margin-left: -4px;"><span style="background: #C0C0C0;padding: 2px 8px;color: black;border-radius:50px ;">'.$loan_securitydata->item_weight.'gm - '.$loan_securitydata->item_purity.' %</span>';
                  $current_rate = $silver_current_rate;
                }

                else if ($security =="gold_silver") 
                {
                  $security = '<img src="'.base_url().'assets/images/icons8-gold.png"   width="40" height="40"><span style="background: #FFD700;padding: 2px 8px;color: black;border-radius:50px ;">'.$loan_securitydata->item_weight.'gm - '.$loan_securitydata->item_purity.' %</span><br>';
                  $security .= '<img src="'.base_url().'assets/images/icons8-silver.png"   width="40" height="40" style="margin-left: 15px;"><span style="background: #C0C0C0;padding: 2px 8px;color: black;border-radius:50px ;">'.$loan_securitydata->item_weight.'gm - '.$loan_securitydata->item_purity.' %</span>';
                }

                $security_details="<span style='padding: 2px 8px;color: black; border-radius:50px;'>".$security."</span><br>";
                // if(!empty($item_name)) $security_details.="<strong> </strong>".$item_name."<br>";  
                // if(!empty($item_photo)) $security_details.="Image".$item_photo."<br>";
                
                if($completed_date != 0000-00-00){
                    $status ='<a href="javascript:void(0);" onclick="disableBankStatus('.$loan_id.');"><img src="'.base_url().'assets/images/true.png"   width="30" height="30" title="Active"></a>';
                }
                else{
                    $status='<a  href="javascript:void(0);" onclick="enableBankStatus('.$loan_id.');"><img src="'.base_url().'assets/images/false.png"   width="30" height="30"></a>';
                }

                $customer_name = "";
                if(!empty($customer_data->f_name))  
                    $customer_name  ="<span class='user_name'>".$customer_data->f_name." ".$customer_data->l_name."</span> S/O ".$customer_data->p_name."<br>";
     
                $contacts = "";
                if(!empty($customer_data->e_mail)) 
                    $contacts.="<strong>Email:</strong> ".$customer_data->e_mail."<br>";

                if(!empty($customer_data->whatsapp))   
                    $contacts.="<img src=".base_url()."assets/images/whatsapp.png> ".$customer_data->whatsapp."&nbsp&nbsp";

                if(!empty($customer_data->phone))  
                    $contacts.="<img src=".base_url()."assets/images/mobile.png> ".$customer_data->phone."<br>";

                if(!empty($customer_data->aadhar)) 
                    $contacts.= "<br><span style='background: aqua;padding: 2px 8px;color: black;border-radius:50px ;'><strong>Aadhar No: </strong>".$customer_data->aadhar."</span><br>";

                $loan_amonut = "";
                if(!empty($amount)) 
                    $loan_amonut.= "<span style='background: #00ffff;padding: 2px 8px;color: black;border-radius:50px ;'>₹ ".$amount." </span> (".$payable_type.")  ".$percentage."%";
                
                // if(!empty($percentage)) 
                //     $loan_amonut.= "Percentage:<span style='background: aqua;padding: 2px 8px;color: black;border-radius:50px ;'></span>";
                // if(!empty($payable_type)) 
                //     $loan_amonut.= "Payable Type:<span style='background: aqua;padding: 2px 8px;color: black;border-radius:50px ;'>".$payable_type."</span><br>";


                $location = "";
                if(!empty($customer_data->address))
                    $location.=ucfirst($customer_data->address)."<br>";

                if(!empty($customer_data->city))
                    $location.=strtoupper($customer_data->city);

                if(!empty($customer_data->postal_code))
                    $location.= "<span> (".$customer_data->postal_code.") </span>";

                if(!empty($customer_data->state))
                    $location.=$customer_data->state."<br>";

                $sub_array = array(
                    $customer_name,
                    $contacts,
                    $location,
                    $security_details,
                    $loan_amonut,
                    $created_date,
                    // $note,
                    // $admin_name,
                    $status,
                    '<tr  style="">
                         <td><a href="javascript:void(0);" onclick=loadPageWithoutRefresh("'.site_url().'/loan/loanOverView/'.$loan_id.'") class="btn btn-primary"><i class="fa fa-eye" style="font-size:15px"></i></a>
                         </td>
                    </tr>');

                $data[] = $sub_array; 
            }  

        }
        $output = array(  
            "draw"            =>   intval($_POST["draw"]),  
            "recordsTotal"    =>   $this->loanmodel->get_all_data(),  
            "recordsFiltered" =>   $this->loanmodel->get_filtered_data(),  
            "data"            =>   $data,
        );  
        echo json_encode($output);  
    }




    function fetch_super_admin_details()
    {   
        $fetch_data = $this->loanmodel->make_super_admin_datatables();
        $data = array();
        $no=0;
        foreach($fetch_data as $loan)  
        {  

            $no+=1;
            $sub_array = array();
            $loan_id=$loan->loan_id;
            if (!empty($loan_id))
            {
                $loan_securitydata = $this->loanmodel->loan_Securitydata($loan_id);
           
                $amount= $loan->amount;
                $gold_current_rate= $loan->gold_current_rate;
                $silver_current_rate= $loan->silver_current_rate;
                $receipt_img= $loan->receipt_img;
                $percentage= $loan->percentage;
                $payable_type= $loan->payable_type;
                $note= $loan->note;
                $completed_date= $loan->completed_date;
                $created_date= date('D M d, Y', strtotime($loan->created_date));
                $security= $loan->security;
                $customer_id = $loan->customer_id;
                $customer_data = $this->loanmodel->customer_datatables($customer_id);
                $id = $loan->admin_id;
                $details = $this->adminmodel->make_subadmindatatables($id);


                $admin_name  ="<span class='user_name' style='background:#00ff8c !important;color: #000 !important;'>".$details->f_name." ".$details->l_name."<br>";
                
                if ($security == "gold") 
                {
                  
                  $security = '<img src="'.base_url().'assets/images/icons8-gold.png"   width="40" height="40"><span style="background: #FFD700;padding: 2px 8px;color: black;border-radius:50px ;">'.$loan_securitydata->item_weight.'gm - '.$loan_securitydata->item_purity.' %</span>';
                  $current_rate = $gold_current_rate;
                }

                else if ($security =="silver") 
                {
                  $security = '<img src="'.base_url().'assets/images/icons8-silver.png"   width="40" height="40"><span style="background: #C0C0C0;padding: 2px 8px;color: black;border-radius:50px ;">'.$loan_securitydata->item_weight.'gm - '.$loan_securitydata->item_purity.' %</span>';
                  $current_rate = $silver_current_rate;
                }

                else if ($security =="gold_silver") 
                {
                  $security = '<img src="'.base_url().'assets/images/icons8-gold.png"   width="40" height="40"><span style="background: #FFD700;padding: 2px 8px;color: black;border-radius:50px ;">'.$loan_securitydata->item_weight.'gm - '.$loan_securitydata->item_purity.' %</span><br>';
                  $security .= '<img src="'.base_url().'assets/images/icons8-silver.png"   width="40" height="40" style="margin-left: 15px;"><span style="background: #C0C0C0;padding: 2px 8px;color: black;border-radius:50px ;">'.$loan_securitydata->item_weight.'gm - '.$loan_securitydata->item_purity.' %</span>';
                }

                $security_details="<span style='padding: 2px 8px;color: black; border-radius:50px;'>".$security."</span><br>";
                // if(!empty($item_name)) $security_details.="<strong> </strong>".$item_name."<br>";  
                // if(!empty($item_photo)) $security_details.="Image".$item_photo."<br>";
                
                if($completed_date != 0000-00-00){
                    $status ='<a href="javascript:void(0);" onclick="disableBankStatus('.$loan_id.');"><img src="'.base_url().'assets/images/true.png"   width="30" height="30" title="Active"></a>';
                }
                else{
                    $status='<a  href="javascript:void(0);" onclick="enableBankStatus('.$loan_id.');"><img src="'.base_url().'assets/images/false.png"   width="30" height="30"></a>';
                }

                $customer_name = "";
                if(!empty($customer_data->f_name))  
                    $customer_name  ="<span class='user_name'>".$customer_data->f_name." ".$customer_data->l_name."</span> S/O ".$customer_data->p_name."<br>";
     
                $contacts = "";
                if(!empty($customer_data->e_mail)) 
                    $contacts.="<strong>Email:</strong> ".$customer_data->e_mail."<br>";

                if(!empty($customer_data->whatsapp))   
                    $contacts.="<img src=".base_url()."assets/images/whatsapp.png> ".$customer_data->whatsapp."&nbsp&nbsp";

                if(!empty($customer_data->phone))  
                    $contacts.="<img src=".base_url()."assets/images/mobile.png> ".$customer_data->phone."<br>";

                if(!empty($customer_data->aadhar)) 
                    $contacts.= "<br><span style='background: aqua;padding: 2px 8px;color: black;border-radius:50px ;'><strong>Aadhar No: </strong>".$customer_data->aadhar."</span><br>";

                $loan_amonut = "";
                if(!empty($amount)) 
                    $loan_amonut.= "<span style='background: #00ffff;padding: 2px 8px;color: black;border-radius:50px ;'>₹ ".$amount." </span> (".$payable_type.")  ".$percentage."% ";
                
                // if(!empty($percentage)) 
                //     $loan_amonut.= "Percentage:<span style='background: aqua;padding: 2px 8px;color: black;border-radius:50px ;'></span>";
                // if(!empty($payable_type)) 
                //     $loan_amonut.= "Payable Type:<span style='background: aqua;padding: 2px 8px;color: black;border-radius:50px ;'>".$payable_type."</span><br>";


                $location = "";
                if(!empty($customer_data->address))
                    $location.=ucfirst($customer_data->address)."<br>";

                if(!empty($customer_data->city))
                    $location.=strtoupper($customer_data->city);

                if(!empty($customer_data->postal_code))
                    $location.= "<span> (".$customer_data->postal_code.") </span>";

                if(!empty($customer_data->state))
                    $location.=$customer_data->state."<br>";

                $sub_array = array(
                    $customer_name,
                    $contacts,
                    $location,
                    $security_details,
                    $loan_amonut,
                    $created_date,
                    // $note,
                    $admin_name,
                    $status,
                    '<tr  style="">
                         <td><a href="javascript:void(0);" onclick=loadPageWithoutRefresh("'.site_url().'/loan/loanOverView/'.$loan_id.'") class="btn btn-primary"><i class="fa fa-eye" style="font-size:15px"></i></a>
                         </td>
                    </tr>');

                $data[] = $sub_array; 
            }  

        }
        $output = array(  
            "draw"            =>   intval($_POST["draw"]),  
            "recordsTotal"    =>   $this->loanmodel->get_all_super_admin_data(),  
            "recordsFiltered" =>   $this->loanmodel->get_filtered_super_admin_data(),  
            "data"            =>   $data,
        );  
        echo json_encode($output);  
    }
 
     function loan_overview_fetch_details($id,$call = "")
    {   
        $loan = $this->loanmodel->loan_overview_date($id);
        $customer_data = $this->loanmodel->customer_datatables($loan->customer_id);
        $loan_security = $this->loanmodel->loan_security_data($loan->loan_id);
        $userInfo = $this->session->admin_login_data;
        $this->mPagetitle = 'Loanoverview';
        $this->mViewData = array(
            'pageName'           => 'LOANOVERVIEW',
            'loan'                 =>  $loan,
            'customer_data'        =>  $customer_data,
            'loan_security'        =>  $loan_security,
        );   

        if($call=="ajax"){
             $this->ajaxRender('loan/loan_overview');
        }
        else{
             $this->render('loan/loan_overview');
        }
      
    }

     public function CompliteLoan()
     {
        $userInfo = $this->session->admin_login_data;
        $admin_id = $userInfo['admin_id'];
        $loan_data = array(
            'admin_id'       => $admin_id,
            'loan_id'        => $this->input->post('loan_id'),
            'customer_id'    => $this->input->post('customer_id'),
            'amount'         => $this->input->post('amount'),
            'amount_with_interst'=> $this->input->post('amount_with_interst'),
            'completed_date' => $this->input->post('completed_date'),
        );

        $type = $this->input->post('recivable_type');
        $bank_detail = array(
            'loan_id'    => $this->input->post('loan_id'),
            'account_no'        => $this->input->post('account_no'),
            'account_holder_name'        => $this->input->post('account_holder_name'),
            'bank_name'    => $this->input->post('bank_name'),
            'ifsc_code'         => $this->input->post('ifsc_code'),
            'cheque_number' => $this->input->post('cheque_number'),
            'recivable_type' => $type,
        );
        if($type != "cash")
        {
            $this->loanmodel->createTransactionBankDetail($bank_detail);
             $this->updateCronJobForChart();
        }
        $response = $this->loanmodel->completeLoan($loan_data);
        $this->updateCronJobForChart();
        echo json_encode($response);
       
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
                    $completed_date_list = $this->loanmodel->getLoansByDate($loan->admin_id, $loan->completed_date, "completed_date");
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
                                $completed_amount = $completed_amount + $completed_date_data->completed_amount_with_interst;
                            }
                        }
                    }
                    $chart_array = array(
                        'admin_id' => $loan->admin_id,
                        'created_date' => $loan->created_date,
                        'number_of_loan' => count($created_date_list),
                        // 'number_of_completed_loan' => count($completed_date_list),
                        'initial_amount' => $created_amount,
                        // 'completed_amount' => $completed_amount,
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


                    $completed_chart_array = array(
                        'admin_id' => $loan->admin_id,
                        'created_date' => $loan->completed_date,
                        // 'number_of_loan' => count($created_date_list),
                        'number_of_completed_loan' => count($completed_date_list),
                        // 'initial_amount' => $created_amount,
                        'completed_amount' => $completed_amount,
                    );
                    if($completed_amount != 0)
                    {
                        $chart_date_completed_status = $this->adminmodel->getChartInfoOnDate($loan->completed_date);
                        if(isset($chart_date_completed_status) && !empty($chart_date_completed_status))
                        {
                            $this->db->where('created_date',$loan->completed_date);
                            $this->db->update('chart_info',$completed_chart_array);
                        }
                        else
                        {
                            $this->db->insert('chart_info',$completed_chart_array);
                        }
                    }
                }
            }
        }



}