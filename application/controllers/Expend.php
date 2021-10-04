<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Expend extends Main_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model('expendmodel');
        $this->load->helper(array('url'));
        $this->userInfo = $this->session->admin_login_data;
        $this->checkAuthentication();
    }


    function index($call = "")
    {
        $this->mViewData['data'] = array(
            'pageName'     => 'EXPAND',
            'bank_details' => $this->bankmodel->BankDetails(),
        );

        if($call=="ajax")
        {
             $this->ajaxRender('expend/expend');
        }
        else
        {
             $this->render('expend/expend');
        }

    }


    function superAdminExpend($call = "")
    {
        $this->mViewData['data'] = array(
            'pageName'     => 'EXPAND',
            'bank_details' => $this->bankmodel->BankDetails(),
            'sub_admins' => $this->adminmodel->getAllSubAdmin()
        );

        if($call=="ajax")
        {
             $this->ajaxRender('expend/superAdminExpend');
        }
        else
        {
             $this->render('expend/superAdminExpend');
        }

    }


    function editExpenseDetails()
    {
        $id = $this->input->post('id');

        $details = $this->expendmodel->getExpenseDetails($id);
        $bank_details = $this->bankmodel->BankDetails();


        $form = ' 
                                <div class="row">
                                    <input type="hidden" name="transaction_id" value="'.$details->transaction_id.'">
                                    <input type="hidden" name="personal_expenses_id" value="'.$id.'">
                                    <div class="form-group col-sm-3 col-md-3">
                                        <label class="control-label asterisk">Amount</label>
                                        <input class="form-control" type="text" name="amount_expend" id="amount_expend" value="'.$details->amount_expend.'">
                                    </div>
                                    <div class="form-group col-sm-3 col-md-3">
                                        <label class="control-label asterisk">Created Date</label>
                                        <input class="form-control normal_datepicker" type="text" name="created_date" id="created_date" value="'.$details->created_date.'">
                                    </div>';

                                    if($details->payable_type == "cash")
                                    {

                                        $form .= '<div class="form-group col-sm-3 col-md-3">
                                                    <label class="control-label asterisk">Payable Type: </label>
                                                    <select class="form-control " id="case_payable_type" name="payable_type" onchange="editexpendTrasactionTypeCase();">
                                                        <option value="">Select Amount Type </option>
                                                        <option value="cash" selected> CASH</option>';

                                        foreach ($bank_details as $bank) 
                                        {                                                            
                                            $form .= '<option value="'.$bank->bank_id.'">
                                                            '.$bank->bank_name.' ('.$bank->account_no.')
                                                        </option>';
                                        }

                                    }
                                    else
                                    {
                                        $form .= '<div class="form-group col-sm-3 col-md-3">
                                            <label class="control-label asterisk">Payable Type: </label>
                                            <select class="form-control " id="bank_payable_type" name="payable_type" onchange="editexpendTrasactionType();">
                                                <option value="">Select Amount Type </option>
                                                <option value="cash">CASH</option>';

                                        foreach ($bank_details as $bank) 
                                        {
                                            if($bank->bank_id == $details->payable_type)
                                            {
                                                $form .= '<option value="'.$bank->bank_id.'" selected>
                                                            '.$bank->bank_name.' ('.$bank->account_no.')
                                                        </option>';
                                            }   
                                            else
                                            {                                                     
                                                $form .= '<option value="'.$bank->bank_id.'">
                                                            '.$bank->bank_name.' ('.$bank->account_no.')
                                                        </option>';
                                            }
                                        }
                                    }
                                
                                                         
                                    $form .= '</select>
                                        </div>
                                    
                                        <div class="form-group col-sm-3 col-md-3" style="display: none;" id="cheque_details">
                                            <label class="control-label">Cheque Number</label>
                                            <input class="form-control" type="text" name="Cheque_Number" id="Cheque_Number" value="'.$details->Cheque_Number.'">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12">
                                            <label class="control-label asterisk">Region</label>
                                            <textarea class="form-control" type="text" name="region" id="region" value="'.$details->region.'" >'.$details->region.'</textarea>
                                        </div>
                                    </div>
                                </div>        
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary bg_green">update</button>
                                </div> 
                            ';

        echo $form;    
    }


    function amountExpendForm()
    {
        $userInfo = $this->session->admin_login_data;
        $admin_id = $userInfo['admin_id'];

        $data = array(
            'amount_expend' => $this->input->post('amount_expend'),
            'created_date'  => $this->input->post('created_date'), 
            'payable_type'  => $this->input->post('payable_type'),
            'Cheque_Number' => $this->input->post('Cheque_Number'),
            'region'        => $this->input->post('region'), 
            'admin_id'      => $admin_id,   
        );

        $adminInfo = $this->adminmodel->getUserBasicInfo($admin_id);
        
        if($adminInfo->intial_investment >= $data['amount_expend'] && $data['payable_type'] == "cash")
        {
            $this->expendmodel->amountExpend($data);
            echo json_encode("true");
        }
        else if($data['payable_type'] != "cash")
        {
            $this->expendmodel->amountExpend($data);
            echo json_encode("true");
        }
        else
        {
            echo json_encode("false");
        }

    }

    function editamountExpendForm()
    {
        $userInfo = $this->session->admin_login_data;
        $admin_id = $userInfo['admin_id'];
        $amount_expend = $this->input->post('amount_expend');
        $data = array(
            'created_date'  => $this->input->post('created_date'), 
            'payable_type'  => $this->input->post('payable_type'),
            'Cheque_Number' => $this->input->post('Cheque_Number'),
            'region'        => $this->input->post('region'), 
            'personal_expenses_id' => $this->input->post('personal_expenses_id'),
            'transaction_id' => $this->input->post('transaction_id'),
            'admin_id'      => $admin_id,   
        );

        $adminInfo = $this->adminmodel->getUserBasicInfo($admin_id);
        $expenseDetails = $this->expendmodel->getExpenseDetails($data['personal_expenses_id']);
            
        if($adminInfo->intial_investment >= $amount_expend && $data['payable_type'] == "cash")
        {
            if($expenseDetails->amount_expend == $amount_expend)
            {
                $data['amount_expend'] = $amount_expend;
                $data['intial_investment'] = $adminInfo->intial_investment;
            }
            else if($expenseDetails->amount_expend > $amount_expend)
            {
                $data['amount_expend'] = $amount_expend;
                $data['intial_investment'] = $adminInfo->intial_investment + ($expenseDetails->amount_expend - $amount_expend);
            }
            else if($expenseDetails->amount_expend < $amount_expend)
            {
                $data['amount_expend'] = $amount_expend;
                $data['intial_investment'] = $adminInfo->intial_investment - ($amount_expend - $expenseDetails->amount_expend);
            }
            $this->expendmodel->editExpense($data);
            echo json_encode("true");
        }
        else if($data['payable_type'] != "cash")
        {
            $data['amount_expend'] = $amount_expend;
            $this->expendmodel->editExpense($data);
            echo json_encode("true");
        }
        else
        {
            echo json_encode("false");
        }
    }


    function fetch_details()
    {   
        $fetch_data = $this->expendmodel->make_datatables();
        $data = array();
        $no=0;
        foreach($fetch_data as $expend)  
        { 
            $no+=1;
            $sub_array = array();
            $expenses_id= $expend->personal_expenses_id;
            $amount= $expend->amount_expend;
            $payable_type = $expend->payable_type;
            
            if(isset($expend->Cheque_Number) && !empty($expend->Cheque_Number))
                $Cheque_Number = $expend->Cheque_Number;
            else
                $Cheque_Number = "N/A";

            $created_date = date('D M d, Y', strtotime($expend->created_date));
            $deleted_date = $expend->deleted_date;

            $id = $expend->admin_id;
            $details = $this->adminmodel->make_subadmindatatables($id);

            $admin_name  ="<span class='user_name'>".$details->f_name." ".$details->l_name."<br>";
            

            if($payable_type !="case") 
            {
                $details=$this->bankmodel->getBankDetails($payable_type);
                if (!empty($details)) 
                {
                    $payable_type = $details->bank_name." : ";
                    $payable_type .= $details->account_no;
                }
                
            }
            else 
            {
                $payable_type = "Cash";
            }
            $region= $expend->region;
           
            
            $sub_array = array(
                // $no,
                "<span style='background: #00ffff;padding: 2px 8px;color: black; border-radius:50px;'>
                <strong>₹ ".$amount."</strong></span><br>",
                $payable_type,
                $Cheque_Number,
                $created_date,
                $region,
                // $admin_name,
                '<a href="javascript:void(0);" onclick=editDetails('.$expenses_id.') class="btn btn-primary"><i class="fa fa-pencil"></i></a>',

            );

            $data[] = $sub_array; 
        }  
        $output = array(  
            "draw"            =>   intval($_POST["draw"]),  
            "recordsTotal"    =>   $this->expendmodel->get_all_data(),  
            "recordsFiltered" =>   $this->expendmodel->get_filtered_data(),  
            "data"            =>   $data,
        );  
        echo json_encode($output);  
    }

    

    function fetch_super_admin_details()
    {   
        $fetch_data = $this->expendmodel->make_super_admin_datatables();
        $data = array();
        $no=0;
        foreach($fetch_data as $expend)  
        { 
            $no+=1;
            $sub_array = array();
            $expenses_id= $expend->personal_expenses_id;
            $amount= $expend->amount_expend;
            $payable_type = $expend->payable_type;
            
            if(isset($expend->Cheque_Number) && !empty($expend->Cheque_Number))
                $Cheque_Number = $expend->Cheque_Number;
            else
                $Cheque_Number = "N/A";

            $created_date = date('D M d, Y', strtotime($expend->created_date));
            $deleted_date = $expend->deleted_date;

            $id = $expend->admin_id;
            $details = $this->adminmodel->make_subadmindatatables($id);

            $admin_name  ="<span class='user_name' style='background:#00ff8c !important;color: #000 !important;'>".$details->f_name." ".$details->l_name."<br>";
            

            if($payable_type !="case") 
            {
                $details=$this->bankmodel->getBankDetails($payable_type);
                if (!empty($details)) 
                {
                    $payable_type = $details->bank_name." : ";
                    $payable_type .= $details->account_no;
                }
                
            }
            else 
            {
                $payable_type = "Cash";
            }
            $region= $expend->region;
           
            
            $sub_array = array(
                // $no,
                "<span style='background: #00ffff;padding: 2px 8px;color: black; border-radius:50px;'>
                <strong>₹ ".$amount."</strong></span><br>",
                $payable_type,
                $Cheque_Number,
                $created_date,
                $region,
                $admin_name,
                // '<a href="javascript:void(0);" onclick=editDetails('.$expenses_id.') class="btn btn-primary"><i class="fa fa-pencil"></i></a>',

            );

            $data[] = $sub_array; 
        }  
        $output = array(  
            "draw"            =>   intval($_POST["draw"]),  
            "recordsTotal"    =>   $this->expendmodel->get_all_super_admin_data(),  
            "recordsFiltered" =>   $this->expendmodel->get_filtered_super_admin_data(),  
            "data"            =>   $data,
        );  
        echo json_encode($output);  
    }

}