@extends('layout.app')
@section('page-title','Grades')
@section('setup','active')
@section('grade','active')

@section('content')
    <grade-list inline-template>
        <div class="panel" v-cloak>
           <delete-modal @input="successdelete" :inputid="grade_id" :inputurl="removeUrl"></delete-modal>
            {{--<action :grade="grade"  @success="successdata" inline-template>--}}
                {{--<div ref="thismodel" id="mymodal" class="modal fade modal-dialog-center" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">--}}
                    {{--<div class="modal-dialog">--}}
                        {{--<div class="modal-content">--}}
                            {{--<div class="modal-header">--}}
                                {{--<h4 class="modal-title">Edit Grade</h4>--}}
                            {{--</div>--}}
                            {{--<form class="form-horizontal" role="form" @submit.prevent="submitdata">--}}

                                 {{--<div class="modal-body">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label class="col-sm-3 control-label">Year :</label>--}}
                                        {{--<div class="col-sm-9">--}}
                                            {{--<academic-select  @input="selectedAcadmiceChange" :value="selected_academic" data-vv-name="academic" v-validate="'required'"></academic-select>--}}
                                            {{--<div  v-show="errors.has('academic')"><span class="error">Required year.</span></div>--}}
                                        {{--</div>--}}

                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label class="col-sm-3 control-label">Category :</label>--}}
                                        {{--<div class="col-sm-9">--}}
                                            {{--<category-select @input="selectedCategoryChange" :value="selected_category" data-vv-name="category" v-validate="'required'"></category-select>--}}
                                            {{--<div  v-show="errors.has('category')"><span class="error">Required category.</span></div>--}}
                                        {{--</div>--}}

                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label class="col-sm-3 control-label">Grade :</label>--}}
                                        {{--<div class="col-sm-9">--}}
                                            {{--<input type="text" class="form-control" name="gradeName" v-model="performdata.gradeName" v-validate="'required'">--}}
                                            {{--<div  v-show="errors.has('gradeName')"><span class="error">Required grade name.</span></div>--}}
                                        {{--</div>--}}

                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label class="col-sm-3 control-label">Description :</label>--}}
                                        {{--<div class="col-sm-9">--}}
                                            {{--<textarea type="text" rows="1" class="form-control" name="description" v-model="performdata.description"></textarea>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                 {{--</div>--}}

                                {{--<div class="modal-footer">--}}
                                    {{--<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>--}}
                                    {{--<button type="submit" class="btn btn-info">Save changes</button>--}}
                                {{--</div>--}}
                            {{--</form>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</action>--}}
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