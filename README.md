MDN IRC bot
===========
A very simple IRC bot that spits out MDN links when a channel message of
the form `!mdn QUERY` is posted. This was mainly written for the [sdphp][]
IRC room and, as a result, is written in PHP.

[sdphp]: http://www.sdphp.org/

Getting started
---------------
1. `composer install -o`
2. Create and edit `config.yml`
3. `php bot.php`

Sample config.yml
-----------------
```yml
server: "irc.example.com"
port: 6667
ssl: false
realname: "my bots real name"
username: mycoolbot
nick: mycoolbot
channels: ["#mychannel"]
debug: true
unflood: 500
log: "bot.log"
```

Libraries used
--------------
* [Philip IRC bot framework][philip]
* [Guzzle HTTP request library][guzzle]
* [Symfony YAML component][yaml]

[philip]: https://github.com/epochblue/philip
[guzzle]: https://github.com/guzzle/guzzle
[yaml]: https://github.com/symfony/Yaml
