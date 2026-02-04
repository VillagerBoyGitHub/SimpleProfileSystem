<?php

namespace Robert\ProfileSystem\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use Robert\ProfileSystem\Main;

class WinsCommand extends Command {
    private $base;

    public function __construct(Main $base)
    {
        $this->base = $base;
        parent::__construct("wins", "View your profile", "/wins", []);

    }

    public function execute(CommandSender $p, $label, array $args)
    {
        if($this->getName() === "wins"){
            $name = $p->getName();
            $wins = $this->base->getPlayerManager()->getWins($name);

            $p->sendMessage("§bWins: §e" . $wins);
        }
    }
}