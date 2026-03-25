@extends('frontend.layouts.master')
@section('title')
    Payment Cancelled
@endsection
@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-lg mx-auto bg-white rounded-lg shadow-md p-8 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-yellow-100 text-yellow-500 mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Payment Cancelled!</h2>
            <p class="text-gray-600 mb-6">{{ $message ?? 'You have cancelled the payment process.' }}</p>
            @if(isset($tran_id))
            <p class="text-gray-500 text-sm mb-6">Transaction ID: <span class="font-semibold">{{ $tran_id }}</span></p>
            @endif
            <div class="mt-8">
                <a href="{{ route('index') }}" class="inline-block bg-gray-600 text-white font-semibold px-6 py-3 rounded-md hover:bg-gray-700 transition">Go Home</a>
            </div>
        </div>
    </div>
@endsection