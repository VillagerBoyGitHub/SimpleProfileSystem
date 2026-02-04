<?php

namespace Robert\ProfileSystem\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use Robert\ProfileSystem\Main;

class KillsCommand extends Command {
    private $base;

    public function __construct(Main $base)
    {
        $this->base = $base;
        parent::__construct("kills", "View your profile", "/kills", []);
    }

    public function execute(CommandSender $p, $label, array $args)
    {
        if($this->getName() === "kills"){
            $name = $p->getName();
            $kills = $this->base->getPlayerManager()->getKills($name);

            $p->sendMessage("§bKills: §e" . $kills);
        }
    }
}