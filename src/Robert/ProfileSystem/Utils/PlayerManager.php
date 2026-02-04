<?php
namespace Robert\ProfileSystem\Utils;
use pocketmine\utils\Config;
use Robert\ProfileSystem\Main;

class PlayerManager {
    /** @var Main $base*/
    private $base;
    public function __construct(Main $base)
    {
        $this->base = $base;
    }
    public function getKills(string $name) : int {
        $config = $this->base->getPlayerConfig($name);
        return $config->getNested("kills");
    }
    public function getWins(string $name) : int {
        $config = $this->base->getPlayerConfig($name);
        return $config->getNested("wins");
    }
    public function getDeaths(string $name) : int {
        $config = $this->base->getPlayerConfig($name);
        return $config->getNested("deaths");
    }

    public function addKill(string $name, int $amount = 1) {
        $config = $this->base->getPlayerConfig($name);
        $config->setNested("kills", $amount);
        $config->save();
    }

    public function addWin(string $name, int $amount = 1) {
        $config = $this->base->getPlayerConfig($name);
        $config->setNested("wins", $amount);
        $config->save();
    }

    public function addDeath(string $name, int $amount = 1) {
        $config = $this->base->getPlayerConfig($name);
        $config->setNested("deaths", $amount);
        $config->save();
    }
}