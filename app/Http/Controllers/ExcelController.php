<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExcelUploadRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AllDataImport;

class ExcelController extends Controller {
    public function uploadForm() {
        return view('admin.uploadForm');
    }

    public function import(ExcelUploadRequest $request) {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new AllDataImport, $file);

        return redirect()->route('admin.uploadForm')->with('status', 'Data imported successfully.');
    }
}
