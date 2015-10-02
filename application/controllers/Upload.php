<?php

class Upload extends CI_Controller {

	public function __construct() {
		//	Obligatoire
		parent::__construct();
		$this->load->model('picture_model', 'pictures');			
		//$this->output->enable_profiler(TRUE);
	}
	
	// Upload // Ajax // Json.
    public function postAjaxUpload() {
        $d['result'] = 0; 	
		
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $erreur = "Seule la methode POST est autorisée ici.";
		}
		
		// Préparation
        if (!isset($error)) {
	        $fileup=$_FILES['Filedata'];
	        $fileup_name=$_FILES['Filedata']['name'];
	        $fileup_size=$_FILES['Filedata']['size'];
	        $fileup_error=$_FILES['Filedata']['error'];
	        $fileup_type=$_FILES['Filedata']['type'];
	        $fileup_tmp_name=$_FILES['Filedata']['tmp_name'];
	        $files_errors = array(
	        0=>"Upload réussi..",
	        1=>"Le fichier est trop lourd.",
	        2=>"La photo est trop grande.",
	        3=>"Le fichier n'a été que partiellement téléchargé.",
	        4=>"Aucun fichier n'a été uploadé.",
	        6=>"Pas de dossier temporaire, contactez le webmaster.",
	        7=>"Échec de l'écriture du fichier sur le disque."
	        );
	        if($fileup_error!=0) { // Erreur
	            $error = $files_errors[$fileup_error];
	        }
    	}

        // Extension 
        if (!isset($error)) {
        	$fileup_name_lower = strtolower($fileup_name); // EN MINUSCULE
        	$fileup_extension = substr(strrchr($fileup_name_lower, '.'),1); // EXTENSION EN MINUSCULE SANS LE POINT
        	$fileup_base = basename($fileup_name_lower,'.'.$fileup_extension); // UN NOM EN MINUSCULE SANS EXTENSION
        	$fileup_name_temp = url_title($fileup_base, '_'); // ON NETTOIRE ENCORE
        	$fileup_new_name=$fileup_name_temp.'.'.$fileup_extension;
	        //$document_auth_extensions = array ('doc', 'fla', 'pdf', 'swf', 'txt');
	        //if (!in_array($fileup_extension, $document_auth_extensions)) {
	        //    $error = $fileup_name." : Extension de fichier non supportée !";
	        //}
	        $picture_auth_extensions = array ('bmp', 'gif', 'iff', 'jp2', 'jpg', 'jpeg', 'png', 'psd', 'tiff', 'wbmp');
	        if (!in_array($fileup_extension, $picture_auth_extensions)) {
	            $error = $fileup_name." : Extension de fichier non supportée !";
	        }
	    }

        // Poid maximum
        if (!isset($error)) {
	        if(($fileup_size==0) OR ($fileup_size > 2000000)) {
	            if($fileup_size==0) {
	                 $error = 'Fichier de 0 ko !';
	            } elseif ($fileup_size>2000000) {
	                $error = $fileup_name." : trop lourd : Max 2mo !"; 
	            }
	        }
	    }

        // Taille // Seulement pour les images
        if (!isset($error)) {
		        $fileup_dim = getimagesize($fileup_tmp_name);
		        if (($fileup_dim[0] > 1024) OR ($fileup_dim[1] > 1024)) {
		            $error = $fileup_name." trop grande : Max 1024 x 1024 pixels !";
		        }
	    }

        // Déplacement du dossier tmeporaire au dossier TEMP souhaité 
        if (!isset($error)) {
	        $fileup_temporaire = './server/TEMP/'.$fileup_new_name; //Chemin de l'image dans une variable.
	        if (!move_uploaded_file($fileup_tmp_name, $fileup_temporaire)) { //Déplacement du fichier avec le son nom d'origine
	            $error = $fileup_name." n'a pas été copié correctement !";
	        }
	    }
		
	    // imagecreatefrom // Seulement pour les images
        if (!isset($error)) {
				if ($fileup_extension=='jpg') { $fileup_extensionx='jpeg'; } else { $fileup_extensionx=$fileup_extension; }
				try {
				    @call_user_func('imagecreatefrom'.$fileup_extensionx,$fileup_temporaire);
				} catch (Exception $e) {
				    $error = $fileup_name." : Exception : ".$e->getMessage();
				}
		}
		
		// Enregistrement en base de donnée
		// Déplacement
        if (!isset($error)) {
        	$insert_data = array(
        		'slug'=>$fileup_new_name,
        		'file_extension' => $fileup_extension,
				'file_type' => $fileup_type,
				'file_size' => $fileup_size,
			);
			$e = $this->pictures->insert($insert_data);
			if($e) {
				if ($fileup_dim[0]>900) {
					$config['image_library'] = 'gd2';
					$config['source_image']	= $fileup_temporaire;
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['width']	= 900;
					//$config['height']	= 50;					
					$this->load->library('image_lib', $config); 					
					$this->image_lib->resize();
				}
				$fileup_final_destination = './server/pictures/'.$e.'-'.$fileup_new_name; //Chemin de l'image dans une variable.
				copy($fileup_temporaire, $fileup_final_destination); // Déplacement du fichier 
				unlink($fileup_temporaire);  // on supprime l'image 00 
				$d['result'] = 1;
				$d['message'] = "Photo ajoutée.";
			} else {
				$d['message'] = "Erreur lors de l'ajout de la Photo en base de donnée.";
			}
        } else { // Sinon erreur
            $d['message'] = $error;        	
        }
		// Retour json
        echo json_encode($d);
        die;
    }

	// Get Ajax Refresh de la liste des photos, retour html
	public function getAjaxRefresh()	{
		$data['pictures'] = $this->pictures->as_object()->get_all();
		$d = $this->load->view('galerie/_pictures',$data);
		return $d; // html
	}
	
	// Post Supprimer photo
	public function getDelete($id) {
		$e = $this->pictures->get($id);
		$fileimg= './server/pictures/'.$e->id.'-'.$e->slug;
		if (unlink($fileimg)) {
			$this->pictures->delete($id);
            $this->session->set_flashdata('success_growl', 'La photo a été supprimé');
		} else {
		 $this->session->set_flashdata('error_growl', "La photo n'a été correctement supprimée du serveur");	
		}
     	redirect('/', 'refresh');
	}
	

}