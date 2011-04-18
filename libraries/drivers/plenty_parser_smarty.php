<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* @name Smarty
* @package Plenty Parser
* @subpackage Driver
* @copyright 2011
* @author Dwayne Charrington
* @license http://philsturgeon.co.uk/code/dbad-license
* @version 1.0
*/

class Plenty_parser_smarty extends CI_Driver {
	
	protected $ci;
    
    protected $_smarty;
    
    public function __construct()
    {
        $this->ci = get_instance();
        $this->ci->config->load('plentyparser'); 
        
        // Require Smarty
        require_once APPPATH."third_party/Smarty/Smarty.class.php";
        
        // Store the Smarty library
        $this->_smarty = new Smarty();
        
        $this->_smarty->template_dir      = config_item('parser.smarty.location');
        $this->_smarty->compile_dir       = config_item('compile_directory');
        $this->_smarty->cache_dir         = config_item('cache_directory');
        $this->_smarty->config_dir        = config_item('config_directory');
        $this->_smarty->template_ext      = config_item('template_ext');
        
        $this->_smarty->exception_handler = null;
          
    }
    
    public function parse($template, $data = array(), $return = false)
    {
        
    }

}