<?php

use Illuminate\Support\MessageBag;
use Easyshop\Services\Validation\Laravel\RaffleValidator;
use Maatwebsite\Excel\Facades\Excel;
use Easyshop\Services\RaffleManagerService as RaffleManagerService;

class RaffleManagerController extends BaseController
{

    /**
     *  Constructor declaration for RaffleManagerService  
     *
     *  
     */
    protected $RaffleManagerService;

    public function __construct(RaffleManagerService $RaffleManagerService) 
    {   
        $this->RaffleManagerService = $RaffleManagerService;
    }


    /** 
     *  Render Add Raffle Console
     *
     */
    public function showRaffle()
    {
        $raffleEntity = App::make('RaffleRepository');        
        return View::make('pages.raffle')
                    ->with("raffles",$raffleEntity->getAllRaffle());    
             
    }

    /**
     * Perform raffle
     *
     * @return JSON
     */
    public function doRaffle()
    {   

        $count = 0;
        $raffleEntity = App::make('RaffleRepository');
        $validator = new RaffleValidator( App::make('validator') );

        $numberOfWinners = Input::get("numberOfWinners");

        if($validator->with(Input::get())->passes()){
            if(Input::get("winnerType") == "upload") {
                if (Input::hasFile('uploadPoolOfWinner')) {

                    $excel = App::make('excel');
                    $file            = Input::file( 'uploadPoolOfWinner');
                    $destinationPath = public_path().'/misc/';
                    $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                    $extension        = str_random(6) . '_' . $file->getClientOriginalExtension();
                    $uploadSuccess   = $file->move($destinationPath, $filename);
                    
                    $reader = $excel->selectSheetsByIndex(0)->load("./public/misc/$filename");                        
                    $data = $reader->noHeading()->get();

                    $userDataCount = count($data);

                    if(Input::get("numberOfWinners") > $userDataCount) {
                        return Response::json(array('errors' => array("userDataCount" => "The number of winners to generate do not match the members in the excel file"))); 
                    }
                    else {
                        $possibleWinnerArr = $this->RaffleManagerService->getPossibleWinners($data);
                    }
                }

            } 
            else {

                $possibleWinnerArr = explode(",", Input::get("poolOfWinner"));
                $userDataCount = count($possibleWinnerArr);
                if(Input::get("numberOfWinners") > $userDataCount) {
                    return Response::json(array('errors' => array("userDataCount" => "The number of winners to generate do not match the members in the excel file"))); 
                }                
            }

                $uniques = $this->RaffleManagerService->getUniqueIndexes($possibleWinnerArr, $userDataCount, $numberOfWinners);

                $winners = implode(",",array_map('trim',$this->RaffleManagerService->getWinnerPools($uniques, $possibleWinnerArr)));
                $members = implode(",", array_map('trim', $possibleWinnerArr));
                $trimmedPrices = implode(",",array_map('trim', explode(",", Input::get("listOfPrices"))));

                $raffleEntity->addRaffle(Input::get('raffleName'),
                                                    $winners, 
                                                    $members,
                                                    $trimmedPrices);
                if($raffleEntity) {                        
                    return Response::json(array('data' => "success"));
                }             
        }
        else {
            return Response::json(array('errors' => $validator->errors())); 
                    
        }
    }    

    /**
     * Render rafflelist
     *
     * @return VIEW
     */
    public function showRaffleList()
    {
        $raffleEntity = App::make('RaffleRepository');        
        return View::make('partials.rafflepartial')
                    ->with("raffles",$raffleEntity->getAllRaffle());    
    }

    /**
     * Delete a Raffle
     *
     * @return VIEW
     */
    public function deleteRaffle()
    {

        $raffleEntity = App::make('RaffleRepository');   
        $isSuccessful =  $raffleEntity->deleteRaffle(Input::get("id"));
        return Response::json(array('data' => "success"));
    }    



}