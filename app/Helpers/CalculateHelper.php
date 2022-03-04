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

        foreach ($list as $opr) {

            if ($opr['operation'] == 'withdraw') {

                if ($opr['type'] == 'private') {

                    $week = date("W", strtotime($opr['date']));
                    $commissionData['commission'] = 0;

                    if (isset($userStack[$opr['user_id']])) {

                        $operationCounter = $userStack[$opr['user_id']]['counter']++;

                        $newAmount = $userStack[$opr['user_id']]['amount'] + $opr['amount'];

                        if ($week == $userStack[$opr['user_id']]['week']) {

                            if ($userStack[$opr['user_id']]['flag']) {



                                if ($userStack[$opr['user_id']]['counter'] > $maxWithdraw) {

                                    $commissionData['commission'] = $opr['amount'] * ($commissionPercent / 100);
                                    $userStack[$opr['user_id']] = ['amount' => $newAmount, 'week' => $week, 'counter' => $operationCounter, 'flag' => 0];
                                } else {
                                    if (($newAmount - $maxWithdrawAmount) > 0) {

                                        $commissionData['commission'] = ($newAmount - $maxWithdrawAmount) * ($commissionPercent / 100);
                                        $userStack[$opr['user_id']] = ['amount' => $newAmount, 'week' => $week, 'counter' => $operationCounter, 'flag' => 0];
                                    } else {
                                        $userStack[$opr['user_id']]['amount'] = $newAmount;
                                        $userStack[$opr['user_id']]['counter'] = $operationCounter;
                                    }
                                }
                            } else {

                                $commissionData['commission'] = $opr['amount'] * ($commissionPercent / 100);
                            }
                        } else {

                            if ($opr['amount'] > $maxWithdrawAmount) {

                                $commissionData['commission'] = ($opr['amount'] - $maxWithdrawAmount) * ($commissionPercent / 100);
                                $userStack[$opr['user_id']] = ['amount' => $newAmount, 'week' => $week, 'counter' => $operationCounter, 'flag' => 0];
                            } else {

                                $userStack[$opr['user_id']] = ['amount' => $opr['amount'], 'week' => $week, 'counter' => 1, 'flag' => 1];
                            }
                        }
                    } else {

                        $userStack[$opr['user_id']] = ['amount' => $opr['amount'], 'week' => $week, 'counter' => 1, 'flag' => 1];
                    }

                    $commissionData['amount'] = $opr['amount'];
                    $commissionData['charge'] = 0;
                } else {

                    $commissionData['amount'] = $opr['amount'];
                    $commissionData['commission'] = $opr['amount'] * ($businessCommissionPercent / 100);
                    $commissionData['charge'] = 0;
                }
            } else {

                $commissionData['amount'] = $opr['amount'];
                $commissionData['commission'] = 0;
                $commissionData['charge'] = $opr['amount'] * ($chargePercent / 100);
            }

            $commissionData['user_id'] = $opr['user_id'];
            $commissionData['type'] = $opr['type'];
            $commissionData['operation'] = $opr['operation'];
            $commissionData['date'] = $opr['date'];
            array_push($calculatedData, $commissionData);
        }

        return $calculatedData;
    }
}
