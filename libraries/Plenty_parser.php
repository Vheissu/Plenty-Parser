<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Plenty_parser extends CI_Driver_Library {
    
    protected $ci;
    
    protected $_template;
    
    protected $valid_drivers     = array(
        'plenty_parser_smarty',
        'plenty_parser_dwoo',
        'plenty_parser_twig',
    );
    
    public function __construct()
    {
        $this->ci = get_instance();
    }
    
}