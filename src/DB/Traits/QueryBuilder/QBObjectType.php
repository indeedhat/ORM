<?php

/**
 * QBObjectType.php
 *
 * @author Matt Holmes <matt.php@aceviral.com>
 * @updated 2/17/2018 -- 1:43 PM
 * @copyright 2018 Aceviral.com
 */
namespace ORM\DB\Traits\QueryBuilder;

trait QBObjectType
{
  protected $objectType = 'array';

  public function setObjectType(string $objectType)
  {
    $this->objectType = $objectType;
  }
}