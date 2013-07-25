<?php namespace juco\cli\command;

use juco\cli\Output;

class Example extends Command
{
	public function run(array $args)
	{
        // No default command, so we'll just return the help menu
		$this->help($args);
	}

	public function help(array $args)
	{
        Output::boldLine('Example command');
        $commands = array(
            'example' => 'Example sub command',
            'foo'     => 'The foo command!'
        );
        array_walk(array_flip($commands), array('juco\cli\Output', 'boldWithDesc'));
	}

	public function helpSummary()
	{
		Output::boldWithDesc('example', 'Example command');
	}

    public function example(array $args)
    {
        Output::boldLine('Example sub-command!');
    }

	public function foo(array $args)
	{
		Output::boldLine('Foo bar');
	}
}