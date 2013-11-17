<?php

require "vendor/autoload.php";

use Philip\Philip;
use Philip\IRC\Response;
use Guzzle\Http\Client;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Symfony\Component\Yaml\Yaml;
use Ciarand\PhilipPlugin\MdnPlugin;

$config = Yaml::parse("config.yml");

$bot = new Philip($config);
$bot->loadPlugin(new MdnPlugin($bot));
$logger = $bot->getLogger();
$logger->pushHandler(new StreamHandler("php://stdout", Logger::DEBUG));
$bot->run();
