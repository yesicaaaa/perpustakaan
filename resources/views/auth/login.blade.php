@extends('layout.template')
@section('title', 'Masuk | Fiore Library')
@section('css', 'auth.css')
@section('content')
<div class="container-auth">
    <h3>Fiore <span>Library</span></h3>
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-floating mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
            <label for="email">Email</label>
            <div class="invalid-feedback">
                @error('email')
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
            <label for="password">Password</label>
            <div class="invalid-feedback">
                @error('password')
                {{$message}}
                @enderror
            </div>
        </div>
        <button class="btn btn-auth" disabled>Masuk</button>
        <button class="btn btn-auth btn-disabled" disabled>Tunggu Sebentar <i class="spinner-border text-light"></i></button>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('.btn-disabled').hide();
        $('#email').on('keypress', function() {
            if ($('#email').val().length >= 1) {
                $('#password').focus();
            }
        });
        $('#password').on('keypress', function() {
            $('.btn-auth').removeAttr('disabled');
        });
        $('.btn-auth').on('click', function() {
            $('.btn-auth').hide();
            $('.btn-disabled').show();
        })
    });
</script>
@endsection