<?php

use Easyshop\Services\MessagesService as MessagesService;

class MessageController extends BaseController
{

    /**
     *  Constructor declaration for MessagesService and MessagesRepostory 
     */
    protected $MessagesService;

    public function __construct(MessagesService $MessagesService) 
    {   
        $this->MessagesService = $MessagesService;
        $this->messagesRepository = App::make('MessagesRepository');
    }

    /**
     *  Renders Messages  
     *
     *  @return VIEW
     */
    public function showMessages()
    {
        $partnersIds = $this->MessagesService->getPartnersId();

        foreach ($partnersIds as $ids) {
            $messages[] = $this->messagesRepository->getAllMessages($ids);
        }        

        return View::make('pages.messages') 
                    ->with('list_of_messages',array_flatten($messages));

    }


    /**
     *  Retrieves conversation of a partner and a customer
     *
     *  @return json
     */
    public function getConversation()
    {
        $messages = $this->messagesRepository->getConversation(Input::get("to_id"),Input::get("from_id"));
        $partnersIds = $this->MessagesService->getPartnersId();

        $html =  View::make('partials.messagespartial')
                    ->with('data',$messages)
                    ->with('partnerIds',$partnersIds)
                    ->with('posted',Input::all())                    
                    ->render();

        return Response::json(array('html' => $html));   
    } 

    /**
     *  Returns messages for the partial views
     *
     *  @return json
     */
    public function getAllMessages()
    {
        $partnersIds = $this->MessagesService->getPartnersId();

        foreach ($partnersIds as $ids) {
            $messages[] = $this->messagesRepository->getAllMessages($ids);
        }        
        $html = View::make('partials.messageslistpartial')
                    ->with('list_of_messages',array_flatten($messages))
                    ->render();

        return Response::json(array('html' => $html));                       

    }    

    /**
     *  Insert messages to the database
     *
     *  @return json
     */
    public function sendMessage()
    {
        if(Input::has("message")) {
            $this->messagesRepository->insertMessages(Input::get('to_id'),
                Input::get('from_id'), htmlspecialchars(Input::get('message')));  
        }

        return Response::json(array('success' => 'success'));                                           
    }                    

    /**
     *  Refresh conversation
     *
     *  @return json
     */
    public function refreshConversation($toid, $fromid)
    {
        $messages = $this->messagesRepository->getConversation($toid,$fromid);
        $partnersIds = $this->MessagesService->getPartnersId();

        return View::make('partials.conversations')
                    ->with('data',$messages)
                    ->with('partnerIds',$partnersIds);
    } 
    
}



