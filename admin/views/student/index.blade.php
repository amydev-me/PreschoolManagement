@extends('layout.app')
@section('studentmenu','active')
@section('student','active')
@section('page-title','All Students')

@section('style')

    <style>
        select{
            min-width:auto !important;
        }
        .form-control{
            height:40px;
        }


        .input-group-btn>.btn{
            position:unset;
        }
        .input-group .form-control {
            position: unset;
        }
        .input-group-btn>.btn   {
            height:40px;
        }
    </style>
@endsection
@section('content')
    <all-student inline-template>
        <div  v-cloak>
            {{--<delete-modal @input="performdelete"></delete-modal>--}}

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-body p-t-0">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-3">
                                        <div class="m-b-10">
                                            <a href="{{route('admin.student.create')}}"  class="btn btn-primary btn-sm">  <i class="fa fa-plus"></i> Add New Student</a>
                                        </div>
                                    </div>
                                    {{--<div class="col-sm-4 col-sm-push-1 m-b-10">--}}
                                        {{--<label class="col-sm-2 control-label" style="text-align: right;margin-top:7px;">Year</label>--}}
                                        {{--<div class="col-sm-7">--}}
                                            {{--<multiselect @input="selectedBatchChange" :searchable="false" :allow-empty="false"  v-model="selected_batch" :options="batches" label="batchName"   :show-labels="false" placeholder="Select year"></multiselect>--}}

                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="col-sm-2 m-b-10">--}}
                                        {{--<select class="form-control"  v-model="selectedFilter" name="filter" @change="filterChange">--}}
                                            {{--<option v-for="filter in filterTypes" :value="filter">@{{ filter.text }}</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-sm-3 m-b-10" v-show="this.selectedFilter.value!='course'">--}}
                                        {{--<div class="input-group">--}}
                                            {{--<input type="text" class="form-control" placeholder="Type to search" v-model="filterValue">--}}
                                            {{--<span class="input-group-btn"> <button type="submit" class="btn btn-primary" @click="searchClick">Search</button> </span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-sm-3" v-show="this.selectedFilter.value=='course'">--}}
                                        {{--<multiselect  @input="selectedCourseChange" v-model="selected_course" :options="courses"  placeholder="Select one" label="courseName" track-by="courseName"></multiselect>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--<div class="row">--}}
                {{--<div class="col-sm-6" v-for="student,index in students">--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-body p-t-10">--}}
                            {{--<div class="media-main">--}}
                                {{--<a class="pull-left" :href="goDetailView(student.id)">--}}
                                    {{--<img class="thumb-lg img-circle bx-s" :src="getImage(student.profile)">--}}
                                {{--</a>--}}

                                {{--<div class="info">--}}
                                    {{--<a :href="goDetailView(student.id)">--}}
                                        {{--<h4>@{{student.firstName+' ' +student.lastName}}</h4>--}}
                                        {{--<p class="text-muted">@{{student.course?student.course.courseName:''}}</p>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="clearfix"></div>--}}
                        {{--</div> <!-- panel-body -->--}}
                    {{--</div> <!-- panel -->--}}
                {{--</div> <!-- end col -->--}}
            {{--</div>--}}

            {{--<div class="row">--}}
                {{--<div class="col-sm-12">--}}
                    {{--<vue-pagination  :length.number="pagination.last_page" v-model="pagination.current_page" @input="searchClick"></vue-pagination>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </all-student>
@endsection

