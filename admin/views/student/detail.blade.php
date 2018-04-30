@extends('layout.app')
@section('student_setup','active')
@section('style')
    <style>
        .input-group .form-control {
            position: unset !important;
        }
        .panel{
            border:none;
            box-shadow: none;
        }
        .panel-group .panel-heading+.panel-collapse>.list-group, .panel-group .panel-heading+.panel-collapse>.panel-body{
            border-top:none !important;
            margin-top: 0px !important;
        }
        .panel-group .panel .panel-heading a[data-toggle=collapse], .panel-group .panel .panel-heading .accordion-toggle{
            color:#204d74;
        }

        .multiselect__option--group {
            background: #e3f2fd !important;
            color: #708690 !important;

        }
        .multiselect--disabled .multiselect__current, .multiselect--disabled .multiselect__select, .multiselect__option--disabled{
            background: #e3f2fd !important;
            color: #708690 !important;
            font-weight: 800;
        }
        .panel .edit-panel{
            padding-top: 0px;
        }

        .panel .panel-body .edit-panel{
            padding-top: 0px;
        }
        .tab-content>.tab-pane .edit-tab{
            padding-top: 0px;
        }
        .btn-primary.active, .btn-primary:active, .open>.dropdown-toggle.btn-primary{
            background-color:red;
            border-color:red;
            color:white;
        }
        .btn-primary.active.focus .attstatus{
            background-color:red;
            border-color:red;
            color:white;
        }
        .btn-primary.active.focus, .btn-primary.active:focus, .btn-primary.active:hover, .btn-primary:active.focus, .btn-primary:active:focus,
        .btn-primary:active:hover, .open>.dropdown-toggle.btn-primary.focus, .open>.dropdown-toggle.btn-primary:focus, .open>.dropdown-toggle.btn-primary:hover{
            background-color:red;
            border-color:red !important;
            color:white;
        }
        .btn.active.focus, .btn.active:focus, .btn.focus, .btn:active.focus, .btn:active:focus, .btn:focus {
            outline: none;
        }
    </style>
@endsection

@section('content')
    <detail-student inline-template>
        <div v-cloak>
            <div class="row" >
                <div class="col-sm-12">
                    <span class="bg-picture-overlay"></span>
                    <div class="box-layout meta bottom">
                        <div class="col-sm-12 clearfix">
                            <span class="img-wrapper pull-left m-r-15 m-t-15"><img :src="getImage(student.profile)" alt="" style="width:128px;" class="br-radius"></span>
                            <div class="media-body">
                                <h3 class="text-white mb-2 m-t-10 ellipsis" style="color: black;" v-if="student.fullName">@{{ student.fullName}}</h3>
                                <h5 class="text-white" style="color: black;"> @{{gradeName}}</h5>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-t-30" >
                <div class="col-sm-12">
                    <div class="panel panel-default p-0" >
                        <div class="panel-body p-0">
                            <ul class="nav nav-tabs profile-tabs">
                                <li class="active"><a data-toggle="tab" href="#aboutme">About Me</a></li>
                                <li class=""><a data-toggle="tab" href="#edit-profile" @click="editview=true">Settings</a></li>
                                <li class=""><a data-toggle="tab" href="#payment-info">Payment</a></li>
                                <li class=""><a data-toggle="tab" href="#attendance">Attendance</a></li>

                            </ul>
                            <div class="tab-content m-0">
                                @include('student.detail-include.info')
                                @include('student.detail-include.edit')
                                @include('student.detail-include.payment')
                                @include('student.detail-include.attendance')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </detail-student>
@endsection

