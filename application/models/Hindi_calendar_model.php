<?php

Class Hindi_calendar_model extends CI_Model
{   
    public $userInfo = null;
   

    function __construct()
    {
        parent::__construct();
        $this->userInfo = $this->session->admin_login_data;
    }


    public function updateUserInfo($data)
    {
      

        $this->db->insert('hindi_calendar',$data);
       
        return true;
    }
    
}