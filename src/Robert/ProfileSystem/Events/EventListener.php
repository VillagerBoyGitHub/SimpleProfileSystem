<?php

namespace Robert\ProfileSystem\Events;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use Robert\ProfileSystem\Main;

class EventListener implements Listener {
    /** @var Main $base */
    private $base;
    public function __construct(Main $base)
    {
        $this->base = $base;
    }

    public function onJoin(PlayerJoinEvent $e) {
        $p = $e->getPlayer();
        $name = $p->getName();

        if(!$this->base->isPlayerRegistered($name)) {
            $this->base->registerPlayer($name);
            $this->base->getLogger()->warning($name . " has not been registered. Registering player...");
            $p->sendMessage("§a» §bWelcome to §6§lVillager §bPE§r§b!");
        }
    }

    public function onDeath(PlayerDeathEvent $e) {
        $p = $e->getPlayer();
        $c = $p->getLastDamageCause();
        if($c instanceof EntityDamageByEntityEvent) {
            $damager = $c->getDamager();
            if($damager instanceof Player) {
                $this->base->getPlayerManager()->addKill($damager->getName());
            }

            $this->base->getPlayerManager()->addDeath($p->getName());
        }
    }
}