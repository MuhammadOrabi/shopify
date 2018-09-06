@extends('admin.layouts.app')

@section('content')
    <div class=" is- is-marginless is-centered">
        <div class="">
            <nav class="card">
                <header class="card-header">
                   <h1 class="subtitle card-header-title"> > Update Admin</h1>
                    <a href="{{ url('/admin/admins') }}" class="button is-primary">
                        <span class="icon"><i class="fa fa-fw p-r-10 fa-arrow-left"></i></span>Back
                    </a>
                </header>
                <div class="card-content" >
                    <admin-admins-form
                        roles="{{ json_encode($roles->toArray()) }}"
                        admin="{{ json_encode($admin->toArray()) }}"
                        site-url="{{ url('/') }}"
                        access-token="{{ auth('web-admin')->user()->createToken('Token')->accessToken }}"
                        ></admin-admins-form>
                </div>
            </nav>
        </div>
    </div>
@endsection