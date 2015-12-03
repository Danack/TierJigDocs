<?php


namespace Site\Model;

class ColorScheme
{
    private $selectedScheme;

    /**
     * @var array
     * Keys are CSS filename, values are descriptions.
     */
    private $knownColorSchemes = [
        'code_highlight_solarized_light' => "Solarized Light",
        'code_highlight_danack' => "Danack",
        'code_highlight_solarized_dark' => "Solarized Dark",
    ];
    
    public function __construct()
    {
        foreach ($this->knownColorSchemes as $key => $value) {
            $this->selectedScheme = $key;
            break;
        }
    }

    public function getSelectedCssName()
    {
        return $this->selectedScheme;
    }

    public function getColorSchemes()
    {
        return $this->knownColorSchemes;
    }
}
