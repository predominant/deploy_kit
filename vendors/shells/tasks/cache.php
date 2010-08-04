<?php
/**
 * Deploy Kit Cache clearing task
 *
 * Created by Graham Weldon (http://grahamweldon.com)
 * Copyright (c) 2010 Graham Weldon
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @package deploy_kit
 * @subpackage deploy_kit.vendors.shells.tasks
 */
class CacheTask extends Shell {

/**
 * Run the task
 *
 * @return void
 */
	public function execute() {
		if (empty($this->args)) {
			$type = 'all';
		} else {
			$type = $this->args[0];
		}
		$this->out('CacheTask::execute()');
		$this->out($type);
	}
}