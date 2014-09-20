        
        @foreach($data as $message)
            @if(in_array($message->from_id,$partnerIds))

                <div style="padding-top:5px;min-">
                    <blockquote  id="quoteLeft">    
                        <p>{{{$message->message}}}</p>
                        <footer>{{{$message->sender}}} <cite title="Source Title">{{{$message->time_sent}}} </cite></footer>
                    </blockquote>
                </div>

            @else
                <div style="padding-top:5px;">
                    <blockquote class="blockquote-reverse" id="quoteRight">
                        <p>{{{$message->message}}}</p>
                        <footer>{{{$message->sender}}} <cite title="Source Title">{{{$message->time_sent}}} </cite></footer>
                    </blockquote>    
                </div>
            @endif
        @endforeach 

        