<?php
namespace EmmaM;

class Config
{
    protected $vars = [];

    public function getVarValue($var)
    {
        if (!$this->vars) {
            $xml = new \DOMDocument();
            $xml->load(__DIR__ . '/../../App/Config/app.xml');

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
