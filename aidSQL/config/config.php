<?php

	$config = array(

		"url"=>array(
			"alias"=>'u',
			"required"=>TRUE
		),
		"sqli-plugins"=>array(
		),
		"info-plugins"=>array(
		),
		"http-method"=>array(
			"alias"=>"m",
			"values"=>array(
				"GET",
				"POST"
			)
		),
		"proxy-server"=>array(
			"requires"=>array("proxy-port")
		),
		"proxy-port"=>array(
			"requires"=>array("proxy-server")
		),
		"proxy-user"=>array(
			"requires"=>array("proxy-server")
		),
		"proxy-password"=>array(
			"requires"=>array(
				"proxy-server",
				"proxy-user"
			)
		),
		"proxy-auth"=>array(
			"values"=>array(
				"ntlm",
				"basic"
			),
			"requires"=>array(
					"proxy-server",
					"proxy-user",
					"proxy-password"
			)
		),
		"proxy-type"=>array(
			"values"=>array(
				"http",
				"socks5"
			),
			"requires"=>array("proxy-server")

		),
		"proxy-tunnel"=>array(
			"values"=>array(
				0,
				1
			),
			"requires"=>array("proxy-server")
		),
		"request-interval"=>array(
		),
		"http-adapter"=>array(
		),
		"proxy-file"=>array(
			"requires"=>array("proxy-server")
		),
		"urlvars"=>array(
			"requires"=>array("url")
		),
		"save-report"=>array(
			"alias"=>"s"
		),
		"verbose"=>array(
			"values"=>array(
					1,
					0
			)
		),
		"immediate-mode"=>array(
			"values"=>array(
				1,
				0
			)
		),
		"omit-paths"=>array(
		),
		"omit-pages"=>array(
		),
		"page-types"=>array(
		),
		"lpp"=>array(
		),
		"max-links"=> array(
		),
		"log-prepend-date"=>array(
			"values"=>array(
				1,
				0
			)
		),
		"colors"=>array(
			"values"=>array(
				1,
				0
			)
		),
		"google"=>array(
			"overlaps-with"=>array("url")
		),
		"google-language"=>array(
			"requires"=>array("google")
		),
		"google-offset"=>array(
			"requires"=>array("google")
		),
		"google-max-results"=>array(
			"requires"=>array("google")
		),
		"shuffle"=>array(
		),
		"omit-sites"=>array(
		),
		"connect-timeout"=>array(
		),
		"follow-redirects"=>array(
			"values"=>array(
				1,
				0
			)
		),
		"log-save"=>array(
		),
		"log-all"=>array(
			"novalue" => TRUE,
			"requires"=> array("log-save")
		),
		"plugin-phpinfo"=>array(
		),
		"classpath"=>array(
		),
		
		"plugin-info-load-order"=>array(
		),
		"crawl"=>array(
		),
		"no-crawl"=>array(
			"novalue"=>TRUE,
			"overlaps-with"=>array("crawl")
		),
		"url-query-char"=>array(
		),
		"url-var-char"=>array(
		),
		"url-equality-char"=>array(
		),
		"url-path-char"=>array(
		),
		"help"=>array(
			"novalue"=>TRUE,
			"overlaps-with"=>array("url","google")
		),
		"list-plugins"=>array(
			"novalue"=>TRUE,
			"overlaps-with"=>array("url","google")
		),
		"no-shell"=>array(
			"novalue"=>TRUE
		),
		"no-schema"=>array(
			"novalue"=>TRUE
		),
		"partial-schema"=>array(
			"novalue"=>TRUE
		),
		"decode-requests"=>array(
			"values"=>array(
				1,
				0
			)
		),
		"list-links"=>array(
			"novalue"=>TRUE,
			"overlaps-with"=>array("no-crawl")
		),
		"interactive"=>array(
			"novalue"=>TRUE
		),
		"http-ignore-errors"=>array(
			"values"=>array(
					0,
					1
			)
		),
		"shell-code"=>array(
		),
		"shell-name"=>array(
		)
	
	);
?>
