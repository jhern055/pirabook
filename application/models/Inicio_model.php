<?php

class Inicio_model extends CI_Model{

    function traer_anuncios(){
        $q = $this->db->get('anuncios');
        return $q->result();
    }

}
