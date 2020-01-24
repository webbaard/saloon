<?php

declare(strict_types=1);


namespace Webbaard\Saloon\Domain\Tab\Event;


use Prooph\EventSourcing\AggregateChanged;
use Webbaard\Saloon\Domain\Tab\ValueObject\CustomerName;
use Webbaard\Saloon\Domain\Tab\ValueObject\OpenedOn;
use Webbaard\Saloon\Domain\Tab\ValueObject\TabId;

final class TabIsOpened extends AggregateChanged
{
    public static function forCustomer(TabId $tabId, CustomerName $customerName)
    {
        return self::occur($tabId->toString(), [
            'customerName' => $customerName->toString()
        ]);
    }

    public function id(): TabId
    {
        return TabId::fromString($this->aggregateId());
    }

    public function customerName(): CustomerName
    {
        return CustomerName::fromString($this->payload['customerName']);
    }

    public function openedOn(): OpenedOn
    {
        return OpenedOn::fromDateTime($this->createdAt);
    }
}