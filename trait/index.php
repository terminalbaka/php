<?php
use TerminalBaka\Model\User;

require_once __DIR__ . '/vendor/autoload.php';

$user = new User();
$user->addUser('John Doe', 'john.doe@example.com');

if (sizeof($user->listUsers()) !== 1) {
    throw new Exception('Failed to add user');
}

foreach ($user->listUsers() as $key => $user) {
    printf(('Number of user: %d' . PHP_EOL), $key + 1);
    printf("User: %s\n", $user->getName());
    printf("Email: %s\n", $user->getEmail());
    print_r('-------------------------' . PHP_EOL);
}