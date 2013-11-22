<?php

namespace Ciarand\PhilipPlugin;

use Philip\AbstractPlugin as BasePlugin;
use Philip\IRC\Response;

class YesManPlugin extends BasePlugin
{
    public function init()
    {
        $possibilities = array(
            "robot agree with me",
            "robot, agree with me",
            "bot agree with me",
            "bot, agree with me",
            // trollface.gif
            "robots are great",
            "botbotbot",
            "robots deserve voting rights",
        );
        $regex = implode("|", $possibilities);

        $answers = array(
            "I agree with :caller 100%",
            ":caller is entirely correct",
            ":caller is right",
            ":caller is so smart",
            ":caller knows what's up",
            ":caller can't be wrong",
            // trollface.gif
            ":caller's a dick",
        );

        $this->bot->onChannel(
            "/^{$regex}$/",
            function ($event) use ($answers) {
                $source = $event->getRequest()->getSource();
                $caller = $event->getRequest()->getSendingUser();
                $message = strtr(
                    $answers[rand(0, count($answers) - 1)],
                    array(":caller" => $caller)
                );
                $event->addResponse(Response::msg($source, $message));
            }
        );
    }

    public function getName()
    {
        return "YesManPlugin";
    }
}
