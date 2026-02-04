<?php

namespace Robert\ProfileSystem\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use Robert\ProfileSystem\Main;

class DeathsCommand extends Command {
    private $base;

    public function __construct(Main $base)
    {
        $this->base = $base;
        parent::__construct("deaths", "View your profile", "/deaths", []);
    }

    public function execute(CommandSender $p, $label, array $args)
    {
        if($this->getName() === "deaths"){
            $name = $p->getName();
            $deaths = $this->base->getPlayerManager()->getDeaths($name);

            $p->sendMessage("§bDeaths: §e" . $deaths);
        }
    }
}