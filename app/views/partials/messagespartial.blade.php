<div class="panel panel-default" style="resize:vertical;">
    <div class="panel-heading">
        <h3 class="panel-title">Conversation History &nbsp;<a href="javascript:void(0)" id="refreshHistory"><span class="glyphicon glyphicon-refresh"></span></a></h3>
    </div>
    <div class="panel-body" id="conversations" style="overflow-y:scroll;height:250px;">
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
    </div>
</div>
<div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Reply Message</h3>
            </div>
            <div class="panel-body">
                <form>
                    <div class="form-group">
                        <input type="hidden" id="to_idForm" value="{{$posted['to_id']}}">
                        <input type="hidden" id="from_idForm" value="{{$posted['from_id']}}">
                        <label>User's Message:</label>                        
                        <textarea class='form-control'  style="resize:vertical" readonly="readonly" rows="5" cols="5">{{{strip_tags($posted['message'])}}}</textarea><br/>
                        <label>Reply</label>
                        <textarea class='form-control' style="resize:vertical" id="messageForm" rows="5" cols="5"></textarea>
                    </div>    
                    <a class="btn btn-primary" href="javascript:void(0)" role="button" id="submitMessage">Submit Message</a>    
                </form> 
            </div>
</div>

