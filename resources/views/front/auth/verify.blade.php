@extends('front.layouts.app')

@section('content')
<div class="flex items-center px-6 md:px-0">
    <div class="w-full max-w-md md:mx-auto">
        <div class="rounded shadow">
            <div class="font-medium text-lg text-teal-darker bg-teal p-3 rounded-t">
                Verify Your Email Address
            </div>
            <div class="bg-white p-3 rounded-b">
                @if (session('resent'))
                    <div class="bg-green-lightest border border-green-light text-green-dark text-sm px-4 py-3 rounded mb-4">
                        A fresh verification link has been sent to your email address.
                    </div>
                @endif

                Before proceeding, please check your email for a verification link.
                If you did not receive the email, <a href="{{ route('verification.resend') }}">click here to request another</a>.
            </div>
        </div>
    </div>
</div>
@endsection
