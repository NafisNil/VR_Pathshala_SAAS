@extends('backend.layouts.master')
@section('title')
{{ $user->name }}  - Show
@endsection
@section('content')

      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">User Details: {{ $user->name }}</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Show</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--end::App Content Header-->

        <div class="app-content">
          <div class="container-fluid">
            <div class="row">

              <!-- User Details Card -->
              <div class="col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user"></i> Basic Information</h3>
                  </div>
                  <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                      <tbody>
                        <tr>
                          <th>Name</th>
                          <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                          <th>Email</th>
                          <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                          <th>Phone</th>
                          <td>{{ $user->phone ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                          <th>Status</th>
                          <td>
                            @if($user->status == 'active')
                              <span class="badge bg-success">Active</span>
                            @elseif($user->status == 'suspended')
                              <span class="badge bg-secondary">Suspended</span>
                            @else
                              <span class="badge bg-info">{{ ucfirst($user->status ?? 'pending') }}</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th>Registered At</th>
                          <td>{{ $user->created_at ? $user->created_at->format('M d, Y h:i A') : 'N/A' }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <!-- Device Info Card -->
              <div class="col-md-6 mb-4">
                <div class="card h-100">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-mobile-alt"></i> Device Information</h3>
                  </div>
                  <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                      <tbody>
                        @if($user->device)
                          <tr>
                            <th>Device Model</th>
                            <td>{{ $user->device->device_model ?? 'N/A' }}</td>
                          </tr>
                          <tr>
                            <th>Device ID</th>
                            <td>{{ $user->device->device_id ?? 'N/A' }}</td>
                          </tr>
                          <tr>
                            <th>Last Login IP</th>
                            <td>{{ $user->device->ip_address ?? 'N/A' }}</td>
                          </tr>
                          <tr>
                            <th>Login Status</th>
                            <td>
                              @if($user->device->is_logged_in)
                                <span class="badge bg-success">Logged In</span>
                              @else
                                <span class="badge bg-danger">Logged Out</span>
                              @endif
                            </td>
                          </tr>
                        @else
                          <tr>
                            <td colspan="2" class="text-center text-muted py-4">No device registered for this user</td>
                          </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <!-- Current Subscription Plan Card -->
              <div class="col-md-12 mb-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-gem"></i> Current Subscription Plan</h3>
                  </div>
                  <div class="card-body p-0">
                    @php
                        $currentSubscription = $user->subscriptions->where('status', 'active')->first() ?? $user->subscriptions->last();
                    @endphp
                    @if($currentSubscription)
                      <div class="row align-items-center p-3">
                        <div class="col-md-6">
                            <h5><strong>Plan Name:</strong> {{ $currentSubscription->plan->name ?? 'N/A' }}</h5>
                            <p class="mb-1"><strong>Price:</strong> {{ config('app.currency_symbol', '₹') }}{{ $currentSubscription->price ?? 0 }}</p>
                            <p class="mb-0"><strong>Status:</strong> 
                                @if($currentSubscription->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif($currentSubscription->status == 'expired')
                                    <span class="badge bg-danger">Expired</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($currentSubscription->status) }}</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p class="mb-1"><strong>Started At:</strong> {{ \Carbon\Carbon::parse($currentSubscription->start_date)->format('M d, Y') }}</p>
                            <p class="mb-0"><strong>Expires At:</strong> {{ \Carbon\Carbon::parse($currentSubscription->end_date)->format('M d, Y') }}</p>
                        </div>
                      </div>
                    @else
                      <div class="p-4 text-center text-muted">No active subscription found</div>
                    @endif
                  </div>
                </div>
              </div>

              <!-- Last 5 Payments Card -->
              <div class="col-md-12 mb-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-receipt"></i> Recent Payments</h3>
                  </div>
                  <div class="card-body p-0">
                    <table class="table table-bordered table-striped text-center mb-0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Transaction ID</th>
                          <th>Amount</th>
                          <th>Method</th>
                          <th>Status</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($user->payments->sortByDesc('created_at')->take(5) as $payment)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $payment->transaction_id ?? 'N/A' }}</td>
                            <td>{{ config('app.currency_symbol', '₹') }}{{ $payment->amount }}</td>
                            <td>{{ ucfirst($payment->payment_method ?? 'N/A') }}</td>
                            <td>
                                @if($payment->status == 'success' || $payment->status == 'paid')
                                  <span class="badge bg-success">Success</span>
                                @elseif($payment->status == 'failed')
                                  <span class="badge bg-danger">Failed</span>
                                @else
                                  <span class="badge bg-warning text-dark">{{ ucfirst($payment->status) }}</span>
                                @endif
                            </td>
                            <td>{{ $payment->created_at->format('M d, Y h:i A') }}</td>
                          </tr>
                        @empty
                          <tr>
                            <td colspan="6" class="text-center text-muted py-4">No payment history found</td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </main>

@endsection
