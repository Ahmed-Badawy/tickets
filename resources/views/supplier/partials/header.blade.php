
<header class="pt-2 main-header mb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-7 col-6">
                <a href="{{ URL::to('supplier') }}"><img class="pt-2" src="{{ asset('images/sumed.png') }}"></a>
            </div>
            <div class="col-lg-1 col-1">

                <div class="dropdown drpDown float-right">
                    <a href="#" class="mt-3" type="button" id="notificationDropdown" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        @if (count($user->notifications->where('read_at',null)))

                            <img class="notification" id="notificationimage" src="{{ asset('images/notifications-active.svg') }}"><p class="badge badge-danger" style=" position: absolute;right: -28px;top: 16px;color: #fff;border-radius:50%;font-size:9px" id="notiftcount">{{ count($user->notifications->where('read_at',null)) }}</p>
                        @else
                            <img class="notification" src="{{ asset('images/notifications-deactive.svg') }}">
                        @endif
                    </a>
                    <div class="dropdown-menu" aria-labelledby="notificationDropdown" id="notificationDropdownMenu">
                        <div class='text-center mb-0 px-3 pt-2 pb-0' style="font-size:13px">Notifications</div>


                        @foreach ($user->notifications->reverse()->take(4) as $notify)

                            <a data-id="{{ $notify->id }}" data-read="{{ $notify->read_at ? 'false':'true' }}" class="dropdown-item dropdown-item-special readNotification {{ $notify->read_at ? '':'backGray' }}" href="#">
                                <span class="pr-1">
                                    @switch($notify->status)
                                        @case('approved')
                                            <img src="{{ asset('images/check.svg') }}">
                                            @break
                                        @case('rejected')
                                            <img src="{{ asset('images/reje.svg') }}">
                                            @break
                                        @case('date')
                                            <img src="{{ asset('images/pend.svg') }}">
                                            @break
                                        @default
                                            <img src="{{ asset('images/check.svg') }}">

                                            @break
                                    @endswitch
                                </span>
                                <span>{!! $notify->content !!}</span>
                            </a>
                        @endforeach
                        <p class="text-center seeAllN mb-3 pb-3 pt-2"> <a href="{{ URL::to('supplier/allnotification') }}"> See All Notifications </a></p>

                    </div>
                </div>

            </div>
            <div class="col-1">
                <div class="vl"></div>
            </div>
            <div class="col-lg-2 col-sm-2 col-3 text-right pt-2 px-4">
                <div class="dropdown">
                        <span  class="dropdown-toggle  text-white font-weight-bold text-right" data-toggle="dropdown">
                            <span class="badge badge-danger pb-2 pt-2 px-3" style="border-radius:50px">{{ $user->company_name[0] }}</span>
                        </span>
                    <div class="dropdown-menu dropdown2" style="left:-80px">
                        <a class="dropdown-item dropdown-item-special border-top-0" href="{{ URL::to('supplier/setting') }}"><img src="{{ asset('images/setting.svg') }}" class="mr-2"> Account Setting</a>
                        <a class="dropdown-item dropdown-item-special" href="{{ URL::to('supplier/contactus') }}"><img src="{{ asset('images/notif.svg') }}" class="mr-2"> Contact Us</a>
                        <a class="dropdown-item dropdown-item-special" href="{{ URL::to('supplier/logout') }}"><i class="fa fa-sign-out-alt mr-2"></i>Logout</a>
                    </div>
                </div>
                <small  class="text-white">{{ $user->national == 1 ? 'International' : 'Loacal' }} Company</small>
            </div>
        </div>
    </div>
</header>
@if(!Request::is('*setting') && !Request::is('*contactus'))
    <div class="container">
            @switch($user->status)
                @case(0)
                    <div class="txtWorn mt-5 mb-4"><br>
                        <div class="media">
                            <img src="{{ asset('images/time.svg') }}" class="mr-3 pt-1 ml-4" alt="...">
                            <div class="media-body">
                                <h6 class="mb-0">Account Status</h6>
                                <p>Not Submitted: Please continue your company’s data submission by the
                                     {{ $user->created_at->addWeeks(2)->format('dS F') }} “Account shall be deleted after this date".</p>
                            </div>
                        </div>
                    </div>
                    @break
                @case(1)
                    <div class="txtSuccess mt-5 mb-4"><br>
                        <div class="media">
                            <img src="{{ asset('images/errorState.svg') }}" class="mr-3 ml-4 pt-1" alt="...">
                            <div class="media-body">
                                <h6 class="mb-0">Account Status</h6>
                                <p>Pending Approval: Sumed team is reviewing your data and will get back to you
                                    soon.</p>
                            </div>
                        </div>
                    </div>
                    @break
                @case(3)
                    <div class="txtSuccess mt-5 mb-4"><br>
                        <div class="media">
                            <img src="{{ asset('images/true.png') }}" class="mr-3 ml-4 pt-1" alt="...">
                            <div class="media-body">
                                <h6 class="mb-0">Account Status</h6>
                                <p>Successfully Approved: your data is approved by Arab Petroleum Pipelines Co.
                                    SUMED information system.</p>
                            </div>
                        </div>
                    </div>
                    @break
                @case(4)
                    <div class="txtSuccess mt-5 mb-4"><br>
                        <div class="media">
                            <img src="{{ asset('images/reject.svg') }}" class="mr-3 ml-4 pt-1" alt="...">
                            <div class="media-body">
                                <h6 class="mb-0">Account Status</h6>
                                <p>Rejected: your data is Rejected by Arab Petroleum Pipelines Co. SUMED
                                    information system.</p>
                            </div>
                        </div>
                    </div>
                    @break
                @case(5)
                    <div class="txtSuccess mt-5 mb-4"><br>
                        <div class="media">
                            <img src="{{ asset('images/reject.svg') }}" class="mr-3 ml-4 pt-1" alt="...">
                            <div class="media-body">
                                <h6 class="mb-0">Account Status</h6>
                                <p class="font-weight-bold">Frozen: your data is Frozen by Arab Petroleum Pipelines Co. SUMED
                                    information system.</p>
                            </div>
                        </div>
                    </div>
                    @break
                @default
                    <div class="txtSuccess mt-5 mb-4"><br>
                        <div class="media">
                            <img src="{{ asset('images/errorState.svg') }}" class="mr-3 ml-4 pt-1" alt="...">
                            <div class="media-body">
                                <h6 class="mb-0">Account Status</h6>
                                <p class="font-weight-bold">Pending Approval: Sumed team is reviewing your data and will get back to you
                                    soon.</p>
                            </div>
                        </div>
                    </div>
                    @break
            @endswitch
    </div>
@endif
