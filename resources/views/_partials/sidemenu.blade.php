<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <div class="pcoded-navigation-label"></div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ request()->segment(1) == 'dashboard' ? 'active pcoded-trigger' : '' }}">
                    <a href="{{ url('dashboard') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="fa fa-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="{{ request()->segment(1) == 'activity' ? 'active pcoded-trigger' : ''  }}">
                    <a href="{{ url('activity') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="fas fa-columns"></i></span>
                        <span class="pcoded-mtext">Activities</span>
                    </a>
                </li>
                <li class="{{ request()->segment(1) == 'leads' ? 'active pcoded-trigger' : ''  }}">
                    <a href="{{ url('leads') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="fa fa-users"></i></span>
                        <span class="pcoded-mtext">Leads</span>
                    </a>
                </li>
                <li class="{{ request()->segment(1) == 'prospects' ? 'active pcoded-trigger' : ''  }}">
                    <a href="{{ url('prospects') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="fa fa-binoculars"></i></span>
                        <span class="pcoded-mtext">Prospects</span>
                    </a>
                </li>
                <li class="{{ request()->segment(1) == 'customer' ? 'active pcoded-trigger' : ''  }}">
                    <a href="{{ url('customer') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="fa fa-users"></i></span>
                        <span class="pcoded-mtext">Customers</span>
                    </a>
                </li>
                <li class="{{ request()->segment(1) == 'opportunities' ? 'active pcoded-trigger' : ''  }}">
                    <a href="{{ url('opportunities') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="fa fa-bolt"></i></span>
                        <span class="pcoded-mtext">Opportunities</span>
                    </a>
                </li>
                 <li class="{{ request()->segment(1) == 'companies' ? 'active pcoded-trigger' : ''  }}">
                    <a href="{{ url('companies') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="fa fa-building"></i></span>
                        <span class="pcoded-mtext">Companies</span>
                    </a>
                </li>
                <li class="{{ request()->segment(1) == 'qualification-questions' ? 'active pcoded-trigger' : ''  }}">
                    <a href="{{ route('qualification-questions.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="fa fa-file-archive"></i></span>
                        <span class="pcoded-mtext">Questionnaires</span>
                    </a>
                </li>
                <li class="{{ request()->segment(1) == 'team' ? 'active pcoded-trigger' : ''  }}">
                    <a href="{{ route('team.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="fa fa-users"></i></span>
                        <span class="pcoded-mtext">Team</span>
                    </a>
                </li>
                <li class="{{ request()->segment(1) == 'target' ? 'active pcoded-trigger' : ''  }}">
                    <a href="{{ url('target') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="fa fa-bullseye"></i></span>
                        <span class="pcoded-mtext">Targets</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
