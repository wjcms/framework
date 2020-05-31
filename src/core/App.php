<?php

namespace wjcms\framework\core;
use ReflectionClass;

Class App extends Container
{
	//注册服务
	protected $serviceProviders = [];

	//延迟注册服务
	protected $deferProviders = [];

	protected $booted =false;
	protected static $app;

	public static function start()
	{
		define("BASE_PATH", __DIR__ . '/../..');
		$app = new self;
		$app->bindProviders();
		$app->boot();
		self::$app = $app;
	}

	public static function app(){
		return self::$app;
	}

	protected function boot(){
		foreach ($this->serviceProviders as $provider) {
			if(method_exists($provider, 'boot')){
				$provider->boot($this);
			}
		}
		$this->booted = true;
	}

	function bindProviders(){
		$config=include BASE_PATH.'/config/app.php';
		foreach ($config['providers'] as $provider) {
			//反射
			$reflection = new ReflectionClass($provider);

			$properties= $reflection->getDefaultProperties();
			if($properties['defer']===false){
				//立即注册
				$this->regsiter($provider);
			}else{
				//延迟注册
				$alias = substr($reflection->getShortName(),0,-8);
				$this->deferProviders[$alias]=$provider;
			}
		}
		// dump($this->deferProviders);
	}

    //立即注册的实现方法
	protected function regsiter($provider)
	{
		if($this->getProvider($provider)){
			return;
		}
		if (is_string($provider)) {
			$provider = new $provider($this);
		}
 
		$provider->regsiter($this);
		$this->serviceProviders[] = $provider;
		//延迟服务的boot
		if ($this->booted===true) {
			$provider->boot($this);
		}
	}

    //获取已注册的服务对象
	protected function getProvider($provider){
		$class = is_object($provider) ? get_class($provider) : $provider;
		//防止重复注册
		foreach ($this->serviceProviders as $instance) {
			if($instance instanceof $class){
				return $instance;
			}
		}
		
	}


	//延迟注册实现方法
	public function make($name,$force=false)
	{
		// dump($this->deferProviders[$name]);
		if (isset($this->deferProviders[$name])) {
			$this->regsiter($this->deferProviders[$name]);
		}
		return parent::make($name,$force);	
	}
} 
