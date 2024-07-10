@extends('layouts.auth')
@section('content')
<div class="test">
    <div class="row d-flex justify-content-center align-items-center h-100" style="width:100%;">
        <div class="col col-lg-6 mb-4 mb-lg-0">
            <div class="card mb-3" style="border-radius: .5rem;">
                <div class="row g-0 align-items-center">
                    <div class="col-md-4 gradient-custom text-center" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                        <img src="{{ asset('/images/profilePicture/' . Auth::user()->profile_pic) }}" alt="Avatar" class="img-fluid my-5" style="width: 70%; border-radius:50%;" />
                        <h5>{{ Auth::user()->name }}</h5>
                        <a href="{{ route('user.edit.show', Auth::user()) }}"><i class="far fa-edit mb-5"></i></a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-4">
                            <h6>Personal Information</h6>
                            <hr class="mt-0 mb-4">
                            <div class="row pt-1">
                                <div class="col-6 mb-3">
                                    <h6>Email</h6>
                                    <p class="text-muted">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <h6>Phone Number</h6>
                                    <p class="text-muted">{{ Auth::user()->phoneNo }}</p>
                                </div>
                            </div>

                            @cannot('isAdmin')
                            <h6>Address</h6>
                            <hr class="mt-0 mb-4">
                            <div class="col-6 mb-3">
                                <p class="text-muted">{{ Auth::user()->address }}</p>
                            </div>
                            @endcannot

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection