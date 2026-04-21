@extends('auth.layout')
@section('content')
<link rel="stylesheet" href="{{asset('css/Auth/login.css')}}">

<section class="midContent loginWrapper justify-content-center align-items-center vh-100" id="midContent">
    <div class="container-fluid">
        <div class="loginWidget br_12">
            <div class="d-flex loginWidgetTop">
                <a href="{{url('/')}}"> <img src="{{asset('fassets/images/arrowLefticon.png')}}" /> Back</a>
            </div>

            <div class="loginFormWidget aos-init aos-animate" data-aos="fade-left">
                <div class="loginFormHeader text-center">
                    <h3>Dubai Production Tool</h3>
                    <!-- <h5 class="mb-3">Login</h5> -->
                    @if($errors->has('email'))
                    <p class="alert alert-danger">
                        {{ $errors->first('email') }}
                    </p>
                    @endif
                    @if($errors->has('password'))
                    <p class="alert alert-danger">
                        {{ $errors->first('password') }}
                    </p>
                    @endif
                </div>
                <div class="loginFormFields">
                    <form method="POST" action="{{route('AuthLogin')}}">
                        @csrf
                        <div class="formFields fieldTxt">
                            <span class="formIcon"><img src="{{asset('fassets/images/loginTxtIcon.png')}}" /></span>
                            <input name="email" type="text" class="formInput" placeholder="Enter Email Id">
                        </div>

                        <div class="formFields fieldPass">
                            <span class="formIcon"><img src="{{asset('fassets/images/loginPassIcon.png')}}" /></span>
                            <input name="password" type="password" class="formInput" placeholder="Enter Password">
                        </div>

                        <div class="loginFormBtn">
                            <div class="loginBtn text-center">
                                <span class="">
                                    <button type="submit" class="btn btn-primary w-100">Login</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="">
            </div>
        </div>
    </div>
</section>

@endsection