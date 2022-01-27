<h2>Product Name: </h2>
<p>{{ $group->name }}</p>

<h3>Product Belongs to</h3>

<ul>
    @foreach($group->messages as $msg)
    <li>{{ $msg->message }}</li>
    @endforeach
</ul>