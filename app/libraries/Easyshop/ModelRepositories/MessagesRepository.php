<?php namespace Easyshop\ModelRepositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Messages, Member;

class MessagesRepository extends AbstractRepository
{

    /**
     *  Retrieves all messages for partners
     *  @return Entity
     */
    public function getAllMessages($ids)
    {
        $messages = DB::select(DB::raw("SELECT 
                          a.`id_msg`,
                          a.`to_id`,
                          c.`store_name` AS `recipient`,
                          a.`from_id`,
                          b.`store_name` AS `sender`,
                          a.`message`,
                          a.`time_sent`,
                          a.`opened` AS opened,
                          a.`is_delete`
                        FROM
                          `es_messages` AS a 
                          LEFT JOIN `es_member` AS b 
                            ON a.`from_id` = b.`id_member` 
                          LEFT JOIN `es_member` AS c 
                            ON a.`to_id` = c.`id_member` 
                          WHERE a.`to_id` = :ids
                          ORDER BY a.`time_sent` desc"), array("ids" => $ids));
        return $messages;
    }
  
    /**
     *  Retrieves message history for a particular customer and a partner
     *  @return Entity
     */  
    public function getConversation($to_id, $from_id)
    {
        $messages = DB::select(DB::raw("SELECT 
                          a.`id_msg`,
                          a.`to_id`,
                          c.`store_name` AS `recipient`,
                          a.`from_id`,
                          b.`store_name` AS `sender`,
                          a.`message`,
                          a.`time_sent`,
                          a.`opened` AS opened,
                          a.`is_delete`
                        FROM
                          `es_messages` AS a 
                          LEFT JOIN `es_member` AS b 
                            ON a.`from_id` = b.`id_member` 
                          LEFT JOIN `es_member` AS c 
                            ON a.`to_id` = c.`id_member` 
                        where (a.`to_id` = :to_reciever AND a.`from_id` = :from_reciever) OR (a.`to_id` = :from_recipient AND a.`from_id` = :to_recipient)
                        ORDER BY time_sent DESC "), array("to_reciever" => $to_id,"from_reciever" => $from_id, 
                                                          "to_recipient" => $to_id,"from_recipient" => $from_id));

        return $messages;
    }
    /**
     *  Inserts messages to the database
     *  @return Entity
     */
    public function insertMessages($from_id, $to_id, $messages)
    {
        $message = new Messages();
       

        $message->to_id = $to_id;
        $message->from_id = $from_id;
        $message->time_sent = Carbon::now();
        $message->message = $messages;
        $message->save();
        return $messages;

    }

    /**
     *  Updates is_opened
     *  @param int $id
     *  @return Entity
     */
    public function updateMessageAsRead($id)
    {
        $message = Messages::find($id);
        $message->opened = "1";
        $message->save();        
        return $message;
    }    



}
