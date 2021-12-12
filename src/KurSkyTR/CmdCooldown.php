<?php

namespace KurSkyTR;

use pocketmine\{
    plugin\PluginBase,
    event\Listener,
    event\player\PlayerCommandPreprocessEvent,
    event\player\PlayerJoinEvent,
    event\player\PlayerQuitEvent,
    Player
};

class CmdCooldown extends PluginBase implements Listener
{
    
    public static $players = [];
    
    public function onEnable(): void
    {
        $this->getLogger()->info("Eklenti aktif");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    public function onJoin(PlayerJoinEvent $event)
    {
        self::$players[$event->getPlayer()->getName()] = time();
    }
    
    public function onQuit(PlayerQuitEvent $event)
    {
        if (isset(self::$players[$event->getPlayer()->getName()])) unset(self::$players[$event->getPlayer()->getName()]);
    }
    
    public function onCommandPre(PlayerCommandPreprocessEvent $event)
    {
        $e = $event->getPlayer();
        $str = str_split($event->getMessage());
        if ($str[0] == "/" or $str[0] == "./")
        {
            if (time() >= self::$players[$e->getName()])
            {
                self::$players[$e->getName()] = time() + 4;
            }else{
                $e->sendMessage("§cTekrar komut kullanman için §4" . self::$players[$e->getName()] - time() . " §csaniye beklemen gerek.");
                $event->setCancelled(true);
                return false;
            }
        }
    }
}
