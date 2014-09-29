            <div id="rolesDiv">
                <legend>Raffle Lists</legend>                  
                <div class="table-responsive table-payment"> 
                    <table class="table table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>/</th>
                                <th>Raffle_Name</th>
                                <th>Winners</th>
                                <th>Time Created</th>
                                <th>Prices</th>
                            </tr>
                        </thead>

                        @foreach($raffles as $raffle)
                            <tr class="seller_detail">
                                <td class="td_id" width="5%">
                                    <a href="javascript:void(0)" id="delete" data-id = "{{$raffle->raffle_id}}"><span class="glyphicon glyphicon-remove"></span></a>
                                </td>
                                <td class="td_username" width="3%">{{ $raffle->raffle_name }}</td>
                                <td class="td_username" width="40%">

                                    <div id="winnersDisplay">{{ str_ireplace(",","<br/>",$raffle->winners) }}</div>


                                </td>
                                <td class="td_username" width="25%">{{ $raffle->created_at }}</td>
                                <td class="td_fullname" width="20%">

                                    <div id="pricesDisplay">{{ str_ireplace(",","<br/>",$raffle->prices) }}
                                </td>                                              
                            </tr>
                        @endforeach  
                    </table>
                </div>
            </div>
  {{ HTML::script('js/raffle.js') }}      
        