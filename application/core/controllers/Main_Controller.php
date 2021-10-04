<?php
/**
 * Base Controller for Admin module
 */
class Main_Controller extends MY_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
    	$this->is_logged_in();
    	$this->userInfo = $this->session->admin_login_data;
	}

	// Render template (override parent)
	protected function render($view_file)
	{
		parent::render($view_file);
	}


    // check for authrnticate user
    public function checkAuthentication() 
    {
        if(!isset($this->userInfo['admin_id']) && empty($this->userInfo['admin_id'])) 
        {
            redirect('login/loginPage');
        }
    }

}
?>
