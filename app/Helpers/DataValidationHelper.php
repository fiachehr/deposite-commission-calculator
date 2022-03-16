<?php

namespace App\Helpers;

class DataValidationHelper
{

    /**
     * Data Validation
     *
     * @param array $row
     * @return boolean
     */

    public static function validation(array $row)
    {
        $path = public_path('currency-exchange-rates.json');
        $currencies = json_decode(file_get_contents($path), true)['rates'];
        $operationType = ['deposit', 'withdraw'];
        $userType = ['private', 'business'];
        if(in_array($row['type'],$userType) && in_array($row['operation'],$operationType) && $row['amount'] > 0 && isset($currencies[$row['currency']])) return true;
        return false;

    }


}

