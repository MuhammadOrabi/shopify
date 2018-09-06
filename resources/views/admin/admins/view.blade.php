@extends('admin.layouts.app')

@section('content')
    <div class=" is- is-marginless is-centered">
        <div class="">
            <nav class="card">
                <header class="card-header">
                   <h1 class="subtitle card-header-title"> > Create Admin</h1>
                    <a href="{{ url('/admin/admins') }}" class="button is-primary">
                        <span class="icon"><i class="fa fa-fw p-r-10 fa-arrow-left"></i></span>Back
                    </a>
                </header>
                <div class="card-content" >

                </div>
            </nav>
        </div>
    </div>
@endsection
