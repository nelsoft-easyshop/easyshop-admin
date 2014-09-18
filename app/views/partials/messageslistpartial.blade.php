                            <div class="table-responsive table-payment"> 
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th data="recipient">Recipient</th>
                                            <th data="sender">Sender</th>
                                            <th data="message">Message</th>
                                            <th data="time_sent">Time Sent</th>
                                        </tr>
                                    </thead>
                                    @foreach($list_of_messages as $messages)
                                            <tr class="messages_detail">
                                                <td class="id" style="display:none;">{{ $messages->id_msg }}</td>        
                                                <td class="to_id" style="display:none;">{{ $messages->to_id }}</td>
                                                <td class="from_id" style="display:none;">{{ $messages->from_id }}</td>
                                                <td class="recipient">{{ $messages->recipient }}</td>
                                                <td class="sender">{{ $messages->sender }}</td>
                                                <td class="message">{{ $messages->message }}</td>
                                                <td class="time_sent">{{ $messages->time_sent }}</td>                          
                                            </tr>
                                        @endforeach
                                </table>
                            </div> 