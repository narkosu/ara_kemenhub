<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

//Yii::setPathOfAlias('myprivatespace', '/var/www/common/mynamespace/');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'SISTIM ADMIN',
	'theme'=>'admin',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.modules.masters.models.Departement',
		'application.components.*',
	),
	'modules'=> array('masters','skj','penilaian',
		'gii'=>array(
				'class'=>'system.gii.GiiModule',
				'password'=>'test',
				
				'generatorPaths'=>array(
					'application.gii',   // a path alias
				)
			)				  
	),
	'defaultController'=>'dashboard',

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			//'allowAutoLogin'=>true,
			'class'=>'WebUser',
		),
		/*'db'=>array(
			'connectionString' => 'sqlite:protected/data/blog.db',
			'tablePrefix' => 'tbl_',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=narkosu_aramenhub',
			'emulatePrepare' => true,
			'username' => 'narkosu_menhub',
			'password' => 'menhub234',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);