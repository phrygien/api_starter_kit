<?php

declare(strict_types = 1);

namespace Mecene\Modules\Identity\DTOs;

final class RegistrationObject
{
    public function __construct(
        public string $name,
        public string $email,
        #[\SensitiveParameter]
        public string $password
    )
    {
      
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}