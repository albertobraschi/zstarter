<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

require 'application/settings/config.php';

$paths = implode(PATH_SEPARATOR, array($config['path']['libs'],$config['path']['models'],$config['path']['system']));

set_include_path($paths);

require 'Kernel.php';

Kernel::run($config,$helpers);
