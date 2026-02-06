<?php
namespace App\Services;

use App\Models\Domain;

class DomainService
{
    public function getByDomain(?string $domain): ?Domain
    {
        if (empty($domain)) {
            return null;
        }

        return Domain::where('domain', strtolower(trim($domain)))->first();
    }
}
