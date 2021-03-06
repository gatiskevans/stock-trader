<?php

namespace App\Repositories\StocksRepositories;

use App\Models\Companies\CompanyProfile;
use App\Models\QuoteData;
use App\Models\Stock;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;

interface StocksRepository
{
    public function fetchData(string $query);

    public function companyProfile(string $symbol): CompanyProfile;

    public function quoteData(string $symbol): QuoteData;

    public function getOne(int $userId, string $ticker, float $stockPrice): ?Stock;

    public function save(Authenticatable $user, CompanyProfile $companyProfile, int $amount, int $total, float $stockPrice, ?Stock $stock = null): void;

    public function getCompanies(): array;

    public function getCompaniesByStock(string $stock): Builder;

    public function getOneByStock(int $userId, string $ticker): ?Stock;
}
