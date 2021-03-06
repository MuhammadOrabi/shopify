@extends('admin.layouts.app')

@section('content')
    <div class=" is- is-marginless is-centered">
        <div class="">
            <nav class="card">
                <header class="card-header">
                   <h1 class="subtitle card-header-title"> > Update Item</h1>
                    <a href="{{ url('/admin/items') }}" class="button is-primary">
                        <span class="icon" ><font-awesome-icon class="m-r-10" icon="arrow-left" size="xs" fixed-width/></span>
                        Back
                    </a>
                </header>
                <div class="card-content" >
                    <admin-items-form
                        :item="{{ $item }}"
                        :categories="{{ $categories }}"
                        :tags="{{ $tags }}"
                        site-url="{{ url('/') }}"
                        ></admin-items-form>
                </div>
            </nav>
        </div>
    </div>
@endsection
