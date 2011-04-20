<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* @name Twig
* @package Plenty Parser
* @subpackage Driver
* @copyright 2011
* @author Dwayne Charrington
* @license http://philsturgeon.co.uk/code/dbad-license
* @version 1.0
*/

class Plenty_parser_twig extends CI_Driver {
    
    protected $ci;
    
    protected $_template;
    
    protected $_template_dir;
    protected $_cache_dir;
    protected $_debug;
    
    public function __construct()
    {
        $this->ci = get_instance();
        
        ini_set('include_path',
        ini_get('include_path') . PATH_SEPARATOR . APPPATH . 'third_party/Twig');

        require_once (string) "Autoloader" . EXT;
        
        Twig_Autoloader::register();
        
        $this->_template_dir = config_item('parser.twig.location');
        $this->_cache_dir    = config_item('parser.twig.cache_location');
        $this->_debug        = config_item('parser.twig.debug');
        
        // Check if a theme has been set and if there is, check it exists and add it to the path
             
    }
    
    /**
    * Override the default template location
    * 
    * @param mixed $location
    * @returns void
    */
    public function set_location($location)
    {
        $this->_template_dir = $location;
    }
	
    /**
    * Load the template and return the data
    * 
    * @param mixed $template
    * @param mixed $data
    * @returns string
    */
	public function parse($template, $data = array(), $return = false)
    {
        $loader = new Twig_Loader_Filesystem($this->_template_dir);
        $twig   = new Twig_Environment($loader, array('cache' => $this->_cache_dir,'debug' => $this->_debug));
         
        $template = $twig->loadTemplate($template);
        
        if (is_array($data))
        {
            $data = array_merge($data, $this->ci->load->_ci_cached_vars);
        }
        
        if ($return === true)
        {
            return $template->render($data);   
        }
        else
        {
            return $template->display($data); 
        }
    }
    
    /**
    * Parse String
    * Parse a string and return it as a string or display it
    * 
    * @param mixed $string
    * @param mixed $data
    * @param mixed $return
    * @returns void
    */
    public function parse_string($string, $data = array(), $return = false)
    {
        $loader = new Twig_Loader_String($this->_template_dir);

        $twig = new Twig_Environment($loader, array(
            'cache' => $this->_cache_dir,
            'debug' => $this->_debug,
        ));
        
        $string = $twig->loadTemplate($string);
        
        if (is_array($data))
        {
            $data = array_merge($data, $this->ci->load->_ci_cached_vars);
        }
        
        if ($return === true)
        {
            return $template->render($data);
        }
        else
        {
            return $template->display($data);
        }
        
    }

}