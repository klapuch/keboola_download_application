<?php
declare(strict_types = 1);

define('DATA_DIRECTORY', getenv('KBC_DATADIR'));
define('OUTPUT_FILE', sprintf('%s/out/tables/reports.csv', DATA_DIRECTORY));
define('CONFIG_FILE', sprintf('%s/config.json', DATA_DIRECTORY));

$config = json_decode(file_get_contents(CONFIG_FILE), true);
$parameters = $config['parameters'];

list($url, $username, $password) = [$parameters['url'], $parameters['username'] ?? null, $parameters['password'] ?? null];
list($oldDelimiter, $newDelimiter) = [$parameters['old_delimiter'] ?? ',', $parameters['new_delimiter'] ?? ','];

$options = [
	'http' => [
		'method' => 'GET',
	],
];
if ($username !== null && $password !== null) {
	$options['http']['header'] = sprintf('Authorization: Basic %s', base64_encode("$username:$password"));
}

$content = file_get_contents($url, false, stream_context_create($options));
$encodedContent = mb_detect_encoding($content) === 'UTF-8' ? $content : iconv('WINDOWS-1250', 'UTF-8', $content);
file_put_contents(OUTPUT_FILE, str_replace($oldDelimiter, $newDelimiter, $encodedContent));