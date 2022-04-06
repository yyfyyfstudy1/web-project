<span style="font-size:14px;">
	<html lang="en">
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php
	function send_post($url, $post_data)
	{
		$postdata = http_build_query($post_data);
		$options = array(
			'http' => array(
				'method' => 'POST',
				'header' => 'Content-type:application/x-www-form-urlencoded',
				'content' => $postdata,
				'timeout' => 15 * 60 // 超时时间（单位:s）
			)
		);
		$context = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		return $result;
	}
				
	$post_data = array(        
	'secret' => '6Lez0kQfAAAAAJU6zhFW8q4Bw23HBbIxWKxjsiLA',        
	'response' => $_POST["g-recaptcha-response"]    );
		$recaptcha_json_result = send_post('https://www.google.com/recaptcha/api/siteverify', $post_data);   
	 $recaptcha_result = json_decode($recaptcha_json_result);   
	//在这里处理返回的值 
	//var_dump($recaptcha_result);    
	?>
	</head>
	<body>
	echo $recaptcha_result;
	</body>
	</html>
	 
		</span>