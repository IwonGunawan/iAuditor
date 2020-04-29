<nav class="navbar navbar-expand-sm navbar-default">

    <div class="navbar-header">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand" href="./"><img src="<?=base_url('assets/img/logo.png'); ?>" alt="Logo"></a>
        <a class="navbar-brand hidden" href="./"><img src="<?=base_url('assets/img/logo2.png'); ?>" alt="Logo"></a>
    </div>

    <div id="main-menu" class="main-menu collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="<?=menu_active('home'); ?>">
                <a href="<?=base_url('home'); ?>"> <i class="menu-icon fa fa-home"></i>Home </a>
            </li>

            <h3 class="menu-title">Data Master</h3><!-- /.menu-title -->
            <li class="<?=menu_active('employee'); ?>">
                <a href="<?=base_url('employee'); ?>"> <i class="menu-icon fa fa-user-plus"></i>Employee </a>
            </li>

            <li class="<?=menu_active('training'); ?>">
                <a href="<?=base_url('training');?>"> <i class="menu-icon fa fa-university"></i>Training Material</a>
            </li>
            
            <li class="<?=menu_active('checklist'); ?>">
                <a href="<?=base_url('checklist');?>"> <i class="menu-icon fa fa-cubes"></i>Checklist </a>
            </li>

            <h3 class="menu-title">Reports</h3><!-- /.menu-title -->
            <li>
                <a href="#"> <i class="menu-icon fa fa-bar-chart"></i>Weekly </a>
            </li>
            <li>
                <a href="#"> <i class="menu-icon fa fa-line-chart"></i>Monthly </a>
            </li>
            <li>
                <a href="#"> <i class="menu-icon fa fa-pie-chart"></i>Yearly </a>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>