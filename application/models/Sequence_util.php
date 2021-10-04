<?php

Class Sequence_util extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
    * Function for generating a unique primary key for any table
	*
	* @request $table_name - for table name
	* @request $primary_column_name - for primary key of table
	* @request $sequence_number - for intializing sequence
	* @response $sequence_number - unique sequence number
	*
   	*/
    public function getUniqueSequenceNumber($table_name, $primary_column_name, $sequence_number = 1) {
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($primary_column_name, $sequence_number);
		$query = $this->db->get();
		$numrows = $query->num_rows();	

		if ($numrows >= 1) {
			$sequence_number++;
			return $this->getUniqueSequenceNumber($table_name, $primary_column_name, $sequence_number);
		} else {
			return $sequence_number;
		}		
	}

}