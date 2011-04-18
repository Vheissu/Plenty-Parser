<?php

/**
* @name Plenty Parser
* @subpackage Config
* @copyright 2011
* @author Dwayne Charrington
* @license http://philsturgeon.co.uk/code/dbad-license
* @version 1.0
*/

// Default driver to render views with (auto mode below overrides this if enabled)
$config['parser.driver'] = "smarty";

// Should the parser library autodetect what driver to use?
// If true, then a list of default extensions should be defined
$config['parser.auto']   = false;

// Default autodriver extensions
$config['parser.extensions'] = array(
	'.tpl'  => "smarty",
	'.twig' => "twig",
	".php"  => "parser"
);

// Default template location
$config['parser.twig.location'] = APPPATH . "views";

// Twig template caching location
$config['parser.twig.cache_location'] = APPPATH . "cache";

// Debug mode turned on or off for Twig?
$config['parser.twig.debug'] = false;



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