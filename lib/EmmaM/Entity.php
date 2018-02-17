<?php
namespace EmmaM;

class Entity
{
	protected $errors = [];

	public function __construct(array $data = [])
	{
		if (!empty($data))
		{
			$this->hydrate($data);
		}
	}

	private function hydrate(array $data)
	{
		foreach ($data as $key => $value)
		{
			$method = 'set' . ucfirst($key);

			if (is_callable([$this, $method]))
			{
				$this->$method($value);
			}
		}
	}

	// GETTERS & SETTERS
	
	public function getErrors()
	{
		return $this->errors;
	}
}