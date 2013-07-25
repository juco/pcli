<?php namespace juco\cli;

/**
 * Util class for retrieving input from the user
 */

class Input
{
	protected static $handle = null;

	public static function get($prompt = null)
	{
		echo ">> $prompt";
		return trim(fgets(static::getHandle()));
	}

	protected static function getHandle()
	{
		if (is_null(static::$handle)) {
			static::$handle = fopen('php://stdin', 'r');
		}

		return static::$handle;
	}
}