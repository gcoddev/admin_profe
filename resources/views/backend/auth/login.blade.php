@extends('backend.auth.auth_master')

@section('auth_title')
    Login | Admin Panel
@endsection

@section('auth-content')
    <section class="login-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <form class="md-float-material form-material" method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf
                        <div class="text-center">
                            <img src="{{ asset('backend/image/logoprofe.png')}}" class="col-sm-6" alt="logoprofe.png"  />
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center">Iniciar sesión</h3>
                                    </div>
                                </div>
                                @include('backend.layouts.partials.messages')
                                <div class="form-group form-primary">
                                    <input type="text" name="correo" class="form-control" required
                                        placeholder="Su dirección de correo electrónico" />
                                    @error('correo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="form-bar"></span>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="password" name="password" class="form-control" required
                                        placeholder="Contraseña" />
                                    <span class="form-bar"></span>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>

                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button id="form_submit" type="submit"
                                            class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">
                                            Iniciar sesión
                                        </button>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Gracias.</p>
                                        <p class="text-inverse text-left">
                                            <a href="https://profe.minedu.gob.bo/"><b class="f-w-600">Volver al sitio web</b></a>
                                        </p>
                                    </div>
                                    {{-- <div class="col-md-2">
                                        <img src="../files/assets/images/auth/Logo-small-bottom.png" alt="small-logo.png" />
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- login area start -->

    <!-- login area end -->
@endsection
