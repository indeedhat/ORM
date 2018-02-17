<?php
/**
 * QBLimit.php
 *
 * @author Matt Holmes <matt.php@aceviral.com>
 * @updated 2/17/2018 -- 2:00 PM
 * @copyright 2018 Aceviral.com
 */

namespace ORM\DB\Traits\QueryBuilder;


trait QBLimit
{
  protected $limit = 0;
  protected $offset = 0;

  public function limit(int $limit)
  {
    $this->limit = $limit;
  }

  public function offset(int $offset)
  {
    $this->offset = $offset;
  }

  protected function buildLimit()
  {
    return "
      LIMIT {$this->limit}, {$this->offset}
    ";
  }
}