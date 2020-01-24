<?php

declare(strict_types=1);


namespace Webbaard\Saloon\Domain\Tab\ValueObject;


final class CustomerName
{
    private string $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function fromString(string $name): self
    {
        return new self($name);
    }

    public function toString(): string
    {
        return $this->name;
    }
}