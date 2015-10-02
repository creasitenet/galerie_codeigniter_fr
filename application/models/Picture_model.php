<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Picture_model extends MY_Model {
	
	public function __construct()
	{
        $this->table = 'pictures';
        $this->primary_key = 'id';
       
		parent::__construct();
	}
	
}
