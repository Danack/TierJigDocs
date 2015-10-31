<?php


require __DIR__.'/../vendor/autoload.php';


function normalizeColor($value)
{
//    if (strlen($value) == 3) {
//        $value = sprintf("%'.06d", $value);
//    }
    
    if (strlen($value)) {
        $value = sprintf("%'.06s", $value);
    }

    return $value;
}



class CSSInfo
{
    public $foreground;
    public $background;
}


class SchemeParser
{
    public $results = [];
    
    /** @var CSSInfo[] */
    private $cssVariables = [];
    
    private $properties = [
        "FOREGROUND",
        "BACKGROUND",
        "FONT_TYPE",
        "EFFECT_COLOR",
        "EFFECT_TYPE",
        "ERROR_STRIPE_COLOR",
    ];

    private $colorMappings = [

        // PHP code - Template Lang
        'default' =>  [
            ['TEXT'],
            [null],
        ],
        // PHP tags - Keyword
        'tags' =>  [
            ['DEFAULT_TAG','PHP_TAG',],
            array(
                'T_OPEN_TAG',
                'T_OPEN_TAG_WITH_ECHO',
            ),
        ],
        // Keywords - Keyword
        'keywords' =>  array(
            array('DEFAULT_KEYWORD','PHP_KEYWORD',),
            array(
                'T_NEW',
                'T_FUNCTION',
                'T_PRIVATE',
                'T_PUBLIC',
                'T_PROTECTED',
                'T_REQUIRE',
                'T_REQUIRE_ONCE',
                'T_PRIVATE',
                'T_PUBLIC',
                'T_PROTECTED',
                'T_REQUIRE',
                'T_REQUIRE_ONCE',                
                'T_PRIVATE',
                'T_PUBLIC',
                'T_PROTECTED',
                'T_REQUIRE',
                'T_REQUIRE_ONCE',                
                'T_PRIVATE',
                'T_PUBLIC',
                'T_PROTECTED',
                'T_REQUIRE',
                'T_REQUIRE_ONCE',                
                'T_PRIVATE',
                'T_PUBLIC',
                'T_PROTECTED',
                'T_REQUIRE',
                'T_REQUIRE_ONCE',
            ),
        ),
        // Comments - Line Comment
        'comments' =>  [
            [],
            [],
        ],
        // Numbers - numbers lang
        'numbers' =>  [
            ['DEFAULT_NUMBER', 'PHP_NUMBER',],
            array(
                'T_DNUMBER',
                'T_LNUMBER',  
            ),
        ],
        // Strings - String lang
        'strings' =>  [
            ['DEFAULT_STRING','PHP_STRING',],
            array(
                'T_CONSTANT_ENCAPSED_STRING'
            ),
        ],
        // Shell command - String
        'shell_command' =>  [
            ['DEFAULT_EXEC_COMMAND_ID', 'PHP_EXEC_COMMAND_ID',],
            [],
        ],
        // Escape sequences - valid escape sequence
        'escape_sequence' =>  [
            ['DEFAULT_ESCAPE_SEQUENCE', 'PHP_ESCAPE_SEQUENCE',],
            [],
        ],
        // Operators - operation sign
        'operators' =>  [
            ['DEFAULT_OPERATION_SIGN', 'PHP_OPERATION_SIGN',],
            array(
                'EQUALS',
                'SEMI_COLON',
                'T_DOUBLE_COLON',
                'T_IS_EQUAL',
                'T_IS_GREATER_OR_EQUAL',
                'T_IS_IDENTICAL',
                'T_IS_NOT_EQUAL',
                'T_IS_NOT_IDENTICAL',
                'T_IS_SMALLER_OR_EQUAL',
                'T_OBJECT_OPERATOR',
                'T_OR_EQUAL',
                'T_PAAMAYIM_NEKUDOTAYIM',
                'T_PLUS_EQUAL',
                'T_POW',
                'T_SPACESHIP',
                'T_XOR_EQUAL',
                'T_SL',
                'T_SL_EQUAL',
                'T_SR',
                'T_SR_EQUAL',
                'T_LOGICAL_AND',
                'T_LOGICAL_OR',
                'T_LOGICAL_XOR',
                'T_METHOD_C',
                'T_MINUS_EQUAL',
                'T_MOD_EQUAL',
                'T_MUL_EQUAL',
                'T_AND_EQUAL',
            ),
        ],
        // Brackets - brackets
        'brackets' =>  [
            ['DEFAULT_BRACKETS', 'PHP_BRACKETS',],
            array(
                'BRACKET'
            ),
        ],
        // Predefined symbols - predefined symbol
        'predefined_symbol' =>  [
            ['DEFAULT_PREDEFINED SYMBOL', 'PHP_PREDEFINED SYMBOL',],
            [],
        ],
        // Unknown character - Bad character lang
        'unknown_character' =>  [
            ['DEFAULT_BAD_CHARACTER', 'PHP_BAD_CHARACTER',],
            [],
        ],
        // Comma - Comma lang
        'comma' =>  [
            ['DEFAULT_COMMA','PHP_COMMA',],
            [],
        ],
        // Semi-colon - Semi-colon Lang
        'semi_colon' =>  [
            ['DEFAULT_SEMICOLON', 'PHP_SEMICOLON',],
            [],
        ],
        // Heredoc ID - Label Lang
        'heredoc_id' =>  [
            ['DEFAULT_HEREDOC_ID', 'PHP_HEREDOC_ID',],
            [],
        ],
        // Heredoc content - String Lang
        'heredoc_content' =>  [
            ['DEFAULT_HEREDOC_CONTENT', 'PHP_HEREDOC_CONTENT',],
            [],
        ],
        // Identifier - Identifier Lang
        'identifier' =>  [
            ['DEFAULT_IDENTIFIER', 'PHP_IDENTIFIER',],
            [],
        ],
        // Variable - Local variable
        'variable' =>  [
            array('DEFAULT_VAR', 'DEFAULT_LOCAL_VARIABLE', 'PHP_VAR',),
            array(
                'T_VARIABLE',
            ),
        ],
        // Constant - Constant
        'constant' =>  [
            ['DEFAULT_CONSTANT', 'PHP_CONSTANT',],
            [],
        ],
        // Function/method declaration - i.e. the name of a function
        'function' =>  [
            ['DEFAULT_FUNCTION', 'PHP_FUNCTION',],
            [],
        ],
        // Parameter - Parameter lang
        'parameter' => [
            ['DEFAULT_PARAMETER','PHP_PARAMETER',],
            [],
        ],
        
        // Function call - function call lang   T_STRING
        'function_call' =>  [
            ['DEFAULT_FUNCTION_CALL', 'PHP_FUNCTION_CALL',],
            [],
        ],
        // Instance Method calls - instance method Lang
        'instance_call' =>  [
            ['DEFAULT_INSTANCE_METHOD', 'PHP_INSTANCE_METHOD',],[],
        ],
        // Static Method call - static method Lang
        'static_call' =>  [
            ['DEFAULT_STATIC_METHOD','PHP_STATIC_METHOD',], 
            [],
        ],
        // Class - class name lang
        'class' =>  [
            ['DEFAULT_CLASS', 'PHP_CLASS',],
            array(
                'T_CLASS',
            ),
        ],
        // Interface - inteface name
        'interface' =>  [
            ['DEFAULT_INTERFACE', 'PHP_INTERFACE',],
            [],
        ],
        // Instance Field - instance field
        'instance_field' =>  [
            ['DEFAULT_INSTANCE_FIELD', 'PHP_INSTANCE_FIELD',],
            [],
        ],
        // Static field - static field lang
        'static_field' =>  [
            ['DEFAULT_STATIC_FIELD', 'PHP_STATIC_FIELD',],
            [],
        ],
        // PHPDoc comment - Doc comment lang
        'doc_comment' =>  [
            ['DEFAULT_COMMENT', 'PHP_COMMENT',],
            [],
        ],
        // PHPDoc tag - Doc comment markup
        'doc_tag' =>  [
            [ 'DEFAULT_DOC_TAG', 'PHP_DOC_TAG',],
            [],
        ],
        // PHPDoc markup - Doc comment markup
        'doc_markup' =>  [
            ['DEFAULT_MARKUP_ID', 'PHP_MARKUP_ID',],
            [],
        ],
        // Goto label - language identifier
        'goto_label' =>  [
            ['GOTO_LABEL'],
            [],
        ],
    ];

//  'DEFAULT_DOC_COMMENT_ID', 'PHP_DOC_COMMENT_ID',
//'DEFAULT_SCRIPTING_BACKGROUND', 'PHP_SCRIPTING_BACKGROUND',

    
    


