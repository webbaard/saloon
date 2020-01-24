<?php

declare(strict_types=1);


namespace Webbaard\Saloon\Domain\Tab;


use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;
use Webbaard\Saloon\Domain\Tab\Event\TabIsOpened;
use Webbaard\Saloon\Domain\Tab\ValueObject\CustomerName;
use Webbaard\Saloon\Domain\Tab\ValueObject\OpenedOn;
use Webbaard\Saloon\Domain\Tab\ValueObject\TabId;

final class Tab extends AggregateRoot
{
    private TabId $tabId;
    private CustomerName $customerName;
    private OpenedOn $openedOn;

    static function forCustomer(CustomerName $customerName): self
    {
        $self = new self();
        $self->tabId = TabId::new();
        $self->recordThat(TabIsOpened::forCustomer($self->tabId, $customerName));
        return $self;
    }

    protected function aggregateId(): string
    {
        return $this->tabId->toString();
    }

    private function whenTabIsOpened(TabIsOpened $event): void
    {
        $this->tabId = $event->id();
        $this->customerName = $event->customerName();
        $this->openedOn = $event->openedOn();
    }

    protected function apply(AggregateChanged $event): void
    {
        switch (true) {
            case $event instanceof TabIsOpened:
                $this->whenTabIsOpened($event);
        }
    }

    public function payload(): array
    {
        return [
          'id' => $this->tabId->toString(),
          'customerName' => $this->customerName->toString(),
          'openedOn' => $this->openedOn->toString()
        ];
    }
}