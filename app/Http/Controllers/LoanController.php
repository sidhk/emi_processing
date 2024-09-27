<?php

namespace App\Http\Controllers;

use App\Services\LoanService;

class LoanController extends Controller
{
    protected $loanService;

    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    public function getLoanDetails()
    {
        $loans = $this->loanService->getAllLoanDetails();
        return view('loans.index', compact('loans'));
    }

    public function getProcessPage()
    {
        return view('loans.process');
    }


    public function getProcessedData()
    {
        $processedData = $this->loanService->getProcessedLoanData();
        return $processedData;
    }
}
