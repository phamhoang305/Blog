<?php
namespace App\Repositories\Quiz;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\Testdetail;

use function GuzzleHttp\json_encode;

class ExportImport{
    public function export($request)
    {
        $styleHeaderDate = array('alignment' => array(
            'vertical' =>Alignment::VERTICAL_CENTER,
            'horizontal' =>Alignment::HORIZONTAL_CENTER,
            'font' => [
                'bold' => true,
                'size' =>50
            ],
        ));
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getColumnDimension('A')->setWidth(25);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(25.5);
        $sheet->getColumnDimension('E')->setWidth(25.5);
        $sheet->getColumnDimension('F')->setWidth(25.5);
        $sheet->getColumnDimension('G')->setWidth(25.5);
        $sheet->getColumnDimension('H')->setWidth(25.5);
        $row = 1;
        $sheet->setCellValue("A{$row}", 'Câu hỏi');
        $sheet->getStyle("A{$row}")->getAlignment()->setWrapText(true);
        $sheet->mergeCells("A{$row}:A2");
        $sheet->getStyle("A{$row}:A2")->applyFromArray($styleHeaderDate);
        //////////////////////////////////////////////
        $sheet->setCellValue("B{$row}", 'Mô tả (Nếu có)');
        $sheet->getStyle("B{$row}")->getAlignment()->setWrapText(true);
        $sheet->mergeCells("B{$row}:B2");
        $sheet->getStyle("B{$row}:B2")->applyFromArray($styleHeaderDate);
        ///////////////////////////////////////////////////////////////////
        $sheet->setCellValue("C{$row}", 'Đáp án (Vị trí câu trả lời)');
        $sheet->getStyle("C{$row}")->getAlignment()->setWrapText(true);
        $sheet->mergeCells("C{$row}:C2");
        $sheet->getStyle("C{$row}:C2")->applyFromArray($styleHeaderDate);
        //////////////////////////////////////////////////////////////////
        $sheet->setCellValue("D{$row}", 'Câu trả lời');
        $sheet->getStyle("D{$row}")->getAlignment()->setWrapText(true);
        $sheet->mergeCells("D{$row}:H1");
        $sheet->getStyle("D{$row}:H1")->applyFromArray($styleHeaderDate);
        $text = "C";
        $textABC ="A";
        for($i=0;$i<=3;$i++){
            $text++;
            $sheet->setCellValue("{$text}2", "Câu {$textABC}");
            $textABC++;
        }
        $row+=2;
        $sheet->setCellValue("A{$row}", 'Test câu hỏi');
         $sheet->getStyle("A{$row}")->getAlignment()->setWrapText(true);
        $sheet->setCellValue("B{$row}", 'Test mô tả');
         $sheet->getStyle("B{$row}")->getAlignment()->setWrapText(true);
        $sheet->setCellValue("C{$row}", 1);
         $sheet->getStyle("C{$row}")->getAlignment()->setWrapText(true);
        $sheet->setCellValue("D{$row}", 'Đáp án 1');
         $sheet->getStyle("D{$row}")->getAlignment()->setWrapText(true);
        $sheet->setCellValue("E{$row}", 'Đáp án 2');
        $sheet->getStyle("E{$row}")->getAlignment()->setWrapText(true);
        $sheet->setCellValue("F{$row}", 'Đáp án 3');
         $sheet->getStyle("F{$row}")->getAlignment()->setWrapText(true);
        $sheet->setCellValue("G{$row}", 'Đáp án 4');
        $sheet->getStyle("G{$row}")->getAlignment()->setWrapText(true);
        // for($i=0;$i<=100;$i++){
        //     $row++;
        //     $sheet->getStyle("A{$row}")->getAlignment()->setWrapText(true);
        //     $sheet->getStyle("B{$row}")->getAlignment()->setWrapText(true);
        //     $sheet->getStyle("C{$row}")->getAlignment()->setWrapText(true);
        //     $sheet->getStyle("D{$row}")->getAlignment()->setWrapText(true);
        //     $sheet->getStyle("E{$row}")->getAlignment()->setWrapText(true);
        //     $sheet->getStyle("F{$row}")->getAlignment()->setWrapText(true);
        //     $sheet->getStyle("G{$row}")->getAlignment()->setWrapText(true);
        // }
        $writer = new Xlsx($spreadsheet);
        ob_start();
        $writer->save('php://output');
        $xlsData = ob_get_contents();
        ob_end_clean();
        $response =  array(
            'icon'=>'success',
            'messages'=>'Xuất File Thành  Công',
            'file' => "data:application/vnd.ms-excel;base64," . base64_encode($xlsData),
            'name' => " Nhập câu hỏi.xlsx",
        );
        die(json_encode($response));
    }
    public function import($request)
    {
        $rs = new \stdClass;
        $arrayError = array();
        $data = array();
        if ($request->hasFile('file-excel')) {
            $file = $request->file('file-excel');
            $spreadsheet = IOFactory::load($file);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
            // dd($rows);
            if(count($rows)==1){
                $rs->status="error";
                $rs->msg = "Vui lòng nhập dữ liệu !";
                $rs->errors = [];
            }else{
                for($i=2;$i<=count($rows)-1;$i++){
                    $error = new \stdClass;
                    $item= array();
                    $columns = $rows[$i];
                    $item['uniqid']=uniqid();
                    $item['test_listID']=$request->test_listID;
                    $item['title']=$columns[0];
                    $item['note']=$columns[1];
                    $item['check_uniqid']= $columns[2];
                    $item['item']=[];
                    $check_uniqid = intval($columns[2]);
                    unset($columns[0]);
                    unset($columns[1]);
                    unset($columns[2]);
                    $arrayItem =array();
                    $index = 0;
                    foreach($columns as $column){
                        if($column!=null){
                            $index++;
                            $uniqid = uniqid();
                            if($check_uniqid==$index){
                                $item['check_uniqid']=$uniqid;
                            }
                            $row_item = new \stdClass;
                            $row_item->uniqid =$uniqid;
                            $row_item->name = $column;
                            $arrayItem[]=($row_item);
                        }

                    }
                    $checkTitle = Testdetail::where('title','=',$item['title'])->where('test_listID','=',$request->test_listID)->count();
                    if($checkTitle>0){
                        $error->msg="Câu => {$item['title']} => Đã tồn tại";
                        $error->row =$i+1;
                        $arrayError[]=$error;
                        // break;
                    }else{
                        $item['item']=($arrayItem);
                        if($item['title']==null){
                            $error->msg="Vui lòng nhập tiêu đề !";
                            $error->row =$i+1;
                            $arrayError[]=$error;
                        }
                        if(count($item['item'])<2){
                            $error->msg="Vui lòng nhập ít nhất 2 câu trả lời !";
                            $error->row =$i+1;
                            $arrayError[]=$error;
                        }
                        if($item['check_uniqid']==null){
                            $error->msg=" Vui lòng nhập đáp án đúng cho câu hỏi !";
                            $error->row =$i+1;
                            $arrayError[]=$error;
                        }
                        $item['created_at']=date('Y-m-d h:s:i');
                        $item['item']=json_encode($arrayItem);
                        $data[]=$item;
                    }

                }
            }
        }
        // dd($data);
        if(count($arrayError)>0){
             $rs->status="error";
             $rs->msg = "Đã xảy ra lỗi khi nhập dữ liệu";
             $rs->errors = $arrayError;
        }else{
            $Testdetail = Testdetail::insert($data);
            if($Testdetail){
                $rs->status="success";
                $rs->msg = "Nhập thành công !";
                $rs->errors = $arrayError;
            }else{
                $rs->status="success";
                $rs->msg = "Nhập không thành công !";
                $rs->errors = $arrayError;
            }
        }
        return $rs;
    }
}
