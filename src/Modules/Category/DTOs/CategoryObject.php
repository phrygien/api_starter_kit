<?php

declare(strict_types = 1);

namespace App\Modules\Category\DTOs;

use App\Enums\Enums\V1\CategoryStatus;

final class CategoryObject
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly ?string $description,
        public readonly ?int $parent_id,
        public readonly CategoryStatus $status
    ){}

    public function fromRequest(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['description'],
            $data['parent_id'],
            status: isset($data['status'])
            ? CategoryStatus::from($data['status'])
            : CategoryStatus::ACTIVE,
        );
    }
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'parent_id' => $this->parent_id,
            'status' => $this->status
        ];
    }
}