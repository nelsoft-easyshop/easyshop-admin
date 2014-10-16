                  <table class="table table-striped table-hover tbl-my-style" id="newArrivalsTable">
                        <thead>
                        <tr>
                            <th>/</th>
                            <th>Text</th>
                            <th>Target</th>

                        <!-- HERE -->
                        </tr>
                        </thead>
                        <tbody id="tbody_boxContent">
                        <span style="display:none;">{{$newArrivalsCount=1}}</span>                               
                        <span style="display:none;">{{$newArrivalsIndex=0}}</span>                               
                        @foreach($newArrivals as $arrivals)
                            <tr id="">
                                <td>
                                    <div class="btn-toolbar" role="toolbar">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger editNewArrival" id="editNewArrivalBtn" 
                                                data-toggle="modal" data-target="#editNewArrival"
                                                data='{"url":"{{$newHomeCmsLink}}/setNewArrival","index":"{{$newArrivalsIndex}}","value":"{{$arrivals->text}}", "target":"{{$arrivals->target}}" } '
                                                >
                                                <span class="glyphicon-center glyphicon glyphicon-cog"></span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn edit_btn removeNewArrival"
                                                    data-nodename="newArrival" data-url="{{$newHomeCmsLink}}/removeContent" data-index = "{{$newArrivalsIndex}}" 
                                                >
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </div>                                                    
                                    </div>
                                </td>
                                <td class="otherCategoriesTD">{{$arrivals->text}}</td>
                                <td class="otherCategoriesTD">{{$arrivals->target}}</td>
                                <span style="display:none;"></span>                            
                            </tr>
                        <span style="display:none;" class="newArrivalsCount">{{$newArrivalsCount++}}</span>                               
                        <span style="display:none;">{{$newArrivalsIndex++}}</span>                               
                        @endforeach
                        </tbody> 
                    </table>