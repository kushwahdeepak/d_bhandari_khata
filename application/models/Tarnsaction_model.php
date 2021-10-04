<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Tarnsaction_model extends CI_Model
{  


    function make_query()  
    {   
        $this->userInfo = $this->session->admin_login_data;
        $admin_id = $this->userInfo['admin_id'];

        $order_column = array("transaction_amount", null, null, null);
        
        if (isset($admin_id) && $admin_id == 1) 
        {
            $this->db->select('transection.*, bank_details.account_no, bank_details.bank_name');
            $this->db->from('transection');
            $this->db->join('bank_details','transection.transaction_type = bank_details.bank_id','left');
        }
        else
        { 
            $this->db->select('transection.*, bank_details.account_no, bank_details.bank_name');
            $this->db->from('transection');
            $this->db->join('bank_details','transection.transaction_type = bank_details.bank_id','left');
            $this->db->where('transection.transaction_admin_id',$admin_id);

        }
        
        if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]))  
        {  
            $this->db->group_start();
            $this->db->or_like("transection.transaction_amount", $_POST["search"]["value"]);
            $this->db->or_like("transection.transaction_created_date", $_POST["search"]["value"]);
            $this->db->or_like("transection.transaction_perpose", $_POST["search"]["value"]);
            $this->db->or_like("transection.transaction_type", $_POST["search"]["value"]);
            $this->db->or_like("bank_details.account_no", $_POST["search"]["value"]);
            $this->db->or_like("bank_details.bank_name", $_POST["search"]["value"]);
            $this->db->group_end();
        } 


        if(isset($_POST["order"]) && !empty($_POST["order"]))  
        {  
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else  
        {  
            $this->db->order_by("transaction_amount","asc"); 
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













    function make_super_admin_query()  
    {   
        $this->userInfo = $this->session->admin_login_data;
        $admin_id = $this->userInfo['admin_id'];
        $order_column = array("transaction_amount", null, null, null, null);
        
        if (isset($admin_id) && $admin_id == 1) 
        {
            $this->db->select('transection.*, bank_details.account_no, bank_details.bank_name');
            $this->db->from('transection');
            $this->db->join('bank_details','transection.transaction_type = bank_details.bank_id','left');
            $this->db->join('admin','transection.transaction_admin_id = admin.admin_id','left');
        }
        else
        { 
            $this->db->select('transection.*, bank_details.account_no, bank_details.bank_name');
            $this->db->from('transection');
            $this->db->join('bank_details','transection.transaction_type = bank_details.bank_id','left');
            $this->db->where('transection.transaction_admin_id',$admin_id);

        }
        $search_admin_id = $_POST["search_name"];
        if($search_admin_id != "name")
        {
            $this->db->where("admin.admin_id", $search_admin_id);
        }
        else
        {
            if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]))  
            {  
                $this->db->group_start();
                $this->db->or_like("transection.transaction_amount", $_POST["search"]["value"]);
                $this->db->or_like("transection.transaction_created_date", $_POST["search"]["value"]);
                $this->db->or_like("transection.transaction_perpose", $_POST["search"]["value"]);
                $this->db->or_like("transection.transaction_type", $_POST["search"]["value"]);
                $this->db->or_like("bank_details.account_no", $_POST["search"]["value"]);
                $this->db->or_like("bank_details.bank_name", $_POST["search"]["value"]);
                $this->db->or_like("admin.f_name", $_POST["search"]["value"]);
                $this->db->or_like("admin.l_name", $_POST["search"]["value"]);
                $this->db->group_end();
            } 
        }


        if(isset($_POST["order"]) && !empty($_POST["order"]))  
        {  
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else  
        {  
            $this->db->order_by("transection.transaction_amount","asc"); 
        }
    }  
  

    function make_super_admin_datatables()
    {  
        $this->make_super_admin_query();

        if($_POST["length"] != -1)  
        {  
            $this->db->limit($_POST['length'], $_POST['start']);  
        }  
        return $this->db->get()->result();
    }



    function get_filtered_super_admin_data()
    {  
        $this->make_super_admin_query();
        $query = $this->db->get();  
        return $query->num_rows();  
    }




    function get_all_super_admin_data()  
    {  
        $this->make_super_admin_query();
        return $this->db->count_all_results();  
    }




    public function getAdminTransactions($admin_id) 
    {
        $this->db->select('*');
        $this->db->from('transection');
        $this->db->where('transaction_admin_id',$admin_id);
        return $this->db->get()->result();
    }

}