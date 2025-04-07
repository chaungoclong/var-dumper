<?php

declare(strict_types=1);

namespace DragonTNT\VarDumper;

class Dumper
{
    public const VERSION = '1.0.0-alpha.1';

    public static function getVersion(): string
    {
        return self::VERSION;
    }

    public static function dump(...$vars): void
    {
        if (PHP_SAPI === 'cli') {
            $dumper = new CliDumper();
        } else {
            $dumper = new HtmlDumper();
        }

        $dumper->dump(...$vars);
    }
}