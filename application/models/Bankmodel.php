<?php

Class Bankmodel extends CI_Model 
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('adminmodel');
        $this->load->model('loginmodel');
        // $this->load->model('customer_table_model');
    }






	function make_query()  
	{  	
		$this->userInfo = $this->session->admin_login_data;
        $admin_id = $this->userInfo['admin_id'];

		
		$order_column = array("bank_id","admin_id","account_no","account_holder_name","bank_name","ifsc_code","type","status",null,null);
		


		$this->db->select('*');
		$this->db->from('bank_details');
		$this->db->where('admin_id',$admin_id);


		


		if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]))  
		{  
			$this->db->group_start();

			
			$this->db->or_like("account_no", $_POST["search"]["value"]);
			$this->db->or_like("account_holder_name", $_POST["search"]["value"]);
			$this->db->or_like("bank_name", $_POST["search"]["value"]);
			$this->db->or_like("ifsc_code", $_POST["search"]["value"]);
			$this->db->or_like("type", $_POST["search"]["value"]);
			$this->db->or_like("status", $_POST["search"]["value"]);
			$this->db->group_end();
		} 


		if(isset($_POST["order"]) && !empty($_POST["order"]))  
		{  
			$this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else  
		{  
			$this->db->order_by("bank_name","asc"); 
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

	public function getBankDetails($bank_id)
	{
		$this->db->select('*');
		$this->db->from('bank_details');
		$this->db->where('bank_id',$bank_id);
		return $this->db->get()->row();

	}

	public function BankDetails()
	{
		$this->db->select('*');
		$this->db->from('bank_details');
        return $this->db->get()->result();

	}

	public function updateBankDetails($model_data){

		$this->db->where('bank_id',$model_data['bank_id']);
		if($this->db->update('bank_details',$model_data)){
			return true;
		}

	}

	public function addBankDetails($model_data){

		$this->db->where('admin_id',$model_data['admin_id']);
		if($this->db->insert('bank_details',$model_data)){
			return true;
		}

	}

	public function disableBankStatus($data)
    {
        $this->db->where('bank_id',$data['bank_id']);
        if($this->db->update('bank_details',$data)){
            return true;
            
        }

    }

    public function getAllBankDetails($admin_id)
    {
    	$this->db->select('*');
    	$this->db->from('bank_details');
    	$this->db->where('admin_id',$admin_id);
    	return $this->db->get()->result();
    }

}  