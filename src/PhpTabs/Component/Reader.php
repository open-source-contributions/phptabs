<?php

/*
 * This file is part of the PhpTabs package.
 *
 * Copyright (c) landrok at github.com/landrok
 *
 * For the full copyright and license information, please see
 * <https://github.com/stdtabs/phptabs/blob/master/LICENSE>.
 */

namespace PhpTabs\Component;

use Exception;

class Reader
{
    /**
     * @var Tablature object
     */
    private $tablature;

    /**
     * @var ReaderInterface bridge
     */
    private $bridge;

    /**
     * @var array List of extensions
     */
    private $extensions = array(
        'gp3'   => 'PhpTabs\\Reader\\GuitarPro\\GuitarPro3Reader',
        'gp4'   => 'PhpTabs\\Reader\\GuitarPro\\GuitarPro4Reader',
        'gp5'   => 'PhpTabs\\Reader\\GuitarPro\\GuitarPro5Reader',
        'mid'   => 'PhpTabs\\Reader\\Midi\\MidiReader',
        'midi'  => 'PhpTabs\\Reader\\Midi\\MidiReader'
    );

    /**
     * Instanciates tablature container
     * Try to load the right dedicated reader
     *
     * @param \PhpTabs\Component\InputStream $file file which should contain a tablature
     *
     * @throws \Exception If file format is not supported
     */
    public function __construct(InputStream $file, string $extension)
    {
        $this->tablature = new Tablature();

        if (isset($this->extensions[ $extension ])) {
            $name = $this->extensions[ $extension ];

            $this->tablature->setFormat($extension);

            $this->bridge = new $name($file);
        }

        // Bridge not found
        if (!($this->bridge instanceof ReaderInterface)) {
            $message = sprintf(
                'No reader has been found for "%s" type of file',
                $extension
            );

            throw new Exception($message);
        }
    }

    /**
     * @return Tablature A tablature read from file.
     *  Otherwise, an empty tablature with some error information
     *
     * @return \PhpTabs\Component\Tablature
     */
    public function getTablature(): Tablature
    {
        if ($this->bridge instanceof ReaderInterface) {
            return $this->bridge->getTablature();
        }

        return $this->tablature;  // Fallback
    }
}
