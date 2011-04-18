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
    * The driver to use for rendering
    * 
    * @var mixed
    */
    protected $_current_driver;
    
    /**
    * Valid drivers for rendering views
    * 
    * @var mixed
    */
    protected $valid_drivers = array(
        'plenty_parser_smarty',
        'plenty_parser_twig',
    );
    
    /**
    * Constructor
    * 
    */
    public function __construct()
    {
        $this->ci = get_instance();
        $this->ci->config->load('plentyparser');
        
        // Get our default driver
        $this->_current_driver = config_item('parser.driver');
    }
    
    /**
    * Parse will return the contents instead of displaying
    * 
    * @param mixed $template
    * @param mixed $data
    */
    public function parse($template, $data = array(), $return = false, $driver = '')
    {
        // Are we setting a particular driver to render with?
        if ($driver != '')
        {
            $this->_current_driver = trim($driver);
        }
        
        // Add in the extension using the default if not supplied
        if (!stripos($template, "."))
        {
            $template = $template.config_item('parser.'.$this->_current_driver.'.extension');
        }
        
        return $this->{$this->_current_driver}->parse($template, $data, $return);
    } 
    
}
