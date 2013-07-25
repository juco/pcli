#!/usr/bin/php
<?php
require 'juco/cli/bootstrap.php';

juco\cli\Interpreter::instance()->process($argv);