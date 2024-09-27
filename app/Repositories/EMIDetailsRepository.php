<?php

namespace App\Repositories;

use App\Repositories\Contracts\EMIDetailsRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class EMIDetailsRepository implements EMIDetailsRepositoryInterface
{
    protected $tableName = "emi_details";


    public function createTable(array $columns): void
    {
        DB::statement("DROP TABLE IF EXISTS $this->tableName");

        $createTableQuery = "CREATE TABLE $this->tableName (clientid BIGINT, " . implode(' DECIMAL(10,2), ', $columns) . " DECIMAL(10,2))";

        DB::statement($createTableQuery);
    }

    public function insertEMIDetails(array $emiData): void
    {
        DB::table($this->tableName)->insert($emiData);
    }

    public function getEmiColumnsNData(): array
    {
        $emiData = DB::table($this->tableName)->get();

        if (!$emiData->isEmpty()) {
            $emiFirstData = (array) $emiData->first();
            $columns = array_keys($emiFirstData);
        }

        $resultSet = ['columns' => $columns, 'data' => $emiData];
        return $resultSet;
    }
}
