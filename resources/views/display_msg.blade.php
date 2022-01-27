@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Group Name: </h2>
			<p>{{ $group->name }}</p>

			<h3>Group Messages:</h3>

			<form name="addMsg" id="addMsg" method="POST" action="{{route('save-msg')}}">
                <div class="card">
                    <div class="card-header"></div>
                    
                    <div>
                        <label><b>Message:</b></label>
                        <textarea name="message" required></textarea>
                    </div>
                    <div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="group_id" value="{{ Request::segment(2) }}">
                        <button type="submit" class="registerbtn">Send</button>
                    </div>
                </div>
            </form>

			<ul>
			    @foreach($group->messages as $msg)
			    <li>{{ $msg->message }}</li>
			    @endforeach
			</ul>

        </div>

    </div>
</div>
@endsection
