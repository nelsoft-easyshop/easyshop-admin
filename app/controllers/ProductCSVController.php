<?php
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Facades\Excel;


class ProductCSVController extends BaseController
{

    /**
     * Render CSV Upload interface
     * @return VIEW
     */    
    public function showCSVupload()
    {
        return View::make("pages.productcsv");
    }

    /**
     * Checks if all of the uploaded files satisfies the MIME type (csv/excel)
     * @return JSON
     */ 
    public function doUpload()
    {
        if (Input::hasFile('image')) {
            Input::flash();
            $MIME = array('xlsx', 'xls', 'csv');            
            $files =  Input::file("image");
            foreach($files as $file) {

                    $extension = $file->getClientOriginalExtension();
                    if(!in_array($extension, $MIME)) {
                        $filename        = str_random(12) . date("ymdhs") . '_' . $file->getClientOriginalName(); 
                        return Response::json(array('error' => "Error in CSV")); 
                    }
                    else {
                        $destinationPath = public_path().'/misc/';
                        $filename        = str_random(12) . date("ymdhs") . '_' . $file->getClientOriginalName();
                        $uploadSuccess   = $file->move($destinationPath, $filename);           
                        $test[] = $filename;
                    }

            }
            return $this->insertData($destinationPath, $test);
        }
        else {
            return Response::json(array('error' => "Error in CSV")); 
        } 
    }

    /**
     * Retrieves the data from the csv file
     * @return JSON
     */ 
    public function insertData($destinationPath,$files)
    {
        $productCSVRepo = App::make('ProductCSVRepository');        
        $excel = App::make('excel');           
        foreach($files as $file) {

            $product = $excel->selectSheets("Products")->load("./public/misc/$file"); 
            $attributes = $excel->selectSheets("Attributes")->load("./public/misc/$file"); 
            $shipments = $excel->selectSheets("Shipment")->load("./public/misc/$file"); 

            $productsObject = $product->ignoreEmpty()->get();
            $optionalAttributesObject = $attributes->ignoreEmpty()->get();
            $shipmentObject = $shipments->ignoreEmpty()->get();
            $result = $productCSVRepo->insertData($productsObject, $optionalAttributesObject, $shipmentObject);
            
            $data[]  = $result;
            if (File::exists($destinationPath.$file)) {
                File::delete($destinationPath.$file);
            }                    
        }

        if(!array_search("error", $data)) {
            return Response::json(array('html' => $data));    
        }
        else {
            $productCSVRepo->removeErrorData($productsObject);
            return Response::json(array('error' => "Error in CSV")); 
        }            
        

    }

}

