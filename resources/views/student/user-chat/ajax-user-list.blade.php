@forelse($userLists as $userList)

    <li id="dp_{{$userList->id}}">
        <a href="javascript:void(0)" id="dpa_{{$userList->id}}"
           class="@if(isset($userID) && $userID == $userList->id) active @endif"
           onclick="getChatData('{{$userList->id}}', '{{$userList->name}}')">

            <img src="@if(is_null($userList->image)) {{asset('default-profile-2.png')}} @else {{asset('profile/'.$userList->image)}} @endif"
                 alt="user-img" class="img-circle" height="40" width="40">
                                            <span @if($userList->message_seen == 'no' && $userList->user_one != $user->id) class="font-bold" @endif>{{$userList->name}}
                                                <small class="text-simple">@if($userList->last_message){{  \Carbon\Carbon::parse($userList->last_message)->diffForHumans()}} @endif</small>
                                            </span>
        </a>
    </li>

@empty
    <li>
        <a href="javascript:void(0)">
            <span>
                @lang('messages.noConversation')
            </span>
        </a>
    </li>
@endforelse