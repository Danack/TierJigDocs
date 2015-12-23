<?php

namespace Site;

use Jig\JigConfig;
use Jig\Jig;
use Jig\Converter\JigConverter;
use Site\SiteException;

// Code is copyright of DigitalNature. No license file was attached to the code
// repository, but the code was offered for use, so I have assumed the author intended
// for people to use the code.
// 
// Original code is available from https://github.com/digitalnature/php-highlight



function getTabbedPanel($output)
{
    
    
    
    
    $html = <<< HTML
<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs"> 
  <ul id="myTabs" class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
      <a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
      Raw output
      </a>
    </li>

    <li role="presentation" class="">
      <a href="#htmlbr" role="tab" id="htmlbr-tab" data-toggle="tab" aria-controls="htmlbr" aria-expanded="false">
        HTML with br
      </a>
    </li>
    
    <li role="presentation" class="">
      <a href="#html" role="tab" id="html-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">
        HTML
      </a>
    </li>
  </ul>
    
  <div id="myTabContent" class="tab-content codeContent">
    <div role="tabpanel" class="tab-pane active" id="home" aria-labelledby="home-tab"> 
      <pre>%s</pre>
    </div>
    <div role="tabpanel" class="tab-pane codeContent" id="htmlbr" aria-labelledby="htmlbr-tab">
      <p>%s</p>
    </div>
    <div role="tabpanel" class="tab-pane codeContent" id="html" aria-labelledby="html-tab">
      <p>%s</p>
    </div>
  </div>
</div>
HTML;

    $panel1Text = ($output); 
    $panel2Text = nl2br($output);
    $panel3Text = $output;
    
    return sprintf($html, $panel1Text, $panel2Text, $panel3Text);
}


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
    
    public static function renderOutputFileEnd(JigConverter $jigConverter, $extraText)
    {
        //$jigConverter->addHTML("renderOutputFileEnd: $extraText");
    }
    
    public static function renderTemplateFileStart(JigConverter $jigConverter, $extraText)
    {
        $path = __DIR__."/../../test/fixtures/example_templates/";
        $dirPath = realpath($path);
        $template = trim($extraText);
        $output = '';
    
        $templatePath = $dirPath.'/'.$template.'.php.tpl';
        $output .= "Template: $template<br/>";
        $output .= "<pre>";
        $string = file_get_contents($templatePath);
        $string = htmlentities($string, ENT_DISALLOWED | ENT_HTML401 | ENT_NOQUOTES, 'UTF-8');
        $output .= $string;
        $output .= "</pre>";
    
        $jigConverter->addText($output);
    }
    
    public static function renderTemplateFileEnd(JigConverter $jigConverter, $extraText)
    {
        //$jigConverter->addHTML("renderTemplateFileEnd: $extraText");
    }
    
    public static function renderExampleCodeStart(JigConverter $jigConverter, $extraText)
    {
        $filePattern = '#example=[\'"](.*)[\'"]#u';
        $valueMatchCount = preg_match($filePattern, $extraText, $valueMatches);
        if ($valueMatchCount == 0) {
            throw new SiteException("Failed to get value for injection");
        }
        $filename = $valueMatches[1];
        $filename = str_replace('/', '_', $filename);
        $codeLines = self::getExampleCode($filename);
    
        if ($codeLines === false) {
            throw new SiteException("Failed to read code from file $filename");
        }
    
        
        $code = implode("", $codeLines);
        $highLightedCode = \Site\CodeHighlighter::highlight($code);
        $jigConverter->addText($highLightedCode);
    }
    
    public static function getExampleCode($exampleName)
    {
        $startPattern = "//Example $exampleName";
        $endPattern = "//Example end";
    
        $srcDirectories = [
            __DIR__ . '/../../test',
            __DIR__ . '/../../lib',
            __DIR__ . '/../../src',
        ];
    
        foreach ($srcDirectories as $srcDirectory) {
            $directory = new \RecursiveDirectoryIterator($srcDirectory);
            $iterator = new \RecursiveIteratorIterator($directory);
            $files = new \RegexIterator($iterator, '/^.+\.php$/i', \RecursiveRegexIterator::MATCH);
        
            foreach ($files as $file) {
                /** @var $file \SplFileInfo */
                $filename = $file->getPath() . "/" . $file->getFilename();
        
                // open the file
                $fileLines = file($filename);
        
                if (!$fileLines) {
                    throw new SiteException("Failed to open $filename");
                }
        
                $firstLine = false;
                $lineCount = 0;
                $codeLines = false;
                $indent = '';
                foreach ($fileLines as $fileLine) {
                    $lineCount++;
        
                    if ($codeLines === false) {
                        $match = strpos($fileLine, $startPattern);
                        if ($match !== false) {
                            $codeLines = [];
                            $firstLine = true;
                            continue;
                        }
                    }
                    if ($codeLines !== false) {
                        $matches = null;
                        if ($firstLine == true) {
                            $matched = preg_match('#\s*#', $fileLine, $matches);
        
                            if ($matched) {
                                $indent = $matches[0];
                            }
                            $firstLine = false;
                        }
        
                        $endMatch = strpos($fileLine, $endPattern);
                        if ($endMatch !== false) {
                            return $codeLines;
                        }
                        
                        if ($indent) {
                            if (strpos($fileLine, $indent) === 0) {
                                $fileLine = substr($fileLine, strlen($indent));
                            }
                        }
        
                        $codeLines[] = $fileLine;
                    }
                }
            }
        }
    
        return false;
    }


    public static function renderExampleCodeEnd(JigConverter $jigConverter, $extraText)
    {
    }
    
    public static function highlightCodeStart(JigConverter $jigConverter, $extraText)
    {
    }
    
    public static function highlightCodeEnd(JigConverter $jigConverter, $blockText)
    {
        $text = \Site\CodeHighlighter::highlight($blockText);
        $jigConverter->addText($text);
    }

    public static function renderOutputFileStart(JigConverter $jigConverter, $extraText)
    {
        $exampleName = trim($extraText);
        $classname = getExampleClassnameFromTemplate($exampleName);
        if (class_exists($classname) == false) {
            throw new SiteException("Class $classname is missing.");
        }
    
        $object = new $classname();
        $output = $object->renderOutput();


        $string = getTabbedPanel(
            $output
        );

        $jigConverter->addText($string);
    }

}
