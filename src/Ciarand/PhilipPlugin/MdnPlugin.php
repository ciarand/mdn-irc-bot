<?php

namespace Ciarand\PhilipPlugin;

use Philip\AbstractPlugin as BasePlugin;
use Philip\IRC\Response;

use Guzzle\Http\Client;

class MdnPlugin extends BasePlugin
{
    protected $guzzleClient;

    public function init()
    {
        $client = new Client("http://www.google.com");
        $endpoint = "/search?btnI&q=mdn+";

        $this->bot->onChannel(
            "/^!mdn (.*)$/",
            function ($event) use ($client, $endpoint) {
                $source = $event->getRequest()->getSource();
                list($query) = $event->getMatches();
                $message = $client
                    // We only want a head request
                    ->head($endpoint . urlencode($query))
                    // Send it
                    ->send()
                    // Grab the URL
                    ->getEffectiveUrl();
                $event->addResponse(Response::msg($source, $message));
            }
        );
    }

    public function getName()
    {
        return "MdnPlugin";
    }
}
