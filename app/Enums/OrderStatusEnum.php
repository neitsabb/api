<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
	case PENDING = 'pending';

	case PAID = 'paid';

	case CANCELED = 'canceled';

	public static function labels(string $status)
	{
		return match ($status) {
			self::PENDING->value => 'En attente',
		};
	}
}
