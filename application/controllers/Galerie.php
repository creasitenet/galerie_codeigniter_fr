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
	
	// AJAX // Retour Json	
	
	// Add 
	public function ajax_add()	{
		
        $text = $this->input->post('value');
		
		if ($text=='') {
            $d['result'] = 0;
            $d['message'] = "La tâche ne peut pas être vide.";
       } else {
			$echappe = array('text' => $text);
            $noechappe=array('status'=>0,'created'=>'NOW()');
			$insert = $this->todos->insert($echappe,$noechappe);
			if($insert) {
				$d['result'] =  1;
	            $d['message'] = "La tâche a été ajoutée.";
				// Pour le refresh
	            $d['url'] = "todo/ajax_refresh";
	            $d['data'] = $insert; // Car la fonction insert de ma classe MY_Model renvoi l'id du dernier enregistrement
	            $d['div'] = "#todos";
			} else {
                $d['result'] =  0;
                $d['message'] =  "Impossible d'ajouter la tâche.";
			}
        }     
   		header('Content-Type: application/json');
    	echo json_encode( $d );
	}
			
	// Refresh
	// J'ai fais le choix de chercher l'enregistrement ajouté pour l'afficher via un partial à la suite des enregistrements déjà affichés.
	// Il aurrait été plus simple et plus rapide (mais moins joli) de rafraichir l'index lors d'un ajout réussi. 
	public function ajax_refresh() {
		$id = intval($this->input->post('value'));
		$data['e'] = $this->todos->get($id);
		print ($this->load->view('todo/_todo',$data, TRUE));
	}
    			
	// MAJ
	public function ajax_maj_status() {
		$id = intval($this->input->post('value'));
        $todo = $this->todos->get($id);
        if ($todo->status==1) {
            $status=0;
            $d['message'] =  "La tâche est à faire.";
        } else {
            $status=1;
            $d['message'] =  "La tâche est finie.";
        }
        $echappe=array();
        $noechappe=array('status'=>$status,'modified'=>'NOW()');
		$this->todos->update($id,$echappe,$noechappe);		
        $d['result'] = $status;
   		header('Content-Type: application/json');
    	echo json_encode( $d );
    }
			
	// DELETE
	public function ajax_delete()	{
		$id = intval($this->input->post('value'));
        if ($this->todos->delete($id)) {
            $d['result'] =  1;
            $d['message'] =  "La tâche a été supprimée.";
        } else {
            $d['result'] =  0;
            $d['message'] = "Impossible de supprimer la tâche.";
        }
   		header('Content-Type: application/json');
    	echo json_encode( $d );
    }
	
}
