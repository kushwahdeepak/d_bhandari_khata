<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
    }


    function fetch_details()
    {   
        $fetch_data = $this->bankmodel->make_datatables();
        $data = array();
        $no=0;
        foreach($fetch_data as $bank)  
        { 
            $sub_array = array();
            $no+=1;

            $bank_id=$bank->bank_id;
            $account_no=$bank->account_no;
            $account_holder_name=$bank->account_holder_name;
            $bank_name=$bank->bank_name;
            $ifsc_code=$bank->ifsc_code;
            $type=$bank->type;
            $status=$bank->status;

            if($status==1)
            {
                $status ='<a href="javascript:void(0);" onclick="disableBankStatus('.$bank_id.');"><img src="'.base_url().'assets/images/true.png" alt="Active" style="margin-top:10px;" width="30" height="30" title="Active"></a>';
            }
            else
            {
                $status='<a  href="javascript:void(0);" onclick="enableBankStatus('.$bank_id.');"><img src="'.base_url().'assets/images/false.png" alt="Deactive" style="margin-top:10px;" width="30" height="30"></a>';
            }

            $sub_array = array(
                $no,
                "<strong>Account No:- </strong> <span style='background: aqua;padding: 2px 8px;color: black; border-radius:50px;'><strong>".$account_no."</strong></span><br><strong>Account Holder Name:- </strong>".$account_holder_name."<br><strong>Bank Name(IFSC):- </strong>".$bank_name." (".$ifsc_code.")",
                // $type,
                $status,
                $user_action='<a href="javascript:void(0);" onclick="editBank('.$bank_id.');" class="btn btn-primary"><i class="fa fa-pencil"></i></a>',
            );

            $data[] = $sub_array; 
        }  
        $output = array(  
            "draw"            =>   intval($_POST["draw"]),  
            "recordsTotal"    =>   $this->bankmodel->get_all_data(),  
            "recordsFiltered" =>   $this->bankmodel->get_filtered_data(),  
            "data"            =>   $data  
        );  
        echo json_encode($output);  
    }

    public function editBankDetails() 
    {
        $bank_id = $this->input->post('bank_id');
        if(!empty($bank_id))  {

            $details=$this->bankmodel->getBankDetails($bank_id);
           
            $bank= "";
            $bank .='
                <input type="hidden" id="updateBankId" name="bank_id" value="'.$bank_id.'">
                <div class="row">
                    <div class="form-group col-sm-12 col-md-12">
                        <label class="control-label asterisk">Account No: </label>
                        <input type="text" class="form-control" name="account_no" value="'.$details->account_no.'" required="required">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label asterisk">Name: </label>
                        <input autocomplete="off" type="text" class="form-control datemask3" id="edit_event_date_from" name="account_holder_name" value="'.$details->account_holder_name.'" required="required" style="padding-top: 0px;">
                    </div>
                     <div class="form-group col-md-6">
                        <label class="control-label asterisk">Bank Name: </label>
                        <input autocomplete="off" type="text" class="form-control datemask3" id="bank_name" name="bank_name" value="'.$details->bank_name.'" required="required" style="padding-top: 0px;">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label asterisk">IFSC Code: </label>
                        <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" value="'.$details->ifsc_code.'" required="required">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Type: </label>
                       <select  class="form-control clockpicker"  data-placement="left" data-align="top" data-autoclose="true" id="Type" name="Type">
                            <option value="">Select Account Type</option>';


                        if($details->type == "saving")
                        {

                           $bank .='
                          <option value="saving" selected> Saving</option>
                          <option value="current"> Current</option>';
                      }
                      else
                      {

                           $bank .='
                          <option value="saving"> Saving</option>
                          <option value="current" selected> Current</option>';
                      }
                        


                         $bank .='</select>
                    </div>  
                </div>
            ';
             echo json_encode($bank);

        }
    }


    public function updateBankInfo()
    {
       
        
        $model_data = array(
            'bank_id' =>  $this->input->post('bank_id'),
            'account_no' => $this->input->post('account_no'),
            'account_holder_name' => $this->input->post('account_holder_name'),
            'bank_name' => $this->input->post('bank_name'),
            'ifsc_code' => $this->input->post('ifsc_code'),
            'type' => $this->input->post('Type'),
            'status' => $this->input->post('Status')

        );
        if($this->bankmodel->updateBankDetails($model_data)){
            echo json_encode(true);
        }
        
    }

    public function addBankInfo()
    {
        $userInfo = $this->session->admin_login_data;
        $model_data = array(
            'admin_id' => $userInfo['admin_id'],
            'account_no' => $this->input->post('account_no'),
            'account_holder_name' => $this->input->post('account_holder_name'),
            'bank_name' => $this->input->post('bank_name'),
            'ifsc_code' => $this->input->post('ifsc_code'),
            'type' => $this->input->post('Type'),
            'status' => 1,
            'created_date'=>date('Y-m-d'),
            'deleted_date'=>0000-00-00,

        );
        if($this->bankmodel->addBankDetails($model_data)){
            echo json_encode(true);
        }
        
    }
    public function disableBankStatus()
    {
        
        $bank_id=$this->input->post('bank_id');
        $data= array(
            'bank_id' => $bank_id,
            'status' =>0
             );
        if($this->bankmodel->disableBankStatus($data)){
            echo json_encode(true);
        }

    }

    public function enableBankStatus()
    {
        
        $bank_id=$this->input->post('bank_id');
        $data= array(
            'bank_id' => $bank_id,
            'status' =>1
             );
        if($this->bankmodel->disableBankStatus($data)){
            echo json_encode(true);
        }

    }

}