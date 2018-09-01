@extends('front.layouts.app')

@section('content')
    <div class="container">
        <div class="columns is- is-marginless is-centered">
            <div class="column is-7">
                <nav class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Dashboard
                        </p>
                    </header>
                    @if (session('status'))
                        {{ session('status') }}
                    @endif
                    <div class="card-content">
                        You are logged in!
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection
