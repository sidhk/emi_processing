<?php

namespace App\Services;

use App\Repositories\Contracts\LoanDetailsRepositoryInterface;
use App\Repositories\Contracts\EMIDetailsRepositoryInterface;

class LoanService
{

    protected $loanRepositoryInterface;
    protected $emiRepositoryInterface;


    public function __construct(LoanDetailsRepositoryInterface $loanRepositoryInterface, EMIDetailsRepositoryInterface $emiRepositoryInterface)
    {
        $this->loanRepositoryInterface = $loanRepositoryInterface;
        $this->emiRepositoryInterface = $emiRepositoryInterface;
    }

    public function getAllLoanDetails()
    {
        return $this->loanRepositoryInterface->getLoanDetails();
    }

    public function getProcessedLoanData()
    {
        $loanDetails = $this->loanRepositoryInterface->getLoanDetails();
        $minDate = $loanDetails->min($this->loanRepositoryInterface->firstPaymentDate());
        $maxDate = $loanDetails->max($this->loanRepositoryInterface->lastPaymentDate());

        $start = new \DateTime($minDate);
        $end = new \DateTime($maxDate);
        $interval = new \DateInterval('P1M');
        $dateRange = new \DatePeriod($start, $interval, $end);

        $columns = [];
        foreach ($dateRange as $date) {
            $columns[] = $date->format('Y_M');
        }

        $this->emiRepositoryInterface->createTable($columns);
        foreach ($loanDetails as $loan) {
            $emiAmount = round($loan->loan_amount / $loan->num_of_payment, 2);
            $remainingAmount = $loan->loan_amount;
            $emiData = ['Clientid' => $loan->clientid];
            $firstPaymentDate = new \DateTime($loan->first_payment_date);
            $lastPaymentDate = new \DateTime($loan->last_payment_date);
            foreach ($columns as $column) {
                $columnDate = \DateTime::createFromFormat('Y_M', $column);
                $firstPaymentYearMonth = $firstPaymentDate->format('Y-m');
                $lastPaymentYearMonth = $lastPaymentDate->format('Y-m');
                $columnYearMonth = $columnDate->format('Y-m');

                if ($columnYearMonth >= $firstPaymentYearMonth && $columnYearMonth <= $lastPaymentYearMonth) {
                    if ($remainingAmount > $emiAmount) {
                        $emiData[$column] = round($emiAmount, 2);
                        $remainingAmount -= $emiAmount;
                    } else {
                        $emiData[$column] = round($remainingAmount, 2);;
                        $remainingAmount = 0.00;
                    }
                    $lastMonth = $column;
                } else {
                    $emiData[$column] = 0.00;
                }
            }
            if ($remainingAmount != 0 && $lastMonth) {
                $emiData[$lastMonth] = round($emiData[$lastMonth] + $remainingAmount, 2);
            }
            $newResultSet[] = $emiData;
        }
        $this->emiRepositoryInterface->insertEMIDetails($newResultSet);
        $emiColumnsNData = $this->emiRepositoryInterface->getEmiColumnsNData();

        return [
            'columns' => $emiColumnsNData['columns'],
            'data' => $emiColumnsNData['data']
        ];
    }
}
