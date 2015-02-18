                        <table class="table table-striped table-hover tbl-my-style"  id="addBrandsTable tableme_{{$index}}">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Target</th>
                                <th>Action Type</th>

                            </tr>
                            </thead>
                            <tbody id="tbody_boxContent">
                            <span style="display:none;">{{$boxContentIndex=0}}</span>
                            @foreach($boxContent as $content)
                                <tr id="tableIndex_{{$index}}">
                                    <td>
                                        <div class="btn-toolbar" role="toolbar">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-danger edit_btn" id="data_{{$index}}_{{$boxContentIndex}}" 
                                                    data='{"tableindex":"{{{ $index }}}","url":"{{{ $mobileCmsLink }}}/setBoxContent","sectionIndex":"{{{ $index }}}","boxIndex":"{{{ $boxContentIndex}}}","value":"{{{ $content->value }}}","type":"{{{ $content->type }}}","target":"{{{ $content->target }}}","actionType":"{{{ $content->actionType }}}" } '
                                                    data-toggle="modal" data-target="#myModal" data="">
                                                    <span class="glyphicon-center glyphicon glyphicon-cog"></span>
                                                </button>
                                            </div>
                                            <div class="btn-group">
                                                <button type="button" class="btn edit_btn removeButton" data-url="{{{ $mobileCmsLink }}}/removeContent" data-nodename="boxContent" data-index="{{{ $index }}}" data-subindex= "{{{ $boxContentIndex }}}" >
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </button>
                                            </div>                                                
                                        </div>
                                    </td>
                                    <td id="value_{{$index}}_{{$boxContentIndex}}">{{{$content->value}}}</td>
                                    <td id="type_{{$index}}_{{$boxContentIndex}}">{{{$content->type}}}</td>
                                    <td id="target_{{$index}}_{{$boxContentIndex}}">{{{$content->target}}}</td>
                                    <td id="actionType_{{$index}}_{{$boxContentIndex}}">{{{$content->actionType}}}</td>
                                    <span style="display:none;">{{$boxContentIndex++}}</span>                            
                                    <input type="hidden" class="boxContentCount_{{$index}}" value="{{$boxContentIndex}}">
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        