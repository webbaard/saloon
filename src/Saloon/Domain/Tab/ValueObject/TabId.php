<?php

declare(strict_types=1);


namespace Webbaard\Saloon\Domain\Tab\ValueObject;


use Ramsey\Uuid\Uuid;

final class TabId
{
    private Uuid $id;

    private function __construct(Uuid $id)
    {
        $this->id = $id;
    }

    public static function new()
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $id)
    {
        return new self(Uuid::fromString($id));
    }

    public function toString(): string
    {
        return $this->id->toString();
    }
}