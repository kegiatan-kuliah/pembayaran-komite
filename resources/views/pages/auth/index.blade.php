@extends('layouts.auth')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                            </div>
                            {{ html()->form('POST', route('auth.login'))->open() }}
                                <div class="form-group">
                                    {{ html()->input('text', 'username')
                                        ->class('form-control form-control-user')->attribute('required', true)
                                        ->attribute('placeholder', 'Isikan username') }}
                                </div>
                                <div class="form-group">
                                    {{ html()->input('password', 'password')
                                        ->class('form-control form-control-user')->attribute('required', true)
                                        ->attribute('placeholder', 'Isikan password') }}
                                </div>
                                {{ html()->button('Login')->class('btn btn-primary btn-user btn-block')->attribute('type', 'submit') }}
                            {{ html()->form()->close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection