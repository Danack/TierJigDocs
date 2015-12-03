<?php


namespace Site;

use TierJig\Model\ColorScheme;

class ColorSchemeSelector
{
    private $colorScheme;
    
    public function __construct(ColorScheme $colorScheme)
    {
        $this->colorScheme = $colorScheme;
    }
    
    public function render()
    {
        $output = "";
        $output .= "<select id='colorSelector'>";

        foreach ($this->colorScheme->getColorSchemes() as $filename => $description) {
            $output .= sprintf(
                "<option value='%s'>%s</option>",
                $filename,
                $description
            );
        }

        $output .= "</select>";

        return $output;
    }
}

// onchange='updateColorSelector(this);'
//'/userSetting'