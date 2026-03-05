                        @forelse ($subscriptions as $item)
                            <tr class="align-middle">
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->user->name }}</td>
                          <td>{{ $item->plan->name }}</td>
                          <td>{{ \Carbon\Carbon::parse($item->started_at)->format('M d, Y') }}</td>
                          <td>{{ \Carbon\Carbon::parse($item->expires_at)->format('M d, Y') }}</td>
                          <td>{{ $item->plan->price }} USD</td>
                          <td>
                            @if($item->status == 'active')
                                <span class="badge bg-success">Active</span> <br>
                               
                            @elseif($item->status == 'inactive')
                                <span class="badge bg-secondary">Inactive</span> <br>
                            @elseif($item->status == 'cancelled')
                                <span class="badge bg-danger">Cancelled</span> <br>
                               
                            @endif
                          </td>
                          <td>
                            {{-- <a href="{{ route('plans.edit', $item->id) }}" class="btn btn-sm btn-primary mb-2" title="Edit"><i class="fas fa-edit"></i> </a>
                            <form action="{{ route('plans.destroy', $item->id) }}" method="POST" class="d-inline" id="delete-form-{{ $item->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" title="Delete" class="btn btn-sm btn-danger delete-btn" data-id="{{ $item->id }}"><i class="fas fa-trash"></i> </button> --}}
                            </form>
                          </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No records available</td>
                            </tr>
                        @endforelse