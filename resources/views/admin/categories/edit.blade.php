@extends('admin.layouts.app')

@section('content')
    <div class=" is- is-marginless is-centered">
        <div class="">
            <nav class="card">
                <header class="card-header">
                   <h1 class="subtitle card-header-title"> > Create Category</h1>
                    <a href="{{ url('/admin/categories') }}" class="button is-primary">
                        <span class="icon" ><font-awesome-icon class="m-r-10" icon="arrow-left" size="xs" fixed-width/></span>
                        Back
                    </a>
                </header>
                <div class="card-content" >
                    <admin-categories-form
                        :category="{{ $category }}"
                        :tags="{{ $tags }}"
                        site-url="{{ url('/') }}"
                        access-token="{{ auth('web-admin')->user()->createToken('Token')->accessToken }}"
                        ></admin-categories-form>
                </div>
            </nav>
        </div>
    </div>
@endsection
