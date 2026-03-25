@extends('frontend.layouts.master')
@section('title')
    Payment Successful
@endsection
@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-lg mx-auto bg-white rounded-lg shadow-md p-8 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 text-green-500 mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="max-width:128px">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Payment Successful!</h2>
            <p class="text-gray-600 mb-6">{{ $message ?? 'Thank you for your purchase.' }}</p>
            @if(isset($tran_id))
            <p class="text-gray-500 text-sm mb-6">Transaction ID: <span class="font-semibold">{{ $tran_id }}</span></p>
            @endif
            <div class="mt-8">
                <a href="{{ route('user.dashboard') }}" class="inline-block bg-blue-600 text-white font-semibold px-6 py-3 rounded-md hover:bg-blue-700 transition">Go to Dashboard</a>
            </div>
        </div>
    </div>
@endsection