<?php

namespace TerminalBaka\Model;

use Exception;
use TerminalBaka\Trait\Helper;

class User
{
    use Helper;

    /**
     * @var \TerminalBaka\Entity\User[]
     */
    private array $users = [];

    public function listUsers(): array
    {
        return $this->users;
    }

    function addUser($name, $email): \TerminalBaka\Entity\User
    {
        if (!$this->validateEmail($email)) {
            throw new \InvalidArgumentException('Invalid email');
        }

        if ($this->isEmailAlreadyInUse($email)) {
            throw new \UnexpectedValueException('Email already in use');
        }

        $user = new \TerminalBaka\Entity\User($name, $email);
        $this->users[] = $user;
        return $user;
    }

    function findUserById($id)
    {
        foreach ($this->users as $user) {
            if ($user->getId() === $id) {
                return $user;
            }
        }
        return null;
    }

    function updateUser($id, $name, $email): \TerminalBaka\Entity\User
    {
        foreach ($this->users as &$user) {
            if ($user->getId() === $id) {
                $user->setName($name);
                $user->setEmail($email);
                return $user;
            }
        }
        throw new Exception('User not found');
    }

    function deleteUser($id): bool
    {
        foreach ($this->users as $key => $user) {
            if ($user->getId() === $id) {
                unset($users[$key]);
                $users = array_values($this->users);
                return true;
            }
        }
        return false;
    }

    private function isEmailAlreadyInUse(string $email): bool
    {
        foreach ($this->users as $user) {
            if ($user->getEmail() === $email) return true;
        }
        return false;
    }
}
