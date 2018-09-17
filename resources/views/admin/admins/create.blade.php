@extends('admin.layouts.app')

@section('content')
    <div class=" is- is-marginless is-centered">
        <div class="">
            <nav class="card">
                <header class="card-header">
                   <h1 class="subtitle card-header-title"> > Create Admin</h1>
                    <a href="{{ url('/admin/admins') }}" class="button is-primary">
                        <span class="icon" ><font-awesome-icon class="m-r-10" icon="arrow-left" size="xs" fixed-width/></span>
                        Back
                    </a>
                </header>
                <div class="card-content" >
                    <admin-admins-form
                        roles="{{ json_encode($roles->toArray()) }}"
                        site-url="{{ url('/') }}"></admin-admins-form>
                </div>
            </nav>
        </div>
    </div>
@endsection
