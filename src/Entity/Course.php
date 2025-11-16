<?php
declare(strict_types=1);

namespace App\Entity;

class Course
{
    private string $id;
    private string $name;
    private ?string $description;

    public function __construct(string $id, string $name, ?string $description = null)
    {
        $this->id = $id;
        $this->name = trim($name);
        $this->description = $description;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            (string)($data['id'] ?? ''),
            (string)($data['name'] ?? ''),
            $data['description'] ?? null
        );
    }
}
