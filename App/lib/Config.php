<?php

namespace App;

class Config
{
    protected $vars = [];

    /**
     * Get the value of a variable in config file
     * @param  string $var [The variable to get its value]
     */
    public function getVarValue($var)
    {
        if (!$this->vars) {
            $xml = new \DOMDocument();
            $xml->load(__DIR__ . '/../Config/app.xml');

            $elements = $xml->getElementsByTagName('define');
            foreach ($elements as $element) {
                $this->vars[$element->getAttribute('var')] = $element->getAttribute('value');
            }
        }

        if (isset($this->vars[$var])) {
            return $this->vars[$var];
        }
        return null;
    }
}