    function addElement($schemeName, $name, $value)
    {
        $this->results[$schemeName][$name] = $value;
    }

    function parseElement(DOMElement $element, $schemeName)
    {
        $name = $element->getAttribute('name');
        $value = $element->getAttribute('value');
        $this->addElement($schemeName, $name, $value);
    }

    
    function extractInfo(DOMElement $element, $lessVariableName)
    {
        $elementDOM = \FluentDOM($element);

        $cssVar = $this->cssVariables[$lessVariableName];

        $setForegroundFn = function (DOMElement $element) use ($cssVar) {
            $value = $element->getAttribute('value');
            
            $cssVar->foreground = normalizeColor($value);
        };
        
        $setBackgroundFn = function (DOMElement $element) use ($cssVar) {
            $value = $element->getAttribute('value');
            $cssVar->background = normalizeColor($value);
        };

        $elementDOM
            ->find(".//option[@name='FOREGROUND']")
            ->each($setForegroundFn);
        
        $elementDOM
            ->find(".//option[@name='BACKGROUND']")
            ->each($setBackgroundFn);
    }
    
    function parseColors($filename)
    {
        $document = \FluentDOM($filename);        
        foreach ($this->colorMappings as $lessVariableName => $info) {
            
            list($sources, $tokens) = $info;
            $this->cssVariables[$lessVariableName] = new CSSInfo();
            
            $extractFn = function(DOMElement $element) use ($lessVariableName) {
                $this->extractInfo($element, $lessVariableName);
            };

            foreach ($sources as $source) {
                $document
                    ->find(".//option[@name='$source']")
                    ->each($extractFn);
            }
        }
    }
    
