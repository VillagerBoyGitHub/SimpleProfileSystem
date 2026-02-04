# SimpleProfileSystem
A stable profile system containing wins, kills and deaths for PocketMine v2.0.0.

# Commands
### Currently, you can use the following commands:
- /profile - view your profile
- /wins - view your wins
    - Aliases:
        - (none)
- /deaths - view your deaths
    - Aliases:
        - /stats
- /kills - view your kills
    - Aliases:
        - (none)

*We are planning to add support for admin commands so admins can modify values*
# Integration

### To integrate this plugin in your server, you can use the following code snippet (assuming the player name is $name):
```php
$ps = \pocketmine\Server::getInstance()->getPluginManager()->getPlugin("SimpleProfileSystem");
$ps->getPlayerManager()->addWin($name);
```
# Releases
[Click here](https://github.com/VillagerBoyGitHub/SimpleProfileSystem/releases)
# Contributions
We welcome any contributions to this plugin.

# Distribution
According to the GPL-3.0 license, used for this plugin, you have the rights to modify it, redistribute it, sell it, and have full control over it all for free.