# CakePHP Deployment Kit #

This plugin is designed to assist the automated deployment of CakePHP applications to servers.

Developed for use in CakePHP 1.3

# Installation #

Install the plugin as normal, by dropping the deployment_kit directory into your /app/plugins directory.

If you are comfortable using git, then setup the repository as a submodule for you project. You can do this by performing the following while in your /app directory:

	$ git submodule add git://github.com/predominant/deployment_kit.git plugins/deployment_kit
	$ git add plugins/deployment_kit .gitmodules
	$ git commit -m "Added DeploymentKit plugin." plugins/deployment_kit .gitmodules

# Usage #

## Cache clearing ##

Cache clearing is necessary when updating production servers with the application configuration set with "Debug" at 0. When set to 0, cache files are stored to ensure maximum performance and minimum database and path reading. However, if your updates contain changes to your database structure then clearing the cache will be necessary to avoid issues with your application.

You can clear the cache with the following commands:

	$ cake deploy cache -x

This clears all caches. The -x switch tells it to bypass "dry run" mode, which will just list the files that _would_ have been deleted.

Dry run is the default mode, and requires this switch to override, and acts as a measure to avoid accidental file deletion.

# Copyright and Licensing #

Created by Graham Weldon (http://grahamweldon.com)

Copyright (c) 2010 Graham Weldon

Licensed under The MIT License (http://www.opensource.org/licenses/mit-license.php)

Redistributions of files must retain the above copyright notice.

# Don't blame me (disclaimer) #

The code is good. I use it myself.

But if somehow, this cache deletion code causes your own files to go missing... don't blame me.
