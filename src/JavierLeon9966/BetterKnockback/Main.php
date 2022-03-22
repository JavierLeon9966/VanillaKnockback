<?php

declare(strict_types = 1);

namespace JavierLeon9966\BetterKnockback;

use pocketmine\plugin\PluginBase;
use pocketmine\event\entity\{EntityDamageByEntityEvent, EntityDamageByChildEntityEvent};
use pocketmine\event\player\PlayerCreationEvent;
use pocketmine\event\Listener;
use pocketmine\Player;

use JavierLeon9966\BetterKnockback\Player as ModPlayer;

class Main extends PluginBase implements Listener{
	public function onEnable(): void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	/**
	 * @priority MONITOR
	 * @ignoreCancelled true
	 */
	public function onEntityDamageEventByEntity(EntityDamageByEntityEvent $event): void{
		$damager = $event->getDamager();
		if(!$event instanceof EntityDamageByChildEntityEvent and $damager->isSprinting()){
			$event->setKnockback(1.3*$event->getKnockback());
			if($damager instanceof Player){
				$damager->toggleSprint(false);
			}else{
				$damager->setSprinting(false);
			}
		}
	}

	/**
	 * @priority MONITOR
	 */
	public function onPlayerCreation(PlayerCreationEvent $event): void{
		$event->setPlayerClass(ModPlayer::class);
	}
}
