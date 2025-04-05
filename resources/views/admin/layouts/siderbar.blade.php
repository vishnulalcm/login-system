<div class="section-menu-left">
    <div class="box-logo">
        <a href="index.html" id="site-logo-inner">
            <img
    id="logo_header"
    alt="Logo"
    src="{{ asset('images/logo/icon-6951393_1280.jpg') }}"
    data-light="{{ asset('images/icon-6951393_1280.jpg') }}"
    data-dark="{{ asset('images/logo/icon-6951393_1280.jpg') }}"
    style="width: 80px; height: 50px;">



        </a>
        <div class="button-show-hide">
            <i class="icon-menu-left"></i>
        </div>
    </div>
    <div class="center">
        <div class="center-item">
            {{-- <div class="center-heading">Main Home</div> --}}
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="{{ route('users-index') }}" class="">
                        <div class="icon"><i class="icon-user"></i></div>
                        <div class="text">User-task-level 1</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('users-level-one-index') }}" class="">
                        <div class="icon"><i class="icon-user"></i></div>
                        <div class="text">User-task-level 2 3</div>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</div>
