<?php

/*
 * This file is part of the PhpTabs package.
 *
 * Copyright (c) landrok at github.com/landrok
 *
 * For the full copyright and license information, please see
 * <https://github.com/stdtabs/phptabs/blob/master/LICENSE>.
 */

namespace PhpTabsTest\Component;

use Exception;
use PHPUnit\Framework\TestCase;
use PhpTabs\PhpTabs;

/**
 * Tests Exporter component
 */
class ExporterTest extends TestCase
{
    public function setUp() : void
    {
        $this->tablature = new PhpTabs(
            PHPTABS_TEST_BASEDIR
            . '/samples/testSimpleTab.gp5'
        );
    }

    /**
     * Following exports must be a string
     * - text
     * - txt
     */
    public function testStringFormats()
    {
        foreach ([
            'text',
            'txt',
        ] as $format) {
            $this->assertTrue(
                is_string(
                    $this->tablature->export($format)
                )
            );
        }
    }

    /**
     * Following exports must be an array
     * - array
     * - none
     */
    public function testArrayFormats()
    {
        foreach ([
                'array',
                null
            ] as $format) {
            $this->assertTrue(
                is_array(
                    $this->tablature->export($format)
                )
            );
        }
    }

    /**
     * Some export format parameters have aliases
     * - text = txt
     * - yaml = yml
     */
    public function testAliases()
    {
        $this->assertSame(
            $this->tablature->export('text'),
            $this->tablature->export('txt')
        );
    
        $this->assertSame(
            $this->tablature->convert('yaml'),
            $this->tablature->convert('yml')
        );
    }

    public function testException()
    {
        $this->expectException(Exception::class);

        // Not a valid export format
        (new PhpTabs())->export('exception');
    }
}
