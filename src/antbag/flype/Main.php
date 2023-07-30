<?php

declare(strict_types=1);

namespace antbag\flype;

use pocketmine\plugin\PluginBase;
use pocketmime\command\Command;
use pocketmime\command\CommandSender;
use pocketmine\player\Player;

class Main extends PluginBase {
  
  public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
    if(!$sender instanceof Player) {
      $sender->sendMessage("You must be a player to run this command");
      return false;
    }
    
    if($sender->hasPermission("fly.command.use")) {
      $this->toggleFlight($sender);
    }
  }
  
  public static function toggleFlight(Player $player, bool $forceOff = false): void
      {
          if ($forceOff) {
              $player->setAllowFlight(false);
              $player->setFlying(false);
              $player->resetFallDistance(); 
              $player->sendMessage("You can no longer fly.");
          } else {
              if (!$player->getAllowFlight()) {
                  $player->setAllowFlight(true);
                  $player->sendMessage("You can fly now");    
              } else {
                  $player->setAllowFlight(false);
                  $player->setFlying(false);
                  $player->resetFallDistance(); 
                  $player->sendMessage("Fly Disabled");            }
          }
      }
  
}