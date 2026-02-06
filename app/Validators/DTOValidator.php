<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DTOValidator
{
    public static function validate(object $dto): void
    {
        $validator = Validator::make(
            (array) $dto,
            method_exists($dto, 'rules') ? $dto->rules() : []
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
