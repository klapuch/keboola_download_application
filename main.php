<?php
declare(strict_types = 1);

define('DATA_DIRECTORY', getenv('KBC_DATADIR'));
define('OUTPUT_FILE', sprintf('%s/out/tables/reports.csv', DATA_DIRECTORY));
define('CONFIG_FILE', sprintf('%s/config.json', DATA_DIRECTORY));

$config = json_decode(file_get_contents(CONFIG_FILE), true);
$parameters = $config['parameters'];

list($url, $username, $password) = [$parameters['url'], $parameters['username'], $parameters['password']];

$options = [
	'http' => [
		'method' => 'GET',
		'header' => sprintf('Authorization: Basic %s', base64_encode("$username:$password")),
	],
];

$content = file_get_contents($url, false, stream_context_create($options));
file_put_contents(OUTPUT_FILE, $content);