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
    protected $_twig;
    
    protected $_template_dir;
    protected $_cache_dir;
    protected $_debug;
    
    public function __construct()
    {
        ini_set('include_path',
        ini_get('include_path') . PATH_SEPARATOR . APPPATH . 'third_party/Twig');

        require_once (string) "Autoloader" . EXT;
        
        Twig_Autoloader::register();
        
        $this->_template_dir = $this->ci->config->item('parser.twig.location');
        $this->_cache_dir    = $this->ci->config->item('parser.twig.cache_location');
        $this->_debug        = $this->ci->config->item('parser.twig.debug');

        $loader = new Twig_Loader_Filesystem($this->_template_dir);

        $this->_twig = new Twig_Environment($loader, array(
            'cache' => $this->_cache_dir,
            'debug' => $this->_debug,
        ));      
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
	public function parse($template, $data = array())
    {
        $template = $this->_twig->loadTemplate($template);

        return $template->render($data);
    }
    
    /**
    * Displays an actual template for use
    * 
    * @param mixed $template
    * @param mixed $data
    * @returns void
    */
    public function display($template, $data = array()) 
    {
        $template = $this->_twig->loadTemplate($template);

        $template->display($data);
    }

}