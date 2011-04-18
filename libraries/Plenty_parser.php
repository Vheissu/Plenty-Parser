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
    * Extension of current template (if any)
    * 
    * @var mixed
    */
    protected $_ext;
    
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
        
        // If we are wanting to use the in-built parser
        if ($this->_current_driver == "parser")
        {
            $this->ci->load->library('parser');
            $render =  $this->_ci->parser->parse($template, $data, $return);
        }
        // If we want to use the Codeigniter standard view loader
        elseif ($this->_current_driver == "view")
        {
            $render = $this->load->view($template, $data, $return);
        }
        else
        {
            $render = $this->{$this->_current_driver}->parse($template, $data, $return);
            
            // Call whatever method we are doing
            return $render;
        }
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
                $$this->_ext = substr(strrchr($this->_current_template,'.'),1);
                
                // Array of mapped extensions for autodetection
                $extensions = config_item('parser.extensions');
                
                // If the extension has been mapped, then use it
                if ( array_key_exists($ext, $extensions) )
                {
                    $this->_current_driver = $extensions[$this->_ext];
                }
                else
                {
                    show_error('Looks like that extension doesn\'t exist. Please define it in your list of extensions if you wish to use autodetection. Extension: '.$ext.'');
                }
                
            }
        }
        else
        {
            // Set the current driver to be the default driver
            $this->_current_driver = config_item('parser.driver');
        }   
    }
    
}
