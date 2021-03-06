<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

declare(strict_types=1);

namespace pocketmine\block;

class RedstoneRail extends BaseRail{
	protected const FLAG_POWERED = 0x08;

	/** @var bool */
	protected $powered = false;

	protected function writeStateToMeta() : int{
		return parent::writeStateToMeta() | ($this->powered ? self::FLAG_POWERED : 0);
	}

	public function readStateFromMeta(int $meta) : void{
		parent::readStateFromMeta($meta);
		$this->powered = ($meta & self::FLAG_POWERED) !== 0;
	}

	protected function getConnectionsFromMeta(int $meta) : array{
		return self::CONNECTIONS[$meta & ~self::FLAG_POWERED] ?? [];
	}
}
