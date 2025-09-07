<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class AvatarValidator extends AbstractValidator
{
    protected string $message = 'Размер аватара должен быть не более 2мб, допустимые форматы: jpg, jpeg, png, gif';

    public function rule(): bool
    {
        $file = $this->value;

        if (empty($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return true;
        }

        if ($file['size'] > 2 * 1024 * 1024) {
            return false;
        }

        $allowedTypes = [
            'image/jpg',
            'image/jpeg',
            'image/png',
            'image/gif'
        ];

        if (!in_array(strtolower($file['type']), $allowedTypes)) {
            return false;
        }

        return true;
    }
}
