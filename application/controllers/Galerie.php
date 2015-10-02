<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galerie extends CI_Controller {

	public function __construct() {
		//	Obligatoire
		parent::__construct();

		$this->load->model('picture_model', 'pictures');
			
		//$this->output->enable_profiler(TRUE);
	}
	
	// Index // page d'accueil
	public function index()	{
		$data['pictures'] = $this->pictures->as_object()->get_all(); 
	    $this->template->view('galerie/index',$data);
	}
	
	
}
