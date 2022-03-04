<?php

namespace App\Helpers;

class CSVParserHelper
{

    /**
     * Calculate commission and charge
     *
     * @param string $file
     * @return array data
     */

    public static function parser(string $file, string $delimiter = ',')
    {
        $header = null;
        $data = array();
        if (($handle = fopen($file, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}
