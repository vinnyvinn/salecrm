@extends('layouts.app-unauthenticated')

@section('content')
<div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">                                    
                                </div>
                                <form action="{{ route('login') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control" type="email" id="email" required placeholder="email" name="email">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <a href="pages-recoverpw.html" class="text-muted float-right"><small></small></a>
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" required id="password" placeholder="Enter your password" name="password">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                            <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted"> <a href="{{ route('password.request') }}" class="text-muted ml-1">Forgot your password?</a></p>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
