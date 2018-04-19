@extends('layout.app')
@section('student','active')
@section('page-title','Add Student Form')
@section('style')
    <style>
        .input-group .form-control {
            position: unset !important;
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
        #student_form>li>a{
            background-color: white;
        }
        .nav>li {

            margin-bottom: 10px;
        }
        .panel .panel-body{
            padding-top: 0px;
        }
        .tab-content>.tab-pane{
            padding: 0px 30px !important;
        }


    </style>
@endsection
@section('content')
    <create-student inline-template>
        <div>
            <div class="col-sm-3">
                <ul class="nav nav-pills nav-stacked" id="student_form">

                    <li class="active">
                        <a data-toggle="tab" href="#personal_tab">  <span id="number">1.</span> Personal Info</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#background_tab">   <span id="number">2.</span> Educational Background</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#sibling_tab">  <span id="number">3.</span> Siblings’ Info</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#medical_tab">  <span id="number">4.</span> Medical History</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#em_tab">  <span id="number">5.</span> Emergency Contact</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#guardian_tab">  <span id="number">6.</span> Guardians Info</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-9">
                <div class="panel"  v-cloak>
                    <div class="panel-body">
                        <div class="tab-content active">
                            @include('student.create-include.personal-info')
                            @include('student.create-include.background')
                            @include('student.create-include.siblings-info')
                            @include('student.create-include.medical')
                            @include('student.create-include.emergency-contact')
                            @include('student.create-include.guardian')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </create-student>
@endsection