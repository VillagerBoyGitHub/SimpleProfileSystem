<?php

namespace Robert\ProfileSystem\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use Robert\ProfileSystem\Main;

class ProfileCommand extends Command {
    private $base;

    public function __construct(Main $base)
    {
        $this->base = $base;
        parent::__construct("profile", "View your profile", "/profile", ["stats"]);
    }

    public function execute(CommandSender $p, $label, array $args)
    {
        if($this->getName() === "profile"){
            $name = $p->getName();
            $deaths = $this->base->getPlayerManager()->getDeaths($name);
            $kills = $this->base->getPlayerManager()->getKills($name);
            $wins = $this->base->getPlayerManager()->getWins($name);
            $pl = $this->base->getServer()->getPluginManager()->getPlugin("EconomyAPI");
            if($pl !== null) {
                $coins = $pl->myMoney($name);
            }
            $p->sendMessage("§6§lVillager§bPE §r§7 - §bYour statistics");
            $p->sendMessage("§bDeaths: §e" . $deaths);
            $p->sendMessage("§bKills: §e" . $kills);
            $p->sendMessage("§bWins: §e" . $wins);
            if(isset($coins)) {
                $p->sendMessage("§bCoins: §e" . $coins);
            }
        }
    }
}