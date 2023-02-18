<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Glasse;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use DB;
class GlassController extends Controller
{
    public function index()
    {
        // $data = Glasse::all();
        return view('welcome');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'import_excel' => 'required|file|mimes:xls,xlsx,csv',
        ]);
        $the_file = $request->file('import_excel');

        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $row_limit = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range = range(2, $row_limit);
            $column_range = range('C', $column_limit);

            $data = [];

            foreach ($row_range as $row) {
                $data[] = [
                    'model' => $sheet->getCell('A' . $row)->getValue(),
                    'quantity' => $sheet->getCell('B' . $row)->getValue(),
                    'rwd_order' => $sheet->getCell('C' . $row)->getValue(),
                ];
            }

            DB::table('ip_casses')->insert($data);
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];

            return back()->withErrors('There was a problem importing the file!');
        }

        return back()->withSuccess('File has been successfully imported.');
    }
}
