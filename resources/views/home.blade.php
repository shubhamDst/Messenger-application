@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($message = Session::get('success'))
                <div class="alert alert-success custom-alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <i class="fa fa-check fa-lg" aria-hidden="true"></i> <strong>Success!</strong> {{ $message }}
                </div>
            @endif
            <form name="addGroup" id="addGroup" method="POST" action="{{route('save-group')}}">
                <div class="card">
                    <div class="card-header"></div>
                    <div>
                        <label for="users"><b>Choose a users:</b></label>
                        <select name="user[]" id="user" multiple>
                            @foreach($allUsers as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                             @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="email"><b>Group Name:</b></label>
                        <input type="text" placeholder="Enter Group" name="group" id="group" required>
                    </div>
                    <div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="registerbtn">Save</button>
                    </div>
                </div>
            </form>

        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4>User Groups:</h4>

                    <table border="1" id="tableRow">
                        <tr>
                            <th>Group Name</th>
                            <th>Delete</th>
                        </tr>
                        @foreach($groups as $group)
                        <tr>
                            <td><a href="group/{{ $group->id }}">{{ $group->name }}</a></td>
                            <td><button onclick="confirmation({{ $group->id }})">Delete</button></td>
                        </tr>
                        @endforeach
                    </table>


                </div>
            </div>
        </div>

    </div>
</div>
@endsection
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        var deleteUserFromGroup = "{{route('delete-user-from-group')}}";
        function confirmation(gid){
            var result = confirm("Are you sure to delete?");
            if(result){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: deleteUserFromGroup, // point to server-side PHP script 
                    data: {'group_id':gid},
                    type: 'post',
                    // beforeSend:function(){
                    //     $('.ibox-content').addClass('sk-loading');
                    // },
                    success: function(data){
                        $('.ibox-content').removeClass('sk-loading');
                        if(data){
                            $("#tableRow").html(data);
                        }
                        else{
                            console.log('No Data');
                        }
                    }
                });
            }
        }
    </script>

