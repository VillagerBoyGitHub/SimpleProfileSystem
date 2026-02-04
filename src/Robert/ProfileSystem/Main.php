<?php
namespace Robert\ProfileSystem;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use Robert\ProfileSystem\Commands\{ KillsCommand, DeathsCommand, WinsCommand, ProfileCommand };
use Robert\ProfileSystem\Events\EventListener;
use Robert\ProfileSystem\Utils\PlayerManager;
class Main extends PluginBase {
    /** @var string */
    private $playerFolder;
    /** @var PlayerManager */
    private $playerManager;
    public function onEnable()
    {
        $this->getLogger()->info("ProfileSystem is enabling...");
        $this->playerFolder = $this->getDataFolder() . "players/";
        $this->playerManager = new PlayerManager($this);
        if(!is_dir($this->getDataFolder()) || !is_dir($this->playerFolder)) {
            $this->getLogger()->info("Creating directories...");
            @mkdir($this->getDataFolder() . "players/", 0755, true);
        }

        $this->getLogger()->info("Registering events...");
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);

        $this->getLogger()->info("Done! Registering commands...");
        $this->getServer()->getCommandMap()->register("", new KillsCommand($this));
        $this->getServer()->getCommandMap()->register("", new DeathsCommand($this));
        $this->getServer()->getCommandMap()->register("", new WinsCommand($this));
        $this->getServer()->getCommandMap()->register("", new ProfileCommand($this));
        
        $this->getLogger()->info("Done! ProfileSystem enabled.");
    }

    public function onDisable()
    {
        $this->getLogger()->info("ProfileSystem disabled.");
    }

    public function getPlayerFolder() : string{
        return $this->playerFolder;
    }

    public function isPlayerRegistered(string $name) : bool {
        return file_exists($this->getPlayerFolder() . $name . ".yml");
    }

    public function registerPlayer(string $name) {
        if($this->isPlayerRegistered($name)) {
            return;
        }

        $config = new Config($this->getPlayerFolder() . $name . ".yml", Config::YAML, [
            "kills" => 0,
            "deaths" => 0,
            "wins" => 0,
        ]);
    }

    public function getPlayerConfig(string $name) : Config {
        if(!$this->isPlayerRegistered($name)) {
            $this->getLogger()->warning($name . " has not been registered. Registering player...");
            $this->registerPlayer($name);
        }
        $config = new Config($this->getPlayerFolder() . $name . ".yml");
        return $config;
    }

    public function getPlayerManager() : PlayerManager {
        return $this->playerManager;
    }
}