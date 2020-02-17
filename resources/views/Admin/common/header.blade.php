<header class="col-md-12" style="height: 75px;background-color: #068cb1;">
  <div class="col-md-2 float-right"  style="text-align: right;">
    <img src="{{asset('images/common/logo.png')}}" alt="" style="height: 50px;">
  </div>
  <div class="col-md-2" >
      <i style="font-family: Georgia, serif; font-size: 16px;color: white;">Welcome {{$admin->name}}</i>
      <a style="color: #fd5e1a; text-decoration: underline;" href="{{route('admin.logout')}}">logout</a>
  </div>

</header>
