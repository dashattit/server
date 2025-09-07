<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class PasswordValidator extends AbstractValidator
{
    protected string $message = 'Пароль должен быть длиной не менее 8 символов и содержать как минимум одну цифру, одну заглавную и одну строчную букву';

    public function rule(): bool
    {
        $value = $this->value;

        if (strlen($value) < 8) {
            return false;
        }

        if (!preg_match('/\d/', $value)) {
            return false;
        }

        if (!preg_match('/[A-Z]/', $value)) {
            return false;
        }

        if (!preg_match('/[a-z]/', $value)) {
            return false;
        }

        return true;
    }
}