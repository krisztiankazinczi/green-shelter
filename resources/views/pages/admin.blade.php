@extends('layouts.index')

@section('title', 'Admin Felület')

@section('content')

<div id="adminSideNav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a 
    href="{{ route('admin.adoption', ['type' => 'requested']) }}"
    class="{{ last(request()->segments()) == 'requested' ? 'active-admin-menu' : '' }}"
  >Befogadási kérések</a>
  <a 
    href="{{ route('admin.adoption', ['type' => 'rejected']) }}"
    class="{{ last(request()->segments()) == 'rejected' ? 'active-admin-menu' : '' }}"
  >Elutasított kérések</a>
  <a 
    href="{{ route('admin.adoption', ['type' => 'adopted']) }}"
    class="{{ last(request()->segments()) == 'adopted' ? 'active-admin-menu' : '' }}"  
  >Befogadások</a>
</div>

<i class="fas fa-bars" id="sidenav-open" onclick="openNav()"></i>

<div id="main">
    @if (last(request()->segments()) == 'requested')
      @isset($requests)
        @include('partials.admin.adoption_requests', ['title' => 'Befogadási kérelmek', 'requests' => $requests])
      @endisset
    @elseif (last(request()->segments()) == 'rejected')
      @isset($requests)
        @include('partials.admin.rejected_requests', ['title' => 'Elutasított kérések', 'requests' => $requests])
      @endisset
    @elseif (last(request()->segments()) == 'adopted')
      @isset($requests)
        @include('partials.admin.adopted_requests', ['title' => 'Befogadott állatok', 'requests' => $requests])
      @endisset
    @endif
</div>

<style>
.sidenav {
  margin-top: 6vh;
  height: 94vh; 
  width: 250px; 
  position: fixed; 
  z-index: 2; 
  top: 0; 
  left: 0;
  background-color: #111; 
  overflow-x: hidden; 
  padding-top: 60px; 
  transition: 0.5s;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 18px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.active-admin-menu {
  color:  white !important;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

#main {
  transition: margin-left .5s;
  padding: 20px;
  margin-left: 250px;
}

#sidenav-open {
  position: fixed;
  top: 6vh;
  left: 30px;
  z-index: 1;
  font-size: 25px;
  padding: 10px;
  box-shadow: 0 0 10px 4px rgba(0, 0, 0, .15);
  cursor: pointer;
  visibility: hidden;
  transition: all 0.5s ease;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidenav {
    padding-top: 15px;
  }
  .sidenav a {font-size: 18px;}
}

@media screen and (max-width: 600px) {
  .sidenav {
    width: 0;
  }

  #main {
    margin-left: 80px;
  }

  #sidenav-open {
    visibility: visible;
  }
}

</style>

<script>

function openNav() {
  document.getElementById("adminSideNav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  document.getElementById("sidenav-open").style.visibility = "hidden";
}

function closeNav() {
  document.getElementById("adminSideNav").style.width = "0";
  document.getElementById("main").style.marginLeft = "80px";
  document.getElementById("sidenav-open").style.visibility = "visible";
}

</script>

@endsection