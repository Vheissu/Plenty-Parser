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
    * Current template extension
    * 
    * @var mixed
    */
    protected $_current_template = '';
    
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
        'plenty_parser_dwoo',
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
    }
    
    /**
    * Parse will return the contents instead of displaying
    * 
    * @param mixed $template
    * @param mixed $data
    */
    public function parse($template, $data = array(), $return = false)
    {
        // Store the template name
        $this->_current_template = $template;
        
        // Autodetect the extension or whatever
        $this->autodetect();
        
        // Call the driver parser function
        return $this->{$this->_current_driver}->parse($template, $data, $return);
    } 
    
    /**
    * Check what rendering driver to use for displaying templates
    * 
    */
    private function autodetect()
    {
        // If we are autodetecting, then set the render
        if ( config_item('parser.auto') == true )
        {
            // Check we have a template
            if (!empty($this->_current_template))
            {
                // Get the extension
                $ext = substr(strrchr($this->_current_template,'.'),1);
            }
        }
        else
        {
            // Set the current driver to be the default driver
            $this->_current_driver = config_item('parser.driver');
        }   
    }
    
}