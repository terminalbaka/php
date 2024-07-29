<?php

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use TerminalBaka\Model\User;

require_once dirname(__DIR__) . '/vendor/autoload.php';

class UserTest extends TestCase
{
    #[Test]
    public function testCreateUserWithInvalidEmail(): void
    {
        try {
            $user = new User();
            $user->addUser('David', 'teste');
        } catch (InvalidArgumentException $e) {
            $this->assertEquals('Invalid email', $e->getMessage());
            return;
        }
    }

    public function testCreateUserWithEmailAlreadyInUse(): void
    {
        try {
            $user = new User();
            $user->addUser('David', 'david@test.com');
            $user->addUser('David', 'david@test.com');
        } catch (UnexpectedValueException $e) {
            $this->assertEquals('Email already in use', $e->getMessage());
            return;
        }
    }

    public function testCreateSuccessUser(): void
    {
        $user = new User();
        $david = $user->addUser('David', 'david@test.com');
        $this->assertInstanceOf(\TerminalBaka\Entity\User::class, $david);

        $userFind = $user->findUserById($david->getId());
        $this->assertEquals($david->getId(), $userFind->getId());
    }

    public function testUpdateSuccessUser(): void
    {
        $user = new User();
        $david = $user->addUser('David', 'david@test.com');

        $user->updateUser($david->getId(), 'David 2', 'david2@test.com');
        $this->assertEquals('David 2', $david->getName());
        $this->assertEquals('david2@test.com', $david->getEmail());
    }

    public function testDeleteSuccessUser(): void
    {
        $user = new User();
        $david = $user->addUser('David', 'david@test.com');
        $arthur = $user->addUser('Arthur', 'arthur@test.com');

        $retorno = $user->deleteUser($david->getId());
        $this->assertTrue($retorno);
    }
}