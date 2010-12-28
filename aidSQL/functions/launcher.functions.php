<?php

	function usageShort(aidSQL\core\Logger &$log){

		$info = $log->getX11Info();
		$log->setX11Info(FALSE);
		$log->log("--url\t\t\t\t<url>\t\t\tUse this URL to perform injection tests",0,"white");
		$log->log("--google\t\t\t<search term>\t\tJust Google it!",0,"white");
		$log->log("--help\t\t\t\tExtended help",0,"white");
		$log->setX11Info($info);
		
	}

	function usageLong(aidSQL\core\Logger &$log){

		$log->setX11Info(FALSE);
		usageShort($log);
		$log->log("--log-save\t\t\tFile where to dump results",0,"white");
		$log->log("--plugins\t\t\tUse these plugins (default all)",0,"white");
		$log->log("--http-adapter\t\t\tSwitch http adapter (default Ecurl) ",0,"white");
		$log->log("--connect-timeout\t\tConnect timeout for A ",0,"white");
		$log->log("--url-query-char\t\t(default ?)",0,"white");
		$log->log("--url-var-char\t\t\t(default &)",0,"white");
		$log->log("--url-equality-char\t\t(default =)",0,"white");
		$log->log("--url-path-char\t\t(default /)",0,"white");
		$log->log("--request-interval\t\tHTTP Request Interval (in seconds)",0,"white");
		$log->log("--no-crawl\t\t\tDont crawl hrefs (default yes)",0,"white");
		$log->log("--http-method\t\t\tPOST or GET (default GET)",0,"white");
		$log->log("--follow-redirects\t\tFollow HTTP 302 (default yes)",0,"white");
		$log->log("--omit-sites\t\t\tRegex for omitting certain sites when googling",0,"white");
		$log->log("--proxy-server\t\t\tHost or IP of the proxy server",0,"white");
		$log->log("--proxy-user\t\t\tUsername for the proxy server (if requires authentication)",0,"white");
		$log->log("--proxy-password\t\tPassword for the proxy server (if requires authentication)",0,"white");
		$log->log("--proxy-port\t\t\tProxy port",0,"white");
		$log->log("--proxy-type\t\t\tProxy type [BASIC | NTLM] (default basic) ",0,"white");
		$log->log("--proxy-tunnel\t\t\tUse CONNECT method (default 0) ",0,"white");
		$log->log("--immediate-mode\t\tQuit as soon as it finds a vulnerable spot (default yes)",0,"white");
		$log->log("--omit-paths\t\t\tcomma delimited list of paths to be ommited",0,"white");
		$log->log("--omit-pages\t\t\tcomma delimited list of pages to be ommited",0,"white");
		$log->log("--page-types\t\t\tPage types that should be taken in account when crawling a site",0,"white");
		$log->log("--lpp\t\t\t\tAmount of links to get per page when crawling (default all)",0,"white");
		$log->log("--max-links\t\t\tAmount of links to consume per site",0,"white");
		$log->log("--colors\t\t\tActivate / Deactivate colors (default 1)",0,"white");
		$log->log("--log-prepend-date\t\tPrepend date to log (default 0)",0,"white");
		$log->log("--google-language\t\tsearch in this language (default \"en\") accepts <es,de,it> amongst others",0,"white");
		$log->log("--google-max-results\t\tLimit the search to a maximum of results others",0,"white");
		$log->log("--google-offset\t\tOffset results (Use with care you can end with no sites)",0,"white");
		$log->log("--google-shuffle\t\tShuffle search results (default yes)",0,"white");
		
		$log->log("--classpath\t\t\tDirectory where aidSQL classes reside",0,"white");
		$log->log("\n",0,"white");
		
	}

	function mergeConfig($var,$file){

		if(is_null($file)||!file_exists($file)){
			return $var;
		}

		//parse_ini_file if an option in the ini file is set to yes is automatically translated into a 1 ...
		//PHP 5.3.2

		$config	= parse_ini_file($file);
		$cmdLine	= array();

		foreach($config as $configParam=>$configValue){
			$cfgFile[] = "--".$configParam."=".$configValue;
		}

		if(!sizeof($var)){
			return $cfgFile;
		}

		$cmdLineArgs	= array();

		for($i=1;isset($var[$i]);$i++){

			$found = FALSE;

			$temp1 = substr($var[$i],0,strpos($var[$i],"="));

			if(empty($temp1)){
				$temp1 = $var[$i];
			}

			for($x=0;isset($cfgFile[$x]);$x++){

				$temp2  = substr($cfgFile[$x],0,strpos($cfgFile[$x],"="));

				if($temp1==$temp2){
					$found = TRUE;
					$cfgFile[$x]=$var[$i];
				}

			}

			if(!$found){
				$cfgFile[] = $var[$i];
			}

		}

		return $cfgFile;

	}


	function banner(aidSQL\core\Logger &$log){

		$log->setX11Info(FALSE);

		$banner="               _     _           _ ";
		$log->log($banner,0,"red");
		$banner="   _          (_)   | |         | |";
		$log->log($banner,0,"red");
		$banner=" _| |_    __ _ _  __| |___  __ _| |";
		$log->log($banner,0,"red");
		$banner="|_   _|  / _` | |/ _` / __|/ _` | |";
		$log->log($banner,0,"red");
		$banner="  |_|   | (_| | | (_| \__ \ (_| | |";
		$log->log($banner,0,"red");
		$banner="         \__,_|_|\__,_|___/\__, |_|";
		$log->log($banner,0,"red");
		$banner="                              | |  ";
		$log->log($banner,0,"red");
		$banner="                              |_|  ";
		$log->log($banner,0,"red");
		$banner="\n\tSQL INJECTION DETECTION TOOL\n";
		$log->log($banner,0,"white");
		$banner="\t\tBy Juan Stange <jpfstange@gmail.com>\n\n\n";
		$log->log($banner,0,"white");

		$log->setX11Info(TRUE);

	}

	function isVulnerable($cmdParser,$httpAdapter,$crawler,$log){

		$aidSQL		=	new \aidSQL\core\Runner($cmdParser,$httpAdapter,$crawler,$log);
		$result		=	FALSE;

		if($aidSQL->isVulnerable()){

			$log->log("Site is vulnerable to sql injection!!",0,"light_cyan");

			if(!$aidSQL->generateReport()){

				$log->log("Site seems to be vulnerable, however we failed to gather necessary data to make the injection report!",1,"red");

			}

			$result	=	TRUE;

		}

		return $result;

	}


	function filterSites (Array &$sites,aidSQL\core\Logger &$log,$regex=NULL){

		$regex	=	trim($regex,"/");
		$doRegex	=	!empty($regex);

		foreach($sites as $key=>$site){

			if($doRegex){

				if(preg_match("/$regex/",$site->getHost())){

					$log->log("SITE OMITTED ".$site->getHost(),2,"yellow",FALSE);
					unset($sites[$key]);
					continue;

				}

			}

			$log->log("Site added ".$site->getHost(),0,"green",FALSE);

		}

	}

?>