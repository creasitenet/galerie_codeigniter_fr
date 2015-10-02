<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(

           'contact' => array(
               array(
                     'field'   => 'name',
                     'label'   => 'name',
                     'rules'   => 'trim|required|alpha_dash|min_length[5]|max_length[20]|xss_clean'
                  ),
               array(
                     'field'   => 'email',
                     'label'   => 'email',
                     'rules'   => 'trim|required|valid_email'
                  ),
                 array(
                     'field'   => 'message',
                     'label'   => 'message',
                     'rules'   => 'trim|required|min_length[5]|max_length[255]|xss_clean'
                  ),
            ),
            
           'newsletter' => array(
               array(
                     'field'   => 'email',
                     'label'   => 'email',
                     'rules'   => 'trim|required|valid_email'
                  ),
            ),
            
           'access/login' => array(
               array(
                     'field'   => 'username',
                     'label'   => 'Identifiant',
                     'rules'   => 'trim|required|alpha_dash|min_length[5]|max_length[20]|xss_clean'
                  ),
               array(
                     'field'   => 'password',
                     'label'   => 'Mot de passe',
                     'rules'   => 'trim|required|alpha_dash|min_length[5]|max_length[20]|xss_clean'
                  ),
            ),
            
           'access/lost_password' => array(
               array(
                     'field'   => 'information',
                     'label'   => 'Identifiant ou adresse email',
                     'rules'   => 'trim|required'
                  ),
            ),
            
            'admin/contact' => array(
               array(
                     'field'   => 'name',
                     'label'   => 'Name',
                     'rules'   => 'trim|required|min_length[5]|max_length[100]|xss_clean'
                  ),
                 array(
                     'field'   => 'postal_code',
                     'label'   => 'Postal code',
                     'rules'   => 'trim|required|min_length[3]|max_length[5]|xss_clean'
                  ),
               array(
                     'field'   => 'address',
                     'label'   => 'Address',
                     'rules'   => 'trim|required|min_length[5]|max_length[100]|xss_clean'
                  ),
                 array(
                     'field'   => 'city',
                     'label'   => 'City',
                     'rules'   => 'trim|required|min_length[5]|max_length[100]|xss_clean'
                  ),
                 array(
                     'field'   => 'tel',
                     'label'   => 'Tel',
                     'rules'   => 'trim|min_length[5]|max_length[100]|xss_clean'
                  ),
                 array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'trim|valid_email|xss_clean'
                  ),
            ),
            
            'admin/article' => array(
               array(
                     'field'   => 'title',
                     'label'   => 'Title',
                     'rules'   => 'trim|required|min_length[3]|max_length[250]|xss_clean'
                  ),
                 array(
                     'field'   => 'content',
                     'label'   => 'Content',
                     'rules'   => 'trim|required|xss_clean'
                  ),
            ),
            
            'admin/newsletter' => array(
               array(
                     'field'   => 'title',
                     'label'   => 'Title',
                     'rules'   => 'trim|required|min_length[3]|max_length[250]|xss_clean'
                  ),
                 array(
                     'field'   => 'content',
                     'label'   => 'Content',
                     'rules'   => 'trim|required|xss_clean'
                  ),
            ),
            
            'admin/album' => array(
               array(
                     'field'   => 'title',
                     'label'   => 'Title',
                     'rules'   => 'trim|required|min_length[4]|max_length[250]|xss_clean'
                  ),
                 array(
                     'field'   => 'content',
                     'label'   => 'Content',
                     'rules'   => 'trim|required|xss_clean'
                  ),
            ),
            
            'admin/user' => array(
               array(
                     'field'   => 'username',
                     'label'   => 'Username',
                     'rules'   => 'trim|required|alpha_dash|min_length[5]|max_length[20]|xss_clean'
                  ),
               array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'trim|required|alpha_dash|min_length[5]|max_length[20]|xss_clean'
                  ),
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'trim|required|valid_email'
                  ),
            ),
            
           );


// Delete accents
function delete_accents($str, $charset='utf-8') {
    $str = htmlentities($str, ENT_NOQUOTES, $charset);
    $str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
    return $str;
}

// URL rewirting
function OptimiseUrl($chaine) {    
    $chaine=trim($chaine);
    $chaine=stripslashes($chaine);
    $chaine=delete_accents($chaine);  
    $chaine=strtolower($chaine);
    $entre = array('<i>', '</i>', '<u>', '</u>', '<b>', '</b>', "'", "’", ' ', '-', '?', '!', '.', ',', ';', ':', '&', '#', '(', ')', '"', '/', '__');
    $sortie = array('', '', '', '', '', '', '_', "_", "_", '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '');
    $chaine = str_replace($entre, $sortie, $chaine);
    return $chaine; 
}
 