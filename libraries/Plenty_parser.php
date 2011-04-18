<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* @name Plenty Parser
* @copyright 2011
* @author Dwayne Charrington
* @license http://philsturgeon.co.uk/code/dbad-license
* @version 1.0
*/

class Plenty_parser extends CI_Driver_Library {
    
    /**
    * Codeigniter instance
    * 
    * @var mixed
    */
    protected $ci;
    
    /**
    * The driver to use for templates
    * 
    * @var mixed
    */
    protected $_current_driver;
    
    protected $valid_drivers = array(
        'plenty_parser_smarty',
        'plenty_parser_dwoo',
        'plenty_parser_twig',
    );
    
    public function __construct()
    {
        $this->ci = get_instance();
        
        $this->ci->config->load('plentyparser');
    }
    
    /**
    * Parse will return the contents instead of displaying
    * 
    * @param mixed $template
    * @param mixed $data
    */
    public function parse($template, $data = array())
    {
        
    }
    
    /**
    * Display will show the template
    * 
    * @param mixed $template
    * @param mixed $data
    */
    public function display($template, $data = array())
    {
        
    }
    
    /**
    * Are we autodetecting which template engine to use?
    * 
    */
    private function autodetect()
    {
        if ( config_item('parser.auto') == true )
        {
            
        }
        else
        {
            return false;
        }   
    }
    
}