<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{ route('payroll-dashboard') }}"><img src="{{ asset('assets/images/svg/mgs-logo-2.svg') }}" alt="Logo" srcset=""></a>
                </div>
                <div class="sidebar-toggler  x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item  {{ (request()->is('payroll')) ? 'active' : ''}}">
                    <a href="{{ route('payroll-dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub {{ (request()->is('payroll/employees/*')) ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-fill-gear"></i>
                        <span>Manage Employee</span>
                    </a>

                    <ul class="submenu {{ (request()->is('payroll/employees/*')) ? 'active' : '' }}">
                        <li class="submenu-item  {{ (request()->is('payroll/employees/list')) ? 'active' : '' }}">
                            <a href="{{ route('employee.list') }}" class="submenu-link">Employees</a>
                        </li>

                        <li class="submenu-item  {{ (request()->is('payroll/employees/create')) ? 'active' : '' }}">
                            <a href="{{ route('employees.create') }}" class="submenu-link">Create Employee</a>
                        </li>
                    </ul>
                </li> {{-- end of manage employee menu --}}

                <li class="sidebar-item  has-sub {{ (request()->is('payroll/time-record/*')) ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-calendar-fill"></i>
                        <span>Manage DTR</span>
                    </a>

                    <ul class="submenu {{ (request()->is('payroll/time-record/*')) ? 'active' : '' }}">
                        <li class="submenu-item  {{ (request()->is('payroll/time-record/employee-time-record-index')) ? 'active' : '' }}">
                            <a href="{{ route('employee-time-record-index') }}" class="submenu-link">Employee Time Record</a>
                        </li>
                    </ul>
                </li> {{-- end of manage time record menu --}}

                <li class="sidebar-item has-sub {{ (request()->is('payroll/manage-payroll/*')) ? 'active' : '' }}">
                    <a href="#" class='sidebar-link {{ (request()->is('payroll/manage-payroll/*')) ? 'active' : '' }}'>
                        <i class="bi bi-wallet-fill"></i>
                        <span>Manage Payroll</span>
                    </a>

                    <ul class="submenu ">
                        <li class="submenu-item  {{ (request()->is('payroll/manage-payroll/cash-advance')) ? 'active' : '' }}">
                            <a href="{{route('cash.advance.index')}}" class="submenu-link">Cash Advance</a>
                        </li>
                        <li class="submenu-item  {{ (request()->is('payroll/manage-payroll/employee-payslip')) ? 'active' : '' }}">
                            <a href="{{route('employee.payslip.index')}}" class="submenu-link">Payslip</a>
                        </li>
                    </ul>
                </li> {{-- end of manage payroll menu --}}

                <li class="sidebar-item has-sub {{ (request()->is('payroll/working-sites/*')) ? 'active' : '' }}">
                    <a href="#" class='sidebar-link {{ (request()->is('payroll/working-sites/*')) ? 'active' : '' }}'>
                        <i class="bi bi-buildings-fill"></i>
                        <span>Manage Working Site</span>
                    </a>

                    <ul class="submenu {{ (request()->is('payroll/working-sites/*')) ? 'active' : '' }}">
                        <li class="submenu-item {{ (request()->is('payroll/working-sites/working-sites-index')) ? 'active' : '' }} ">
                            <a href="{{ route('working.sites.index') }}" class="submenu-link">Sites</a>
                        </li>
                        <li class="submenu-item  {{ (request()->is('payroll/working-sites/working-sites-salary-expenses-index')) ? 'active' : '' }}">
                            <a href="{{ route('working.sites.salary.expenses.index') }}" class="submenu-link">Site salary expenses</a>
                        </li>
                    </ul>
                </li> {{-- end of manage working site menu --}}

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-database-fill"></i>
                        <span>Backup</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item  ">
                            <a href="form-validation-parsley.html" class="submenu-link">Backup DB</a>
                        </li>
                    </ul>
                </li> {{-- end of backup menu --}}
            </ul>
        </div>
    </div>
</div>