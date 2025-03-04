@forelse($lists as $list)
    <tr>
        <td>{{ $list->name }}</td>
        <td>{{ $list->email }}</td>
        <td><a href={{ route('user.edit', ['userinfo' => $list]) }}>edit</a></td>
    </tr>
@empty
    <tr>
        <td colspan="3">No Records Found!</td>
    </tr>
@endforelse
