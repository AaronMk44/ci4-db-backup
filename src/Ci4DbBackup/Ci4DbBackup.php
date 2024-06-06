<?php

namespace Ci4DbBackup;

use Exception;

class Ci4DbBackup
{
  private $dbHost;
  private $dbUsername;
  private $dbPassword;

  public function __construct(array $options = [])
  {
    $options = (object) $options;
    $this->dbHost = $options->host ?? 'localhost';
    $this->dbUsername = $options->username;
    $this->dbPassword = $options->password;
  }

  /**
   * backup
   */
  public function backup(string $dbName = '', string $path = '')
  {
    if ($dbName == '') {
      throw new Exception("ERR: Database name not set");
    }
    if ($path == '') {
      throw new Exception("ERR: Backup path not set");
    }

    if ($this->dbHost == '') {
      throw new Exception("ERR: Host not set");
    }

    $backupFile = $path . '/' . $dbName . '_' . date("Y-m-d_H-i-s") . '.sql';

    // mysqldump command
    $command = "mysqldump --host=$this->dbHost --user=$this->dbUsername --password=$this->dbPassword $dbName > $backupFile";

    // Execute the command
    exec($command, $output, $returnVar);

    if ($returnVar === 0) {
      return "Backup successfully created at: $backupFile";
    } else {
      throw new Exception("An error occurred during backup. Return code: $returnVar");
    }
  }
}
