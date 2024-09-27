<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface LoanDetailsRepositoryInterface
{

    public function getLoanDetails(): Collection;

    public function firstPaymentDate(): ?String;

    public function lastPaymentDate(): ?String;
}
