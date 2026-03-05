@forelse ($user as $item)
    <tr class="align-middle">
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->email }}</td>
        <td>{{ $item->device->device_id ?? 'N/A' }}</td>
        <td>{{ $item->device->device_model ?? 'N/A' }}</td>
        <td>{{ $item->otp }}</td>
        <td>
        @if($item->status == 'active')
            <span class="badge bg-success">Active</span> <br>
            <a href="{{ route('users.makeUserSuspended', $item->id) }}" class="btn btn-sm btn-warning mt-2 status-btn" data-message="mark this user as Suspended">Make Suspended</a>
        @elseif($item->status == 'suspended')
            <span class="badge bg-secondary">Suspended</span> <br>
            <a href="{{ route('users.makeUserActive', $item->id) }}" class="btn btn-sm btn-success mt-2 status-btn" data-message="mark this user as Active">Make Active</a>
        @elseif($item->status == 'pending')
            <span class="badge bg-info">Pending</span> <br>
            <a href="{{ route('users.makeUserActive', $item->id) }}" class="btn btn-sm btn-success mt-2 status-btn" data-message="mark this user as Active">Make Active</a>
        @endif
        </td>
        <td>
        <a href="{{ route('users.show', $item->id) }}" class="btn btn-sm btn-primary" title="View"><i class="fas fa-eye"></i> </a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="8" class="text-center">No users available</td>
    </tr>
@endforelse
