<!-- Sidebar -->
<div class="sidebar" data-color="orange" data-background-color="white">
    <!-- Brand Logo -->
    <div class="logo">
        <a href="#" class="simple-text logo-normal">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <!-- Sidebar Menu -->
    <div class="sidebar-wrapper">
        <ul class="nav" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route("frontend.home") }}" class="nav-link">
                    <p>
                        <i class="fas fa-fw fa-tachometer-alt">

                        </i>
                        <span>{{ trans('global.dashboard') }}</span>
                    </p>
                </a>
            </li>
            @can('user_management_access')
                <li class="nav-item has-treeview {{ request()->is('frontend/permissions*') ? 'menu-open' : '' }} {{ request()->is('frontend/roles*') ? 'menu-open' : '' }} {{ request()->is('frontend/users*') ? 'menu-open' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#user_management">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <p>
                            <span>{{ trans('cruds.userManagement.title') }}</span>
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse show" id="user_management">
                        <ul class="nav">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("frontend.permissions.index") }}" class="nav-link {{ request()->is('frontend/permissions') || request()->is('frontend/permissions/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-unlock-alt">

                                        </i>
                                        <span>{{ trans('cruds.permission.title') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("frontend.roles.index") }}" class="nav-link {{ request()->is('frontend/roles') || request()->is('frontend/roles/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-briefcase">

                                        </i>
                                        <span>{{ trans('cruds.role.title') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("frontend.users.index") }}" class="nav-link {{ request()->is('frontend/users') || request()->is('frontend/users/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-user">

                                        </i>
                                        <span>{{ trans('cruds.user.title') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan
            @can('expense_management_access')
                <li class="nav-item has-treeview {{ request()->is("frontend/expense-categories*") ? "menu-open" : "" }} {{ request()->is("frontend/income-categories*") ? "menu-open" : "" }} {{ request()->is("frontend/expenses*") ? "menu-open" : "" }} {{ request()->is("frontend/incomes*") ? "menu-open" : "" }} {{ request()->is("frontend/expense-reports*") ? "menu-open" : "" }}">
                    <a class="nav-link" data-toggle="collapse" href="#expense_managment">
                        <i class="fa-fw nav-icon fas fa-money-bill">

                        </i>
                        <p>
                            {{ trans('cruds.expenseManagement.title') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse hide" id="expense_managment">
                        <ul class="nav nav-treeview">
                            @can('expense_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("frontend.expense-categories.index") }}" class="nav-link {{ request()->is("frontend/expense-categories") || request()->is("frontend/expense-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-list">

                                        </i>
                                        <p>
                                            {{ trans('cruds.expenseCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('income_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("frontend.income-categories.index") }}" class="nav-link {{ request()->is("frontend/income-categories") || request()->is("frontend/income-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-list">

                                        </i>
                                        <p>
                                            {{ trans('cruds.incomeCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('expense_access')
                                <li class="nav-item">
                                    <a href="{{ route("frontend.expenses.index") }}" class="nav-link {{ request()->is("frontend/expenses") || request()->is("frontend/expenses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-arrow-circle-right">

                                        </i>
                                        <p>
                                            {{ trans('cruds.expense.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('income_access')
                                <li class="nav-item">
                                    <a href="{{ route("frontend.incomes.index") }}" class="nav-link {{ request()->is("frontend/incomes") || request()->is("frontend/incomes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-arrow-circle-right">

                                        </i>
                                        <p>
                                            {{ trans('cruds.income.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('expense_report_access')
                                <li class="nav-item">
                                    <a href="{{ route("frontend.expense-reports.index") }}" class="nav-link {{ request()->is("frontend/expense-reports") || request()->is("frontend/expense-reports/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-chart-line">

                                        </i>
                                        <p>
                                            {{ trans('cruds.expenseReport.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan
            @can('product_management_access')
                <li class="nav-item has-treeview {{ request()->is("frontend/product-tags*") ? "menu-open" : "" }} {{ request()->is("frontend/products*") ? "menu-open" : "" }}">
                    <a class="nav-link" data-toggle="collapse" href="#product_management">

                        <i class="fa-fw nav-icon fas fa-shopping-cart">

                        </i>
                        <p>
                            {{ trans('cruds.productManagement.title') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse hide" id="product_management">

                        <ul class="nav nav-treeview">
                            @can('product_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("frontend.product-tags.index") }}" class="nav-link {{ request()->is("frontend/product-tags") || request()->is("frontend/product-tags/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.productTag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('product_access')
                                <li class="nav-item">
                                    <a href="{{ route("frontend.products.index") }}" class="nav-link {{ request()->is("frontend/products") || request()->is("frontend/products/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-shopping-cart">

                                        </i>
                                        <p>
                                            {{ trans('cruds.product.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan
            @can('basic_c_r_m_access')
                <li class="nav-item has-treeview {{ request()->is("frontend/crm-statuses*") ? "menu-open" : "" }} {{ request()->is("frontend/crm-customers*") ? "menu-open" : "" }} {{ request()->is("frontend/crm-notes*") ? "menu-open" : "" }} {{ request()->is("frontend/crm-documents*") ? "menu-open" : "" }}">
                    <a class="nav-link" data-toggle="collapse" href="#basic_c_r_m_access">
                        <i class="fa-fw nav-icon fas fa-briefcase">

                        </i>
                        <p>
                            {{ trans('cruds.basicCRM.title') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse hide" id="basic_c_r_m_access">
                        <ul class="nav nav-treeview">
                            @can('crm_status_access')
                                <li class="nav-item">
                                    <a href="{{ route("frontend.crm-statuses.index") }}" class="nav-link {{ request()->is("frontend/crm-statuses") || request()->is("frontend/crm-statuses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmStatus.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('crm_customer_access')
                                <li class="nav-item">
                                    <a href="{{ route("frontend.crm-customers.index") }}" class="nav-link {{ request()->is("frontend/crm-customers") || request()->is("frontend/crm-customers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-plus">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmCustomer.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('crm_note_access')
                                <li class="nav-item">
                                    <a href="{{ route("frontend.crm-notes.index") }}" class="nav-link {{ request()->is("frontend/crm-notes") || request()->is("frontend/crm-notes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-sticky-note">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmNote.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('crm_document_access')
                                <li class="nav-item">
                                    <a href="{{ route("frontend.crm-documents.index") }}" class="nav-link {{ request()->is("frontend/crm-documents") || request()->is("frontend/crm-documents/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmDocument.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan
            @can('appointment_access')
                <li class="nav-item">
                    <a href="{{ route("frontend.appointments.index") }}" class="nav-link {{ request()->is("frontend/appointments") || request()->is("frontend/appointments/*") ? "active" : "" }}">
                        <i class="fa-fw nav-icon fas fa-cogs">

                        </i>
                        <p>
                            {{ trans('cruds.appointment.title') }}
                        </p>
                    </a>
                </li>
            @endcan
            @can('asset_management_access')
                <li class="nav-item has-treeview {{ request()->is("frontend/asset-categories*") ? "menu-open" : "" }} {{ request()->is("frontend/asset-locations*") ? "menu-open" : "" }} {{ request()->is("frontend/asset-statuses*") ? "menu-open" : "" }} {{ request()->is("frontend/assets*") ? "menu-open" : "" }} {{ request()->is("frontend/assets-histories*") ? "menu-open" : "" }}">
                    <a class="nav-link" data-toggle="collapse" href="#asset_management_access">

                        <i class="fa-fw nav-icon fas fa-book">

                        </i>
                        <p>
                            {{ trans('cruds.assetManagement.title') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse hide" id="asset_management_access">
                        <ul class="nav nav-treeview">
                            @can('asset_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("frontend.asset-categories.index") }}" class="nav-link {{ request()->is("frontend/asset-categories") || request()->is("frontend/asset-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tags">

                                        </i>
                                        <p>
                                            {{ trans('cruds.assetCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('asset_location_access')
                                <li class="nav-item">
                                    <a href="{{ route("frontend.asset-locations.index") }}" class="nav-link {{ request()->is("frontend/asset-locations") || request()->is("frontend/asset-locations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-map-marker">

                                        </i>
                                        <p>
                                            {{ trans('cruds.assetLocation.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('asset_status_access')
                                <li class="nav-item">
                                    <a href="{{ route("frontend.asset-statuses.index") }}" class="nav-link {{ request()->is("frontend/asset-statuses") || request()->is("frontend/asset-statuses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-server">

                                        </i>
                                        <p>
                                            {{ trans('cruds.assetStatus.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('asset_access')
                                <li class="nav-item">
                                    <a href="{{ route("frontend.assets.index") }}" class="nav-link {{ request()->is("frontend/assets") || request()->is("frontend/assets/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-book">

                                        </i>
                                        <p>
                                            {{ trans('cruds.asset.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan

                            @can('assets_history_access')
                                <li class="nav-item">
                                    <a href="{{ route("frontend.assets-histories.index") }}" class="nav-link {{ request()->is("frontend/assets-histories") || request()->is("frontend/assets-histories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-th-list">

                                        </i>
                                        <p>
                                            {{ trans('cruds.assetsHistory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan
            <li class="nav-item">
                <a href="{{ route("frontend.systemCalendar") }}" class="nav-link {{ request()->is("frontend/system-calendar") || request()->is("frontend/system-calendar/*") ? "active" : "" }}">
                    <i class="fas fa-fw fa-calendar nav-icon">

                    </i>
                    <p>
                        {{ trans('global.systemCalendar') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <p>
                        <i class="fas fa-fw fa-sign-out-alt">

                        </i>
                        <span>{{ trans('global.logout') }}</span>
                    </p>
                </a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
