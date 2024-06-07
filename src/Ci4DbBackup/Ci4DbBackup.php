<?php

namespace Ci4DbBackup;

use Exception;
use PDO;

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

    try {
      // Connect to the database
      $pdo = new PDO("mysql:host=$this->dbHost;dbname=$dbName", $this->dbUsername, $this->dbPassword);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Start the backup process
      $backup = "-- Database Backup: $dbName\n-- Date: " . date("Y-m-d H:i:s") . "\n\n";

      // Fetch tables
      $tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);

      foreach ($tables as $table) {
        // Fetch table structure
        $createTableStmt = $pdo->query("SHOW CREATE TABLE $table")->fetch(PDO::FETCH_ASSOC);
        $backup .= "-- Structure for table `$table`\n\n";
        $backup .= $createTableStmt['Create Table'] . ";\n\n";

        // Fetch table data
        $rows = $pdo->query("SELECT * FROM $table")->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0) {
          $backup .= "-- Data for table `$table`\n\n";
          foreach ($rows as $row) {
            $columns = array_map(function ($column) use ($pdo) {
              return "`" . str_replace("`", "``", $column) . "`";
            }, array_keys($row));
            $values = array_map(function ($value) use ($pdo) {
              return is_null($value) ? "NULL" : $pdo->quote($value);
            }, array_values($row));
            $backup .= "INSERT INTO `$table` (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ");\n";
          }
          $backup .= "\n";
        }
      }

      // Save the backup to a file
      file_put_contents($backupFile, $backup);
      return [
        'message' => 'Backup successfully Created',
        'file' => $backupFile
      ];
    } catch (Exception $e) {
      throw $e;
    }
  }
}
