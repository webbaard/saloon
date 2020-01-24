<?php

declare(strict_types=1);


namespace Webbaard\Saloon\Domain\Tab\ValueObject;


use DateTimeInterface;

final class OpenedOn
{
    private DateTimeInterface $date;

    private function __construct(DateTimeInterface $date)
    {
        $this->date = $date;
    }

    public static function fromDateTime(DateTimeInterface $date): OpenedOn
    {
        return new self($date);
    }

    public function toString()
    {
        return $this->date->format("Y-m-d H:i:s");
    }
}