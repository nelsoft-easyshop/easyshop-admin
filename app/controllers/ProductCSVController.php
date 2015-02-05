<?php
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Facades\Excel;
use Easyshop\Services\ProductCSVService as ProductCSVService;

class ProductCSVController extends BaseController
{
    /**
     *  Constructor declaration for ProductCSVService  
     */
    protected $ProductCSVService;

    public function __construct(ProductCSVService $ProductCSVService) 
    {   
        $this->ProductCSVService = $ProductCSVService;
    }
    /**
     * Render CSV Upload interface
     * @return VIEW
     */    
    public function showCSVupload()
    {
        $productCSVRepo = App::make('AdminImagesRepository');   
        return View::make("pages.productcsv")
                ->with("easyShopLink",\Config::get('easyshop/webservice.easyShopLink'))
                ->with("productCSVwebservice",\Config::get('easyshop/webservice.productCSVwebservice'))
                ->with("adminImages",$productCSVRepo->getAllAdminImages());
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
        $productCSVRepo = App::make('ProductRepository');        
        $excel = App::make('excel');
        $data = [];
        foreach($files as $file) {

            $product = $excel->selectSheets("Products")->load("./public/misc/$file"); 
            $attributes = $excel->selectSheets("Attributes")->load("./public/misc/$file"); 
            $shipments = $excel->selectSheets("Shipment")->load("./public/misc/$file"); 
            $images = $excel->selectSheets("Images")->load("./public/misc/$file"); 

            $productsObject = $product->get();
            $optionalAttributesObject = $attributes->get();
            $shipmentObject = $shipments->get();
            $imagesObject = $images->ignoreEmpty()->get();

            if(count($productsObject) > 0
               && count($optionalAttributesObject) > 0
               && count($shipmentObject) > 0
               && count($imagesObject) > 0) {
               $data[] =  $this->ProductCSVService->insertData($productsObject, 
                                                               $optionalAttributesObject, 
                                                               $shipmentObject, 
                                                               $imagesObject);
                if (File::exists($destinationPath.$file)) {
                    File::delete($destinationPath.$file);
                }
            }
            else {
                continue;
            }
        }
        
        if( !isset($data[0]["dataNotFound"]) && !isset($data[0]["databaseError"]) ) {
            return Response::json(['html' => $data]);            
        }
        else {
            if(isset($data[0]["partialProductIds"]) && count($data[0]["partialProductIds"]) > 0) {
                $this->ProductCSVService->removeErrorData($data[0]["partialProductIds"]);
            }
            return Response::json(['error' => $data]);
        }
    }
}

