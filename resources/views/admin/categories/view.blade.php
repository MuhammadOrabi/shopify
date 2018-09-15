@extends('admin.layouts.app')

@section('content')
    <div class=" is- is-marginless is-centered">
        <div class="">
            <nav class="card">
                <header class="card-header">
                   <h1 class="subtitle card-header-title"> > Categories</h1>
                    <a href="{{ url('/admin/categories') }}" class="button is-primary">
                        <span class="icon" ><font-awesome-icon class="m-r-10" icon="arrow-left" size="xs" fixed-width/></span>
                        Back
                    </a>
                </header>
                <div class="card-content content" >
                    <a href="{{ url('/admin/categories/'. $category->id.'/edit') }}" class="button is-primary ">
                        <span class="icon"><font-awesome-icon class="m-r-10" icon="edit" /></span>
                        Edit
                    </a>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>ID</td>
                                <td>{{ $category->id }}</td>
                            </tr>
                            <tr>
                                <td>Title</td>
                                <td>{{ $category->title }}</td>
                            </tr>
                            <tr>
                                <td>Slug</td>
                                <td>{{ $category->slug }}</td>
                            </tr>
                            <tr>
                                <td>Tags</td>
                                <td>{{ $category->tags->pluck('title')->implode(',') }}</td>
                            </tr>
                            <tr>
                                <td>Images</td>
                                <td>
                                    <div class="columns">
                                        @foreach($category->images() as $image)
                                            <div class="column">
                                                <figure class="image is-128x128">
                                                    <img src="{{ $image->links['normal'] }}">
                                                </figure>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Created at</td>
                                <td>{{ $category->created_at->diffForHumans() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </nav>
        </div>
    </div>
@endsection
