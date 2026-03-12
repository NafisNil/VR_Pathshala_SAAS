@extends('frontend.layouts.master')
@section('title')
    Payment History
@endsection
@section('content')
        <section class="slider-area slider-area2">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height2">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-11 col-md-12">
                                <div class="hero__caption hero__caption2">
                                    <h1 data-animation="bounceIn" data-delay="0.2s">Payment History</h1>
                                    <!-- breadcrumb Start-->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <x-home-link />
                                            <li class="breadcrumb-item"><a href="#">Payment History</a></li> 
                                        </ol>
                                    </nav>
                                    <!-- breadcrumb End -->
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
            </div>
        </section>
<div class="courses-area section-padding40 fix" style="background-color: #fcf1f4; min-height: 60vh;">
    <div class="container">
        <div class="row py-5">
            <!-- Sidebar Navigation -->
           <x-user-sidebar />

            <!-- Main Content Area -->
            <div class="col-md-9 pl-md-5 mt-4 mt-md-0">
                <div class="dashboard-content bg-white p-4 p-md-5 rounded shadow-sm">
                    <h3 class="mb-4" style="font-weight: 600;">Payment History</h3>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mt-3">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" style="font-weight: 500; font-size: 14px; text-transform: uppercase;">Date</th>
                                    <th scope="col" style="font-weight: 500; font-size: 14px; text-transform: uppercase;">Transaction ID</th>
                                     <th scope="col" style="font-weight: 500; font-size: 14px; text-transform: uppercase;">Payment Method</th>
                                    <th scope="col" style="font-weight: 500; font-size: 14px; text-transform: uppercase;">Plan</th>
                                    <th scope="col" style="font-weight: 500; font-size: 14px; text-transform: uppercase;">Amount</th>
                                    <th scope="col" style="font-weight: 500; font-size: 14px; text-transform: uppercase;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example static row. Replace with your loop: @ foreach($payments as $payment) -->
                                @foreach ($payments as $item)
                                <tr>
                                    <td style="color: #555; vertical-align: middle;">{{ $item->created_at->format('F d, Y') }}</td>
                                    <td style="color: #555; vertical-align: middle;">#{{ $item->transaction_id }}</td>
                                    <td style="color: #555; vertical-align: middle;">{{ $item->payment_method }}</td>
                                    <td style="color: #555; vertical-align: middle;">{{ $item->plan->name }}</td>
                                    <td style="color: #555; vertical-align: middle;">${{ $item->amount }}</td>
                                    <td style="vertical-align: middle;">
                                            @if($item->status == 'completed')
                                                <span class="badge badge-success" style="background-color: #28a745; font-size: 12px; padding: 5px 10px;">Completed</span>
                                            @elseif ($item->status == 'pending')
                                                <span class="badge badge-warning" style="background-color: #ffc107; font-size: 12px; padding: 5px 10px;">Pending</span>
                                            @elseif ($item->status == 'failed')
                                                <span class="badge badge-danger" style="background-color: #dc3545; font-size: 12px; padding: 5px 10px;">Failed</span>
                                            @else
                                                 <span class="badge badge-secondary" style="background-color: #6c757d; font-size: 12px; padding: 5px 10px;">{{ ucfirst($item->status) }}</span>
                                            @endif
                                    </td>
                                </tr>
                                @endforeach


                                <!-- @ endforeach -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection