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
 * Override the constructor to import required classes.
 *
 */
	public function __construct(&$dispatch) {
		parent::__construct($dispatch);
		App::import('Core', array('File', 'Folder'));
	}

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

		$this->_discoverCache();
	}

/**
 * Discover the cache contents for the specified type
 *
 * @param string $type Cache type to discover
 * @return ArrayObject Cached items
 */
	protected function _discoverCache() {
		foreach (Cache::configured() as $name) {
			$config = Cache::config($name);
			$engine = $config['settings']['engine'];
			$discoverMethod = '_discoverCache' . ucfirst($engine);
			if (method_exists($this, $discoverMethod)) {
				$cache = $this->{$discoverMethod}($config);
			}
			unset($discoverMethod);
			
			if ($this->_isDryRun()) {
				$this->_listCache($cache);
			} else {
				$cleanMethod = '_cleanCache' . ucfirst($engine);
				if (method_exists($this, $cleanMethod)) {
					$cache = $this->{$cleanMethod}($cache, $config);
				}
			}
		}
	}

/**
 * Determine if a "dry run" was requested
 *
 * @return boolean Dry run?
 */
	protected function _isDryRun() {
		return !isset($this->params['x']);
	}

/**
 * List the cache
 *
 * @param array $cache Cache objects
 * @return void
 */
	protected function _listCache(array $cache) {
		$this->out(sprintf(__('%s cache objects:', true), count($cache)));
		foreach ($cache as $obj) {
			$this->out('   ' . $obj);
		}
	}

/**
 * Clean the cache of the specified keys
 *
 * @param array $files Keys to clean (or files)
 * @param array $config Cache configuration
 * @return void
 */
	protected function _cleanCacheFile(array $files, array $config) {
		foreach ($files as $name) {
			$file = new File($name);
			if ($file->delete()) {
				$this->out('[OK ]', 0);
			} else {
				$this->out('[ERR]', 0);
			}
			$this->out(sprintf(__(' deleting file: %s', true), $name));
		}
	}

/**
 * Discover cache items for 'File' cache engine
 *
 * @param ArrayObject $config Cache configuration settings
 * @return ArrayObject Discovered cache files
 */
	protected function _discoverCacheFile(array $config) {
		$folder = new Folder($config['settings']['path']);
		$files = array();
		foreach ($folder->find($config['settings']['prefix'] . '.*') as $file) {
			$files[] = $config['settings']['path'] . $file;
		}
		return $files;
	}
}
