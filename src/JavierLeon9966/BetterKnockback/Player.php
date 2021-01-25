<?php
declare(strict_types = 1);
namespace JavierLeon9966\BetterKnockback;
use pocketmine\Player as PMPlayer;
use pocketmine\entity\{Entity, Attribute};
class Player extends PMPlayer{
	public function knockBack(Entity $attacker, float $damage, float $x, float $z, float $base = 0.4): void{
		$f = sqrt($x * $x + $z * $z);
		if($f <= 0){
			return;
		}
		if(mt_rand() / mt_getrandmax() > $this->getAttributeMap()->getAttribute(Attribute::KNOCKBACK_RESISTANCE)->getValue()){
			$f = 1 / $f;

			$motion = clone $this->motion;

			$motion->x /= 2;
			$motion->y /= 2;
			$motion->z /= 2;
			$motion->x += $x * $f * $base;
			$motion->y += $base;
			$motion->z += $z * $f * $base;

			if($motion->y > 0.4){
				$motion->y = 0.4;
			}

			$this->setMotion($motion);
		}
	}
}
