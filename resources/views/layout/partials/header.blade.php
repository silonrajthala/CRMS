@php 
$userinfo=getUserDetail();
@endphp
<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
					<span class="sidebar-brand-text align-middle">
						ADMIN
					</span>
					<svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1.5"
						stroke-linecap="square" stroke-linejoin="miter" color="#FFFFFF" style="margin-left: -3px">
						<path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
						<path d="M20 12L12 16L4 12"></path>
						<path d="M20 16L12 20L4 16"></path>
					</svg>
				</a>

				

				<ul class="sidebar-nav">
					
					@php
					$menulist=getSideMenu();
					$path=Request::path();

					@endphp

					@foreach($menulist as $li)

					  @php
					  $submenulist=getSideSubMenu($li->id);


					  @endphp

					  
					 @if(count($submenulist) > 0)
					  
					 @php
						$html='';
						$isactive='';
						$collapsed='collapsed';
						$ariaexpanded='false';
						$iscollapse='collapse';

						 foreach($submenulist as $subli)
						 {
							$menuname=$subli->modulename;
							$url=$subli->url;
							$icon=$subli->icon;
							if($path=='/'.$url)
							{
								$active='active';
								$isactive='active';
								$collapsed='';
								$ariaexpanded='true';
								$iscollapse='';


							}
							else
							{
								$active='';
							}
							$html .= '<li class="sidebar-item '.$active.'"><a class="sidebar-link" href="'.url('/'.$url).'">'.$menuname.'</a></li>';
						 }
						@endphp

					<li class="sidebar-item {{$isactive}}">
						<a data-bs-target="#{{preg_replace('/\s/', '', $li->modulename)}}" data-bs-toggle="collapse" class="sidebar-link {{$collapsed}}" aria-expanded="{{$ariaexpanded}}">
							<i class="align-middle {{$li->icon}}" data-feather="layout"></i> <span class="align-middle">{{$li->modulename}}</span>
						</a>
						
						<ul id="{{preg_replace('/\s/', '', $li->modulename)}}" class="sidebar-dropdown list-unstyled {{$iscollapse}}" data-bs-parent="#sidebar">
						  @php 
						    echo $html;
						  @endphp
						</ul>
					</li>

					@else
					 @php
							if($path=='/'.$li->url)
							{
								$active='active';
							}
							else
							{
								$active='';
							}

					 @endphp
					<li class="sidebar-item {{$active}}">
						<a class="sidebar-link" href="{{url('/'.$li->url)}}">
							<i class="align-middle {{$li->icon}}" ></i> <span class="align-middle">{{$li->modulename}}</span>
						</a>
					</li>
					@endif
					@endforeach

					
				</ul>

				
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				

				

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						
						
					
						<li class="nav-item">
							<a class="nav-icon js-fullscreen d-none d-lg-block" href="#">
								<div class="position-relative">
									<i class="align-middle" data-feather="maximize"></i>
								</div>
							</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon pe-md-0 dropdown-toggle" href="#" data-bs-toggle="dropdown">
								{{$userinfo->fname.' '.$userinfo->lname}}
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="{{url('/changepassword')}}"><i class="align-middle me-1" data-feather="key"></i> Change Pasword</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{url('/logout')}}">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>