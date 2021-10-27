<?php

namespace App\Http\Controllers;

use App\Models\Agriculcultural;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class UpdatePriceController extends Controller
{
    public function uploadFileCSV(Request $request)
    {
        try {
            if ($request->hasFile('csv_file')) {
                $file = $request->file('csv_file');
                $type = File::mimeType($file);
                if ($type == 'application/csv') {
                    $filePath = $file->move('data', 'file_update_price.csv');
                    $format_file_csv = ['name', 'kind', 'price', 'province', 'date'];
                    $array = $this->readCSV($filePath);
                    if ($format_file_csv == $array[0]) {
                        for ($i = 1; $i < count($array); $i++) {
                            $dataExist = Agriculcultural::where('name', $array[$i][0])
                                ->where('province', $array[$i][3])
                                ->where('date', $array[$i][4])->get();
                            if (count($dataExist) == 0) {
                                $item = new Agriculcultural([
                                    'name' => $array[$i][0],
                                    'kind' => $array[$i][1],
                                    'price' => $array[$i][2],
                                    'province' => $array[$i][3],
                                    'date' => $array[$i][4],
                                ]);
                                $item->save();
                            }
                           
                        }
                    } else return 'File không đúng định dạng';
                    return redirect('dashboard')->with(['content'=>'Cập nhật thành công']);
                } else return 'File không đúng định dạng';
            } else {
                return 'File không tồn tại.';   
            }
        } catch (Exception $e) {
            Log::debug($e);
            return 'File không tồn tại.';
        }
    }
    public function readCSV($csvFile)
    {
        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 0, ',');
        }
        fclose($file_handle);
        return $line_of_text;
    }
}
