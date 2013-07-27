<?php namespace juco\cli\command;

abstract class Command
{
	protected static $helpCommands = array(
		'-h',
		'help'
	);

    /**
     * Run the command where no known sub-command has been specified
     *
     * @param array $args Additional command line arguments
     */
    public abstract function run(array $args);

    /**
     * Output command help
     *
     * @param array $args Additional arguments passed after help
     */
    public abstract function help(array $args);

    /**
     * Output the command help summary
     * This is output when called from php juco-cli.php [help|-h]
     */
    public abstract function helpSummary();

    public static function toMethodName($command)
    {
        return preg_replace_callback('/-([a-z])/', function ($match) {
            return strtoupper($match[1]);
        }, $command);
    }

	protected function isHelpSwitch($switch) 
	{
		return in_array($switch, self::$helpCommands);
	}

	protected function getCommandInstances()
	{
		$instances = array();
		foreach ($this->getCommandClassNames() as $className) {
			$object = new $className;
			if (is_subclass_of($object, '\\juco\\cli\\command\\Command')) {
				$instances[] = $object;
			}
		}

		return $instances;
	}

	private function getCommandClassNames()
	{
		$classNames = array();

		if ($handle = opendir(__DIR__)) {
			while (($name = readdir($handle)) !== false) {
				if ($this->isAllowedCommandFile($name)) {
					$classNames[] = __NAMESPACE__.'\\'.current(explode('.', $name));
				}
			}
		}

		return $classNames;
	}

    protected function getSwitches(array $args)
    {
        $switches = array();

        if (count($args) > 0) {
            $switches = current($args);
            $switches = str_split(ltrim($switches, '-'));
        }

        return $switches;
    }

    protected function hasSwitch($switch, $switches)
    {
        return in_array($switch, $this->getSwitches($switches));
    }

    private function isAllowedCommandFile($className)
    {
        // If one of the last 2 chars are . it's likely a Unix CWD
        if (strrpos($className, '.') <= 1) {
            return false;
        }

        $ignoreNames = array('Command.php');

        return !in_array($className, $ignoreNames);
    }
}