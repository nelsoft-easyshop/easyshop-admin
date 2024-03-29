        <div id="rolesDiv">
            <legend>Manage Roles</legend>                  
                <div class="table-responsive table-payment"> 
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Fullname</th>
                                <th>Role</th>
                                <th>Activation</th>
                            </tr>
                        </thead>
                        <span style="display:none">{{$accessor=0}}</span>   
                        @foreach($users as $adminUsers)

                            <tr class="seller_detail">
                                <td class="td_id">{{$adminUsers->id_admin_member}}</td>
                                <td class="td_username">{{$adminUsers->username}}</td>
                                <td class="td_fullname">{{$adminUsers->fullname}}</td>
                                <td class="td_role" style="width:20%;">

                                    <div class="btn-group">
                                      <button class="btn btn-default dropdown-toggle" id="action{{$accessor}}">{{$specificRoles[$accessor]->role_name}}</button>
                                      <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            &nbsp;<span class="caret"></span>
                                      </button>

                                      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                          @foreach($roles as $adminRoles)
                                            <li><a tabindex="-1" data-role="{{ $adminRoles->role_name }}" data-id = "{{$adminUsers->id_admin_member}}" data-index="{{$index}}" data-action="{{$accessor}}" data-roleid="{{$adminRoles->id_role}}"  id="rolesLink"><span id="myspan{{$index}}">{{ $adminRoles->role_name }}</span></a></li>
                                            <span style="display:none">{{$index++}}</span>
                                          @endforeach
                                      </ul>
                                    </div>
                                </td>
                                <td class="td_activation" style="width:20%;">
                                    <div class="btn-group btn-toggle" > 
                                        @if($adminUsers->is_active == 0)
                                            <button class="btn btn-sm btn-default" id="toggleMe" data-admin="{{$adminUsers->id_admin_member}}">Enabled</button>
                                            <button class="btn btn-sm btn-primary active" id="toggleMe" data-admin="{{$adminUsers->id_admin_member}}">Disabled</button>
                                        @else
                                            <button class="btn btn-sm btn-primary active" id="toggleMe" data-admin="{{$adminUsers->id_admin_member}}">Enabled</button>
                                            <button class="btn btn-sm btn-default" id="toggleMe" data-admin="{{$adminUsers->id_admin_member}}">Disabled</button>                                    
                                        @endif
                                    </div>
                                </td>                           
                            </tr>
                        <span style="display:none">{{$accessor++}}</span>                    
                        @endforeach 
                    </table>
                </div>
        </div>