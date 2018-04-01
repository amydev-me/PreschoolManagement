@extends('layout.app')
@section('student','active')
@section('style')
    <style>
        .input-group .form-control {
            position: unset !important;
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
                                {{--<li class=""><a data-toggle="tab" href="#payment-info" @click="paymentinfo=true">Payment</a></li>--}}
                                {{--<li class=""><a data-toggle="tab" href="#attendance">Attendance</a></li>--}}

                            </ul>
                            <div class="tab-content m-0">
                                @include('student.detail-include.info')
                                @include('student.detail-include.edit')
                                {{--@include('student.payment_index')--}}
                                {{--@include('student.attendance')--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </detail-student>
@endsection

