@extends('layout.app')

@section('teacher','active')
@section('page-title','Teacher List')
@section('style')

    <style>
        select{
            min-width:auto !important;
        }
    </style>
@endsection

@section('content')
    <all-teacher inline-template>
        <div  v-cloak>

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-body p-t-0">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-7">
                                        <div class="m-b-10">
                                            <a href="{{route('admin.teacher.create')}}"  class="btn btn-primary btn-sm">  <i class="fa fa-plus"></i> Add New Teacher</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-offset-2 col-sm-2 m-t-10  m-b-5">
                                        <category-select @input="selectedCategoryChange"></category-select>
                                    </div>

                                    {{--<div class="col-sm-2 m-t-10 m-b-5">--}}
                                        {{--<multiselect @input="selectedGradeChange"  :searchable="false"   v-model="selected_grade" :options="grades" label="gradeName"   :show-labels="false" placeholder="Select grade"></multiselect>--}}
                                    {{--</div>--}}
                                    <div class="col-sm-3 m-b-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Type to search" v-model="filterValue">
                                            <span class="input-group-btn"> <button type="submit" class="btn btn-primary" @click="searchClick">Search</button> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6" v-for="teacher in teachers">
                    <div class="panel">
                        <div class="panel-body p-t-10">
                            <div class="media-main">
                                <a class="pull-left" :href="goDetailView(teacher.id)">
                                    <img class="thumb-lg img-circle bx-s" :src="getImage(teacher.profile)">
                                </a>
                                <div class="info">
                                    <a :href="goDetailView(teacher.id)"><h4>@{{teacher.fullName}}</h4></a>
                                    <p class="text-muted">@{{teacher.position}}</p>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                        </div> <!-- panel-body -->
                    </div> <!-- panel -->
                </div> <!-- end col -->
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <vue-pagination  :length.number="pagination.last_page" v-model="pagination.current_page" @input="searchClick"></vue-pagination>
                </div>
            </div>
        </div>
    </all-teacher>
@endsection