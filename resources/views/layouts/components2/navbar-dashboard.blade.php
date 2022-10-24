
<header id="page-header" class="header-has-logo ">
    
    <div class="content-header">
        <div class="content-header-logo">
            <div class="d-inline-block">
            </div>
        </div>

        <div class="content-header-section">
            <div class="row no-gutters">
                <div class="col">
                    <button type="button" class="btn btn-dual-secondary d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                        <i class="fa fa-navicon"></i>
                    </button>
                </div>
                <div class="col text-right">
                   <div class="btn-group" id="notifications" role="group">
                    <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-notification-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="badge badge-primary" id="notification-counter"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right min-width-320" id="notification-dropdown" aria-labelledby="page-header-notification-dropdown" x-placement="bottom-end" style="position: absolute; transform: translate3d(-57px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                    </div>
                    <form method="POST" action="{{url('')}}/api/notification/mark_as_read" id="markAsRead">
                        {{csrf_field()}}
                        <input type="hidden" id="notificationID" name="id">
                        <input type="hidden" id="notificationURL" name="url">
                    </form>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->name}}<i class="fa fa-angle-down ml-5"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right min-width-150" aria-labelledby="page-header-user-dropdown" x-placement="bottom-end" style="position: absolute; transform: translate3d(-57px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="{{route('profil', ['id' => Auth::user()->id])}}">
                            <i class="si si-user mr-5"></i> Profile
                        </a>
                        <a class="dropdown-item" href="{{url('settings/account')}}" data-toggle="layout" data-action="side_overlay_toggle">
                            <i class="si si-wrench mr-5"></i> Settings
                        </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{url('logout')}}">
                            <i class="si si-logout mr-5"></i> Sign Out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</header>


@include('layouts.components2.sidebar')