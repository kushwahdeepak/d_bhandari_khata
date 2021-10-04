<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Transaction extends Main_Controller
 {

 	
 	function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->userInfo = $this->session->admin_login_data;
        $this->checkAuthentication();
    }


    function index($call = "")
    {
        $this->mViewData['data'] = array(
            'pageName'     => 'TRANSECTION',
            'bank_details' => $this->bankmodel->BankDetails(),
        );

        if($call=="ajax")
        {
             $this->ajaxRender('transaction/transection.php');
        }
        else
        {
             $this->render('transaction/transection.php');
        }

    }

    function superAdminTransactionPage($call = "")
    {
        $this->mViewData['data'] = array(
            'pageName'     => 'TRANSECTION',
            'bank_details' => $this->bankmodel->BankDetails(),
            'sub_admins' => $this->adminmodel->getAllSubAdmin()
        );

        if($call=="ajax")
        {
             $this->ajaxRender('transaction/superAdminTransactionPage.php');
        }
        else
        {
             $this->render('transaction/superAdminTransactionPage.php');
        }

    }


    function fetch_details()
    {   
        $this->load->model('tarnsaction_model');
        $fetch_data = $this->tarnsaction_model->make_datatables();
        $data = array();
        $no=0;
        foreach($fetch_data as $transection)  
        { 
            $no+=1;
            $sub_array = array();
            $transection_id = $transection->transaction_id;
            $transaction_perpose = $transection->transaction_perpose;
            $transaction_perpose_id = $transection->transaction_perpose_id;
            $transaction_amount = $transection->transaction_amount;
            $transaction_date = date('D M d, Y', strtotime($transection->transaction_date));
            $transaction_created_date = $transection->transaction_created_date;
            $transaction_deleted_date = $transection->transaction_deleted_date;
            if($transection->transaction_type == "cash")
            {
                $transaction_type = "Cash";
            }
            else if($transection->transaction_type == "bank")
            {
                $transaction_type = "Bank"; 
            }
            else if(isset($transection->transaction_type) && !empty($transection->transaction_type))
            {
                $bank_detail = $this->bankmodel->getBankDetails($transection->transaction_type);
                $transaction_type = $bank_detail->bank_name." : ".$bank_detail->account_no;
            }
            $id = $transection->transaction_admin_id;
            $details = $this->adminmodel->make_subadmindatatables($id);

            $admin_name  ="<span class='user_name'>".$details->f_name." ".$details->l_name."<br>";
            // if($transaction_type !="case") 
            // {
            //     $details=$this->bankmodel->getBankDetails($payable_type);
            //     if (!empty($details)) 
            //     {
            //         $payable_type = $details->bank_name;
            //         $payable_type .= $details->account_no;
            //     }
                
            // }
            // else if ($payable_type == "case") 
            // {
            //     $payable_type = $payable_type;
            // }
           
            $sub_array = array(
                // $no,
                "<span style='background: #00ffff;padding: 2px 8px;color: black; border-radius:50px; text-align: center;'>
                <strong>₹ ".$transaction_amount."</strong></span><br>",
                $transaction_perpose,
                $transaction_type,
                $transaction_date,
                // $admin_name,
                // $transaction_created_date,
                // $transaction_deleted_date,

            );

            $data[] = $sub_array; 
        }  
        $output = array(  
            "draw"            =>   intval($_POST["draw"]),  
            "recordsTotal"    =>   $this->tarnsaction_model->get_all_data(),  
            "recordsFiltered" =>   $this->tarnsaction_model->get_filtered_data(),  
            "data"            =>   $data,
        );  
        echo json_encode($output);  
    }
    
    function fetch_super_admin_transaction_list()
    {   
        $this->load->model('tarnsaction_model');
        $fetch_data = $this->tarnsaction_model->make_super_admin_datatables();
        $data = array();
        $no=0;
        foreach($fetch_data as $transection)  
        { 
            $no+=1;
            $sub_array = array();
            $transection_id = $transection->transaction_id;
            $transaction_perpose = $transection->transaction_perpose;
            $transaction_perpose_id = $transection->transaction_perpose_id;
            $transaction_amount = $transection->transaction_amount;
            $transaction_date = date('D M d, Y', strtotime($transection->transaction_date));
            $transaction_created_date = $transection->transaction_created_date;
            $transaction_deleted_date = $transection->transaction_deleted_date;
            if($transection->transaction_type == "cash")
            {
                $transaction_type = "Cash";
            }
            else if($transection->transaction_type == "bank")
            {
                $transaction_type = "Bank"; 
            }
            else if(isset($transection->transaction_type) && !empty($transection->transaction_type))
            {
                $bank_detail = $this->bankmodel->getBankDetails($transection->transaction_type);
                $transaction_type = $bank_detail->bank_name." : ".$bank_detail->account_no;
            }
            $id = $transection->transaction_admin_id;
            $details = $this->adminmodel->make_subadmindatatables($id);
            
            $admin_name ="";
            if (!empty($details->f_name)) 
            {
              $admin_name  ="<span class='user_name' style='background:#00ff8c !important;color: #000 !important;'>".$details->f_name." ".$details->l_name."<br>";
            }
            // if($transaction_type !="case") 
            // {
            //     $details=$this->bankmodel->getBankDetails($payable_type);
            //     if (!empty($details)) 
            //     {
            //         $payable_type = $details->bank_name;
            //         $payable_type .= $details->account_no;
            //     }
                
            // }
            // else if ($payable_type == "case") 
            // {
            //     $payable_type = $payable_type;
            // }
           
            $sub_array = array(
                // $no,
                "<span style='background: #00ffff;padding: 2px 8px;color: black; border-radius:50px; text-align: center;'>
                <strong>₹ ".$transaction_amount."</strong></span><br>",
                $transaction_perpose,
                $transaction_type,
                $transaction_date,
                $admin_name,
                // $transaction_created_date,
                // $transaction_deleted_date,

            );

            $data[] = $sub_array; 
        }  
        $output = array(  
            "draw"            =>   intval($_POST["draw"]),  
            "recordsTotal"    =>   $this->tarnsaction_model->get_all_super_admin_data(),  
            "recordsFiltered" =>   $this->tarnsaction_model->get_filtered_super_admin_data(),  
            "data"            =>   $data,
        );  
        echo json_encode($output);  
    }
 } 
 ?>