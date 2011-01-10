<?php

	namespace aidSQL\plugin\info {

		interface InfoPluginInterface{

			public function __construct(\aidSQL\http\Adapter &$httpAdapter,Array $config,\aidSQL\core\Logger &$log=NULL);
			public function getInfo();
			public function setLog(\aidSQL\core\Logger &$log);
			public function setConfig(Array $config);
			public function setHttpAdapter(\aidSQL\http\Adapter &$httpAdapter);
			public static function getHelp(\aidSQL\core\Logger $logger);

		}

	}

?>
