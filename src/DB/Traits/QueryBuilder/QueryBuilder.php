<?php
/**
 * QueryBuilder.php
 *
 * @author Matt Holmes <matt.php@aceviral.com>
 * @updated 2/17/2018 -- 2:51 PM
 * @copyright 2018 Aceviral.com
 */

namespace ORM\DB\Traits\QueryBuilder;


trait QueryBuilder
{
  use QBShared;
  use QBFrom;
  use QBLimit;
  use QBObjectType;
  use QBOrder;
  use QBSelect;
  use QBWhere;
}