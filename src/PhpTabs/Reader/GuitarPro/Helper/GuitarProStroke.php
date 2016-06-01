<?php

namespace PhpTabs\Reader\GuitarPro\Helper;

use PhpTabs\Model\Beat;
use PhpTabs\Model\Duration;
use PhpTabs\Model\Stroke;

class GuitarProStroke extends AbstractReader
{
  public function readStroke(Beat $beat)
  {
    $strokeDown = $this->reader->readByte();
    $strokeUp = $this->reader->readByte();

    if($strokeDown > 0 )
    {
      $beat->getStroke()->setDirection(Stroke::STROKE_DOWN);
      $beat->getStroke()->setValue($this->toStrokeValue($strokeDown));
    }
    else if($strokeUp > 0)
    {
      $beat->getStroke()->setDirection(Stroke::STROKE_UP);
      $beat->getStroke()->setValue($this->toStrokeValue($strokeUp));
    }
  }

	/**
   * Get stroke value
   * 
   * @param integer $value
   * @return integer stroke value
   */
  private function toStrokeValue($value)
  {
    if($value == 1 || $value == 2)
    {
      return Duration::SIXTY_FOURTH;
    }

    if($value == 3)
    {
      return Duration::THIRTY_SECOND;
    }

    if($value == 4)
    {
      return Duration::SIXTEENTH;
    }

    if($value == 5)
    {
      return Duration::EIGHTH;
    }

    if($value == 6)
    {
      return Duration::QUARTER;
    }

    return Duration::SIXTY_FOURTH;
  }
}
