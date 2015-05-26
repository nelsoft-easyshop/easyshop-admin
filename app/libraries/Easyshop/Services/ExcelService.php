<?php namespace Easyshop\Services;

use Maatwebsite\Excel\Facades\Excel;

class ExcelService
{
    const TRANSACTIONS_DONWLOAD_LIMIT = 450; 

    /**
     * Transfer record from html file to excel file
     *
     * @param string $filename
     * @param Order[] $transactionRecord
     * export excel file
     */
    public function transactionRecord($filename, $transactionRecord)
    {
        Excel::create($filename, function($excel) use($transactionRecord) {

            $excel->sheet('Active sheet', function($sheet) use($transactionRecord) {

                $sheet->cells('A1:Z1', function($cells) {
                    $cells->setBackground('#f48000');
                    $cells->setFontColor('#ffffff');
                    $cells->setAlignment('center');
                    $cells->setBorder('thin', 'none', 'none', 'none');
                });

                $sheet->cells('A2:Z2', function($cells) {
                    $cells->setBorder('thin', 'none', 'none', 'none');
                });
                foreach($transactionRecord as $key => $record){
                    $orderID = $record['Order_ID'];
                    $preOrderID = ($key == 0) ? 0 : $transactionRecord[$key - 1]['Order_ID'];

                    if($orderID == $preOrderID){
                        $sheet->mergeCells('A' . ($key + 1) . ':' . 'A' . ($key + 2));
                        $sheet->cells('A' . ($key + 1) . ':' . 'Z' . ($key + 2), function($cells) {
                            $cells->setBackground('#E4E4E4');
                        });
                    }

                }

                $sheet->loadView('excel.transactionrecord')->with('transactionRecord', $transactionRecord);
            });
        })->download();
    }
}
