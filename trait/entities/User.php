<?php

namespace TerminalBaka\Entity;

use Ramsey\Uuid\Nonstandard\Uuid;
use TerminalBaka\Trait\Helper;

class User
{
    use Helper;

    private $id;

    private string $name;

    private string $email;

    public function __construct(string $name, string $email)
    {
        if (!$this->validateEmail($email)) {
            throw new \InvalidArgumentException('Invalid email');
        }
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->email = $email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        if (!$this->validateEmail($email)) {
            throw new \InvalidArgumentException('Invalid email');
        }
        $this->email = $email;
    }
}
