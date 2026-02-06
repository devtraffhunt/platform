<?php

namespace App\DTO\Games;

use App\DTO\BaseDTO;

class GameShowDTO extends BaseDTO
{
    public function __construct(
        public string $game_key,
        public ?string $type = null,
    ) {
        $this->normalizeType();
    }

    public static function rules(): array
    {
        return [
            'game_key' => [
                'required',
                'string',
                'regex:/^[a-zA-Z0-9_-]+$/',
            ],
            'type' => [
                'nullable',
                'string',
            ],
        ];
    }

    protected function normalizeType(): void
    {
        $normalized = strtolower((string) $this->type);

        $this->type = in_array($normalized, ['real', 'demo'], true)
            ? $normalized
            : 'real'; // по дефолту всегда 'real'
    }
}
