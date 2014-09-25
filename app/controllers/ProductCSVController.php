<?php
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Facades\Excel;
use Easyshop\Services\XMLContentGetterService as XMLService;

class ProductCSVController extends BaseController
{
    /**
     *  Constructor declaration for XMLService  
     *
     *  
     */
    protected $XMLService;

    public function __construct(XMLService $XMLService) 
    {   
        $this->XMLService = $XMLService;
    }

    /**
     * Render CSV Upload interface
     * @return VIEW
     */    
    public function showCSVupload()
    {
        return View::make("pages.productcsv")
                ->with("serviceLink",$this->XMLService->GetEasyShopLink());
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
                        return View::make('pages.productcsv')
                            ->withErrors($errors)
                            ->with("serviceLink",$this->XMLService->GetEasyShopLink());

                    }
                    else {
                        $destinationPath = public_path().'/misc/';
                        $filename        = str_random(12) . date("ymdhs") . '_' . $file->getClientOriginalName();
                        $uploadSuccess   = $file->move($destinationPath, $filename);                        
                        $reader = $excel->load("./public/misc/$filename"); 
                        $result = $productCSVRepo->inserData($reader->get());

                        $data[]  = $result;
                          
                    }

                    if (File::exists($destinationPath.$filename)) {
                        File::delete($destinationPath.$filename);
                    }
            }

            if($data[0]!= "error") {

                return Response::json(array('html' => $data));  
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

