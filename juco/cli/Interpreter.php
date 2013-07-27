<?php namespace juco\cli;

use juco\cli\command\Command;

class Interpreter
{
	protected static $self = null;
	
	protected $args = array();

	public static function instance()
	{
		if(is_null(static::$self)) {
			static::$self = new static();
		}
		return static::$self;
	}

    public function process(array $argv)
	{
		$this->args = $argv;
		
		// Ditch the first element, it's useless to us!
		array_shift($this->args);

		$class = $this->getObject();
		$method = $this->getMethod();

		$method = method_exists($class, $method) ? $method : 'help';

		call_user_func(array($class, $method), $this->args);
	}

	protected function getObject()
	{
		$className = 'juco\\cli\\command\\NoCommand';

		if (count($this->args) > 0) {
			$_className = 'juco\\cli\\command\\'.ucfirst(array_shift($this->args));
			if (class_exists($_className)) {
				$className = $_className;
			}
		}

		return new $className;
	}

	protected function getMethod()
	{
		if (count($this->args) > 0) {
            return Command::toMethodName(array_shift($this->args));
        }

		return 'help';
	}
}