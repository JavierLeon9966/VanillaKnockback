<?php

declare(strict_types = 1);

namespace JavierLeon9966\BetterKnockback;

use pocketmine\plugin\PluginBase;
use pocketmine\event\entity\{EntityDamageByEntityEvent, EntityDamageByChildEntityEvent};
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener{
	public function onEnable(): void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	/**
	 * @priority HIGHEST
	 */
	public function onEntityDamageEventByEntity(EntityDamageByEntityEvent $event): void{
		$damager = $event->getDamager();
		if(!$event instanceof EntityDamageByChildEntityEvent and $damager->isSprinting()){
			$event->setKnockback(1.3*$event->getKnockback());
			$damager->setSprinting(false);
		}
	}
}
