<?php
/**
 * QBOrder.php
 *
 * @author Matt Holmes <matt.php@aceviral.com>
 * @updated 2/17/2018 -- 2:03 PM
 * @copyright 2018 Aceviral.com
 */

namespace ORM\DB\Traits\QueryBuilder;


trait QBOrder
{
  use QBShared;

  protected $order = [];

  public function orderBy(string $field, string $order = 'ASC', bool $overwrite = false)
  {
    $entry = [$this->escapeSqlThing($field), $order == 'ASC' ? 'ASC' : 'DESC'];
    if ($overwrite) {
      $this->order = [
        $entry
      ];
    } else {
      $this->order[] = $entry;
    }
  }

  protected function buildOrder()
  {
    if (empty($this->order)) {
      return "";
    }

    $orders = [];
    foreach ($this->order as list($field, $order)) {
      $orders[] = "{$field} {$order},";
    }

    return "
      ORDER BY
    " . implode(',' . PHP_EOL, $orders) . PHP_EOL;
  }
}