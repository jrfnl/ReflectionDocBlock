<?php

declare(strict_types=1);

/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link      http://phpdoc.org
 */

namespace phpDocumentor\Reflection;

use PHPUnit\Framework\TestCase as PHPUnit_TestCase;
use function is_string;
use function strpos;
use function str_replace;

/**
 * Generic TestCase from which all tests extend.
 */
abstract class TestCase extends PHPUnit_TestCase
{
    /**
     * Assert that two text strings are the same when the line endings are ignored.
     *
     * @param mixed  $expected Expected value.
     * @param mixed  $actual   Actual value.
     * @param string $message  Message to display in case of failure.
     *
     * @return void
     */
    public function assertSameIgnoreLineEndings($expected, $actual, string $message = ''): void
    {
        if (is_string($expected)) {
            $expected = static::normalizeLE($expected);
        }

        if (is_string($actual)) {
            $actual = static::normalizeLE($actual);
        }

        $this->assertSame($expected, $actual, $message);
    }

    /**
     * Normalize the line endings in an arbitrary text string to "\n".
     *
     * This can prevent tests failing on mismatched line endings.
     *
     * @param string $text Arbitrary text string.
     * @return string
     */
    public static function normalizeLE(string $text): string
    {
        return str_replace("\r\n", "\n", $text);;
    }
}
