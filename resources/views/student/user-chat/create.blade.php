<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title"><i class="icon-note"></i> @lang("modules.messages.startConversation")</h4>
</div>
<div class="modal-body">
    <div class="portlet-body">

        {!! Form::open(['id'=>'createChat','class'=>'ajax-form','method'=>'POST']) !!}
        <div class="form-body">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="form-group">
                        <label>@lang("modules.messages.chooseMember")</label>
                        <select class="select2 form-control" data-placeholder="@lang("modules.messages.chooseMember")" name="user_id" id="user_id">
                            @foreach($members as $member)
                                @if($member->id==$supervisor_id||$member->id==1)
                                <option
                                        value="{{ $member->id }}">{{ ucwords($member->name) }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="">@lang("modules.messages.message")</label>
                        <textarea name="message" class="form-control" id="message" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions m-t-20">
            <button type="button" id="post-message" class="btn btn-success"><i class="fa fa-send-o"></i> @lang("modules.messages.send")</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>


<script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"></script>

<script>

    $('.select2').select2();

    $('#post-message').click(function () {
        $.easyAjax({
            url: '{{route('student.user-chat.message-submit')}}',
            container: '#createChat',
            type: "POST",
            data: $('#createChat').serialize(),
            success: function (response) {
                if (response.status == 'success') {
                    var blank = "";
                    $('#submitTexts').val('');

                    //getting values by input fields
                    var dpID = $('#dpID').val();
                    var dpName = $('#dpName').val();


                    //set chat data
                    getChatData(dpID, dpName);

                    //set user list
                    $('.userList').html(response.userList);

                    //set active user
                    if (dpID) {
                        $('#dp_' + dpID + 'a').addClass('active');
                    }

                    $('#newChatModal').modal('hide');
                }
            }
        })
    });
</script>