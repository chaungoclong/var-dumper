<?php

declare(strict_types=1);

namespace DragonTNT\VarDumper;

class HtmlDumper extends AbstractDumper
{
    public function dump(...$vars): void
    {
        echo $this->getHeader();

        foreach ($vars as $var) {
            echo $this->dumpVar($var);
            echo '<hr>';
        }

        echo '</div></body></html>';
    }

    protected function dumpVar($var): string
    {
        if (is_null($var)) {
            return '<span class="dd-null">null</span>';
        }
        if (is_string($var)) {
            return '<span class="dd-string">"' . htmlspecialchars($var) . '"</span>';
        }
        if (is_numeric($var)) {
            return '<span class="dd-number">' . $var . '</span>';
        }
        if (is_bool($var)) {
            return '<span class="dd-boolean">' . ($var ? 'true' : 'false') . '</span>';
        }
        if (is_array($var)) {
            $html = '<span class="toggle-btn" onclick="toggleExpand(this)">[Array] (' . count($var) . ')</span>';
            $html .= '<div class="dd-array">';
            foreach ($var as $key => $value) {
                $html .= '<div><span class="dd-key">' . htmlspecialchars((string)$key) . ':</span> '
                    . $this->dumpVar($value) . '</div>';
            }
            return $html . '</div>';
        }
        if (is_object($var)) {
            $className = get_class($var);
            $properties = $this->getObjectProperties($var);

            $html = '<span class="toggle-btn" onclick="toggleExpand(this)">
                [Object] <span class="dd-class">' . $className . '@' . spl_object_id($var)
                . '</span> (' . count($properties) . ')</span>';

            $html .= '<div class="dd-object">';
            foreach ($properties as $key => $value) {
                $html .= '<div><span class="dd-key">' . htmlspecialchars($key) . ':</span> '
                    . $this->dumpVar($value) . '</div>';
            }

            return $html . '</div>';
        }

        return '<span>' . htmlspecialchars(print_r($var, true)) . '</span>';
    }

    protected function getHeader(): string
    {
        return '<!DOCTYPE html>
        <html lang="vi">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dump and Die - Laravel Style</title>
            <style>
                body { font-family: Consolas, monospace; background-color: #f4f4f4; padding: 20px; }
                .dd-container { background: #282c34; color: #ffffff; padding: 20px; border-radius: 10px; margin: auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
                .dd-key { color: #61afef; }
                .dd-string { color: #98c379; }
                .dd-number { color: #d19a66; }
                .dd-boolean { color: #e06c75; }
                .dd-null { color: #c678dd; }
                .dd-object, .dd-array { margin-left: 20px; border-left: 2px solid #555; padding-left: 10px; display: none; }
                .toggle-btn { cursor: pointer; color: #e5c07b; font-weight: bold; }
                .toggle-btn::before { content: "▶ "; display: inline-block; transition: transform 0.2s; }
                .expanded::before { transform: rotate(90deg); }
                .dd-class { color: #56b6c2; font-weight: bold; }
                .dd-id { color: #e06c75; }
            </style>
            <script>
                function toggleExpand(element) {
                    let next = element.nextElementSibling;
                    if (next.style.display === "none" || next.style.display === "") {
                        next.style.display = "block";
                        element.classList.add("expanded");
                    } else {
                        next.style.display = "none";
                        element.classList.remove("expanded");
                    }
                }
            </script>
        </head>
        <body>
            <div class="dd-container">';
    }
}