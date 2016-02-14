<?php

namespace atomita\wordpress\eloquent;

use \Illuminate\Database\Capsule\Manager;
use \Illuminate\Events\Dispatcher;
use \Illuminate\Container\Container;
use \atomita\Facade;

class DatabaseManager extends Facade {
	protected static function facadeInstance(){
		static $instance;
		if (!isset($instance)){
			$container = new Container;
			$instance = new Manager($container);
			$instance->setEventDispatcher(new Dispatcher($container));
			$instance->setAsGlobal();
			$instance->addConnection([
				'driver'    => 'mysql',
				'host'      => \DB_HOST,
				'database'  => \DB_NAME,
				'username'  => \DB_USER,
				'password'  => \DB_PASSWORD,
				'charset'   => \DB_CHARSET,
				'collation' => (!defined('\DB_COLLATE') || empty(\DB_COLLATE)) ? 'utf8_unicode_ci' : \DB_COLLATE,
				'prefix'    => $GLOBALS['table_prefix'],
			]);
		}
		return $instance;
	}

	public static function bootEloquent(){
		static $booted = false;
		if (!$booted){
			static::facadeInstance()->bootEloquent();
			$booted = true;
		}
	}
}
