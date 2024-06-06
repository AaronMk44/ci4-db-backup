<?php

namespace Ci4DbBackup;

class Ci4DbBackup
{
  public function __construct(array $options = [])
  {
  }

  public function backup()
  {
    return 'backing up';
  }

  public function restore()
  {
    return 'restoring';
  }
}
