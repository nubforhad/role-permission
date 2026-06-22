		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand gap-3">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>

					  <div class="search-bar d-lg-block d-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
					     <a href="avascript:;" class="btn d-flex align-items-center"><i class='bx bx-search'></i>Search</a>
					  </div>

					  <div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center gap-1">
							<li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
								<a class="nav-link" href="avascript:;"><i class='bx bx-search'></i>
								</a>
							</li>
							<li class="nav-item dropdown dropdown-laungauge d-none d-sm-flex">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="avascript:;" data-bs-toggle="dropdown"><img src="assets/images/county/02.png" width="22" alt="">
								</a>
								<ul class="dropdown-menu dropdown-menu-end">
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/01.png" width="20" alt=""><span class="ms-2">English</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/02.png" width="20" alt=""><span class="ms-2">Catalan</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/03.png" width="20" alt=""><span class="ms-2">French</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/04.png" width="20" alt=""><span class="ms-2">Belize</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/05.png" width="20" alt=""><span class="ms-2">Colombia</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/06.png" width="20" alt=""><span class="ms-2">Spanish</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/07.png" width="20" alt=""><span class="ms-2">Georgian</span></a>
									</li>
									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/08.png" width="20" alt=""><span class="ms-2">Hindi</span></a>
									</li>
								</ul>
							</li>
							<li class="nav-item dark-mode d-none d-sm-flex">
								<a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i>
								</a>
							</li>
							

						</ul>
					</div>
					<!-- Right Side User Dropdown -->
					@guest
						<div class="user-box px-3">
							<a href="{{ route('login') }}" class="btn btn-primary btn-sm">
								Login
							</a>
						</div>
					@else
						<div class="user-box dropdown px-3">
							<a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
							href="#"
							role="button"
							data-bs-toggle="dropdown"
							aria-expanded="false">

								<img src="{{ asset('assets/images/avatars/avatar-2.png') }}"
									class="user-img"
									alt="user avatar">

								<div class="user-info">
									<p class="user-name mb-0">
										{{ Auth::user()->name }}
									</p>
									<p class="designattion mb-0">
										{{ Auth::user()->email }}
									</p>
								</div>
							</a>

							<ul class="dropdown-menu dropdown-menu-end">

								<li>
									<a class="dropdown-item d-flex align-items-center"
									href="#">
										<i class="bx bx-user fs-5"></i>
										<span class="ms-2">Profile</span>
									</a>
								</li>

								<li>
									<a class="dropdown-item d-flex align-items-center"
									href="#">
										<i class="bx bx-cog fs-5"></i>
										<span class="ms-2">Settings</span>
									</a>
								</li>

								<li>
									<div class="dropdown-divider mb-0"></div>
								</li>

								<li>
									<a class="dropdown-item d-flex align-items-center"
									href="{{ route('logout') }}"
									onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">
										<i class="bx bx-log-out-circle fs-5"></i>
										<span class="ms-2">Logout</span>
									</a>

									<form id="logout-form"
										action="{{ route('logout') }}"
										method="POST"
										class="d-none">
										@csrf
									</form>
								</li>

							</ul>
						</div>
					@endguest
				</nav>
			</div>
		</header>
		<!--end header -->