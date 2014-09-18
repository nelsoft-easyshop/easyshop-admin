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
                          c.`username` AS `recipient`,
                          a.`from_id`,
                          b.`username` AS `sender`,
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
                          WHERE a.`to_id` = $ids
                          ORDER BY a.`time_sent` desc
                          "));
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
                          c.`username` AS `recipient`,
                          a.`from_id`,
                          b.`username` AS `sender`,
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
                        where (a.`to_id` = '$to_id' AND a.`from_id` = '$from_id') 
                               OR (a.`to_id` = '$from_id' AND a.`from_id` = '$to_id')
                        ORDER BY time_sent DESC "));

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

        return $message->save();

    }

    /**
     *  Updates is_opened
     *  @param int $id
     *  @return Entity
     */
    public function updateMessage($id)
    {
        $message = Messages::find($id);
        $message->opened = "1";
        return $message->save();        
    }    



}
