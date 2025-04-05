<div class="header-dashboard">
    <div class="wrap">
        <div class="header-left">
            <a href="index-2.html">


            <img class="" id="logo_header_mobile" alt=""
                src="{{ asset('images/logo/chrisans-final-logo.png') }}"
                data-light="{{  asset('images/logo/chrisans-final-logo.png') }}"
                data-dark="{{ asset('images/logo/chrisans-final-logo.png') }}"
                data-width="154px" data-height="52px"
                data-retina="{{ asset('images/logo/chrisans-final-logo.png') }}">




                    {{-- <img src="{{ asset('web/assets/images/logo/search-logo.png') }}" alt="Logo"> --}}
            </a>
            <div class="button-show-hide">
                <i class="icon-menu-left"></i>
            </div>



        </div>
        <div class="header-grid">

            <div class="popup-wrap message type-header">
                <div class="dropdown">
                    {{-- <button class="btn btn-secondary dropdown-toggle" type="button"
                        id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="header-item">
                            <span class="text-tiny">1</span>
                            <i class="icon-bell"></i>
                        </span>
                    </button> --}}
                    <ul class="dropdown-menu dropdown-menu-end has-content"
                        aria-labelledby="dropdownMenuButton2">
                        <li>
                            <h6>Notifications</h6>
                        </li>
                        <li>
                            <div class="message-item item-1">
                                <div class="image">
                                    <i class="icon-noti-1"></i>
                                </div>
                                <div>
                                    <div class="body-title-2">Discount available</div>
                                    <div class="text-tiny">Morbi sapien massa, ultricies at rhoncus
                                        at, ullamcorper nec diam</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="message-item item-2">
                                <div class="image">
                                    <i class="icon-noti-2"></i>
                                </div>
                                <div>
                                    <div class="body-title-2">Account has been verified</div>
                                    <div class="text-tiny">Mauris libero ex, iaculis vitae rhoncus
                                        et</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="message-item item-3">
                                <div class="image">
                                    <i class="icon-noti-3"></i>
                                </div>
                                <div>
                                    <div class="body-title-2">Order shipped successfully</div>
                                    <div class="text-tiny">Integer aliquam eros nec sollicitudin
                                        sollicitudin</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="message-item item-4">
                                <div class="image">
                                    <i class="icon-noti-4"></i>
                                </div>
                                <div>
                                    <div class="body-title-2">Order pending: <span>ID 305830</span>
                                    </div>
                                    <div class="text-tiny">Ultricies at rhoncus at ullamcorper</div>
                                </div>
                            </div>
                        </li>
                        <li><a href="#" class="tf-button w-full">View all</a></li>
                    </ul>
                </div>
            </div>




            <div class="popup-wrap user type-header">
                <div class="dropdown">

                    <button class="btn btn-secondary dropdown-toggle" type="button"
                    id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="header-user wg-user d-flex align-items-center">
                        <span class="image">
                            <img src="{{ Auth::check() && Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/avatar/user-1.png') }}"
                            alt="User Image" style="width: 40px; height: 40px; border-radius: 50%;">

                        </span>
                        <span class="d-flex flex-column ms-2">
                            <span class="body-title mb-1"> <b>{{ Auth::user()->name ?? '' }}</b></span>
                            <span class="text-tiny">Admin</span>
                        </span>
                    </span>
                </button>
                    {{-- <button class="btn btn-secondary dropdown-toggle" type="button"
                        id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="header-user wg-user">
                            <span class="image">
                                <img src="images/avatar/user-1.png" alt="">
                            </span>
                            <span class="flex flex-column">
                                <span class="body-title mb-2">{{ Auth()->user->name ?? '' }}</span>
                                <span class="text-tiny">Admin</span>
                            </span>
                        </span>
                    </button> --}}
                    <ul class="dropdown-menu dropdown-menu-end has-content"
                        aria-labelledby="dropdownMenuButton3">
                        <li>
                            <a href="" class="user-item">
                                <div class="icon">
                                    <i class="icon-user"></i>
                                </div>
                                <div class="body-title-2">Account</div>
                            </a>
                        </li>

                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                                @csrf
                                <button type="submit" class="user-item logout-btn">
                                    <div class="icon">
                                        <i class="icon-log-out"></i>
                                    </div>
                                    <div class="body-title-2">Log out</div>
                                </button>
                            </form>
                        </li>
                        {{-- <li>
                            <a href="#" class="user-item">
                                <div class="icon">
                                    <i class="icon-mail"></i>
                                </div>
                                <div class="body-title-2">Inbox</div>
                                <div class="number">27</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="user-item">
                                <div class="icon">
                                    <i class="icon-file-text"></i>
                                </div>
                                <div class="body-title-2">Taskboard</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="user-item">
                                <div class="icon">
                                    <i class="icon-headphones"></i>
                                </div>
                                <div class="body-title-2">Support</div>
                            </a>
                        </li> --}}


                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
