<?php

namespace Ciarand\PhilipPlugin;

use Philip\AbstractPlugin as BasePlugin;
use Philip\IRC\Response;

class FrenchPhrasePlugin extends BasePlugin
{
    public function init()
    {
        $phrases = array(
            "à gogo",
            "adieu",
            "au revoir",
            "bon mot",
            "brunette",
            "ça ne fait rien",
            "cherchez la femme",
            "c'est la vie",
            "faute de mieux",
            "excusez-moi",
            "Honi soit qui mal y pense",
            "mauvais quart d'heure",
            "n'est-ce pas?",
            "répondez s'il vous plaît",
            "savoir-vivre",
        );

        $config = $this->bot->getConfig();
        $nickname = $config["nick"];
        $this->bot->onChannel(
            "/^{$nickname} french me$/",
            function ($event) use ($phrases) {
                $source = $event->getRequest()->getSource();
                $message = $phrases[rand(0, count($phrases) - 1)];
                $event->addResponse(Response::msg($source, $message));
            }
        );
    }

    public function getName()
    {
        return "FrenchPhrasePlugin";
    }
}
