<tr>
    <th>Group Name</th>
    <th>Delete</th>
</tr>
@foreach($groupList as $group)
<tr>
    <td><a href="group/{{ $group->id }}">{{ $group->name }}</a></td>
    <td><button onclick="confirmation({{ $group->id }})">Delete</button></td>
</tr>
@endforeach