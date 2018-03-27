@extends('layout.app')
@section('page-title','Grades')
@section('setup','active')
@section('grade','active')

@section('content')
    <grade-list inline-template>
       <div v-cloak>
           <delete-modal @input="successdelete" :inputid="grade_id" :inputurl="removeUrl"></delete-modal>
           <div class="row">
               <div class="col-sm-12">
                   <div class="panel panel-default">
                       <div class="panel-body p-t-0">
                           <div class="row">
                               <div class="col-sm-12">
                                   <div class="col-sm-3">
                                       <div class="m-b-10">
                                           <a href="{{route('admin.grade.action')}}"  class="btn btn-primary btn-sm">  <i class="fa fa-plus"></i> Add New Grade</a>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <div class="row">
               <div class="col-sm-6" v-for="grade in grades">
                   <div class="panel">
                       <div class="panel-body">
                           <div class="media-main">
                               <div class="pull-right btn-group-sm">
                                   <a :href="'/admin/grade/action?grade_id='+grade.id" class="btn btn-success tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit">
                                       <i class="fa fa-pencil"></i>
                                   </a>
                                   <a @click="showDeleteModal(grade.id)" class="btn btn-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                                       <i class="fa fa-close"></i>
                                   </a>
                               </div>
                               <div class="info">
                                   <h4 style="display: inline !important;">@{{grade.gradeName}}</h4>
                                   <p class="text-muted" style="display: inline !important;">(@{{ grade.description }})</p>
                               </div>
                               <div class="clearfix"></div>
                               <hr style="margin-top: 10px;margin-bottom: 10px;">
                               <view-component :terms="grade.terms" inline-template>
                                   <div class="col-sm-12">
                                       <div class="col-sm-6">
                                           <h5>Term#1</h5>
                                           <p><i class="fa  fa-calendar"></i> <span>@{{fstart_date}}</span>,@{{fend_date}}</p>
                                           <p> <i class="fa fa-clock-o"></i> @{{ffterm_time}} <i class="fa fa-money"></i> @{{ffamount}}</p>
                                           <p> <i class="fa fa-clock-o"></i> @{{fhterm_time}} <i class="fa fa-money"></i> @{{fhamount}}</p>

                                       </div>
                                       <div class="col-sm-6">
                                           <h5>Term#2</h5>
                                           <p><i class="fa  fa-calendar"></i> <span>@{{sstart_date}}</span>,@{{send_date}}</p>
                                           <p> <i class="fa fa-clock-o"></i> @{{sfterm_time}} <i class="fa fa-money"></i> @{{sfamount}}</p>
                                           <p> <i class="fa fa-clock-o"></i> @{{shterm_time}} <i class="fa fa-money"></i> @{{shamount}}</p>
                                       </div>
                                   </div>
                               </view-component>

                           </div>
                       </div> <!-- panel-body -->
                   </div> <!-- panel -->
               </div>

           </div>
       </div>
    </grade-list>
@endsection