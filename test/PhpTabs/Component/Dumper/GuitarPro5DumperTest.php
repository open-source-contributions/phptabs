<?php

namespace PhpTabsTest\Component\Dumper;

/**
 * Tests with a simple tablature
 * Guitar Pro 5
 */
class GuitarPro5DumperTest extends DumperHelper
{
  protected static function getFilename()
  {
    return 'testSimpleTab.gp5';
  }

  /**
   * Provider for text scenarios
   */
  public function getTextScenarios()
  {
    return [
      ['song:'],
      ['name:'],
      ['artist:'],
      ['album:'],
      ['author:'],
      ['copyright:'],
      ['writer:'],
      ['comments:'],
      ['channels:'],
      ['channelId:'],
      ['bank:'],
      ['program:'],
      ['volume:'],
      ['balance:'],
      ['chorus:'],
      ['reverb:'],
      ['phaser:'],
      ['tremolo:'],
      ['parameters:'],
      ['key:'],
      ['value:'],
      ['measureHeaders:'],
      ['number:'],
      ['start:'],
      ['timeSignature:'],
      ['numerator:'],
      ['denominator:'],
      ['dotted:'],
      ['doubleDotted:'],
      ['divisionType:'],
      ['enters:'],
      ['times:'],
      ['tempo:'],
      ['marker:'],
      ['repeatOpen:'],
      ['repeatAlternative:'],
      ['repeatClose:'],
      ['tripletFeel:'],
      ['tracks:'],
      ['offset:'],
      ['solo:'],
      ['mute:'],
      ['color:'],
      ['R:'],
      ['G:'],
      ['B:'],
      ['lyrics:'],
      ['from:'],
      ['measures:'],
      ['clef:'],
      ['keySignature:'],
      ['header:'],
      ['beats:'],
      ['chord:'],
      ['text:'],
      ['voices:'],
      ['duration:'],
      ['index:'],
      ['empty:'],
      ['direction:'],
      ['notes:'],
      ['stroke:'],
      ['velocity:'],
      ['string:'],
      ['tiedNote:'],
      ['effect:'],
      ['bend:'],
      ['tremoloBar:'],
      ['harmonic:'],
      ['grace:'],
      ['trill:'],
      ['tremoloPicking:'],
      ['vibrato:'],
      ['deadNote:'],
      ['slide:'],
      ['hammer:'],
      ['ghostNote:'],
      ['accentuatedNote:'],
      ['heavyAccentuatedNote:'],
      ['palmMute:'],
      ['staccato:'],
      ['tapping:'],
      ['slapping:'],
      ['popping:'],
      ['fadeIn:'],
      ['letRing:'],
      ['strings:']
    ];
  }
}
