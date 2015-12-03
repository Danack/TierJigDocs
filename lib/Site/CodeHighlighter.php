<?php

namespace Site;

// Code is copyright of DigitalNature. No license file was attached to the code
// repository, but the code was offered for use, so I have assumed the author intended
// for people to use the code.
// 
// Original code is available from https://github.com/digitalnature/php-highlight

class CodeHighlighter
{
    
    private static $stringClassMapping = [
        '(' => 'BRACKET',
        ')' => 'BRACKET',
        '[' => 'BRACKET',
        ']' => 'BRACKET',
        '{' => 'BRACKET',
        '}' => 'BRACKET',
        "=" => 'EQUALS',
        ";" => 'SEMI_COLON'
    ];
    
    
    /**
     * Highlights PHP syntax from the given string and formats it as HTML
     *
     * @version 1.0
     * @author  digitalnature, http://digitalnature.eu
     * @param   string $code
     * @return  string
     */
    public static function highlight($code, $prefix = "php_")
    {
        // caches tokenizer constants
        static $tokenStrings = null;

        $openingTagAdded = false;

        if (strpos($code, "<?php") === false) {
            $code = "<?php \n" . $code;
            $openingTagAdded = true;
        }

        // get all tokenizer constants if this is the first call;
        // we will use constants names as class names (eg. T_DOC_COMMENT => .tDocComment)
        if (!$tokenStrings) {
            $tokenStrings = get_defined_constants();
            // throw away constants that don't start with 'T_'
            array_walk($tokenStrings, function ($value, $key) use (&$tokenStrings) {
                if (strpos($key, 'T_') !== 0) {
                    unset($tokenStrings[$key]);
                }
            });
        }

        $output = $styles = '';
        $tokens = token_get_all((string)$code);

        // iterate tokens and generate HTML
        foreach ($tokens as $token) {
            if ($token[0] === T_OPEN_TAG) {
                if ($openingTagAdded) {
                    continue;
                }
            }

            // turn whitespace into a string token
            if ($token[0] === T_WHITESPACE) {
                $token = $token[1];
            }

            if (is_string($token)) {
                
                if (array_key_exists($token, self::$stringClassMapping)) {
                    $class = self::$stringClassMapping[$token];
                    $output .= sprintf('<span class="%s%s">%s</span>', $prefix, $class, $token);
                    continue;
                }

                $output .= htmlspecialchars($token, ENT_QUOTES);
                continue;
            }

            list($id, $text, $line) = $token;

            // escape for HTML output
            $text = htmlspecialchars($text, ENT_QUOTES);

            // get the token name
            if (($class = array_search($id, $tokenStrings)) !== false) {
                $output .= sprintf('<span class="%s%s">%s</span>', $prefix, $class, $text);
            } else {
                // we should never reach this point (!?)
                $output .= $text;
            }
        }

        return sprintf('<pre class="code">%s%s</pre>', $styles, $output);
    }
}
