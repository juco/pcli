<?php namespace juco\cli\command;

use juco\cli\Output;

class NoCommand extends Command
{
    public function run(array $args)
    {
        $this->help($args);
    }

    public function help(array $args)
    {
        Output::notice('Pure Cli Help');
        foreach($this->getCommandInstances() as $instance)
        {
            $instance->helpSummary();
        }
    }

    public function helpSummary() { /* NoOp */ }
}