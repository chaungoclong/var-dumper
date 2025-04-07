<?php

declare(strict_types=1);

namespace DragonTNT\VarDumper;

interface DumperInterface
{
    public function dump(...$vars): void;
}