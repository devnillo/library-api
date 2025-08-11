<?php

namespace App\DTOs\Auth;

class AuthLoginDTO
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}


    public static function fromArray(array $data): self
    {
        return new self(
            $data['email'],
            $data['password'],
        );
    }

    public  function toArray(): array
    {
        return [
          'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
