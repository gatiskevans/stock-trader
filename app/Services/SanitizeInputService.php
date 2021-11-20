<?php

namespace App\Services;

use Illuminate\Support\Str;

class SanitizeInputService
{
    public function execute(string $query): string
    {
        return Str::snake(strtolower($query));
    }
}
