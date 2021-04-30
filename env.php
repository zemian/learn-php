<?php
/**
 * Parse .env file and return array of env key value pairs.
 */
function parse_dot_env(string $file = '.env'): array {
    $handle = fopen($file, 'r');
    if ($handle) {
        $env = array();
        while (($line = fgets($handle)) !== false) {
            // Skip empty lines
            $line = trim($line);
            if (!$line) {
                continue;
            }

            // Skip comment lines, or remove comment portion
            $stripped_line = strstr($line, '#', true);
            if ($stripped_line !== false && $stripped_line === '') {
                continue;
            }

            // Parse key = value pair
            // Empty value will be stored as empty string ('').
            $pair = preg_split('/\s*=\s*/', $line, 2);
            if (count($pair) === 2) {
                $value = $pair[1];

                // Remove quotes from value
                $value = rtrim($value, '"');
                $value = ltrim($value, '"');
                $value = rtrim($value, "'");
                $value = ltrim($value, "'");

                $env[$pair[0]] = $value;
            } else if (count($pair) === 1) {
                $env[$pair[0]] = '';
            }
        }
        fclose($handle);
        return $env;
    } else {
        throw new Exception("File not found: $file");
    }
}

// Test
//print_r(parse_dot_env());