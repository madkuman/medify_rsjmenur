
    <div class="content-header content-header-fullrow px-15">
      <!-- Mini Mode -->
      <div class="content-header-section sidebar-mini-visible-b">
        <!-- Logo -->
        <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
          <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
        </span>
        <!-- END Logo -->
      </div>
      <!-- END Mini Mode -->

      <!-- Normal Mode -->
      <div class="content-header-section text-center align-parent sidebar-mini-hidden">
        <!-- Close Sidebar, Visible only on mobile screens -->
        <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
        <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
          <i class="fa fa-times text-danger"></i>
        </button>
        <!-- END Close Sidebar -->

        <!-- Logo -->
        <div class="content-header-item">
          <a class="link-effect font-w600" href="{{url('')}}">
            <span class="d-none d-md-inline-block">
              <span class="font-size-xl text-black"> {{config('app.name')}}</span>
            </span>
          </a>
        </div>
        <!-- END Logo -->
      </div>
      <!-- END Normal Mode -->
    </div>