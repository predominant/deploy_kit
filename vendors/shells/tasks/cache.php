<?php

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