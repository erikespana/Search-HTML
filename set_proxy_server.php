<?php
/*
Include this in any environment that routes outgoing requests through a proxy server.
Replace 127.0.0.1 with your proxy server address.
*/

$default_opts = array(
		'http'=>array(
			'method'=>"GET",
		/*	'header'=>"Accept-language: en\r\n" .
						"Cookie: foo=bar",*/
			'proxy'=>"tcp://127.0.0.1:80"
			)
	);
$default = stream_context_set_default($default_opts);

$context =
    array( 'trace' => 1,
        'proxy_host' => "127.0.0.1:80",
        'proxy_port' => "80",
        'stream_context' => stream_context_create(
			array( 'https' =>
				array( 'proxy' => "tcp:// 127.0.0.1:80",
					   'request_fulluri' => true )/*,
				   'http' =>
				array( 'method' => "GET",
					   'header' => "Accept-language: en\r\n" . "Cookie: foo=bar",
					   'proxy'=>"tcp://127.0.0.1:80" )*/
            )
			
        )
    );
	
?>
