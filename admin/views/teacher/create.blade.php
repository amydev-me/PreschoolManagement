@extends('layout.app')
@section('teacher_setup','active')
@section('add-teacher','active')
@section('page-title','Add Teacher Form')

@section('content')

    <teacher-action inline-template>
        <div class="panel"  v-cloak>
            <div class="panel-body">

                <ul class="nav nav-pills nav-justified" id="teacher_form">
                    {{--<li class="active" id="test">--}}
                        {{--<a data-toggle="tab"  href="#account_detail"><span id="number">1.</span>Account Detail</a>--}}
                    {{--</li>--}}
                    <li class="active">
                        <a data-toggle="tab" href="#personal_detail">  <span id="number">1.</span> Personal Details</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#employee_detail">   <span id="number">2.</span>Employment Details</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#contact_info">  <span id="number">3.</span> Contact Person</a>
                    </li>
                </ul>

                <div class="tab-content">

                    {{--@include('teacher.info.account-detail')--}}
                    @include('teacher.info.personal-detail')
                    @include('teacher.info.employee-detail')
                    @include('teacher.info.contact-person')




                </div>

            </div>
        </div>
    </teacher-action>

@endsection

