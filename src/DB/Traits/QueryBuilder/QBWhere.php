<?php
/**
 * QBWhere.php
 *
 * @author Matt Holmes <matt.php@aceviral.com>
 * @updated 2/17/2018 -- 2:16 PM
 * @copyright 2018 Aceviral.com
 */

namespace ORM\DB\Traits\QueryBuilder;


trait QBWhere
{
  protected $where = [];

  public function where(string $field, mixed $value, $operator = '=')
  {
    $this->where[] = [$this->escpeSqlThing($field), $value, is_array($value) && 'NOT IN' !== $operator ? 'IN' : $operator];
  }

  public function orWhere(string $field, mixed $value, $operator = '')
  {
    $last = end($this->where);

    if (!is_array($last[0])) {
      $last = [$last];
    }

    $last[] = [$this->escpeSqlThing($field), $value, is_array($value) && 'NOT IN' !== $operator ? 'IN' : $operator];

    $this->where[count($this->where) - 1] = $last;
  }

  protected function buildWhere()
  {
    $rows   = [];
    $values = [];
    foreach ($this->where as $line) {
      if (is_array($line[0])) {
        $vals = [];
        $row = "(" . implode(
            PHP_EOL . '    AND' . PHP_EOL . '      ',
            array_map(function($line) use (&$vals) {
              list($_row, $_vals) = $this->buildWhereLine(...$line);
              array_push($vals, ...$_vals);
              return $_row;
            }, $line)
          ) . ")";
      } else {
        list($row, $vals) = $this->buildWhereLine(...$line);
      }

      $rows[] = $row;
      array_push($values, ...$vals);
    }

    return "
      WHERE
    " . implode(PHP_EOL . '  AND' . PHP_EOL . '    ', $rows);
  }

  private function buildWhereLine(string $field, mixed $value, string $operator)
  {
    if (is_array($value)) {
      return [
        "{$field} {$operator} " . rtrim( str_repeat('?,', count($value)), ','),
        $value
      ];
    }

    return [
      "{$field} {$operator} ?",
      [$value]
    ];
  }
}