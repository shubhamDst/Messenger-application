<h2>User Name: </h2>
<p>{{ $user->name }}</p>

<h3>User Belongs to</h3>

<ul>
    @foreach($user->groups as $group)
    <li>{{ $group->name }}</li>
    @endforeach
</ul>