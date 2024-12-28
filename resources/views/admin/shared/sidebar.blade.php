<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{!! route('admin.dashboard') !!}">
            <img src="{!! asset('images/logo.png') !!}" alt="" class="dark-logo">
            <img src="{!! asset('images/logo.png') !!}" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="{!! route('admin.dashboard') !!}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{!! route('admin.users.index') !!}" class="dropdown-toggle no-arrow">
                        <span class="micon fi-torsos-all"></span><span class="mtext">Users</span>
                    </a>
                </li>
                <li>
                    <a href="{!! route('admin.categories.index') !!}" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-list-alt"></span><span class="mtext">Category</span>
                    </a>
                </li>
                <li>
                    <a href="{!! route('admin.brands.index') !!}" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-cogs"></span><span class="mtext">Brand</span>
                    </a>
                </li>
                <li>
                    <a href="{!! route('admin.models.index') !!}" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-car"></span><span class="mtext">Model</span>
                    </a>
                </li>
                <li>
                    <a href="{!! route('admin.vehicals.index') !!}" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-truck"></span><span class="mtext">Vehicle</span>
                    </a>
                </li>
                <li>
                    <a href="{!! route('admin.inquiries.index') !!}" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-question-circle"></span><span class="mtext">Inquiry</span>
                    </a>
                </li>
                <li>
                    <a href="{!! route('admin.feedbacks.index') !!}" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-comment"></span><span class="mtext">Feedback</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
