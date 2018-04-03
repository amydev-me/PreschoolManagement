@extends('layout.app')
@section('teacher','active')

@section('content')

    <detail-teacher inline-template>
        <div>
            <div class="row" v-cloak>
                <div class="col-sm-12">
                    <span class="bg-picture-overlay"></span>

                    <div class="box-layout meta bottom">
                        <div class="col-sm-12 clearfix">
                            <span class="img-wrapper pull-left m-r-15 m-t-15"><img :src="getImage(teacher.profile)" alt="" style="width:128px;" class="br-radius"></span>
                            <div class="media-body">
                                <h3 class="text-white mb-2 m-t-10 ellipsis" style="color: black;" v-if="teacher.fullName!=null">@{{ teacher.fullName }}</h3>
                                <h5 class="text-white" style="color: black;"> @{{ teacher.position }}</h5>
                                <p>@{{ teacher.biography }}</p>
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
                                <li class=""><a data-toggle="tab" href="#edit-profile" @click="editclick=true">Settings</a></li>
                                <li class=""><a data-toggle="tab" href="#projects" @click="gradeclick=true">Classes</a></li>
                            </ul>

                            <div class="tab-content m-0">

                                @include('teacher.detail-include.info')

                                @include('teacher.detail-include.edit')

                                @include('teacher.detail-include.grade-teacher')
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </detail-teacher>
@endsection

