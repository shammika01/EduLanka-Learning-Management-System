@extends('layouts.admin.app')

@section('title', 'Dashboard')
@section('content_title', 'Progress')
@section('breadcrumb', ' Monitor Progress')

@section('sidebar')
    <!-- Sidebar content specific to this page -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
            <a class="nav-link" href="{{ url('/redirects') }}"
                    style="display: block; text-align: center; font-size: 18px; transition: font-size 0.3s ease-in-out;">
                    Home
                </a>
            <a class="nav-link" href="{{ route('student.course') }}" data-bs-toggle="collapse"
                    data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages"
                    style="display: block; text-align: center; font-size: 18px; transition: font-size 0.3s ease-in-out;">
                    Courses
                </a>
                <!-- <a class="nav-link collapsed" href="{{ route('student.index') }}" data-bs-toggle="collapse"
                    data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages"
                    style="display: block; text-align: center; font-size: 18px; transition: font-size 0.3s ease-in-out;">
                    Assignments
                </a> -->
                <a class="nav-link collapsed" href="{{ route('student.module.index') }}" data-bs-toggle="collapse"
                    data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages"
                    style="display: block; text-align: center; font-size: 18px; transition: font-size 0.3s ease-in-out;">
                    Modules
                </a>
                <a class="nav-link collapsed" href="{{ url('/progress') }}" data-bs-toggle="collapse"
                    data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages"
                    style="display: block; text-align: center; font-size: 18px; transition: font-size 0.3s ease-in-out;">
                    Progression
                </a>
                <a class="nav-link active" href="{{ route('student.submissions') }}" data-bs-toggle="collapse"
                    data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages"
                    style="display: block; text-align: center; font-size: 18px; transition: font-size 0.3s ease-in-out;">
                    Submittion
                </a>

                <a>
                    <x-dropdown align="right" width="55">
                        <x-slot name="trigger">
                            <div style="display: flex; justify-content: center; align-items: center; padding-top: 50px;">
                                <button
                                    style="border-radius: 10px; padding: 10px 20px; background-color: #3498db; color: white; border: none;">
                                    <div>{{ Auth::user()->name }}</div>
                                </button>
                            </div>
                        </x-slot>

                        <x-slot name="content">

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                        this.closest('form').submit();"
                                    style="display: block; padding: 10px 15px; color: #3498db; text-decoration: none; text-align: center; background: transparent; border: none;">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </a>
            </div>
        </div>
    </nav>
@endsection

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Submission ID</th>
                    <th>Module Name</th>
                    <th>Student ID</th>
                    <th>Submitted Document</th>



                    {{-- <th>type</th>
                    <th>Issued date</th>
                    <th>Submission date</th>
                    <th>Document</th>
                    <th>Status</th>
                    <th>Actions</th> --}}


                </tr>
            </thead>
            <tbody>
                </tr>
                </thead>
            <tbody>
                @foreach ($submissions as $submission)
                    <tr>
                        <td>{{ $submission->id }}</td>
                        <td>{{ $submission->module->name }}</td>
                        <td>{{ $submission->user_id }}</td>

                        <td>
                            @if (!empty($submission->document_file))
                                <a href="{{ asset($submission->document_file) }}" class="btn btn-primary"
                                    download="{{ $submission->document_file }}">Download</a>
                            @endif
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div class="container mt-5">
        <form method="post" action="{{ route('student.submissions') }}">
            @csrf
            <label for="user_id">Enter The Module Number to View Submissions:</label>
            <input type="text" name="user_id" id="user_id" required>
            <button type="submit">Submit</button>
        </form>




    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var submitButtons = document.querySelectorAll(".submit-button");

            // Check if the submission was successful
            if (typeof submissionSuccess !== 'undefined' && submissionSuccess === true) {
                submitButtons.forEach(function(button) {
                    button.disabled = true;
                });
            }
        });
    </script>


@endsection
