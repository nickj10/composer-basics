<?php

declare(strict_types=1);

namespace SallePW\Model;

final class User
{

    public function __construct(private int $id, private string $name)
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function name()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }
}