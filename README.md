# Ci4 Database Backup

![Packagist Version](https://img.shields.io/packagist/v/aaronmk44/ci4-db-backup)
![Packagist License](https://img.shields.io/packagist/l/aaronmk44/ci4-db-backup)

## Overview

Ci4 Database Backup is a PHP library designed to facilitate database backups for applications built with CodeIgniter 4 and other PHP Frameworks. It's able to operate in native PHP project too. This library provides an easy way to create SQL dumps of your MySQL databases.

## Features

- Simple and easy to use
- Generates SQL dumps of your database
- Supports CodeIgniter 4

## Installation

You can install this library via Composer. Run the following command:

```sh
composer require aaronmk44/ci4-db-backup
```

## Usage

Here is an example of how to use the `Ci4 Database Backup` library:

### Basic Usage

1. **Include Autoload File**: Ensure you include the Composer autoload file in your script.

2. **Create a Backup Script**:

```php
<?php

require './vendor/autoload.php'; // Autoload classes

use Ci4DbBackup\Ci4DbBackup;

(new Ci4DbBackup([
  'host' => 'localhost',
  'username' => 'root',
  'password' => ''
]))->backup('test_db', 'path/to/backups');
```

In this example:
- The `Ci4DbBackup` class is instantiated with database connection details (host, username, and password).
- The `backup` method is called with the database name (`test_db`) and the path where the backup file should be saved.

### Advanced Usage

For more advanced usage and options, refer to the documentation.

## Methods

### `__construct`

Initializes the `Ci4DbBackup` class with database connection details.

```php
public function __construct(array $dbConfig)
```

- **$dbConfig**: An associative array with the following keys:
  - `host`: Database host (e.g., `localhost`)
  - `username`: Database username
  - `password`: Database password

### `backup`

Creates a backup of the specified database.

```php
public function backup(string $database, string $backupPath)
```

- **$database**: The name of the database to back up
- **$backupPath**: The path where the backup file will be saved

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request with your improvements.

## Author

- **Aaron Mkandawire** - [AaronMk44](https://github.com/AaronMk44)

## Acknowledgements

https://dev.to/joemoses33/create-a-composer-package-how-to-29kn
