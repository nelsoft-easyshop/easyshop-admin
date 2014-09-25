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
     * Retrieves the data from the csv file
     * @return VIEW
     */ 
    public function doUpload()
    {
        $productCSVRepo = App::make('ProductCSVRepository');        
        $excel = App::make('excel');        
        if (Input::hasFile('image')) {
            Input::flash();
            $MIME = array('xlsx', 'xls', 'csv');            
            $files =  Input::file("image");
            foreach($files as $file) {

                    $extension = $file->getClientOriginalExtension();
                    if(!in_array($extension, $MIME)) {

                        $errors = new MessageBag(['noinput' => ['Upload .xlsx, .xls and .csv file types only']]);             
                        return false;

                    }
                    else {
                        $destinationPath = public_path().'/misc/';
                        $filename        = str_random(12) . date("ymdhs") . '_' . $file->getClientOriginalName();
                        $uploadSuccess   = $file->move($destinationPath, $filename);                        
                        $reader = $excel->load("./public/misc/$filename"); 
                        $result = $productCSVRepo->checkData($reader->get());

                        $data[]  = $result;
                    }

                    if (File::exists($destinationPath.$filename)) {
                        File::delete($destinationPath.$filename);
                    }
            }

            if($data[0]!= "error") {
                if(!array_key_exists("existing", $data[0])){
                    return Response::json(array('html' => $data));    
                }
                else {
                    return Response::json(array('existing' => $data));  
                }
            }
            else {
                return false;
            }            
        }
        else {
                return false;
        } 
    }

}

