<?php
Class Expendmodel extends CI_Model
{   
    function amountExpend($data)
    {       
         
        $transaction_data = array(
             'transaction_amount' => $data['amount_expend'],
             'transaction_type' => $data['payable_type'],
             'transaction_perpose' => $data['region'],
             'transaction_date' => $data['created_date'],
             'transaction_admin_id' => $data['admin_id'],
        );
        if($data['payable_type'] == "cash")
        {
            $transaction_data['transaction_keyword'] = "expense_by_cash";
        }
        else
        {
            $transaction_data['transaction_keyword'] = "expense_by_bank";
        }

        $this->userInfo = $this->session->admin_login_data;
        $admin_id = $this->userInfo['admin_id'];

        $admin_intial_amount = $this->adminmodel->getAdminIntialAmount($admin_id);
        $update_admin_transaction = array(
                'intial_investment' => $admin_intial_amount->intial_investment - $transaction_data['transaction_amount']
            );
        $this->db->where('admin_id',$admin_id);
        $this->db->update('admin',$update_admin_transaction);
                                             
        $this->db->insert('transection',$transaction_data);
        $data['transaction_id'] = $this->db->insert_id();
        
        $this->db->insert('personal_expenses',$data);
        
        return true;
    }


    function editExpense($data)
    {
        $this->userInfo = $this->session->admin_login_data;
        $admin_id = $this->userInfo['admin_id'];

        if($data['payable_type'] == "cash")
        {
            $admin_intial_amount = $this->adminmodel->getAdminIntialAmount($admin_id);
            $update_admin_intial_investment = array(
                'intial_investment' => $data['intial_investment']
            );
            $this->db->where('admin_id',$admin_id);
            $this->db->update('admin',$update_admin_intial_investment);
        }
        $personal_expenses_data = array(
            'amount_expend' => $data['amount_expend'],
            'created_date'  => $data['created_date'], 
            'payable_type'  => $data['payable_type'],
            'Cheque_Number' => $data['Cheque_Number'],
            'region'        => $data['region'], 
            'personal_expenses_id' => $data['personal_expenses_id'],
            'admin_id'      => $data['admin_id'],  
        );
        
        $this->db->where('personal_expenses_id',$data['personal_expenses_id']);
        if($this->db->update('personal_expenses',$personal_expenses_data))
        {
            $transaction_data = array(
                'transaction_amount' => $data['amount_expend'],
                'transaction_id' => $data['transaction_id'],
            );
            $this->db->where('transaction_id',$transaction_data['transaction_id']);
            $this->db->update('transection',$transaction_data);
            return true;
        }

    }

    function getExpenseDetails($expenses_id)
    {  
        $this->db->select('*');
        $this->db->from('personal_expenses');
        $this->db->where('personal_expenses_id',$expenses_id);
        return $this->db->get()->row();
    }


    function make_query()  
    {   
        $this->userInfo = $this->session->admin_login_data;
        $admin_id = $this->userInfo['admin_id'];

        $order_column = array("amount_expend",null, null, null, null, null);

        
        if (isset($admin_id) && $admin_id == 1 ) 
        { 
            $this->db->select('personal_expenses.*, bank_details.account_no, bank_details.bank_name');
            $this->db->from('personal_expenses');
            $this->db->join('bank_details','personal_expenses.payable_type = bank_details.bank_id','left');
        }
        else
        {
            $this->db->select('personal_expenses.*, bank_details.account_no, bank_details.bank_name');
            $this->db->from('personal_expenses');
            $this->db->join('bank_details','personal_expenses.payable_type = bank_details.bank_id','left');
            $this->db->where('personal_expenses.admin_id',$admin_id);
        }
        
       
        if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]))  
        {  
            $this->db->group_start();
            $this->db->or_like("personal_expenses.amount_expend", $_POST["search"]["value"]);
            $this->db->or_like("personal_expenses.payable_type", $_POST["search"]["value"]);
            $this->db->or_like("personal_expenses.Cheque_Number", $_POST["search"]["value"]);
            $this->db->or_like("personal_expenses.created_date", $_POST["search"]["value"]);
            $this->db->or_like("personal_expenses.region", $_POST["search"]["value"]);

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
            $this->db->order_by("amount_expend","asc"); 
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

        $order_column = array("amount_expend",null, null, null, null, null);

        if (isset($admin_id) && $admin_id == 1 ) 
        { 
            $this->db->select('personal_expenses.*, bank_details.account_no, bank_details.bank_name');
            $this->db->from('personal_expenses');
            $this->db->join('bank_details','personal_expenses.payable_type = bank_details.bank_id','left');
            $this->db->join('admin','personal_expenses.admin_id = admin.admin_id','left');
        }
        else
        {
            $this->db->select('personal_expenses.*, bank_details.account_no, bank_details.bank_name');
            $this->db->from('personal_expenses');
            $this->db->join('bank_details','personal_expenses.payable_type = bank_details.bank_id','left');
            $this->db->where('personal_expenses.admin_id',$admin_id);
            $this->db->join('admin','personal_expenses.admin_id = admin.admin_id','left');
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
                $this->db->or_like("personal_expenses.amount_expend", $_POST["search"]["value"]);
                $this->db->or_like("personal_expenses.payable_type", $_POST["search"]["value"]);
                $this->db->or_like("personal_expenses.Cheque_Number", $_POST["search"]["value"]);
                $this->db->or_like("personal_expenses.created_date", $_POST["search"]["value"]);
                $this->db->or_like("personal_expenses.region", $_POST["search"]["value"]);

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
            $this->db->order_by("personal_expenses.amount_expend","asc"); 
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
}