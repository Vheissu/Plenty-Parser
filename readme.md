# Plenty Parser for Codeigniter

## Intro

Plenty Parser is a driver based parser library for Codeigniter 2.0 and up. It allows you to render view templates using different drivers. Out of the box Plenty Parser supports rendering using Smarty 3 and Twig templating libraries, because it doesn't override any in-built parsing or view capabilities of Codeigniter, you have yourself a swiss army knife of view loading.

## Drivers

Plenty Parser uses drivers, if Plenty Parser doesn't come with a driver to support rendering templates with your preferred template engine, write one and share it with us. Twig and Smarty should satisfy 95% of all your needs.

## Using Plenty Parser

* Copy the files from the downloadable zip in this repo inside your application directory.
* Load the driver $this->load->driver('plenty_parser');
* Use it like this: $this->plenty_parser->parse('templatename');

Basically it uses the same format and parameters as the in-built view loader and parser: $this->plenty_parser->parse($templatename, $variables, $return = false); if you set return to true, then the template contents will be returned rather than displayed. The above example will render views using the default driver which is 'smarty'. You can also specify the driver you want to use by supplying it to the parse function at the end.