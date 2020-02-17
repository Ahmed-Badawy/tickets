@extends('Admin.layouts.admin-layout')

@push('styles')
    @include('Admin.common.styles')
    <link rel="stylesheet" href="{{ $resources }}css/admin/login.css">
@endpush

@section('title','Sumed Login')


@section('content')
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="{{ $resources }}images/common/user.png" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form action="{{route('admin.login.submit')}}" method="post">
      @csrf
      <input type="text" id="login" class="fadeIn second" name="email" placeholder="E-mail">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <!-- <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div> -->

  </div>
</div>
@endsection
