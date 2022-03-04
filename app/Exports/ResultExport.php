<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class ResultExport implements FromCollection
{

    protected $result;

    function __construct($result)
    {
        $this->result = $result;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect($this->result);
    }
}
