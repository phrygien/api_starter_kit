<?php

declare(strict_types = 1);

namespace Mecene\Modules\Identity\DTOs;

final readonly class LoginObject
{
    public function __construct(public string $email, #[\SensitiveParameter] public string $password){}

    /**
     * Summary of toArray
     * @return array{email: string, password: string}
     */
    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}