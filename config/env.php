<?php

function env($key, $default = null) {
    static $vars = null;

    if ($vars === null) {
        $vars = [];
        $lines = file(__DIR__ . "/../.env", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) continue;
            list($k, $v) = explode("=", $line, 2);
            $vars[trim($k)] = trim($v);
        }
    }

    return $vars[$key] ?? $default;
}
