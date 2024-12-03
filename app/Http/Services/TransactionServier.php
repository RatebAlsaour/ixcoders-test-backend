<?php


namespace App\Http\Services;

use Illuminate\Support\Facades\DB;


class TransactionServier
{

        public static function performTransaction(callable $callback)
        {
            return DB::transaction(function (...$argc) use ($callback) {
                try {
                    $result = $callback($argc);
                } catch (\Exception $e) {

                    DB::rollBack();

                    throw $e;
                }

                return $result;
            });
        }




}
