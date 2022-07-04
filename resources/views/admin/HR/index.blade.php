@extends('layouts.admin.admin')

@section('styles')

@endsection

@section('page-title')
  إعدادات شئون الموظفين
@endsection

@section('current-page-name')
    إعدادات شئون الموظفين
@endsection

@section('page-links')
    <li class="breadcrumb-item active">      إعدادات شئون الموظفين</li>
@endsection

@section('content')

    <style>

        .settings-category .content {
            height: 140px;
            -webkit-box-shadow: 0px 0px 6px #00000030;
            box-shadow: 0px 0px 6px #00000030;
            border-radius: 6px;
            -webkit-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out;
            background-color: white;
        }

        .settings-category .content h3 {
            font-weight: 600;
        }

        .settings-category .content i {
            font-size: 35px;
            color: #a6b7bf;
        }

        .settings-category .content:hover {
            -webkit-transform: scale(0.95);
            transform: scale(0.95);
            -webkit-box-shadow: 0px 0px 8px #186dde;
            box-shadow: 0px 0px 8px #186dde;
        }

        .settings-category .content h3 {
            font-weight: 600;
            color: black;
        }
    </style>

    <section class="settings-category my-5">

        <div class="row">


            {{--======================== HR Mohamed ============================--}}

            <div class="col-lg-4 col-sm-6 mb-4">
                <a href="{{route('admin.hrDepartment.index')}}">
                    <div class="content  d-flex align-items-center justify-content-center">
                        <div class="text-i">
                            <div class="w-100 mb-3 d-flex align-items-center justify-content-center">
                                <i class="fa fa-adjust"></i>
                            </div>

                            <h3>
                               إعدادات الأقسام
                            </h3>
                        </div>
                    </div>
                </a>

            </div>

            <div class="col-lg-4 col-sm-6 mb-4">
                <a href="{{route('admin.hrVacations.index')}}">
                    <div class="content  d-flex align-items-center justify-content-center">
                        <div class="text-i">
                            <div class="w-100 mb-3 d-flex align-items-center justify-content-center">
                                <i class="fa fa-hand-holding"></i>
                            </div>

                            <h3>
                               إعدادات الأجازات
                            </h3>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-lg-4 col-sm-6 mb-4">
                <a href="{{route('admin.hrSentence.index')}}">
                    <div class="content  d-flex align-items-center justify-content-center">
                        <div class="text-i">
                            <div class="w-100 mb-3 d-flex align-items-center justify-content-center">
                                <i class="fa fa-pause-circle"></i>
                            </div>

                            <h3>
                               إعدادات الجزاءات
                            </h3>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-lg-4 col-sm-6 mb-4">
                <a href="{{route('admin.hrShifts.index')}}">
                    <div class="content  d-flex align-items-center justify-content-center">
                        <div class="text-i">
                            <div class="w-100 mb-3 d-flex align-items-center justify-content-center">
                                <i class="fa fa-calendar-times"></i>
                            </div>

                            <h3>
                               إعدادات الشيفتات
                            </h3>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-lg-4 col-sm-6 mb-4">
                <a href="{{route('admin.hrShiftsTimes.index')}}">
                    <div class="content  d-flex align-items-center justify-content-center">
                        <div class="text-i">
                            <div class="w-100 mb-3 d-flex align-items-center justify-content-center">
                                <i class="fa fa-user-times"></i>
                            </div>

                            <h3>
                               إعدادات شيفتات الأقسام
                            </h3>
                        </div>
                    </div>
                </a>

            </div>

            {{--======================== END HR Mohamed ============================--}}

            <div class="col-lg-4 col-sm-6 mb-4">
                <a href="{{route('admin.HRJobs.index')}}">
                    <div class="content  d-flex align-items-center justify-content-center">
                        <div class="text-i">
                            <div class="w-100 mb-3 d-flex align-items-center justify-content-center">
                                <i class="fa fa-user-md"></i>
                            </div>

                            <h3>
                                الوظائف
                            </h3>
                        </div>
                    </div>
                </a>

            </div>

            <div class="col-lg-4 col-sm-6 mb-4">
                <a href="{{route('admin.HRAllowances.index')}}">
                    <div class="content  d-flex align-items-center justify-content-center">
                        <div class="text-i">
                            <div class="w-100 mb-3 d-flex align-items-center justify-content-center">
                                <i class="fa fa-dollar-sign"></i>
                            </div>

                            <h3>
                                البدلات
                            </h3>
                        </div>
                    </div>
                </a>

            </div>

            <div class="col-lg-4 col-sm-6 mb-4">
                <a href="{{route('admin.HREmployee.index')}}">
                    <div class="content  d-flex align-items-center justify-content-center">
                        <div class="text-i">
                            <div class="w-100 mb-3 d-flex align-items-center justify-content-center">
                                <i class="fa fa-users-cog"></i>
                            </div>

                            <h3>
                                الموظفين
                            </h3>
                        </div>
                    </div>
                </a>

            </div>


            <div class="col-lg-4 col-sm-6 mb-4">
                <a href="{{route('admin.HREmployeeVacations.index')}}">
                    <div class="content  d-flex align-items-center justify-content-center">
                        <div class="text-i">
                            <div class="w-100 mb-3 d-flex align-items-center justify-content-center">
                                <i class="fa fa-smile"></i>
                            </div>
                            <h3>
                                إجازات الموظفين
                            </h3>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-sm-6 mb-4">
                <a href="{{route('admin.HREmployeeSanctions.index')}}">
                    <div class="content  d-flex align-items-center justify-content-center">
                        <div class="text-i">
                            <div class="w-100 mb-3 d-flex align-items-center justify-content-center">
                                <i class="fa fa-meh"></i>
                            </div>
                            <h3>
                                جزاءات الموظفين
                            </h3>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-sm-6 mb-4">
                <a href="{{route('admin.HREmployeeEvaluations.index')}}">
                    <div class="content  d-flex align-items-center justify-content-center">
                        <div class="text-i">
                            <div class="w-100 mb-3 d-flex align-items-center justify-content-center">
                                <i class="fa fa-balance-scale"></i>
                            </div>
                            <h3>
                                التقييمات
                            </h3>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-sm-6 mb-4">
                <a href="{{route('admin.HREmployeeBonus.index')}}">
                    <div class="content  d-flex align-items-center justify-content-center">
                        <div class="text-i">
                            <div class="w-100 mb-3 d-flex align-items-center justify-content-center">
                                <i class="fa fa-search"></i>
                            </div>
                            <h3>
                                المكافآت
                            </h3>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-sm-6 mb-4">
                <a href="{{route('admin.HREmployeeAdvances.index')}}">
                    <div class="content  d-flex align-items-center justify-content-center">
                        <div class="text-i">
                            <div class="w-100 mb-3 d-flex align-items-center justify-content-center">
                                <i class="fa fa-edit"></i>
                            </div>
                            <h3>
                                السلف
                            </h3>
                        </div>
                    </div>
                </a>
            </div>


        </div>

    </section>
@endsection

@section('js')
    <script>

    </script>
@endsection
