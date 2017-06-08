<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pagination extends CI_Controller {
 
    public function __construct()
    {
        
        //cargamos todas las librerías necesarías
        parent::__construct();
        $this->load->helper('url');//-->hacemos uso de las urls
        $this->load->database('default');//-->la base de datos por defecto
        $this->load->model('pagination_model');//-->el modelo pagination_model
        $this->load->library('table');//-->haremos uso de tablas
        $this->load->library('Jquery_pagination');//-->la estrella del equipo
        
    }
    
    public function index($offset = 0)
    {
        
        //creamos la salida del html a la vista con ob_get_contents
        //que lo que hace es imprimir el html
        ob_start();
        $this->paginacion_ajax(0);
        $initial_content = ob_get_contents();
        ob_end_clean();    
        
        //asignamos $initial_content al array data para pasarlo a la vista
        //y así poder mostrar tanto los links como la tabla
        $data['table'] = "<div id='paginacion'>" . $initial_content . "</div>" ;
 
        $this->load->view('pagination_view',$data);
 
    }
 
    public function paginacion_ajax($offset = 0)
    {
 
        //hacemos la configuración de la librería jquery_pagination
        $config['base_url'] = base_url('pagination/paginacion_ajax/');
        
        $config['div'] = '#paginacion';//asignamos un id al contendor general
        
        $config['anchor_class'] = 'page_link';//asignamos una clase a los links para maquetar
        
        $config['show_count'] = true;//en true queremos ver Viendo 1 a 10 de 52
        
        $config['total_rows'] = $this->pagination_model->num_rows();
        
        $config['per_page'] = 10;//-->número de provincias por página
        
        $config['num_links'] = 4;//-->número de links visibles
        
        $config['first_link'] = '&lsaquo; Primera';//->configuramos 
        $config['next_link'] = '&gt;';//-------------->los links
        $config['prev_link'] = '&lt;';//-------------->de anterior
        $config['last_link'] = 'Última &rsaquo;';//--->y siguiente
 
        //inicializamos la librería
        $this->jquery_pagination->initialize($config);
 
        //creamos la cabecera de nuestra tabla con los campos que necesitemos
        $this->table->set_heading('Id', 'Provincia');
        
        //cargamos la paginación con los links
        $html = $this->table->generate($this->pagination_model->paginacion($config['per_page'], $offset)).
        $this->jquery_pagination->create_links();
        
        echo $html;
 
    }
}
 