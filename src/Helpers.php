<?php
/**
 * Helpers.php
 *
 * @author Matt Holmes <matt.php@aceviral.com>
 * @updated 2/28/2018 -- 6:41 PM
 * @copyright 2018 Aceviral.com
 */

namespace ORM;


class Helpers
{
  /**
   * Convert string to a camel cased version
   *
   * @param string $string
   * @param string $delimiter
   *
   * @return string
   */
  public static function camelCase(string $string, string $delimiter = '_'): string
  {
    $parts = explode($delimiter, $string);

    array_map('ucfirst', $parts);

    return lcfirst(implode('', $parts));
  }
}