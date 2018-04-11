@extends('layout.app')
@section('page-title','Grades')
@section('setup','active')
@section('grade','active')

@section('content')
    <grade-list inline-template>
        <div class="panel" v-cloak>
           <delete-modal @input="successdelete" :inputid="grade_id" :inputurl="removeUrl"></delete-modal>

            <div class="panel-body">
               <div class="row">
                   <div class="col-sm-12">
                       <div class="col-sm-6">
                           <div class="m-b-30">
                               <a :href="'/admin/grade/manage'"  class="btn btn-primary btn-sm">  <i class="fa fa-plus"></i> Add New Grade</a>
                           </div>
                       </div>
                       <div class="col-sm-4 pull-right">
                           <div class="form-group m-b-30 ">
                               <category-select @input="selectedCategoryChange"></category-select>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                       <div class="table-responsive">
                           <table class="table" id="datatable-normal">
                               <thead>
                               <tr>
                                   <th>#</th>
                                   <th>Category</th>
                                   <th>Grade</th>
                                   <th>Description</th>
                                   <th>Actions</th>
                               </tr>
                               </thead>
                               <tbody>
                               <tr v-for="grade,index in grades">
                                   <td>@{{pagination.from+index}}</td>
                                   <td>@{{grade.category?grade.category.categoryName:''}}</td>
                                   <td>@{{grade.gradeName}}</td>
                                   <td>@{{grade.description}}</td>
                                   <td>
                                       <a :href="'/admin/grade/edit?grade_id='+grade.id" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                       <a @click="showDeleteModal(grade.id)" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                   </td>
                               </tr>
                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-sm-12">
                       <vue-pagination  :length.number="pagination.last_page" v-model="pagination.current_page" @input="searchClick"></vue-pagination>
                   </div>
               </div>
            </div>
        </div>
    </grade-list>
@endsection