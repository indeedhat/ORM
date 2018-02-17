<?php
/**
 * QBInterface.php
 *
 * @author Matt Holmes <matt.php@aceviral.com>
 * @updated 2/17/2018 -- 2:05 PM
 * @copyright 2018 Aceviral.com
 */

namespace ORM\DB\Traits\QueryBuilder;


interface QBInterface
{
  function escapeSqlThing(string $thing);
}