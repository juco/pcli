<?php namespace juco\cli;

/**
 * Util class for displaying output to the user
 */

class Output {
	
	const BOLD_START       = "\033[1m";
	const NORMAL_START     = "\033[0m";

	const SEPARATOR_LENGTH = 15;

	public static function notice($str)
	{
		printf(">> %s\n", $str);
	}

	public static function line($str)
	{
		echo "$str\n";
	}

	public static function boldWithDesc($header, $description)
	{
		$separator = str_repeat(" ", self::SEPARATOR_LENGTH - strlen($header));
		printf("%s%s %s - %s%s\n", self::BOLD_START, $header, $separator, self::NORMAL_START, $description);
	}

	public static function boldLine($str)
	{
		echo "\033[1m$str\033[0m\n";
	}

	public static function error($str)
	{
		printf("\033[41m !! %s \033[0m\n", $str);
	}

	public static function colorString($str, $forground, $background)
	{
		// TODO
	}
}