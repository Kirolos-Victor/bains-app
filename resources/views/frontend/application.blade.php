@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">Application form</div>
        <div class="card-body">

            <form action="{{route('application.store')}}" method="POST">
                @csrf
                @auth()
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name"
                               placeholder="Enter your first name" name="first_name"
                               value="{{Auth()->user()->first_name}}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name"
                               placeholder="Enter your last name" name="last_name"
                               value="{{Auth()->user()->last_name}}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email"
                               placeholder="Enter your email address" name="email"
                               value="{{Auth()->user()->email}}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="phone">Phone number</label>
                        <input type="text" class="form-control" id="phone"
                               placeholder="Enter your phone number" name="phone"
                               value="{{Auth()->user()->phone}}">
                    </div>
                @else
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name"
                               placeholder="Enter your first name" name="first_name" value="{{old('first_name')}}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" aria-describedby="emailHelp"
                               placeholder="Enter your last name" name="last_name" value="{{old('last_name')}}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email"
                               placeholder="Enter your email address" name="email" value="{{old('email')}}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="phone">Phone number</label>
                        <input type="text" class="form-control" id="phone"
                               placeholder="Enter your phone number" name="phone" value="{{old('phone')}}">
                    </div>
                @endauth

                <div class="form-group mt-3">
                    <label for="date_of_birth">Date Of Birth</label>
                    <input type="date" class="form-control" id="date_of_birth"
                           placeholder="Enter your date of birth" name="date_of_birth" value="{{old('date_of_birth')}}">
                </div>
                <div class="form-group mt-3">
                    <label for="job">Select Your Job</label>
                    <select id="job" class="form-select" name="job">
                        @foreach($jobs as $job)
                            <option value="{{$job->value}}">{{$job->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-check mt-3">
                    <input type="checkbox" class="form-check-input" id="experience"
                           name="previous_experience" value="1">
                    <label class="form-check-label" for="experience">Previous Experience</label>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Apply</button>
            </form>

        </div>
    </div>
@endsection
