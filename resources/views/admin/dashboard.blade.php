@extends('admin.layouts.app')

@section('content')
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
                    Welcome Admin!
                </div>
            </nav>
        </div>
    </div>
@endsection