    function writeThemeLessFile($filename)
    {
        $output = "";
        
        foreach ($this->colorMappings as $lessVariableName => $info) {
            list($sources, $tokens) = $info;
            
            $block = "\n";
            $classes = [];
            
            if (count($tokens) == 1 && $tokens[0] == null) {
                $output .= "
pre.code {
  font-family: Menlo, Monaco, 'Courier New', monospace;
  font-size: 14px;
  padding: 5px;
  color: @default-color; 
  background-color: @default-background-color;
}
";
                continue; 
            }
            
            if (count($tokens) == 0) {
                $block .= "/* No code uses this color\n";
            }
            
            foreach ($tokens as $token) {
                $classes[] = ".php_".$token;
            }
            
            $block .= implode(",\n", $classes);
            $block .= " {\n";
            $block .= sprintf(
                "    color: @%s-color;\n",
                $lessVariableName
            );
            $block .= sprintf(
                "    background-color: @%s-background-color;\n",
                $lessVariableName
            );
            $block .= "}\n";
            
            if (count($tokens) == 0) {
                $block .= "*/\n";
            }

            $output .= $block;
        }

        file_put_contents($filename, $output);
    }

    
    function writeColorsLessFile($filename)
    {
        $output = '';
        foreach ($this->colorMappings as $lessName => $info) {
            //list($sources, $tokens) = $info;
            $cssVar = $this->cssVariables[$lessName];
            $foregroundValue = 'inherit';
            if ($cssVar->foreground != null) {
                $foregroundValue = "#".$cssVar->foreground;
            }
            $backgroundValue = 'inherit';
            if ($cssVar->background != null) {
                $backgroundValue = "#".$cssVar->background;
            }

            $output .= sprintf(
                "@%s-color: %s; \n",
                $lessName,
                $foregroundValue
            );

            $output .= sprintf(
                "@%s-background-color: %s; \n",
                $lessName,
                $backgroundValue
            );
        }

        file_put_contents($filename, $output);
    }
}

$themes = [
    "Danack.xml"   => "danack",
    "Solarized_Dark.xml" => "solarized_dark",
    "Solarized_Light_(Alternate).xml" => "solarized_light",
];

foreach ($themes as $input => $output) {
    try {
        $colorsOutputName = "colors_$output.less";
        $codeOutputName = "code_highlight_$output.less";

        $schemeParser = new SchemeParser();
        $schemeParser->writeThemeLessFile(__DIR__ . "/../data/less/code/code_highlight.less");
        //$schemeParser->parseFile(__DIR__ . "/../data/less/code/theme_source/$input");
        $schemeParser->parseColors(__DIR__ . "/../data/less/code/theme_source/$input");
        $schemeParser->writeColorsLessFile(__DIR__ . "/../data/less/code/$colorsOutputName");

$lessContent = <<< LESS
@import "$colorsOutputName";
@import "code_highlight.less";
LESS;

        file_put_contents(
            __DIR__ . "/../data/less/code/$codeOutputName",
            $lessContent
        );
    }
    catch(\Exception $e) {
        echo "Failed to parse $input :";
        echo $e->getMessage();
        echo "\n";
    }
}



