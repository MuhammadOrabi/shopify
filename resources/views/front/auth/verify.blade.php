@extends('front.layouts.app')
@section('content')
    <div class="container">
        <div class="columns is- is-marginless is-centered">
            <div class="column is-7">
                <nav class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Verify Your Email Address
                        </p>
                    </header>
                    @if (session('resent'))
                        A fresh verification link has been sent to your email address.
                    @endif
                    <div class="card-content">
                        Before proceeding, please check your email for a verification link.
                        If you did not receive the email,
                        <a href="{{ route('verification.resend') }}">click here to request another</a>.
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection
