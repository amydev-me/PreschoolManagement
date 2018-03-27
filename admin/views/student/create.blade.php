@extends('layout.app')
@section('student','active')
@section('page-title','Add Student Form')
@section('style')
    <style scope>
        body.modal-open {
            overflow: hidden;
            position: fixed;
        }
        .input-group .form-control {
            position: unset !important;
        }
    </style>
@endsection
@section('content')

    <create-student inline-template>
        <div class="panel"  v-cloak>
            <create-guardian @input="submitsuccess">


            </create-guardian>
            <div class="panel-body">

                <ul class="nav nav-pills nav-justified" id="teacher_form">
                    <li class="active" id="test">
                        <a data-toggle="tab"  href="#account_detail"><span id="number">1.</span>Account Detail</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#personal_detail">  <span id="number">2.</span> Personal Details</a>
                    </li>
                </ul>

                <div class="tab-content">

                    @include('student.create-include.account-detail')

                    @include('student.create-include.personal-detail')

                </div>

            </div>
        </div>
    </create-student>

@endsection