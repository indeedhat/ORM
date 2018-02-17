<?php
/**
 * QBShared.php
 *
 * @author Matt Holmes <matt.php@aceviral.com>
 * @updated 2/17/2018 -- 1:56 PM
 * @copyright 2018 Aceviral.com
 */

namespace ORM\DB\Traits\QueryBuilder;


trait QBShared
{
  private function escapeSqlThing(string $thing)
  {
    $escaped = preg_replace('/[^a-z\d-_]+/i', '', $thing);

    return "`{$escaped}`";
  }
}