<?php

namespace App\Helpers;

class CalculateHelper
{

    /**
     * Calculate commission and charge
     *
     * @param array $list
     * @param float $commissionPercent
     * @param float $businessCommissionPercent
     * @param float $chargePercent
     * @param int $maxWithdraw
     * @param int $maxWithdrawAmount
     *
     * @return array $calculatedData
     */

    public static function calculate(array $list, float $commissionPercent = 0.3, float $businessCommissionPercent = 0.5, float $chargePercent = 0.03, int $maxWithdraw = 3, int $maxWithdrawAmount = 1000)
    {

        $calculatedData = [];
        $userStack = [];

        $path = public_path('currency-exchange-rates.json');
        $currencies = json_decode(file_get_contents($path), true)['rates'];

        foreach ($list as $opr) {

            $amount = round($opr['amount'] / $currencies[$opr['currency']],2);

            if ($opr['operation'] == 'withdraw') {

                if ($opr['type'] == 'private') {

                    $week = date("W", strtotime($opr['date']));
                    $commissionData['commission'] = 0;


                    if (isset($userStack[$opr['user_id']])) {

                        $operationCounter = $userStack[$opr['user_id']]['counter']++;

                        $newAmount = $userStack[$opr['user_id']]['amount'] + $amount;


                        if ($week == $userStack[$opr['user_id']]['week']) {

                            if ($userStack[$opr['user_id']]['flag']) {

                                if ($userStack[$opr['user_id']]['counter'] > $maxWithdraw) {

                                    $commissionData['commission'] = round(($amount * ($commissionPercent / 100)) * $currencies[$opr['currency']],2);
                                    $userStack[$opr['user_id']] = ['amount' => $newAmount, 'week' => $week, 'counter' => $operationCounter, 'flag' => 0];
                                } else {
                                    if (($newAmount - $maxWithdrawAmount) > 0) {


                                        $commissionData['commission'] = round((($newAmount - $maxWithdrawAmount) * ($commissionPercent / 100)) * $currencies[$opr['currency']],2);
                                        $userStack[$opr['user_id']] = ['amount' => $newAmount, 'week' => $week, 'counter' => $operationCounter, 'flag' => 0];
                                    } else {
                                        $userStack[$opr['user_id']]['amount'] = $newAmount;
                                        $userStack[$opr['user_id']]['counter'] = $operationCounter;
                                    }
                                }
                            } else {

                                $commissionData['commission'] = round(($amount * ($commissionPercent / 100)) * $currencies[$opr['currency']],2);
                            }
                        } else {

                            if ($amount > $maxWithdrawAmount) {

                                $commissionData['commission'] = round((($amount - $maxWithdrawAmount) * ($commissionPercent / 100)) * $currencies[$opr['currency']],2);
                                $userStack[$opr['user_id']] = ['amount' => $newAmount, 'week' => $week, 'counter' => $operationCounter, 'flag' => 0];
                            } else {

                                $userStack[$opr['user_id']] = ['amount' => $amount, 'week' => $week, 'counter' => 1, 'flag' => 1];
                            }
                        }
                    } else {

                        $userStack[$opr['user_id']] = ['amount' => $amount, 'week' => $week, 'counter' => 1, 'flag' => 1];
                    }

                    $commissionData['amount'] = $amount;
                    $commissionData['charge'] = 0;
                } else {

                    $commissionData['amount'] = $amount;
                    $commissionData['commission'] = round($opr['amount'] * ($businessCommissionPercent / 100),2);
                    $commissionData['charge'] = 0;
                }
            } else {

                $commissionData['amount'] = $amount;
                $commissionData['commission'] = 0;
                $commissionData['charge'] = $opr['amount'] * ($chargePercent / 100);
            }

            $commissionData['user_id'] = $opr['user_id'];
            $commissionData['currentAmount'] = $opr['amount'];
            $commissionData['currencyRate'] = $currencies[$opr['currency']];
            $commissionData['type'] = $opr['type'];
            $commissionData['operation'] = $opr['operation'];
            $commissionData['currency'] = $opr['currency'];
            $commissionData['date'] = $opr['date'];
            array_push($calculatedData, $commissionData);
        }

        return $calculatedData;
    }
}
