      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{route('home')}}"> <img alt="image" src="img/companyLogo.jpeg" class="header-logo" style="height: 86px;
        width:166px;" /> <!--span
                class="logo-name">Miles Education</span -->
            </a>
          </div>
          <div class="sidebar-user">
            <div class="sidebar-user-picture">
			  <?php if(Auth::user()->gender == 'Female'){?>
              <img alt="image" src="assets/img/user.png" style="margin-top: 25px;">
			  <?php } ?>
			  <?php if(Auth::user()->gender == 'Male'){?>
              <img alt="image" src="assets/img/users/user-8.png" style="margin-top: 25px;">
			  <?php } ?>
			  <?php if(Auth::user()->gender == 'Others'){?>
			  <img alt="image" src="assets/img/users/user-1.png" style="margin-top: 25px;">
			  <?php } ?>
            </div>
            <div class="sidebar-user-details">
              <div class="user-name">{{Auth::user()->name;}}</div>
              <div class="user-role">{{Auth::user()->position;}}</div>
              <div class="sidebar-userpic-btn">
                <a href="{{route('viewProfileDetails')}}" data-bs-toggle="tooltip" title="Profile" style="margin-left: 106px;">
                  <i data-feather="user"></i>
                </a>                
                <a href="{{route('login')}}" data-bs-toggle="tooltip" title="Log Out" style="margin-right: 114px;">
                  <i data-feather="log-out"></i>
                </a>
              </div>
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
			 <li class="dropdown">
              <a href="{{route('home')}}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
			<li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="user"></i><span>Profile Management</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('ProfileManagement.employee')}}">Employee</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="users"></i><span>CRM</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('getAppEmployerUsers')}}">Employer Details</a></li>
                <li><a class="nav-link" href="{{route('getAppEmployeeUsers')}}">Candidate Details</a></li>
              </ul>
            </li>
			<!--li class="dropdown">
			    <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="clipboard"></i><span>Leads Management</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('LeadsManagement.leads')}}">Add Leads</a></li>
                </ul>
            </li>
			<li class="dropdown">
              <a href="{{route('salesList')}}" class="nav-link"><i data-feather="dollar-sign"></i><span>Sales</span></a>
            </li>
			<li class="dropdown">
              <a href="{{route('QuotationManagement.quotation')}}" class="nav-link"><i data-feather="shopping-bag"></i><span>Quotation Management</span></a>
            </li>
			<li class="dropdown">
              <a href="{{route('WorkOrder.workOrder')}}" class="nav-link"><i data-feather="book-open"></i><span>Sale Order</span></a>
            </li>
			<li class="dropdown active">
              <a href="{{route('TaskManagement.task')}}" class="nav-link"><i data-feather="check-circle"></i><span>Task</span></a>
            </li -->
			<li class="dropdown">
              <a href="{{route('EmployeeEnquiry.employeeEnquiry')}}" class="nav-link"><i data-feather="clipboard"></i><span>Candidate's Enquiry</span></a>
            </li>
			<li class="dropdown">
              <a href="{{route('EmployerEnquiry.employerEnquiry')}}" class="nav-link"><i data-feather="clipboard"></i><span>Employer's Enquiry</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="users"></i><span>Leads Management</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('LeadsManagement.leads')}}">Facebook Leads</a></li>
                <li><a class="nav-link" href="{{route('showWebsiteLeads')}}">Website's Leads</a></li>
              </ul>
            </li>
			<li class="dropdown">
              <a href="{{route('JobManagement.jobManagement')}}" class="nav-link"><i data-feather="clipboard"></i><span>Post A job</span></a>
            </li>
            <li class="dropdown">
              <a href="{{route('feedbackDetails')}}" class="nav-link"><i data-feather="clipboard"></i><span>Feedback Management</span></a>
            </li>
			<li class="menu-header">Master Modules</li>
			<li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Master Options</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('masterModules.designationDetails')}}">Designation Master</a></li>
                <li><a class="nav-link" href="{{route('masterModules.status')}}">Status Master</a></li>
                <li><a class="nav-link" href="{{route('masterModules.about')}}">Company Content Master</a></li>
              </ul>
            </li>
           </ul>
        </aside>
      </div>