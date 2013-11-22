<?php

require "vendor/autoload.php";

use Philip\Philip;
use Philip\IRC\Response;
use Guzzle\Http\Client;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Symfony\Component\Yaml\Yaml;
use Ciarand\PhilipPlugin\MdnPlugin;
use Ciarand\PhilipPlugin\YesManPlugin;
use Ciarand\PhilipPlugin\FrenchPhrasePlugin;

$config = Yaml::parse("config.yml");

$bot = new Philip($config);
$bot->loadPlugin(new MdnPlugin($bot));
$bot->loadPlugin(new YesManPlugin($bot));
$bot->loadPlugin(new FrenchPhrasePlugin($bot));
$logger = $bot->getLogger();
$logger->pushHandler(new StreamHandler("php://stdout", Logger::DEBUG));
$bot->run();
