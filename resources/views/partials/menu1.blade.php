<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="/">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('customs_clearance_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/shipping-and-clearances*") ? "menu-open" : "" }} {{ request()->is("admin/invoices*") ? "menu-open" : "" }} {{ request()->is("admin/invoice-translates*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.customsClearance.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('shipping_and_clearance_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.shipping-and-clearances.index") }}" class="nav-link {{ request()->is("admin/shipping-and-clearances") || request()->is("admin/shipping-and-clearances/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.shippingAndClearance.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('receipt_voucher_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.receipt-vouchers.index") }}" class="nav-link {{ request()->is("admin/receipt-vouchers") || request()->is("admin/receipt-vouchers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-invoice">

                                        </i>
                                        <p>
                                            {{ trans('cruds.receiptVoucher.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('invoice_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.invoices.index") }}" class="nav-link {{ request()->is("admin/invoices") || request()->is("admin/invoices/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.invoice.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('invoice_translate_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.invoice-translates.index") }}" class="nav-link {{ request()->is("admin/invoice-translates") || request()->is("admin/invoice-translates/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.invoiceTranslate.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('client_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.clients.index") }}" class="nav-link {{ request()->is("admin/clients") || request()->is("admin/clients/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon far fa-address-book">

                            </i>
                            <p>
                                {{ trans('cruds.client.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('domestic_shipping_access')
                    <li class="nav-item has-treeview {{ request()->is("admin.receiptdeliveries*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.other.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            @can('receiptdelivery_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.receiptdeliveries.index") }}" class="nav-link {{ request()->is("admin/receiptdeliveries") || request()->is("admin/receiptdeliveries/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-signature">

                                        </i>
                                        <p>
                                            {{ trans('cruds.receiptdelivery.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('car_permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.car-permissions.index") }}" class="nav-link {{ request()->is("admin/car-permissions") || request()->is("admin/car-permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.carPermission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('domestic_shipping_access')


                    {{--                    <li>--}}
                    {{--                        <a class="has-arrow" id="employee" href="#" aria-expanded="false"><span class="educate-icon educate-course icon-wrap"></span><span class="mini-click-non"> {{ __('adminmenu.employee_affairs') }}</span></a>--}}
                    {{--                        <ul class="submenu-angle page-mini-nb-dp" aria-expanded="false">--}}
                    {{--                            <li><a  href="{{url('manageemployee')}}"><span class="mini-sub-pro">{{ __('adminmenu.manage_employee') }}</span></a></li>--}}
                    {{--                            <li><a  href="{{url('orgstructure')}}"><span class="mini-sub-pro">{{ __('adminmenu.org_structure') }}</span></a></li>--}}
                    {{--                            <li><a  href="#"><span class="mini-sub-pro"> {{ __('adminmenu.attendance_departure') }}</span></a></li>--}}
                    {{--                            <li><a  href="#"><span class="mini-sub-pro"> {{ __('adminmenu.manage_salary') }}</span></a></li>--}}
                    {{--                            <li><a  href="#"><span class="mini-sub-pro"> {{ __('adminmenu.employee_settings') }}</span></a></li>--}}
                    {{--                        </ul>--}}
                    {{--                    </li>--}}


                    <li class="nav-item">
                        <a href="{{ route("admin.HRIndex") }}" class="nav-link {{ request()->is("admin/HRIndex") || request()->is("admin/HRIndex/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon far fa-user">

                            </i>
                            <p>
                                {{ trans('hr.mainHr') }}
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route("admin.financesIndex.index") }}" class="nav-link {{ request()->is("admin/financesIndex") || request()->is("admin/financesIndex/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-deaf">

                            </i>
                            <p>
                                {{ trans('cruds.finance.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('setting_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/invoices-types*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.setting.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('invoices_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.invoices-types.index") }}" class="nav-link {{ request()->is("admin/invoices-types") || request()->is("admin/invoices-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.invoicesType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('printsetting_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.printsetting.index") }}" class="nav-link {{ request()->is("admin/printsetting") || request()->is("admin/printsetting/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.printsetting.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('carslist_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.carslists.index") }}" class="nav-link {{ request()->is("admin/carslists") || request()->is("admin/carslists/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-luggage-cart">

                                        </i>
                                        <p>
                                            {{ trans('cruds.carslist.title') }}
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route("admin.cardriver.index") }}" class="nav-link {{ request()->is("admin/cardriver") || request()->is("admin/cardriver/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-luggage-cart">

                                        </i>
                                        <p>
                                            سائقين السيارات
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('payment_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.payment-types.index") }}" class="nav-link {{ request()->is("admin/payment-types") || request()->is("admin/payment-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.paymentType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('service_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.services.index") }}" class="nav-link {{ request()->is('admin/services') || request()->is('admin/services/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-cogs nav-icon">

                                        </i>
                                        {{ trans('cruds.service.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                        <p>{{ trans('global.logout') }}</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
