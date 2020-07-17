<div style="min-height: 100%" class="flex-row d-flex align-itemsstretch m-0">
    <div class="polished-sidebar bg-light col-12 col-md-3 col-lg-2
p-0 collapse d-md-inline" id="sidebar-nav">
        <ul class="polished-sidebar-menu ml-0 pt-4 p-0 d-md-block">
            <input class="border-dark form-control d-block d-md-none
mb-4" type="text" placeholder="Search" aria-label="Search" />
            <li><a href="/home"><span class="oi oi-home"></span>
                    Home</a></li> 
                    <li><a href="{{ route('user.index') }}"><span class="oi oi-person"></span>
                    List users</a></li>

                    <div class="d-block d-md-none">
                        <div class="dropdown-divider"></div>
                        <li><a href="#"> Profile</a></li>
                        <li><a href="#"> Setting</a></li>
                        <li>
                            <form action="{{ route("logout") }}" method="POST">
                                @csrf
                                <button class="dropdown-item" style="cursor:pointer">Sign Out</button>
                            </form>
                        </li>
                    </div>
                </ul>
                <div class="pl-3 d-none d-md-block position-fixed" style="bottom: 0px">
                    <span class="oi oi-cog"></span> Setting
                </div>
            </div>