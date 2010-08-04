<?php
/**
 * Deployment Kit main shell
 *
 * Created by Graham Weldon (http://grahamweldon.com)
 * Copyright (c) 2010 Graham Weldon
 *
 * Licensed under The MIT License
 * http://www.opensource.org/licenses/mit-license.php
 * Redistributions of files must retain the above copyright notice.
 *
 * @package deployment_kit
 * @subpackage deploy_kit.vendors.shells.tasks
 */
class DeployShell extends Shell {

/**
 * Deploy Tasks
 *
 * @var array
 */
	public $tasks = array('Cache');

/**
 * Default operation when no tasks specified. This provides a help message if
 * no task was specified to run.
 *
 * @return void
 */
	public function main() {
		if (!isset($this->args[0])) {
			$this->help();
			$this->_stop();
		}
	}

/**
 * Display console help
 *
 * @return void
 */
	public function help() {
		$help = <<<TEXT

The CakePHP Deploy Kit helps ease production server deployment tasks. It
cleans out caches to force CakePHP to reindex and cache important files
such as database schemas etc.
---------------------------------------------------------------
Usage: cake deploy [<command>] [<option> ..]
---------------------------------------------------------------

Commands:
	deploy cache
		Clear the cache.

	deploy logs
		Clear log files.

Options:
	-x
		Execute commands. Default is to perform a dry run, which does
		not actually modify the production data.

TEXT;
		$this->out($help);
		$this->_stop();
	}
}
