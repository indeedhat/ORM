<?php
/**
 * QBFrom.php
 *
 * @author Matt Holmes <matt.php@aceviral.com>
 * @updated 2/17/2018 -- 1:53 PM
 * @copyright 2018 Aceviral.com
 */

namespace ORM\DB\Traits\QueryBuilder;


trait QBFrom
{
  protected $table;

  public function setTable(string $table)
  {
    $this->table = $this->escapeSqlThing($table);
  }

  protected function buildFrom()
  {
    return "
      FROM
        {$this->table}
    ";
  }
}