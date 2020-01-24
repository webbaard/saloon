<?php

declare(strict_types=1);


namespace Webbaard\Saloon\Domain\Tab\Command;


use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;
use Webbaard\Saloon\Domain\Tab\ValueObject\CustomerName;

final class OpenTab extends Command implements PayloadConstructable
{
    use PayloadTrait;

    public static function forCustomer(string $customerName)
    {
        return new self([
            'customerName' => $customerName
        ]);
    }

    public function customerName(): CustomerName
    {
        return CustomerName::fromString($this->payload['customerName']);
    }
}