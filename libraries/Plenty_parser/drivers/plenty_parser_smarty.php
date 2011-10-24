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
        $this->_smarty->template_dir    = config_item('parser.smarty.location');
        $this->_smarty->compile_dir     = config_item('parser.smarty.compile_dir');
        $this->_smarty->cache_dir       = config_item('parser.smarty.cache_dir');
        $this->_smarty->config_dir      = config_item('parser.smarty.config_dir');
        $this->_smarty->cache_lifetime  = config_item('parser.smarty.cache_lifetime');
        
        // Should let us access Codeigniter stuff in views
        $this->assign_var("CI", $this->ci);
        
        $this->_smarty->disableSecurity(); 
    }
    
    /**
    * Assign Var
    * Assign a variable for template view use
    * 
    * @param mixed $name
    * @param mixed $val
    * @returns void
    */
    public function assign_var($name, $val)
    {
        // If an empty variable name or value supplied
        if (empty($name) OR empty($val))
        {
            show_error('Smarty assign var function expects a name and value for assigning variables');
        }
        
        // Call Smarty assign function
        $this->_smarty->assign($name, $val);
    }
    
    /**
    * Parse
    * Display or return template contents
    * 
    * @param mixed $template
    * @param array $data
    * @param mixed $return
    */
    public function parse($template, $data = array(), $return = false)
    {        
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
    
    /**
    * Parse string
    * Parses a string as a template and can be returned or displayed
    * 
    * @param mixed $string
    * @param mixed $data
    * @param mixed $return
    */
    public function parse_string($string, $data = array(), $return = false)
    {
        return $this->_smarty->fetch('string:'.$string, $data);
    }

}