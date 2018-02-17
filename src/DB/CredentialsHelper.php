<?php
/**
 * ConfigHelper.php
 *
 * @author Matt Holmes <matt.php@aceviral.com>
 * @updated 2/17/2018 -- 12:55 PM
 * @copyright 2018 Aceviral.com
 */

namespace ORM\DB;

class CredentialsHelper
{
  private static $defaultCredentials;

  private $user;
  private $pass;
  private $host;
  private $dbname;

  /**
   * Set the default credentials used for making a database connection
   *
   * @param string $user
   * @param string $pass
   * @param string $host
   * @param string $dbname
   */
  public static function setDefaultCredentials(string $user, string $pass, string $host, string $dbname)
  {
    self::$defaultCredentials = new self($user, $pass, $host, $dbname);
  }

  /**
   * Get the default credentials
   *
   * @return CredentialsHelper
   */
  public static function getDefaultCredentials(): CredentialsHelper
  {
    if (!self::$defaultCredentials instanceof CredentialsHelper) {
      return new self('root', '', 'localhost', 'test');
    }

    return self::$defaultCredentials;
  }

  function __construct(string $user, string $pass, string $host, string $dbname)
  {
    $this->user   = $user;
    $this->pass   = $pass;
    $this->host   = $host;
    $this->dbname = $dbname;
  }

  /**
   * Return an array of connection details to be unpacked into the client connect method
   *
   * @return array
   */
  public function getConnectionArray(): array
  {
    return [
      "mysql:host={$this->host};dbname={$this->dbname}",
      $this->user,
      $this->pass
    ];
  }
}