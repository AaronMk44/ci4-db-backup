<?php

require './vendor/autoload.php';

use Ci4DbBackup\Ci4DbBackup;

(new Ci4DbBackup([
  'host' => 'localhost',
  'username' => 'root',
  'password' => ''
]))->backup('text', 'path/to/backups');
