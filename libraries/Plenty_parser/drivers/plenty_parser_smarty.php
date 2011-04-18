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
        
        // Smarty config options
        $this->_smarty->template_dir      = config_item('parser.smarty.location');
        $this->_smarty->compile_dir       = config_item('parser.smarty.compile_dir');
        $this->_smarty->cache_dir         = config_item('parser.smarty.cache_dir');
        $this->_smarty->config_dir        = config_item('parser.smarty.config_dir');
        $this->_smarty->error_reporting   = config_item('parser.smarty.error_level');
        
        $this->_smarty->exception_handler = null;
          
    }
    
    public function parse($template, $data = array(), $return = false)
    {
        // Check we haven't got cached variables to use
        if (is_array($data))
        {
            $data = array_merge($data, $this->ci->load->_ci_cached_vars);
        }
        
        // If we have variables to assign, lets assign them
        if ($data)
        {
            foreach ($data as $key => $val)
            {
                $this->_smarty->assign($key, $val);
            }
        }
        
        // If we're returning the template contents
        if ($return === true)
        {
            return $this->_smarty->fetch($template);
        }
        else
        {
            $this->_smarty->display($template);
        }
                
    }

}