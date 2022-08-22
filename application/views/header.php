<!DOCTYPE html>
<html>
  <head>
    <title><?= !empty($title) ? $title:""?><?= NAME ?> | CI - HMS</title>
    <meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link href="<?= base_url() ?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
	        rel="stylesheet">
	<link href="<?= base_url() ?>css/font-awesome.css" rel="stylesheet">
	<link href="<?= base_url() ?>css/style.css" rel="stylesheet">
	<link href="<?= base_url() ?>css/pages/dashboard.css" rel="stylesheet">
	<link href="<?= base_url() ?>css/pages/signin.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url() ?>js/guidely/guidely.css" rel="stylesheet"> 


	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	    <![endif]-->
  </head>
  <body style="margin-bottom: 50px;">
  <div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="<?= base_url() ?>"><i class="icon-building"></i> <?=NAME?></a>
      <?php
        if(UID){?>
          <div class="nav-collapse">
            <ul class="nav pull-right">
              <!-- <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                class="icon-cog"></i> Account <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="javascript:;">Settings</a></li>
                  <li><a href="javascript:;">Help</a></li>
                </ul>
              </li> -->
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                  class="icon-user"></i> <?=FULLNAME?> (<?=USERNAME?>) <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?= base_url() ?>login/logout">Logout</a></li>
                  </ul>
                </li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Stadion Malang Kabupaten</a>
                </li>
              </ul>
              <form class="navbar-search pull-right" action="<?= base_url() ?>search" method="POST">
                <input type="text" name="customer" class="search-query" placeholder="Search Customer">
              </form>
          </div>
          <!--/.nav-collapse --> 
      <?php } ?>
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<?php
  if(UID)
{?>
      <div class="subnavbar">
        <div class="subnavbar-inner">
          <div class="container">
            <ul class="mainnav">
              <li <?php if($page == "dashboard"){ echo 'class="active"'; } ?>><a href="<?= base_url() ?>"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
              <li <?php if($page == "employee"){ echo 'class="active"'; } ?>><a href="<?= base_url() ?>employee"><i class="icon-user"></i><span>Employees</span> </a> </li>
              <li <?php if($page == "reservation"){ echo 'class="active"'; } ?>><a href="<?= base_url() ?>reservation"><i class="icon-list-alt"></i><span>Reservation</span> </a> </li>
              <li class="dropdown <?php if($page == "facility" || $page == "facility_type"){ echo 'active'; } ?>"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-home"></i><span>Facilities</span> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?= base_url() ?>facility">Facilities</a></li>
                  <li><a href="<?= base_url() ?>facility-type">Facility Types</a></li>
                </ul>
          </div>
          <!-- /container --> 
        </div>
        <!-- /subnavbar-inner --> 
      </div>
<?php } ?>
<!-- /subnavbar -->