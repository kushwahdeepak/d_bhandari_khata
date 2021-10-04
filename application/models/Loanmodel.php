<?php

Class Loanmodel extends CI_Model
{   
 	function make_query()  
	{  	
		$this->userInfo = $this->session->admin_login_data;
        $admin_id = $this->userInfo['admin_id'];

		
		$order_column = array(null, null, null, null, "amount", null, null, null);
		
       if (isset($admin_id) && $admin_id == 1) 
       {
          
			$this->db->select('loan.*, customer.f_name, customer.l_name, customer.p_name, customer.phone, customer.whatsapp, customer.city, customer.address, customer.state, customer.postal_code, customer.aadhar_no');
			$this->db->from('loan');
			$this->db->join('customer','loan.customer_id = customer.customer_id','left');
			// $this->db->group_by('loan_security.loan_id'); 
			// $this->db->where('admin_id',$admin_id);
       }
       else
       {
          
			$this->db->select('loan.*, customer.f_name, customer.l_name, customer.p_name, customer.phone, customer.whatsapp, customer.city, customer.address, customer.state, customer.postal_code, customer.aadhar_no');
			$this->db->from('loan');
			$this->db->join('customer','loan.customer_id = customer.customer_id','left');
			// $this->db->join('loan_security','loan.loan_id = loan_security.loan_id','left');
			// $this->db->group_by('loan_security.loan_id'); 
			$this->db->where('loan.admin_id',$admin_id);
       }

		if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]))  
		{  
			$this->db->group_start();

			
			$this->db->or_like("loan.amount", $_POST["search"]["value"]);
			$this->db->or_like("loan.loan_date", $_POST["search"]["value"]);
			$this->db->or_like("loan.payable_type", $_POST["search"]["value"]);
			$this->db->or_like("loan.percentage", $_POST["search"]["value"]);
			$this->db->or_like("loan.security", $_POST["search"]["value"]);
			$this->db->or_like("loan.gold_current_rate", $_POST["search"]["value"]);
			$this->db->or_like("loan.silver_current_rate", $_POST["search"]["value"]);


			$this->db->or_like("customer.f_name", $_POST["search"]["value"]);
			$this->db->or_like("customer.l_name", $_POST["search"]["value"]);
			$this->db->or_like("customer.p_name", $_POST["search"]["value"]);
			$this->db->or_like("customer.phone", $_POST["search"]["value"]);
			$this->db->or_like("customer.whatsapp", $_POST["search"]["value"]);
			$this->db->or_like("customer.city", $_POST["search"]["value"]);
			$this->db->or_like("customer.address", $_POST["search"]["value"]);
			$this->db->or_like("customer.state", $_POST["search"]["value"]);
			$this->db->or_like("customer.postal_code", $_POST["search"]["value"]);
			$this->db->or_like("customer.aadhar_no", $_POST["search"]["value"]);
			$this->db->or_like("customer.e_mail", $_POST["search"]["value"]);

			$this->db->group_end();
		} 


		if(isset($_POST["order"]) && !empty($_POST["order"]))  
		{  
			$this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else  
		{  
			$this->db->order_by("loan.amount","asc"); 
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

		
		$order_column = array(null, null, null, null, "amount", null, null, null, null);
		
       if (isset($admin_id) && $admin_id == 1) 
       {
          
			$this->db->select('loan.*, customer.f_name, customer.l_name, customer.p_name, customer.phone, customer.whatsapp, customer.city, customer.address, customer.state, customer.postal_code, customer.aadhar_no');
			$this->db->from('loan');
			$this->db->join('customer','loan.customer_id = customer.customer_id','left');
            $this->db->join('admin','loan.admin_id = admin.admin_id','left');
       }
       else
       {
          
			$this->db->select('loan.*, customer.f_name, customer.l_name, customer.p_name, customer.phone, customer.whatsapp, customer.city, customer.address, customer.state, customer.postal_code, customer.aadhar_no');
			$this->db->from('loan');
			$this->db->join('customer','loan.customer_id = customer.customer_id','left');
            $this->db->join('admin','loan.admin_id = admin.admin_id','left');
			$this->db->where('loan.admin_id',$admin_id);
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

				
				$this->db->or_like("loan.amount", $_POST["search"]["value"]);
				$this->db->or_like("loan.loan_date", $_POST["search"]["value"]);
				$this->db->or_like("loan.payable_type", $_POST["search"]["value"]);
				$this->db->or_like("loan.percentage", $_POST["search"]["value"]);
				$this->db->or_like("loan.security", $_POST["search"]["value"]);
				$this->db->or_like("loan.gold_current_rate", $_POST["search"]["value"]);
				$this->db->or_like("loan.silver_current_rate", $_POST["search"]["value"]);


				$this->db->or_like("customer.f_name", $_POST["search"]["value"]);
				$this->db->or_like("customer.l_name", $_POST["search"]["value"]);
				$this->db->or_like("customer.p_name", $_POST["search"]["value"]);
				$this->db->or_like("customer.phone", $_POST["search"]["value"]);
				$this->db->or_like("customer.whatsapp", $_POST["search"]["value"]);
				$this->db->or_like("customer.city", $_POST["search"]["value"]);
				$this->db->or_like("customer.address", $_POST["search"]["value"]);
				$this->db->or_like("customer.state", $_POST["search"]["value"]);
				$this->db->or_like("customer.postal_code", $_POST["search"]["value"]);
				$this->db->or_like("customer.aadhar_no", $_POST["search"]["value"]);
				$this->db->or_like("customer.e_mail", $_POST["search"]["value"]);

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
			$this->db->order_by("amount","asc"); 
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





    function loan_Securitydata($loan_id)
    {
    	$this->db->select('*');
		$this->db->from('loan_security');
		$this->db->where('loan_id',$loan_id);
		return $this->db->get()->row();

    }

	function customer_datatables($customer_id)
	{  
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('customer_id',$customer_id);
		return $this->db->get()->row();
	}

	public function customer_intrest_day($date)
	{
		$todaydate = date("Y-m-d");
        $this->db->select("SUM(count) AS today");
        $this->db->from("hindi_calendar");
		$this->db->where('date >=', $date);
		$this->db->where('date <=', $todaydate);
        $query1 = $this->db->get();
        if($query1->num_rows() > 0)
        { 
         $res = $query1->row_array();
         return $res['today'];
        }
        else
        {
       		return 0;
       	}
    }

	public function customer_dashboard_intrest_day($date, $last_date)
	{
		$todaydate = date("Y-m-d");
        $this->db->select("SUM(count) AS today");
        $this->db->from("hindi_calendar");
		$this->db->where('date >=', $date);
		$this->db->where('date <=', $last_date);
        $query1 = $this->db->get();
        if($query1->num_rows() > 0)
        { 
         $res = $query1->row_array();
         return $res['today'];
        }
        else
        {
       		return 0;
       	}
    }







	function addLoanDetails($array_data)
	{
		$customer_id  = $array_data['customer_id'];
		$admin_id     = $array_data['admin_id'];
		$created_date = $array_data['loan_date'];
		$security     = $array_data['security'];

        $add_loan_data = array(
            'admin_id'     => $admin_id, 
            'customer_id'  => $customer_id,
            'amount'       => $array_data['amount'], 
            'security'     => $array_data['security'], 
            'percentage'   => $array_data['percentage'], 
            'payable_type' => $array_data['payable_type'], 
            'note'         => $array_data['note'],
            'loan_date'    => $array_data['loan_date'], 
            'created_date' => $created_date, 
        );

        if ($security == "gold") 
        {
        	$add_loan_data['gold_current_rate'] = $array_data['gold_current_rate'];	
        }
        else if ($security == "silver")
        {
        	$add_loan_data['silver_current_rate'] = $array_data['silver_current_rate'];
        }
        else if ($security == "gold_silver")
        {
        	$add_loan_data['gold_current_rate'] = $array_data['gold_current_rate'];	
            $add_loan_data['silver_current_rate'] = $array_data['silver_current_rate'];
        } 


       	$this->db->insert('loan',$add_loan_data);
       	$loan_id = $this->db->insert_id();

       	if ($security == "gold" || $security == "gold_silver") 
        {
        	$gold_item_count = sizeof($array_data['gold_item_name']);
        	for ($i=0; $i < $gold_item_count; $i++) 
        	{ 
        		$add_gold_security = array(
		            'loan_id'     	=> $loan_id, 
		            'customer_id'  	=> $customer_id,
		            'item_name'     => $array_data['gold_item_name'][$i], 
		            'item_type'     => "gold", 
		            'item_weight'   => $array_data['gold_item_weight'][$i], 
		            'item_value' 	=> $array_data['gold_item_value'][$i], 
		            'item_purity'   => $array_data['gold_item_purity'][$i],
		            'item_quantity' => $array_data['gold_item_quantity'][$i],
		            // 'item_photo'    => $array_data['gold_item_photo'][$i], 
		        );

	            if($array_data['gold_item_photo'])
	                $add_gold_security['item_photo'] = $array_data['gold_item_photo'][$i];

		        $this->db->insert('loan_security',$add_gold_security);
        	}	
        }
        if ($security == "silver" || $security == "gold_silver")
        {
        	$silver_item_count = sizeof($array_data['silver_item_name']);
        	for ($i=0; $i < $silver_item_count; $i++) 
        	{ 
        		$add_silver_security = array(
		            'loan_id'     	=> $loan_id, 
		            'customer_id'  	=> $customer_id,
		            'item_name'     => $array_data['silver_item_name'][$i], 
		            'item_type'     => "silver", 
		            'item_weight'   => $array_data['silver_item_weight'][$i], 
		            'item_value' 	=> $array_data['silver_item_value'][$i], 
		            'item_purity'   => $array_data['silver_item_purity'][$i],
		            'item_quantity' => $array_data['silver_item_quantity'][$i], 
		            // 'item_photo'    => $array_data['silver_item_photo'][$i], 

		        );
	            if($array_data['silver_item_photo'])
	                $add_silver_security['item_photo'] = $array_data['silver_item_photo'][$i];
	            
		        $this->db->insert('loan_security',$add_silver_security);
        	}
        }

        if($array_data['payable_type'] == "bank")
        {   
            $add_bank_data = array(
	            'loan_id'     	=> $loan_id, 
	            'customer_id'  	=> $customer_id,
	            'bank_id'       => $array_data['account_id'], 
	            'chaque'        => $array_data['cheque'],
	            'amount'        => $array_data['amount'],
	        );
	        $this->db->insert('loan_bank_history',$add_bank_data);       
        }
        else
        {
        	$admin_intial_amount = $this->adminmodel->getAdminIntialAmount($admin_id);

        	$update_admin_intial_investment = array(
	            'intial_investment' => $admin_intial_amount->intial_investment - $array_data['amount']
	        );
       		$this->db->where('admin_id',$admin_id);
	        $this->db->update('admin',$update_admin_intial_investment);
        }

        if (!empty($array_data['amount']))
        {
        	$customer_loan = $this->customermodel->getCustomerDetails($customer_id);

        	$update_customer_loan = array(
	            'total_loan' => $customer_loan->total_loan + $array_data['amount'],
	            'no_of_loan' => $customer_loan->no_of_loan + "1"
	        );
       		$this->db->where('customer_id',$customer_id);
	        $this->db->update('customer',$update_customer_loan);

        }

        //--------------------transation data- -----------------------------

        $add_transaction_data = array(
            'transaction_admin_id'     => $admin_id, 
            'transaction_amount'       => $array_data['amount'], 
            'transaction_type'         => $array_data['payable_type'], 
            'transaction_date'         => $created_date,
            // 'transaction_perpose'      => '<p>i have give loan Mr./Mis.<h3 >"'.$customer_loan->l_name.'"</h3>.S/O '.$customer_loan->p_name.' 
            // 								and loan amount is "'.$array_data['amount'].'".</p>',

            'transaction_perpose'      =>  '<strong>I have give loan Mr./Mis.</strong> 
							                <span style="background: #fff300;padding: 2px 8px;color: black; border-radius:50px;">
							                <strong>'.$customer_loan->f_name." ".$customer_loan->l_name.' S/O '.$customer_loan->p_name.'</strong></span>
							                <strong> and loan amount is </strong>₹ '.$array_data['amount'].'',
             );
        // $add_transaction_data['transaction_perpose'] .= 'i have give loan "'.$customer_loan->l_name.'".S/O '.$customer_loan->p_name.' and loan amount is "'.$array_data['amount'].'".i have give loan by  case /bank.';

        if($array_data['payable_type'] == "cash")
        {
        	$add_transaction_data['transaction_keyword'] = "loan_by_cash";
        }
        else
        {
        	$add_transaction_data['transaction_keyword'] = "loan_by_bank";
        }
        $this->db->insert('transection',$add_transaction_data);

        //--------------------transation data- -----------------------------

        return true;
	}


    function mark_overview($id)  
	{  	
		$this->userInfo = $this->session->admin_login_data;
        $admin_id = $this->userInfo['admin_id'];

		if (isset($admin_id) && $admin_id == 1)
		{
			$this->db->select('*');
			$this->db->from('loan');
			$this->db->where('loan.loan_id',$id);
		}
		else
		{
			$this->db->select('*');
			$this->db->from('loan');
			$this->db->where('loan.loan_id',$id);
			$this->db->where('admin_id',$admin_id);
		}
	   
    }  

     function loan_security_data($loan_id)  
	{  	
		$this->userInfo = $this->session->admin_login_data;
        $admin_id = $this->userInfo['admin_id'];

		
	    $this->db->select('*');
		$this->db->from('loan_security');
		$this->db->where('loan_security.loan_id',$loan_id);
		return $this->db->get()->result();

    }  
    function loan_overview_date($id)
	{  
		$this->mark_overview($id);

		return $this->db->get()->row();
	}

	function getbankdetails($loan_id)
	{  
		$this->userInfo = $this->session->admin_login_data;
        $admin_id = $this->userInfo['admin_id'];

        $this->db->select('*');
        $this->db->from('loan_bank_history');
        $this->db->join('bank_details','loan_bank_history.bank_id = bank_details.bank_id','left');
        $this->db->where('loan_bank_history.loan_id',$loan_id);
        return $this->db->get()->row();
		
	}

	function completeLoan($array_data)
	{  
     $admin_id         =  $array_data['admin_id'];
     $customer_id      =  $array_data['customer_id'];
     $loan_id          =  $array_data['loan_id'];
     $amount           =  $array_data['amount'];
     $amount_with_interst           =  $array_data['amount_with_interst'];
     $profit_amount    =  $amount_with_interst - $amount;
     $completed_date   =  $array_data['completed_date'];
     $date             =   date("Y-m-d");
     $todaydate        =  array('completed_date' => $date,'completed_amount' => $array_data['amount'],'completed_amount_with_interst' =>$array_data['amount_with_interst'],);
		if($completed_date == 0000-00-00)
		{
			// for loan update 
	        $this->db->where('loan_id',$loan_id);
			$this->db->update('loan', $todaydate);
            
            // for intial ammount 
			$admin_intial_amount = $this->adminmodel->getAdminIntialAmount($admin_id);

        	$update_admin_intial_investment = array(
	            'intial_investment' => $admin_intial_amount->intial_investment + $amount,
	            'profit_amount'     => $profit_amount
	        );
       		$this->db->where('admin_id',$admin_id);
	        $this->db->update('admin',$update_admin_intial_investment);
        
            // customer loan amount
        	$customer_loan = $this->customermodel->getCustomerDetails($customer_id);
            $update_customer_loan = array(
	            'total_loan' => $customer_loan->total_loan - $amount,
	            'no_of_loan' => $customer_loan->no_of_loan - 1,
	        );

        	$this->db->where('customer_id',$customer_id);
	        $this->db->update('customer',$update_customer_loan);


	        $add_transaction_data = array(
	            'transaction_admin_id'     => $admin_id, 
	            'transaction_amount'       => $array_data['amount_with_interst'], 
	            'transaction_date'         => date('Y-m-d'),
	            'transaction_perpose'      =>  '<strong>Loan is completed</strong>',
	         );
	        $recivable_type = $this->input->post('recivable_type');
			$add_transaction_data['transaction_type'] = $recivable_type;
	        if($recivable_type == "cash")
	        {
				$add_transaction_data['transaction_keyword'] = "loan_completed_by_cash";
	        }
	        else
	        {
				$add_transaction_data['transaction_keyword'] = "loan_completed_by_loan";
	        }
	        $this->db->insert('transection',$add_transaction_data);
	        


            $return = 'true';
	        return $return;
	    }
        else 
        {
           $return = 'false';
           return $return;
        }
    }

    public function createTransactionBankDetail($data)
    {
       	$this->db->insert('loan_completed_details',$data);
       	return true;
    }


	function getCompleteLoanBankInfo($loan_id)
	{  
        $this->db->select('*');
        $this->db->from('loan_completed_details');
        $this->db->where('loan_id',$loan_id);
        return $this->db->get()->row();
		
	}


	function getAdminLoans($admin_id)
	{  
        $this->db->select('*');
        $this->db->from('loan');
        $this->db->where('admin_id',$admin_id);
        return $this->db->get()->result();
		
	}


	function getLoansByDate($admin_id, $date, $loan_status="")
	{  
        $this->db->select('amount, created_date, completed_date, completed_amount, completed_amount_with_interst');
        $this->db->from('loan');
        if($loan_status == "created_date")
        {
        	$this->db->where('created_date',$date);
        }
        else if($loan_status == "completed_date")
        {
        	$this->db->where('completed_date',$date);
        }
        return $this->db->get()->result();
		
	}
}