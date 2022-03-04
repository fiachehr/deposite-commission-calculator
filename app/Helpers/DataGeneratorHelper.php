<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;

class DataGeneratorHelper
{

    /**
     * Generate random data
     *
     * @param int $count
     * @return array list
     */

    public static function generateRandomData(int $count)
    {

        $dummyData = [];
        $sampleCurrency = ['USD', 'TRY', 'EUR', 'IRR', 'JPY', 'UAH'];
        $userType = ['private', 'business'];
        $dateCounter = -1;
        $operationType = ['deposit', 'withdraw'];
        for ($i = 1; $i <= $count; $i++) {
            if ($i % 10 == 0) {
                $dateCounter--;
            }

            $data['date'] = Carbon::today()->addDay($dateCounter)->format("Y-m-d");
            $data['user_id'] = rand(100, 110);
            $data['type'] = $userType[rand(0, 1)];
            $data['operation'] = $operationType[rand(0, 1)];
            $data['amount'] = rand(2, 2000);
            $data['currency'] = $sampleCurrency[rand(0, 5)];
            array_push($dummyData, $data);
        }

        return $dummyData;
    }

    /**
     * Generate static data
     *
     * @return array list
     */

    public static function generateStaticData()
    {

        return [
                    [
                        'date' => '2022-03-01',
                        'user_id' => '1',
                        'type' => 'private',
                        'operation' => 'withdraw',
                        'amount' => 400,
                        'currency' => 'EURO',
                    ],
                    [
                        'date' => '2022-03-01',
                        'user_id' => '1',
                        'type' => 'private',
                        'operation' => 'withdraw',
                        'amount' => 650,
                        'currency' => 'EURO',
                    ],
                    [
                        'date' => '2022-03-03',
                        'user_id' => '1',
                        'type' => 'private',
                        'operation' => 'withdraw',
                        'amount' => 100,
                        'currency' => 'EURO',
                    ],
                    [
                        'date' => '2022-03-10',
                        'user_id' => '1',
                        'type' => 'private',
                        'operation' => 'withdraw',
                        'amount' => 1100,
                        'currency' => 'EURO',
                    ],
                    [
                        'date' => '2022-03-10',
                        'user_id' => '1',
                        'type' => 'private',
                        'operation' => 'withdraw',
                        'amount' => 550,
                        'currency' => 'EURO',
                    ],
                    [
                        'date' => '2022-03-10',
                        'user_id' => '1',
                        'type' => 'private',
                        'operation' => 'withdraw',
                        'amount' => 1200,
                        'currency' => 'EURO',
                    ],
                    [
                        'date' => '2022-03-17',
                        'user_id' => '1',
                        'type' => 'private',
                        'operation' => 'withdraw',
                        'amount' => 100,
                        'currency' => 'EURO',
                    ],
                    [
                        'date' => '2022-03-17',
                        'user_id' => '1',
                        'type' => 'private',
                        'operation' => 'withdraw',
                        'amount' => 100,
                        'currency' => 'EURO',
                    ],
                    [
                        'date' => '2022-03-17',
                        'user_id' => '1',
                        'type' => 'private',
                        'operation' => 'withdraw',
                        'amount' => 900,
                        'currency' => 'EURO',
                    ],
                    [
                        'date' => '2022-03-17',
                        'user_id' => '2',
                        'type' => 'private',
                        'operation' => 'withdraw',
                        'amount' => 105,
                        'currency' => 'EURO',
                    ],
                    [
                        'date' => '2022-03-17',
                        'user_id' => '2',
                        'type' => 'private',
                        'operation' => 'withdraw',
                        'amount' => 900,
                        'currency' => 'EURO',
                    ],
                    [
                        'date' => '2022-03-17',
                        'user_id' => '1',
                        'type' => 'private',
                        'operation' => 'withdraw',
                        'amount' => 750,
                        'currency' => 'EURO',
                    ],
                ];
    }
}
