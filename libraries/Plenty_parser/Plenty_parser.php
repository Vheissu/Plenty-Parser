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
    * Current theme in use
    * 
    * @var mixed
    */
    protected $_current_theme;
    
    /**
    * Get default theme (if any)
    * 
    * @var mixed
    */
    protected $_default_theme;
    
    /**
    * Theme locations
    * 
    * @var mixed
    */
    protected $_theme_locations;
    
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
        
        // Get theme locations
        $this->_theme_locations = config_item('parser.theme.locations');
        
        // Get default theme (if one set)
        $this->_default_theme = config_item('parser.theme.default');
    }
    
    /**
    * Set Driver
    * Sets which driver to use for view rendering
    * 
    * @param mixed $driver
    * @returns void
    */
    public function set_driver($driver)
    {
        $this->_current_driver = trim($driver);
    }
    
    /**
    * Set Theme
    * Set the currently used theme
    * 
    * @param mixed $theme
    */
    public function set_theme($theme)
    {
        $this->_current_theme = trim($theme);
    }
    
    /**
    * Assign Var
    * Set a variable name and value for a template
    * 
    * @param mixed $name
    * @param mixed $value
    * @returns void
    */
    public function assign_var($name, $value)
    {
        return $this->{$this->_current_driver}->assign_var($name, $value);
    }
    
    /**
    * Parse will return the contents instead of displaying
    * 
    * @param mixed $template
    * @param mixed $data
    * @returns void
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
        
        // Call the driver parse function
        return $this->{$this->_current_driver}->parse($template, $data, $return);
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
        return $this->{$this->_current_driver}->parse_string($string, $data, $return);
    } 
    
}
