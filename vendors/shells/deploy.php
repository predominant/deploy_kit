<?php
/**
 * Deployment Kit main shell
 *
 * @package deployment_kit
 * @author Predominant
 */
class DeployShell extends Shell {

/**
 * Dry run (don't modify caches / filesystem)
 *
 * @var boolean
 */
	protected $_dry = true;

/**
 * Deploy Tasks
 *
 * @var array
 */
	public $tasks = array('Cache');

/**
 * Run before all tasks
 *
 * @return void
 */
	public function initialize() {
		$this->_welcome();
		$this->out(__('Deployment Kit Shell', true));
		$this->hr();
	}

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
	deploy cache [<cacheType>]
		Clear the cache. Optionally provide a cache type to clear, such
		as: all, model, view, persistent, main

	deploy logs [<logType>]
		Clear log files. Optionally provide a log name to clear, for example:
		all, debug, error

Options:
	-x
		Execute commands. Default is to perform a dry run, which does
		not actually modify the production data.

TEXT;
		$this->out($help);
		$this->_stop();
	}
}