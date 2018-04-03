@extends('layout.app')
@section('setup','active')
@section('assign_teacher','active')
@section('page-title','Manage Teacher Grade')

@section('content')
    <grade-teacher inline-template>
        <div class="panel" v-cloak>
            <delete-modal @input="successdelete" :inputid="gradeteacher_id" :inputurl="removeUrl"></delete-modal>
            <action-grade :isedit="isedit" :subjects="subjects" :active_academic="active_academic"  :categories="categories" :grade_teacher="grade_teacher" @submit="successperform" inline-template>
                <div ref="thismodel"  id="courseteacher-modal" class="modal fade modal-dialog-center" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title">@{{ isedit?'Edit Assign Class': 'Assign Class'}}</h4>
                                        </div>
                                        <form class="form-horizontal" role="form" @submit.prevent="submitdata">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Category</label>
                                                    <div class="col-sm-10">
                                                        <multiselect  v-validate="'required'"
                                                                      data-vv-name="course_id"
                                                                     v-model="selected_category"
                                                                      :options="categories"
                                                                      label="categoryName"
                                                                      :show-labels="false"
                                                                      laceholder="Select categorys" @input="selectedCategoryChange"></multiselect>

                                                    </div>
                                                    <div class="col-sm-offset-2 col-sm-9" v-show="errors.has('course_id')"><span class="error">Required grade.</span></div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Grade</label>
                                                    <div class="col-sm-10">
                                                        <multiselect
                                                                v-validate="'required'"
                                                                data-vv-name="grade_id"
                                                                v-model="selected_grade"
                                                                :options="grades" label="gradeName"
                                                                :show-labels="false"
                                                                placeholder="Select grade"></multiselect>

                                                    </div>
                                                    <div class="col-sm-offset-2 col-sm-9" v-show="errors.has('grade_id')"><span class="error">Required grade.</span></div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Teacher</label>
                                                    <div class="col-sm-10">
                                                        <multiselect v-validate="'required'"
                                                                     data-vv-name="teacher_id"
                                                                     v-model="selected_teacher"
                                                                     label="fullName"

                                                                     placeholder="Type to search"
                                                                     open-direction="bottom"
                                                                     :options="teachers"
                                                                     :multiple="false" @search-change="asyncFindTeacher">

                                                        </multiselect>
                                                    </div>
                                                    <div class="col-sm-offset-2 col-sm-9" v-show="errors.has('teacher_id')"><span class="error">Required teacher.</span></div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Subject</label>
                                                    <div class="col-sm-10">

                                                        <multiselect
                                                                v-validate="'required'"
                                                                data-vv-name="subject_id"
                                                                  v-model="selected_subject"
                                                                :options="subjects"
                                                                label="subjectName"
                                                                :show-labels="false"
                                                                placeholder="Select subject"></multiselect>
                                                    </div>
                                                    <div class="col-sm-offset-2 col-sm-9" v-show="errors.has('subject_id')"><span class="error">Required subject.</span></div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-info">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                </div>
            </action-grade>

            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-3">
                            <div class="m-b-30">
                                <a  @click="showAddModal" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#courseteacher-modal">  <i class="fa fa-plus"></i> Grade Teacher Allocation</a>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="col-sm-offset-2 col-sm-12 m-b-30">
                                <div class="col-sm-5">
                                    <label class="col-sm-3 control-label" style="text-align: right;margin-top:7px;">Category</label>
                                    <div class="col-sm-9">
                                        <multiselect @input="selectedCategoryChange"
                                                     :searchable="false"
                                                     v-model="selected_category"
                                                     :options="categories"
                                                     label="categoryName"
                                                     :show-labels="false" placeholder="Select Category">
                                        </multiselect>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <label class="col-sm-2 control-label" style="text-align: right;margin-top:7px;">Grade</label>
                                    <div class="col-sm-7">
                                        <multiselect @input="selectedGradeChange" v-model="selected_grade" :options="grades"  placeholder="Select Grade" label="gradeName"></multiselect>
                                    </div>
                                </div>
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
                                    <th>Year</th>
                                    <th>Grade</th>
                                    <th>Teacher</th>
                                    <th>Subject</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="class_teacher,index in grade_teachers">
                                    <td>@{{pagination.from+index}}</td>
                                    <td>@{{class_teacher.academic.academicName}}</td>
                                    <td>@{{class_teacher.grade.gradeName}}</td>
                                    <td>@{{class_teacher.teacher.fullName}}</td>
                                    <td>@{{class_teacher.subject.subjectName}}</td>
                                    <td>
                                        <a @click="showEditModal(class_teacher)"  class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                        <a @click="showDeleteModal(class_teacher.id)" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <vue-pagination  :length.number="pagination.last_page" v-model="pagination.current_page"></vue-pagination>
                    </div>
                </div>
            </div>
        </div>
    </grade-teacher>
@endsection