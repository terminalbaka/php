<?php
namespace TerminalBaka\Trait;

trait Helper
{
    public final function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}