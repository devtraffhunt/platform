<?php

namespace App\DTO\Games;

use App\DTO\BaseDTO;

class GamesListDTO extends BaseDTO
{
    public function __construct(
        public ?int $page = 1,
        public ?string $provider_id = '',
        public ?string $search = '',
    ) {}

    public static function rules(): array
    {
        return [
            'page' => ['required', 'integer', 'min:1'],
            'provider_id' => ['nullable', 'string'],
            'search' => ['nullable', 'string'],
        ];
    }
}
