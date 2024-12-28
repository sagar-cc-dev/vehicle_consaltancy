<div class="header d-flex justify-content-between align-items-center px-3">
    <div class="menu-icon dw dw-menu"></div>
    <div class="user-info-dropdown dropdown">
        <a class="dropdown-toggle d-flex align-items-center" href="#" role="button" data-toggle="dropdown">
            <span class="user-icon">
                <img src="{!! asset('images/profile-photo.jpg') !!}" alt="">
            </span>
            <span class="user-name ml-2">{!! Auth::user()->name !!}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
            <a class="dropdown-item" href="{!! route('admin.profile') !!}">
                <i class="dw dw-user"></i> Profile
            </a>
            <a class="dropdown-item" href="{!! route('logout') !!}" data-method="delete" data-confirm="Are you sure want to logout?">
                <i class="dw dw-logout"></i> Log Out
            </a>
        </div>
    </div>
</div>
