<?php

declare(strict_types=1);

namespace DragonTNT\VarDumper;

class CliDumper extends AbstractDumper
{
    protected array $colors = [
        'null' => "\033[35m",
        'string' => "\033[32m",
        'number' => "\033[33m",
        'boolean' => "\033[31m",
        'reset' => "\033[0m",
        'key' => "\033[36m",
        'class' => "\033[34m",
    ];

    public function dump(...$vars): void
    {
        foreach ($vars as $var) {
            echo $this->dumpVar($var);
            echo "\n\n";
        }
    }

    protected function dumpVar($var, int $indent = 0): string
    {
        $spaces = str_repeat('  ', $indent);

        if (is_null($var)) {
            return $spaces . $this->colors['null'] . '[NULL]' . $this->colors['reset'];
        }
        if (is_string($var)) {
            return $spaces . $this->colors['string'] . '"' . $var . '"' . $this->colors['reset'];
        }
        if (is_numeric($var)) {
            return $spaces . $this->colors['number'] . $var . $this->colors['reset'];
        }
        if (is_bool($var)) {
            return $spaces . $this->colors['boolean'] . ($var ? 'true' : 'false') . $this->colors['reset'];
        }
        if (is_array($var)) {
            $output = $spaces . $this->colors['key']
                . "[Array] (" . count($var) . " items)" . $this->colors['reset'] . "\n";
            foreach ($var as $key => $value) {
                $output .= $spaces . '  ' . $this->colors['key'] . $key . $this->colors['reset']
                    . " => " . $this->dumpVar($value, $indent + 1) . "\n";
            }
            return $output;
        }
        if (is_object($var)) {
            $className = get_class($var);
            $properties = $this->getObjectProperties($var);
            $output = $spaces . $this->colors['class'] . "[Object] $className" . $this->colors['reset'] . "\n";

            foreach ($properties as $key => $value) {
                $output .= $spaces . '  ' . $this->colors['key'] . $key . $this->colors['reset']
                    . " => " . $this->dumpVar($value, $indent + 1) . "\n";
            }
            return $output;
        }

        return $spaces . print_r($var, true);
    }
}