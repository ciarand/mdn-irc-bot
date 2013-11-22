<?php

namespace Ciarand\PhilipPlugin;

use Philip\AbstractPlugin as BasePlugin;
use Philip\IRC\Response;

use Guzzle\Http\Client;

class MdnPlugin extends BasePlugin
{
    public function init()
    {
        $client = new Client("http://www.google.com");
        $endpoint = "/search?btnI&q=site:developer.mozilla.org+";

        $this->bot->onChannel(
            "/^!mdn (.*)$/",
            function ($event) use ($client, $endpoint) {
                $source = $event->getRequest()->getSource();
                $caller = $event->getRequest()->getSendingUser();
                list($query) = $event->getMatches();
                $link = $client
                    // We only want a head request
                    ->head($url = ($endpoint . urlencode($query)))
                    // Send it
                    ->send()
                    // Grab the URL
                    ->getEffectiveUrl();

                if ($url === $link) {
                    $message = "{$caller}: No results found";
                } else {
                    $message = "{$caller}: {$link}";
                }
                $event->addResponse(Response::msg($source, $message));
            }
        );
    }

    public function getName()
    {
        return "MdnPlugin";
    }
}
