<?php

namespace App\Repositories;

use App\Models\LoanDetails;
use App\Repositories\Contracts\LoanDetailsRepositoryInterface;
use Illuminate\Support\Collection;

class LoanDetailsRepository implements LoanDetailsRepositoryInterface
{

    protected $model;
    protected const FIRST_PAYMENT_DATE = 'first_payment_date';
    protected const LAST_PAYMENT_DATE = 'last_payment_date';

    public function __construct(LoanDetails $model)
    {
        $this->model = $model;
    }

    public function getLoanDetails(): Collection
    {
        return  $this->model::all();
    }

    public function firstPaymentDate(): ?String
    {
        return self::FIRST_PAYMENT_DATE;
    }

    public function lastPaymentDate(): ?String
    {
        return self::LAST_PAYMENT_DATE;
    }
}
