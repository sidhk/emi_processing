<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface EMIDetailsRepositoryInterface
{
    public function createTable(array $columns): void;
    public function insertEMIDetails(array $emiData): void;
    public function getEmiColumnsNData(): array;
}
