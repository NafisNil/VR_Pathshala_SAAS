                        @forelse ($payments as $item)
                            <tr class="align-middle">
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->user->name }}</td>
                          <td>{{ $item->plan->name }}</td>
                          <td>{{ $item->amount }} USD</td>
                          <td>{{ $item->transaction_id }}</td>
                          <td>{{ $item->payment_method }}</td>
                          <td>
                            @if($item->status == 'completed')
                                <span class="badge bg-success">Completed</span> <br>
                               
                            @elseif($item->status == 'pending')
                                <span class="badge bg-secondary">Pending</span> <br>

                            @elseif($item->status == 'failed')
                                <span class="badge bg-danger">Failed</span> <br>
                            
                            @elseif($item->status == 'refunded')
                                <span class="badge bg-info">Refunded</span> <br>
                                
                            @endif
                          </td>
                          <td>
                            {{-- <a href="{{ route('plans.edit', $item->id) }}" class="btn btn-sm btn-primary mb-2" title="Edit"><i class="fas fa-edit"></i> </a>
                            <form action="{{ route('plans.destroy', $item->id) }}" method="POST" class="d-inline" id="delete-form-{{ $item->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" title="Delete" class="btn btn-sm btn-danger delete-btn" data-id="{{ $item->id }}"><i class="fas fa-trash"></i> </button>
                            </form> --}}
                          </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No plans available</td>
                            </tr>
                        @endforelse