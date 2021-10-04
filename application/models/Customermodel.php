<?php

Class Customermodel extends CI_Model
{   
 	function make_query()  
	{  	
		$this->userInfo = $this->session->admin_login_data;
        $admin_id = $this->userInfo['admin_id'];

		
		$order_column = array(null,"f_name", null, null, "no_of_loan", "total_loan", null, null);
		
        if (isset($admin_id) && $admin_id == 1) 
        {
        	$this->db->select('*');
			$this->db->from('customer');
		}
		else
		{
			$this->db->select('*');
			$this->db->from('customer');
		    $this->db->where('admin_id',$admin_id);

		}	
      
        if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]))  
		{  
			$this->db->group_start();

			
			$this->db->or_like("f_name", $_POST["search"]["value"]);
			$this->db->or_like("p_name", $_POST["search"]["value"]);
			$this->db->or_like("e_mail", $_POST["search"]["value"]);
			$this->db->or_like("phone", $_POST["search"]["value"]);
			$this->db->or_like("aadhar_no", $_POST["search"]["value"]);
			$this->db->or_like("city", $_POST["search"]["value"]);
			$this->db->or_like("address", $_POST["search"]["value"]);
			$this->db->or_like("state", $_POST["search"]["value"]);
			$this->db->or_like("postal_code", $_POST["search"]["value"]);
			$this->db->or_like("total_loan", $_POST["search"]["value"]);
			$this->db->or_like("no_of_loan", $_POST["search"]["value"]);
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


 	function make_super_admin_query()  
	{  	
		$this->userInfo = $this->session->admin_login_data;
        $admin_id = $this->userInfo['admin_id'];

		
		$order_column = array(null,"f_name", null, null, "no_of_loan", "total_loan", null, null);
		
        if (isset($admin_id) && $admin_id == 1) 
        {
        	$this->db->select('customer.*');
			$this->db->from('customer');
            $this->db->join('admin','customer.admin_id = admin.admin_id','left');
		}
		else
		{
			$this->db->select('customer.*');
			$this->db->from('customer');
            $this->db->join('admin','customer.admin_id = admin.admin_id','left');
		    $this->db->where('customer.admin_id',$admin_id);

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

				
				$this->db->or_like("customer.f_name", $_POST["search"]["value"]);
				$this->db->or_like("customer.p_name", $_POST["search"]["value"]);
				$this->db->or_like("customer.e_mail", $_POST["search"]["value"]);
				$this->db->or_like("customer.phone", $_POST["search"]["value"]);
				$this->db->or_like("customer.aadhar_no", $_POST["search"]["value"]);
				$this->db->or_like("customer.city", $_POST["search"]["value"]);
				$this->db->or_like("customer.postal_code", $_POST["search"]["value"]);
				$this->db->or_like("customer.address", $_POST["search"]["value"]);
				$this->db->or_like("customer.state", $_POST["search"]["value"]);
				$this->db->or_like("customer.total_loan", $_POST["search"]["value"]);
				$this->db->or_like("customer.no_of_loan", $_POST["search"]["value"]);

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
			$this->db->order_by("customer.f_name","asc"); 
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


	public function addCustomerDetails($model_data)
	{
		if($this->db->insert('customer',$model_data)){
			return true;
		}

	}

	public function updateCustomerDetails($model_data)
	{
		$this->db->where('customer_id',$model_data['customer_id']);
		if($this->db->update('customer',$model_data)){
			return true;
		}

	}


	public function getCustomerDetails($customer_id)
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('customer_id',$customer_id);
		return $this->db->get()->row();
	}

	public function getAllCustomerDetails($admin_id)
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('admin_id',$admin_id);
		$this->db->where('deleted_date' ,0000-00-00);
		return $this->db->get()->result();
	}
}