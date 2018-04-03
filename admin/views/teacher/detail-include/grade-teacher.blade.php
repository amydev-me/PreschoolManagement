<div id="projects" class="tab-pane" >
    <grade-teacher  inline-template v-if="gradeclick">
        <div >
            <delete-grade @input="successdelete" :inputid="assign_id" :id="'deletegrade_modal'" :inputurl="removeUrl"></delete-grade>

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
            <div class=" animated bounceInRight">
                <div class="col-md-12">
                    <div class="pull-right m-b-10">
                        <a @click="showAddModal"  class="btn btn-primary btn-sm">  <i class="fa fa-plus"></i> Assign Classes</a>
                    </div>
                </div>

                <table class="table" id="datatable-normal">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Year</th>
                        <th>Grade</th>
                        <th>Subject</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="class_teacher,index in grade_teachers">
                            <td>@{{index+1}}</td>
                            <td>@{{class_teacher.academic.academicName}}</td>
                            <td>@{{class_teacher.grade.gradeName}}</td>
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
    </grade-teacher>
</div>