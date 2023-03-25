<?php declare(strict_types=1);

class Card
{
    protected int $ID;
    protected string $type;
    protected string $description;
    protected ?string $imageLink;
    protected string $updated_at;
    protected bool $deleted;

    public function getID(): int
    {
        return $this->ID;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}