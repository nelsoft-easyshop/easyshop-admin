<?php

use Easyshop\Services\XMLContentGetterService as XMLService;

class MessageController extends BaseController
{

    /**
     *  Constructor declaration for XMLService
     */
    private $XMLService;

    public function __construct(XMLService $XMLService) 
    {   
        $this->XMLService = $XMLService;
        $this->messagesRepository = App::make('MessagesRepository');
    }

    /**
     *  Renders Messages  
     *
     *  @return VIEW
     */
    public function showMessages()
    {
        $partnersIds = $this->getPartnersId();
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
        $this->messagesRepository->updateMessageAsRead(Input::get("messageid"));        

        $html =  View::make('partials.messagespartial')
                    ->with('data',$messages)
                    ->with('partnerIds',$this->getPartnersId())
                    ->with('posted',Input::all())                    
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
                Input::get('from_id'), Input::get('message'));  
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

        return View::make('partials.conversations')
                    ->with('data',$messages)
                    ->with('partnerIds',$this->getPartnersId());
    } 

    /**
     *  Retrieves Partners ID
     *
     *  @return array
     */
    public function getPartnersId()
    {
        $map = simplexml_load_string(trim($this->XMLService->GetXmlContentFiles()));
        $target = current($map->xpath("/map/select[@id='partners-member-id']")); 
        return array_map('trim', explode(",",$target));
    }

    
}



