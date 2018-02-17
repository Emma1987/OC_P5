<?php
namespace EmmaM;

class Page
{
	protected $contentFile;
	protected $vars = [];

	public function addVar($var, $value)
	{
		if (!is_string($var) || is_numeric($var) || empty($var))
		{
			throw new \InvalidArgumentException('Le nom de la variable doit être une chaine de caractères non nulle.');
		}

		$this->vars[$var] = $value;
	}

	public function getPage()
	{
		if (!file_exists($this->contentFile))
		{
			throw new \RuntimeException('La vue spécifiée n\'existe pas.');
		}

		extract($this->vars);

		ob_start();
			require $this->contentFile;
		$content = ob_get_clean();

		ob_start();
			require __DIR__ . '/../../App/Templates/layout.php';
		return ob_get_clean();
	}

	// GETTERS & SETTERS

	public function setContentFile($contentFile)
	{
		$this->contentFile = $contentFile;
	}
}