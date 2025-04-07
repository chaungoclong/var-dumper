<?php

declare(strict_types=1);

use DragonTNT\VarDumper\Dumper;

if (!function_exists('dd')) {
    /**
     * Dump the given variables and terminate the script.
     *
     * @param mixed ...$vars
     */
    function dd(...$vars): void
    {
        Dumper::dump(...$vars);
        exit(1);
    }
}

if (!function_exists('dump')) {
    /**
     * Dump the given variables.
     *
     * @param mixed ...$vars
     */
    function dump(...$vars): void
    {
        Dumper::dump(...$vars);
    }
}