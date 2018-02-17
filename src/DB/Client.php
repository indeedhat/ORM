<?php
/**
 * Client.php
 *
 * @author Matt Holmes <matt.php@aceviral.com>
 * @updated 2/17/2018 -- 12:49 PM
 * @copyright 2018 Aceviral.com
 */

namespace ORM\DB;

use PDO;
use PDOException;
use PDOStatement;

use ORM\DB\Traits\DBSelector;

class Client
{
  use DBSelector;

  /**
   * @var PDO
   */
  private $pdo;
  private $credentials;

  function __construct(CredentialsHelper $creds = null)
  {
    $this->credentials = $creds;
  }

  /**
   * Check if the client is already connected
   *
   * @return bool
   */
  public function isConnected(): bool
  {
    return $this->pdo instanceof PDO;
  }

  /**
   * Connect the client to the database
   *
   * @return bool
   */
  public function connect(): bool
  {
    if ($this->isConnected()) {
      return true;
    }

    $creds = $this->credentials ?? CredentialsHelper::getDefaultCredentials();

    try {
      $this->pdo = new PDO(...$creds);
    } catch (PDOException $e) {
      return false;
    }

    return true;
  }

  /**
   * Perform a prepared query
   *
   * @param string $sql
   * @param array $params
   *
   * @return PDOStatement|null
   */
  public function query(string $sql, array $params = [])
  {
    $statement = $this->pdo->prepare($sql);
    return $statement->execute($params) ? $statement : null;
  }

  /**
   * Fetch the first row from the query
   *
   * @param string $sql
   * @param array $params
   * @param string $returnType (will fetch objects if set to anything other than array)
   *
   * @return mixed|null
   */
  public function fetchOne(string $sql, array $params = [], string $returnType = 'array')
  {
    $statement = $this->query($sql, $params);

    if (!$statement instanceof PDOStatement) {
      return null;
    }

    if ('array' == $returnType) {
      $statement->setFetchMode(PDO::FETCH_ASSOC);
    } else {
      $statement->setFetchMode(PDO::FETCH_CLASS, $returnType);
    }

    return $statement->fetch();
  }

  /**
   * Fetch all rows from the query
   *
   * @param string $sql
   * @param array $params
   * @param string $returnType (will fetch objects if set to anything other than array)
   *
   * @return array
   */
  public function fetchAll(string $sql, array $params = [], string $returnType = 'array')
  {
    $statement = $this->query($sql, $params);

    if (!$statement instanceof PDOStatement) {
      return [];
    }

    if ('array' == $returnType) {
      $statement->setFetchMode(PDO::FETCH_ASSOC);
    } else {
      $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $returnType);
    }

    return $statement->fetchAll();
  }
}