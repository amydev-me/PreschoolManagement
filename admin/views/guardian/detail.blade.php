@extends('layout.app')
@section('teacher','active')

@section('content')

    <detail-guardian inline-template>
        <div v-cloak>
            <div class="row" v-cloak>
                <div class="col-sm-12">
                    <span class="bg-picture-overlay"></span>
                    <div class="box-layout meta bottom">
                        <div class="col-sm-12 clearfix">
                            <div class="media-body">
                                <h3 class="text-white mb-2 m-t-10 ellipsis" style="color: black;" v-if="guardian.firstName!=null&&guardian.lastName!=null">@{{ guardian.firstName +' '+guardian.lastName }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-t-30">
                <div class="col-sm-12">
                    <div class="panel panel-default p-0">
                        <div class="panel-body p-0">
                            <ul class="nav nav-tabs profile-tabs">
                                <li class="active"><a data-toggle="tab" href="#aboutme">About Me</a></li>
                                <li class=""><a data-toggle="tab" href="#edit-profile">Settings</a></li>
                                <li class=""><a data-toggle="tab" href="#students">Students</a></li>
                            </ul>

                            <div class="tab-content m-0">

                                @include('guardian.info')
                                @include('guardian.edit')
                                {{--@include('guaridan.student')--}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </detail-guardian>
@endsection

