@extends('layout.app')
@section('studentmenu','active')
@section('student','active')
@section('page-title','Student List')

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
            position: unset!important;
        }
        .input-group-btn>.btn   {
            height:40px;
        }

        .panelp{
            padding:5px 10px;
        }
    </style>
@endsection
@section('content')
    <all-student inline-template>
        <div  v-cloak>
            <div class="row">
                <div class="panel panel-default panelp">
                    <div class="panel-body p-t-0">
                        <div class="col-sm-3 m-b-5">
                            <a href="{{route('admin.student.create')}}" class="btn btn-primary btn-sm m-t-15">  <i class="fa fa-plus"></i> Add New Student</a>
                        </div>
                        {{--<div class="col-sm-offset-2 col-sm-2 m-t-10  m-b-5">--}}
                            {{--<multiselect @input="selectedCategoryChange" :searchable="false"  v-model="selected_category" :options="categories" label="categoryName"   :show-labels="false" placeholder="Select category"></multiselect>--}}
                        {{--</div>--}}

                        {{--<div class="col-sm-2 m-t-10 m-b-5">--}}
                            {{--<multiselect @input="selectedGradeChange"  :searchable="false"   v-model="selected_grade" :options="grades" label="gradeName"   :show-labels="false" placeholder="Select grade"></multiselect>--}}
                        {{--</div>--}}
                        <div class="col-sm-3 m-t-10 m-b-5 pull-right">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Type to search" v-model="filterValue">
                                    <span class="input-group-btn"> <button type="submit" class="btn btn-primary" @click="searchClick">Search</button> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6" v-for="student,index in students">
                    <div class="panel">
                        <div class="panel-body p-t-10">
                            <div class="media-main">
                                <a class="pull-left" :href="goDetailView(student.id)">
                                    <img class="thumb-lg img-circle bx-s" :src="getImage(student.profile)">
                                </a>
                                <div class="info">
                                    <a :href="goDetailView(student.id)">
                                        <h4>@{{student.fullName}}</h4>
                                        <p class="text-muted">@{{student.grade.gradeName}}</p>
                                    </a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <vue-pagination  :length.number="pagination.last_page" v-model="pagination.current_page" @input="paginationdata"></vue-pagination>
                </div>
            </div>
        </div>
    </all-student>
@endsection

