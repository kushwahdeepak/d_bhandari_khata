<?php

Class Loginmodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // function verify login credentials
    public function verify_login($email, $password)
    {   
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('e_mail', $email);
        // $this->db->where('admin_type','admin'); 
        $result = $this->db->get();
        $numrows = $result->num_rows();

        if ($numrows == 1) {
            $row = $result->row();

            if (password_verify($password,$row->password)) {
                $this->db->select('*');
                $this->db->from('admin');
                $this->db->where('e_mail', $email);
                // $this->db->where('admin_type', 'admin');
                $query = $this->db->get();
                $data = $query->row();
                return $data;
                
            } else {
                return 0;
            }
        } else {
            return "NO_USER_FOUND";
        }
    }

}
