<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pagination_model extends CI_Model{
    
    public function __construct()
    {
        
        parent::__construct();
        
    }
    
    //obtenemos el total de filas para hacer la paginación
    public function num_rows() 
    {
        
        $consulta = $this->db->get('provincias_es');
        return $consulta->num_rows();
        
    }
 
    //obtenemos todos los posts a paginar con la función
    //total_posts_paginados pasando lo que buscamos, la cantidad por página y el segmento
    //como parámetros de la misma
    public function paginacion($limit, $offset) 
    {
        $consulta = $this->db->get('provincias_es', $limit, $offset);
        if ($consulta->num_rows() > 0) 
        {
            
            return $consulta->result_array();
        
        }
        
    }
}