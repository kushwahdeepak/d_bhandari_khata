<?php

Class Adminmodel extends CI_Model
{   
    public $userInfo = null;
   

    function __construct()
    {
        parent::__construct();
        $this->userInfo = $this->session->admin_login_data;
    }


    /**
     * Function for getting users info
     * @param $party_id
     * @return mixed
     */
    public function getUserBasicInfo($party_id) 
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('admin_id',$party_id);

        if(!$this->db->get()) {
            show_error('Error in getting basic info');
            die();
        }
        else {
            $this->db->select('*');
            $this->db->from('admin');
            $this->db->where('admin_id',$party_id);
            $row = $this->db->get()->row();
            return $row;
        }
    }

    public function getAdminIntialAmount($admin_id) 
    {
        $this->db->select('intial_investment');
        $this->db->from('admin');
        $this->db->where('admin_id',$admin_id);
        return $this->db->get()->row();
    }

    public function getRate() 
    {
        $this->db->select('*');
        $this->db->from('rate_table');
        return $this->db->get()->row();
    }

    public function getBankDetails() 
    {
        $this->db->select('*');
        $this->db->from('bank_details');
        return $this->db->get()->result();
    }

    
    public function updateUserInfo($model_data)
    {
        $admin_id = $model_data['admin_id'];
        $model_data['created_date'] = date('Y-m-d');
    
        if (empty($admin_id)) {            
            $this->db->insert('admin',$model_data);
        } else {
            $this->db->where('admin_id',$admin_id);
            $this->db->update('admin',$model_data);
        }
        return true;
    }

    public function updateAdminProfilePicture($model_data)
    {
        $this->db->where('admin_id',$model_data['admin_id']);
        if($this->db->update('admin',$model_data))
        {
            return true;
        }   
    }


    public function updateUserPasswordInfo($model_data)
    {
        $party_id = $model_data['party_id'];
        $new_password = $model_data['new_password'];
  
        $PASSWORD = password_hash($new_password, PASSWORD_BCRYPT);

        $sql = "UPDATE `admin` SET `password` = '$PASSWORD' WHERE admin_id = '$party_id'";
        $this->db->query($sql);
    }

    public function updateRate($model_data)
    {
        if($this->db->update('rate_table',$model_data))
        {
            return true;
        }
    }
    
     public function addSubAdminDetails($sub_Admin_data)
    {
        $this->userInfo = $this->session->admin_login_data;
        $admin_id = $this->userInfo['admin_id'];

        $this->db->insert('admin',$sub_Admin_data);
        $new_admin_id = $this->db->insert_id();

        if (!empty($sub_Admin_data['intial_investment'])) 
        {
             $admin_intial_amount = $this->adminmodel->getAdminIntialAmount($admin_id);

            $update_admin_intial_investment = array(
                'intial_investment' => $admin_intial_amount->intial_investment - $sub_Admin_data['intial_investment']
            );
            $this->db->where('admin_id',$admin_id);
            $this->db->update('admin',$update_admin_intial_investment);
        }


        $add_transaction_data = array(
            'transaction_admin_id'     => $new_admin_id, 
            'transaction_amount'       => $sub_Admin_data['intial_investment'], 
            'transaction_type'         => "cash", 
            'transaction_date'         => date('Y-m-d'),
            'transaction_keyword'      => 'user_initial_investment',
            'transaction_perpose'      =>  '<strong>Add Initial Investment is </strong>₹ '.$sub_Admin_data['intial_investment'],
         );
        $this->db->insert('transection',$add_transaction_data);
        $transection_id = $this->db->insert_id();

         $transection_id = array(
                                    'transection_id' => $transection_id
                                );

        $this->db->where('admin_id',$new_admin_id);
        $this->db->update('admin',$transection_id);
        //--------------------transation data- -----------------

        return true;
    }

   
    function make_datatables1()
    {  
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('admin_type','admin');
        return $this->db->get()->result();
    }


    function get_filtered_data1()
    {  
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('admin_type','admin');
        $query = $this->db->get();  
        return $query->num_rows();  
    }


    function get_all_data1()  
    {  
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('admin_type','admin');
        return $this->db->count_all_results();  
    }







    function make_query()  
    {   
        $this->userInfo = $this->session->admin_login_data;
        $admin_id = $this->userInfo['admin_id'];

        
        $order_column = array(null, "f_name","admin_id", null, null, "registration_no", null, null);
        


        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('admin_type','admin');


        


        if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]))  
        {  
            $this->db->group_start();

            
            $this->db->or_like("f_name", $_POST["search"]["value"]);
            $this->db->or_like("l_name", $_POST["search"]["value"]);
            $this->db->or_like("registration_no", $_POST["search"]["value"]);
            $this->db->or_like("e_mail", $_POST["search"]["value"]);
            $this->db->or_like("phone", $_POST["search"]["value"]);
            $this->db->or_like("address", $_POST["search"]["value"]);
            $this->db->or_like("city", $_POST["search"]["value"]);
            $this->db->or_like("state", $_POST["search"]["value"]);
            $this->db->group_end();
        } 


        if(isset($_POST["order"]) && !empty($_POST["order"]))  
        {  
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else  
        {  
            $this->db->order_by("f_name","asc"); 
        }



        
    }  


    function make_datatables()
    {  
        $this->make_query();

        if($_POST["length"] != -1)  
        {  
            $this->db->limit($_POST['length'], $_POST['start']);  
        }  
        return $this->db->get()->result();
    }





    function get_filtered_data()
    {  
        $this->make_query();
        $query = $this->db->get();  
        return $query->num_rows();  
    }




    function get_all_data()  
    {  
        $this->make_query();
        return $this->db->count_all_results();  
    }





    function make_subadmindatatables($id)
    {  
        $this->userInfo = $this->session->admin_login_data;
        $admin_id = $this->userInfo['admin_id'];
        
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('admin_id',$id);
        return $this->db->get()->row();
    }

    function editsubadmin($data)
    {
        $id = $data['admin_id'];
        // $transection_id = $data['transection_id'];
        $update_data = array(
                            'admin_id'               => $data['admin_id'],                                                       
                            'f_name'                 => $data['f_name'],                                                       
                            'l_name'                 => $data['l_name'],                                                       
                            'e_mail'                 => $data['e_mail'],                                                       
                            'phone'                  => $data['phone'],                                                       
                            'name_of_organisation'   => $data['name_of_organisation'],                                                       
                            'establish_year'         => $data['establish_year'],                                                       
                            'intial_investment'      => $data['intial_investment'],                                                       
                            'registration_no'        => $data['registration_no'],                                                       
                            'city'                   => $data['city'],                                                       
                            'state'                  => $data['state'],                                                       
                            'address'                => $data['address'],                                                       
                            'postal_code'            => $data['postal_code'],                                                       
                            'aadhar_no'              => $data['aadhar_no'],                                                       
                            );
        
        $this->db->where('admin_id',$id);
        $this->db->update('admin',$update_data);
        // $this->db->where('transaction_id',$transection_id);
        // $this->db->update('transection',$data);
        return true;
    }


    function addInitialAmount($data)
    {   
        $transaction_data = array(
            'transaction_amount' => $data['amount_add'],
            'transaction_type' => $data['payable_type'],
            'transaction_perpose' => $data['region'],
            'transaction_date' => $data['created_date'],
            'transaction_admin_id' => $data['admin_id'],
            'transaction_perpose'      =>  '<strong>Add Initial Investment is </strong>₹ '.$data['amount_add'],
        );

        if($data['payable_type'] == "cash")
        {
            $transaction_data['transaction_keyword'] = "add_initial_amount_by_cash";
        }
        else
        {
            $transaction_data['transaction_keyword'] = "add_initial_amount_by_bank";
        }
        $this->userInfo = $this->session->admin_login_data;
        $admin_id = $this->userInfo['admin_id'];

        $admin_intial_amount = $this->getAdminIntialAmount($admin_id);
        $update_admin_transaction = array(
            'intial_investment' => $admin_intial_amount->intial_investment + $transaction_data['transaction_amount'],
            'initial_investment_by_admin' => $admin_intial_amount->intial_investment + $transaction_data['transaction_amount']
        );

        $this->db->where('admin_id',$admin_id);
        $this->db->update('admin',$update_admin_transaction);
        $this->db->insert('transection',$transaction_data);
        
        return $update_admin_transaction['intial_investment'];
    }
    

    public function getAllSubAdmin()
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('admin_type',"admin");
        $this->db->where('deleted_date' ,0000-00-00);
        return $this->db->get()->result();
    }
    

    public function getAllLoans() 
    {
        $this->db->select('*');
        $this->db->from('loan');
        return $this->db->get()->result();
    }
    

    public function getChartInfoOnDate($created_date) 
    {
        $this->db->select('*');
        $this->db->from('chart_info');
        $this->db->where('created_date',$created_date);
        return $this->db->get()->row();
    }

    public function getAllChartInfo($admin_id) 
    {
        $this->db->select('*');
        $this->db->from('chart_info');
        $this->db->where('admin_id',$admin_id);
        return $this->db->get()->result();
    }
}