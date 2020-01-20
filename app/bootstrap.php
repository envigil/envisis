<?php


// Load Config
require_once 'config/config.php';

//Load Helpers
require_once "helpers/Page.php";
require_once "helpers/page-content.php";



// Autoload Core Libraries
spl_autoload_register(function ($className) {
  require_once 'libraries/' . ($className) . '.php';
});
