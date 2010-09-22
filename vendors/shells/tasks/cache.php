<?php
/**
 * Deploy Kit Cache clearing task
 *
 * Created by Graham Weldon (http://grahamweldon.com)
 * Copyright (c) 2010 Graham Weldon
 *
 * Licensed under The MIT License
 * http://www.opensource.org/licenses/mit-license.php
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
		// @todo Implement cache "type" clearing, so you can clear just models, and leave cached views untouched.
		// $type = 'all';
		// if (!empty($this->args)) {
		// 	$type = $this->args[0];
		// }

		foreach (Cache::configured() as $name) {
			$config = Cache::config($name);
			if (Cache::clear(false, $name)) {
				$this->out('- Cleared ' . $name);
			} else {
				$this->out('! Failed clearing ' . $name);
			}
		}
	}
}
