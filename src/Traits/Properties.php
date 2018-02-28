<?php
/**
 * Properties.php
 *
 * @author Matt Holmes <matt.php@aceviral.com>
 * @updated 2/28/2018 -- 6:21 PM
 * @copyright 2018 Aceviral.com
 */

namespace ORM\Traits;


use ORM\Exceptions\InvalidInput;
use ORM\Helpers;

trait Properties
{
  protected $props       = [];
  protected $updates     = [];
  protected $constraints = [];
  protected $propThrow   = false;

  public function __get(string $key): mixed
  {
    if (isset($this->props[$key])) {
      return method_exists($this, Helpers::camelCase("get_{$key}")) ?
        $this->{Helpers::camelCase("get_{$key}")}($this->props[$key]) :
        $this->props[$key];
    }

    return null;
  }

  public function __set(string $key, mixed $value)
  {
    if ($this->checkConstraint($key, $value)) {
      $this->props[$key]   = $value;
      $this->updates[$key] = true;
    } else if ($this->propThrow) {
      throw new InvalidInput("Property value for {$key} does not match constraint");
    }
  }

  /**
   * Return the raw value of a property without get modifier methods being applied
   * @param string $key
   * @return mixed
   */
  public function rawProp(string $key): mixed
  {
    return isset($this->props[$key]) ?  $this->props[$key] : null;
  }

  /**
   * Check the input against the array of property constraints
   *
   * @param string $key
   * @param mixed $value
   *
   * @return bool
   */
  private function checkConstraint(string $key, mixed $value): bool
  {
    if (empty($this->constraints[$key])) {
      return true;
    }

    $type = gettype($value);
    if ($type == $this->constraints[$key]) {
      return true;
    }

    if ('object' == $type) {
      return $value instanceof $this->constraints[$key];
    }

    return false;
  }
}