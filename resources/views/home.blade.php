@extends('layouts_new.app')

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
	  <ul class="breadcrumb breadcrumb-style ">
		<li class="breadcrumb-item">
		  <h4 class="page-title m-b-0">Dashboard</h4>
		</li>
		<li class="breadcrumb-item">
		  <a href="{{route('home')}}">
			<i data-feather="home"></i></a>
		</li>
		<li class="breadcrumb-item active">Dashboard</li>
	  </ul>
	  <div class="row ">
		<div class="col-xl-4 col-lg-6">
		  <div class="card l-bg-style1">
			<div class="card-statistic-3">
			  <div class="card-icon card-icon-large"><i class="fa fa-award"></i></div>
			  <div class="card-content">
				<h4 class="card-title">Facebook</h4>
				<span>0 Leads</span>
				<div class="progress mt-1 mb-1" data-height="8">
				  <div class="progress-bar l-bg-purple" role="progressbar" data-width="25%" aria-valuenow="0"
					aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<!-- p class="mb-0 text-sm">
				  <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
				  <span class="text-nowrap">Since last month</span>
				</p -->
			  </div>
			</div>
		  </div>
		</div>
		<div class="col-xl-4 col-lg-6">
		  <div class="card l-bg-style2">
			<div class="card-statistic-3">
			  <div class="card-icon card-icon-large"><i class="fa fa-briefcase"></i></div>
			  <div class="card-content">
				<h4 class="card-title">Instagram</h4>
				<span>0 Leads</span>
				<div class="progress mt-1 mb-1" data-height="8">
				  <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="0"
					aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<!--p class="mb-0 text-sm">
				  <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
				  <span class="text-nowrap">Since last month</span>
				</p -->
			  </div>
			</div>
		  </div>
		</div>
		<div class="col-xl-4 col-lg-6">
		  <div class="card l-bg-style3">
			<div class="card-statistic-3">
			  <div class="card-icon card-icon-large"><i class="fa fa-globe"></i></div>
			  <div class="card-content">
				<h4 class="card-title">Website</h4>
				<span>{{$websiteLeads}} Leads</span>
				<div class="progress mt-1 mb-1" data-height="8">
				  <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="{{$websiteLeads}}"
					aria-valuemin="0" aria-valuemax="{{$websiteLeads}}"></div>
				</div>
				<!-- p class="mb-0 text-sm">
				  <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
				  <span class="text-nowrap">Since last month</span>
				</p -->
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	  <div class="row">
		<div class="col-md-12 col-lg-6 col-xl-6 ">
		  <div class="card">
			<div class="card-header">
			  <h4>Number of Jobs</h4>
			  <div class="card-header-action">
				<ul class="nav nav-pills" role="tablist" id="chart-tabs">
				  <li class="nav-item">
					<a class="nav-link active card-tab-style" data-bs-toggle="tab" data-id="1" role="tab"
					  aria-selected="true">2017</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link card-tab-style" data-bs-toggle="tab" data-id="2" role="tab"
					  aria-selected="false">2018</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link card-tab-style" data-bs-toggle="tab" data-id="3" role="tab"
					  aria-selected="false">2019</a>
				  </li>
				</ul>
			  </div>
			</div>
			<div class="card-body">
			  <div id="chart1"></div>
			</div>
		  </div>
		</div>
		<div class="col-md-12 col-lg-6 col-xl-6 ">
		  <div class="card">
			<div class="card-header">
			  <h4>Number of Visitor on App's</h4>
			</div>
			<div class="card-body">
			  <div id="chart2"></div>
			</div>
		  </div>
		</div>
	  </div>
	</section>
	<div class="settingSidebar">
	  <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
	  </a>
	  <div class="settingSidebar-body ps-container ps-theme-default">
		<div class=" fade show active">
		  <div class="setting-panel-header">Setting Panel
		  </div>
		  <div class="p-15 border-bottom">
			<h6 class="font-medium m-b-10">Select Layout</h6>
			<div class="selectgroup layout-color w-50">
			  <label class="selectgroup-item">
				<input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
				<span class="selectgroup-button">Light</span>
			  </label>
			  <label class="selectgroup-item">
				<input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
				<span class="selectgroup-button">Dark</span>
			  </label>
			</div>
		  </div>
		  <div class="p-15 border-bottom">
			<h6 class="font-medium m-b-10">Sidebar Color</h6>
			<div class="selectgroup selectgroup-pills sidebar-color">
			  <label class="selectgroup-item">
				<input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
				<span class="selectgroup-button selectgroup-button-icon" data-bs-toggle="tooltip"
				  data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
			  </label>
			  <label class="selectgroup-item">
				<input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
				<span class="selectgroup-button selectgroup-button-icon" data-bs-toggle="tooltip"
				  data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
			  </label>
			</div>
		  </div>
		  <div class="p-15 border-bottom">
			<h6 class="font-medium m-b-10">Color Theme</h6>
			<div class="theme-setting-options">
			  <ul class="choose-theme list-unstyled mb-0">
				<li title="white" class="active">
				  <div class="white"></div>
				</li>
				<li title="cyan">
				  <div class="cyan"></div>
				</li>
				<li title="black">
				  <div class="black"></div>
				</li>
				<li title="purple">
				  <div class="purple"></div>
				</li>
				<li title="orange">
				  <div class="orange"></div>
				</li>
				<li title="green">
				  <div class="green"></div>
				</li>
				<li title="red">
				  <div class="red"></div>
				</li>
			  </ul>
			</div>
		  </div>
		  <div class="p-15 border-bottom">
			<div class="theme-setting-options">
			  <label class="m-b-0">
				<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
				  id="mini_sidebar_setting">
				<span class="custom-switch-indicator"></span>
				<span class="control-label p-l-10">Mini Sidebar</span>
			  </label>
			</div>
		  </div>
		  <div class="p-15 border-bottom">
			<div class="theme-setting-options">
			  <label class="m-b-0">
				<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
				  id="sticky_header_setting">
				<span class="custom-switch-indicator"></span>
				<span class="control-label p-l-10">Sticky Header</span>
			  </label>
			</div>
		  </div>
		  <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
			<a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
			  <i class="fas fa-undo"></i> Restore Default
			</a>
		  </div>
		</div>
	  </div>
	</div>
</div>
@endsection
      
