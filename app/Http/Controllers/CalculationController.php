<?php

namespace App\Http\Controllers;

use App\Exports\ResultExport;
use App\Helpers\CalculateHelper;
use App\Helpers\DataGeneratorHelper;
use App\Helpers\CSVParserHelper;
use App\Http\Requests\CalculateRequest;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class CalculationController extends Controller
{

    /**
     * Display a calculate form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function calculate(CalculateRequest $request)
    {
        $input = $request->all();

        switch ($input['data']) {
            case 'd':
                $data = DataGeneratorHelper::generateRandomData($input['countData']);
                break;
            case 's':
                $data = DataGeneratorHelper::generateStaticData();
                break;
            default:
                $data = CSVParserHelper::parser($input['file']->getPathName());
                break;
        }

        $result = CalculateHelper::calculate($data,$input['privateWithdrawCommission'],$input['businessWithdrawCommission'],$input['depositCharge'],$input['freeWithdrawLimit'],$input['freeWithdrawAmountLimit']);

        switch ($input['export']) {
            case 'p':
                $pdf = PDF::loadView('pdf', compact('result'));
                return $pdf->download('report.pdf');
                break;
            case 'e':
                return Excel::download(new ResultExport($result), 'report.xlsx');
                break;
            default:
                return view('report',compact('result'));
                break;
        }

    }


}
