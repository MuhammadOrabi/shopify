@extends('admin.layouts.app')

@section('content')
    <admin-media
        :form="false"
        site-url="{{ url('/') }}"
        access-token="{{ auth('web-admin')->user()->createToken('Token')->accessToken }}"
        ></admin-media>
@endsection
