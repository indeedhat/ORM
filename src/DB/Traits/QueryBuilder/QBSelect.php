<?php
/**
 * QBSelect.php
 *
 * @author Matt Holmes <matt.php@aceviral.com>
 * @updated 2/17/2018 -- 1:45 PM
 * @copyright 2018 Aceviral.com
 */

namespace ORM\DB\Traits\QueryBuilder;


trait QBSelect
{
  protected $fields = '*';

  public function setSelectFieldsString(string $fields)
  {
    $this->fields = $fields;
  }

  public function setSelectFieldsArray(array $fields)
  {
    $this->fields = implode(',', array_map([$this, 'escapeSqlThing'], $fields));
  }

  protected function buildSelect()
  {
    return "
      SELECT SQL_CALC_FOUND_ROWS
        {$this->fields}
    ";
  }


}