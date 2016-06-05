<?php

namespace PhpTabs;

use Exception;

use PhpTabs\Component\Config;
use PhpTabs\Component\File;
use PhpTabs\Component\Reader;
use PhpTabs\Component\Tablature;

class PhpTabs
{
  /** @var Tablature A tablature container */
  private $tablature;

  /**
   * @param string $pathname A complete pathname
   */
  public function __construct($pathname = null)
  {
    try
    {
      if(null === $pathname)
      {
        $this->setTablature(new Tablature());
      }
      else
      {
        $reader = new Reader(new File($pathname));

        $this->setTablature($reader->getTablature());
      }
    }
    catch(Exception $e)
    {
      $message = sprintf('%s in %s on line %d%s'
          , $e->getMessage()
          , $e->getFile()
          , $e->getLine()
          , PHP_EOL . $e->getTraceAsString() . PHP_EOL
      );

      # if debug mode, an error kills the process
      if(Config::get('debug'))
      {
        trigger_error($message, E_USER_ERROR);

        return;
      }

      $this->setTablature(new Tablature());
      $this->getTablature()->setError($e->getMessage());
    }
  }

  /**
   * Gets the tablature instance
   *
   * @return Tablature A tablature instance
   */
  public function getTablature()
  {
    return $this->tablature;
  }

  /**
   * Sets the tablature instance
   *
   * @param Tablature $tablature a tablature instance
   */
  protected function setTablature(Tablature $tablature)
  {
    $this->tablature = $tablature;
  }

  /**
   * Overloads with $tablature methods
   * 
   * @param string $name A method name
   * @param array $arguments Some arguments for the method 
   *
   * @return mixed
   */
  public function __call($name, $arguments)
  {
    switch(count($arguments))
    {
      case 0:
        return $this->tablature->$name();
        break;

      case 1:
        return $this->tablature->$name($arguments[0]);
        break;

      default:
        $message = sprintf('%s method does not support %d arguments'
          , __METHOD__
          , count($arguments)
        );

        trigger_error($message, E_USER_ERROR);
    }
  }
}
