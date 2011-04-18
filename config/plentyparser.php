<?php

/**
* @name Plenty Parser
* @subpackage Config
* @copyright 2011
* @author Dwayne Charrington
* @license http://philsturgeon.co.uk/code/dbad-license
* @version 1.0
*/

// Default driver to render views with
$config['parser.driver'] = "smarty";

// Twig template extension (default)
$config['parser.twig.extension'] = ".twig";

// Default template location
$config['parser.twig.location'] = APPPATH . "views";

// Twig template caching location
$config['parser.twig.cache_location'] = APPPATH . "cache/twig";

// Debug mode turned on or off for Twig?
$config['parser.twig.debug'] = false;



// Smarty template extension (default)
$config['parser.smarty.extension'] = ".php";

// Default location for finding Smarty templates
$config['parser.smarty.location'] = APPPATH . "views";

// Where compiled Smarty templates will reside
$config['parser.smarty.compile_dir'] = APPPATH . "cache/smarty/compiled";

// Where Smarty caching happens
$config['parser.smarty.cache_dir'] = APPPATH . "cache/smarty";

// Smarty configs directory
$config['parser.smarty.config_dir'] = APPPATH."third_party/Smarty/configs";

// Smarty error level
$config['parser.smarty.error_level'] = "E_ERROR";