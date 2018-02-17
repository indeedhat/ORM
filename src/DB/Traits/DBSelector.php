<?php
/**
 * DBSelector.php
 *
 * @author Matt Holmes <matt.php@aceviral.com>
 * @updated 2/17/2018 -- 12:47 PM
 * @copyright 2018 Aceviral.com
 */

namespace ORM\DB\Traits;

use ORM\DB\Client;

trait DBSelector
{
  private static $instances = [];
  private static $instanceKey = 'master';

  /**
   * select the connection to be used by the database wrapper
   *
   * @param string $key
   */
  public static function selectConnection(string $key)
  {
    self::$instanceKey = $key;
  }

  /**
   * Get/Set a client instance
   *
   * @param string|null $key
   * @param Client|null $client
   *
   * @return Client
   */
  public static function connection(string $key = null, Client $client = null): Client
  {
    $key = $key ?? self::$instanceKey;

    if ($client instanceof Client) {
      self::$instances[$key] = $client;
    }

    if (empty(self::$instances[$key]) || !self::$instances[$key] instanceof Client) {
      self::$instances[$key] = new Client();
    }

    return self::$instances[$key];
  }

  /**
   * Check if a connection is present for the given key
   *
   * @param string $key
   *
   * @return bool
   */
  public static function hasConnection(string $key): bool
  {
    return !empty(self::$instances[$key]);
  }
}