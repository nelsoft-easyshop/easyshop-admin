
                  @foreach($orders as $details)
                      <tr class='buyer-list'>
                          <td class='td_order_id'>{{{$details->id_order}}}</td>
                          <td class='username' data-memberid="{{{ $details->seller_id }}}">{{{$details->username}}}</td>
                          <td class='email'>{{{$details->email}}}</td>
                          <td class='email'><span class="org_btn view" style="background-color:{{  $details->tag_color  }};">{{{ ($details->tag_description) ? $details->tag_description : 'NO TAG'  }}} </span></td>
                          <td class="contactno">{{{ ($details->contactno) ? $details->contactno : 'N/A' }}}</td>                        
                      </tr>
                  @endforeach
