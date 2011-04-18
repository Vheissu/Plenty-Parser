<?php

// Default driver to render views with (auto mode below overrides this if enabled)
$config['parser.driver'] = "smarty";

// Should the parser library autodetect what driver to use?
// If true, then a list of default extensions should be defined
$config['parser.auto']   = "false";

// Default autodriver extensions
$config['parser.extensions'] = array(
	'.tpl'  => "smarty",
	'.twig' => "twig",
	".php"  => "parser"
);