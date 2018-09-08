@extends('admin.layouts.app')

@section('content')
    <div class=" is- is-marginless is-centered">
        <div class="">
            <nav class="card">
                <header class="card-header">
                   <h1 class="subtitle card-header-title"> > Admin</h1>
                    <a href="{{ url('/admin/admins') }}" class="button is-primary">
                        <span class="icon" ><font-awesome-icon class="m-r-10" icon="arrow-left" size="xs" fixed-width/></span>
                        Back
                    </a>
                </header>
                <div class="card-content content" >
                    <a href="{{ url('/admin/admins/'. $admin->id.'/edit') }}" class="button is-primary ">
                        <span class="icon"><font-awesome-icon class="m-r-10" icon="edit" /></span>
                        Edit
                    </a>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>ID</td>
                                <td>{{ $admin->id }}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{ $admin->name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $admin->email }}</td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td>{{ $admin->roles->first()->title }}</td>
                            </tr>
                            <tr>
                                <td>Created at</td>
                                <td>{{ $admin->created_at->diffForHumans() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </nav>
        </div>
    </div>
@endsection
