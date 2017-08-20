<?php

namespace PhpTabs\Reader\GuitarPro\Helper;

use PhpTabs\Music\Measure;
use PhpTabs\Music\Track;

class GuitarProClef extends AbstractReader
{
  /**
   * @param  \PhpTabs\Music\Track $track
   * @return int                  The Clef of $track
   */
  public function getClef(Track $track)
  {
    if (!$track
          ->getSong()
          ->getChannelById($track->getChannelId())
          ->isPercussionChannel()
    ) {

      $strings = $track->getStrings();

      foreach ($strings as $string)
      {
        if ($string->getValue() <= 34)
        {
          return Measure::CLEF_BASS;
        }
      }
    }

    return Measure::CLEF_TREBLE;
  }
}
