<?php

declare(strict_types=1);

/*
 * This file is part of the PhpTabs package.
 *
 * Copyright (c) landrok at github.com/landrok
 *
 * For the full copyright and license information, please see
 * <https://github.com/stdtabs/phptabs/blob/master/LICENSE>.
 */

namespace PhpTabs\Reader\Json;

use Exception;
use PhpTabs\Component\InputStream;
use PhpTabs\Component\ReaderInterface;
use PhpTabs\Component\Tablature;
use PhpTabs\Music\Song;
use PhpTabs\IOFactory;

class JsonReader implements ReaderInterface
{
    public function __construct(InputStream $file)
    {
        $song = new Song();

        $data = json_decode(
            $file->getStream($file->getSize()),
            true
        );

        // JSON decoding error
        if (json_last_error() !== JSON_ERROR_NONE) {
            $message = sprintf(
                'JSON_DECODE_FAILURE: Error number %d - %s',
                json_last_error(),
                json_last_error_msg()
            );

            throw new Exception($message);
        }

        $this->setTablature(IOFactory::fromArray($data)->getSong());
    }

    /**
     * {@inheritdoc}
     */
    public function getTablature(): Tablature
    {
        return isset($this->tablature)
            ? $this->tablature
            : new Tablature();
    }

    /**
     * Initialize Tablature with read Song
     */
    private function setTablature(Song $song): void
    {
        if (!isset($this->tablature)) {
            $this->tablature = new Tablature();
        }

        $this->tablature->setSong($song);
        $this->tablature->setFormat('json');
    }
}
