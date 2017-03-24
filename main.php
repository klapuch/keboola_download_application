<?php
declare(strict_types = 1);

define('DATA_DIRECTORY', getenv('KBC_DATADIR'));
define('OUTPUT_FILE', DATA_DIRECTORY . DIRECTORY_SEPARATOR . 'out' . DIRECTORY_SEPARATOR . 'tables' . DIRECTORY_SEPARATOR . 'reports.csv');
define('CONFIG_FILE', DATA_DIRECTORY . DIRECTORY_SEPARATOR . 'config.json');

$config = json_decode(file_get_contents(CONFIG_FILE), true);
$parameters = $config['parameters'];
var_dump($config);

list($url, $username, $password) = [$parameters['url'], $parameters['username'], $parameters['password']];
var_dump($url);
var_dump($username);
var_dump($password);

$options = [
	'http' => [
		'method' => 'GET',
		'header' => sprintf('Authorization: Basic %s', base64_encode("$username:$password")),
	],
];

$context = stream_context_create($options);
$content = file_get_contents($url, false, $context);
file_put_contents(OUTPUT_FILE, $content);
