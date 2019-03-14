<style>
  .navbar-default .navbar-nav > li.dropdown:hover > a, 
.navbar-default .navbar-nav > li.dropdown:hover > a:hover,
.navbar-default .navbar-nav > li.dropdown:hover > a:focus {
    background-color: rgb(231, 231, 231);
    color: rgb(85, 85, 85);
}
li.dropdown:hover > .dropdown-menu {
    display: block;
}
</style>

<div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-6 pt-1" style="padding-left: 20px;">
            <a href="<?php echo $halaman->base_path()?>"><img src="<?php echo $halaman->base_path()?>assets/img/logo.png" style="max-width: 250px" alt=""></a>
          </div>
          <div class="col-6 d-flex justify-content-end align-items-center">
            <form method="GET" action="<?php echo $halaman->base_path()?>search" class="navbar-form" role="search" autocomplete="off">
                <div class="input-group" >
                    <input type="text" class="form-control" placeholder="Search" name="key" id="key" style="border-radius: 0px;">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-xs" type="submit" style="border-radius: 0px;"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </header>

      <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
          <a class="p-2 text-muted" href="#">HOME</a>
          <a class="p-2 text-muted" href="#">ABOUT US</a>
          <a class="p-2 text-muted" href="#">OUR SERVICE</a>
          <a class="p-2 text-muted" href="#">FLEET</a>
          <a class="p-2 text-muted" href="#">GCG</a>
          <a class="p-2 text-muted" href="#">INVESTOR RELATIONS</a>
          <a class="p-2 text-muted" href="<?php echo $halaman->base_path()?>">CAREERS</a>
          <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
                  </li> -->
          <a class="p-2 text-muted" href="#">CONTACT US</a>
          <a class="p-2 text-muted" href="#">PROCUREMENT</a>
        </nav>
      </div>  
