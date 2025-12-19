<?php

declare(strict_types = 1);

namespace Mecene\Modules\Identity\DTOs;

final class RegistrationObject
{
    /**
     * Summary of __construct
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(
        public string $name,
        public string $email,
        #[\SensitiveParameter]
        public string $password
    )
    {
      
    }

    /**
     * Summary of toArray
     * @return array{email: string, name: string, password: string}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}