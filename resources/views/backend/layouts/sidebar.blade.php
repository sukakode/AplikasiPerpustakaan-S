<aside class="control-sidebar control-sidebar-dark">
  <div class="p-3">
    <h5 class="text-center" style="border-top: 1px solid #fff; border-bottom: 1px solid #fff; padding: 10px 0px;">Sistem Informasi Perpustakaan</h5>
    <p class="text-center">Selamat Datang</p>
    <div class="user-panel mt-3 pb-3 mb-3 text-center" >
      <img src="{{ asset('assets') }}/dist/img/UserLogo.png " class="img-circle elevation-2" style="width: 50%; padding: 2px; border: 1px solid #fff;" alt="User Image">
      <a href="#" class="d-block mt-2" style="padding: 5px; border: 1px solid #fff;">
        <span class="fa fa-user float-left "></span>
        {{ auth()->user()->name }}
      </a> 
      <h6 style="margin-bottom: 0px; padding: 5px; border: 1px solid #fff;">
        <span class="fa fa-key float-left "></span>
        <u>{{ auth()->user()->getRoleNames()->first() }}</u>
      </h6>
      <h6 style="border: 1px solid #fff;">
        <a class="d-block" style="padding: 6px;" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <span class="fa fa-sign-out-alt float-left"></span>
          Logout
        </a>
      </h6>
  
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </div>
  </div>
</aside>