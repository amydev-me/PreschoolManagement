@extends('layout.app')
@section('student','active')
@section('page-title','Add Student Form')
@section('style')
    <style scope>
        body.modal-open {
            overflow: hidden;
            position: fixed;
        }
        .input-group .form-control {
            position: unset !important;
        }
    </style>
@endsection
@section('content')
    <create-student inline-template>
        <div class="panel"  v-cloak>
            <create-guardian @input="submitsuccess" inline-template>
                <div ref="thismodel" id="guardian-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style="padding-bottom: 10px!important;">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Guardian</h4>
                            </div>
                            <div class="modal-body">
                                <ul class="nav nav-pills nav-justified" id="guardian_form">
                                    <li class="active" id="test">
                                        <a data-toggle="tab"  href="#guardian_account_detail"><span id="number">1.</span>Account Detail</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#guardian_personal_detail">  <span id="number">2.</span> Personal Details</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="guardian_account_detail">
                                        <form class="form-horizontal  animated bounceInRight"  role="form" @submit.prevent="validateData('guardian_account_form')" data-vv-scope="guardian_account_form">
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="username">Username:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="username" v-model="guardian.username" name="username" v-validate="'required|verify_user'" placeholder="Enter User Name">
                                                    <div v-show="errors.has('guardian_account_form.username')"><span class="error">@{{ errors.first('guardian_account_form.username') }}</span></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="password">Password:</label>
                                                <div class="col-sm-9">

                                                    <input type="password" class="form-control" id="password"  v-model="guardian.password" name="password" v-validate="'required'" placeholder="Enter Password">
                                                    <div v-show="errors.has('guardian_account_form.password')"><span class="error">@{{ errors.first('guardian_account_form.password') }}</span></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="confirm_password">Confirm Password:</label>
                                                <div class="col-sm-9">

                                                    <input v-validate="'required|confirmed:password'" id="confirm_password" name="password_confirmation" type="password" class="form-control" placeholder="Confirm password" data-vv-as="password">
                                                    <div v-show="errors.has('guardian_account_form.password_confirmation')"><span class="error">@{{ errors.first('guardian_account_form.password_confirmation') }}</span></div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary pull-right">Next</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="guardian_personal_detail">
                                        <form class="form-horizontal animated bounceInRight"  @submit.prevent="validateData('guardian_personal_detail_form')" data-vv-scope="guardian_personal_detail_form">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Email :</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="email" v-model="guardian.email" v-validate="'required|email'" placeholder="Enter Email">
                                                    <div  v-show="errors.has('guardian_personal_detail_form.email')"><span class="error">Required email.</span></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">First Name :</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="firstName" v-model="guardian.firstName" v-validate="'required'" placeholder="Enter First Name">
                                                    <div v-show="errors.has('guardian_personal_detail_form.firstName')"><span class="error">Required first name.</span></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Last name :</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="lastName" v-model="guardian.lastName" v-validate="'required'" placeholder="Enter Last Name">
                                                    <div  v-show="errors.has('guardian_personal_detail_form.lastName')"><span class="error">Required last name.</span></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Relation :</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="realation" v-model="guardian.realation" v-validate="'required'" placeholder="Enter Relation">
                                                    <div  v-show="errors.has('guardian_personal_detail_form.realation')"><span class="error">Required relation.</span></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Occupation :</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="occupation" v-model="guardian.occupation" v-validate="'required'" placeholder="Enter Occupation">
                                                    <div v-show="errors.has('guardian_personal_detail_form.occupation')"><span class="error">Required occupation.</span></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Phone :</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="phone" v-model="guardian.phone" v-validate="'required'" placeholder="Enter Phone">
                                                    <div  v-show="errors.has('guardian_personal_detail_form.phone')"><span class="error">Required phone.</span></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Address :</label>
                                                <div class="col-sm-9">
                                                    <textarea rows="1" type="text" class="form-control" name="address" v-model="guardian.address" v-validate="'required'" placeholder="Enter Address"></textarea>
                                                    <div  v-show="errors.has('guardian_personal_detail_form.address')"><span class="error">Required address.</span></div>
                                                </div>
                                            </div>

                                            <div class="text-right">
                                                <button id="previous_account"  class="btn btn-primary" type="button" @click="personal_back_click">Previous</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </create-guardian>
            <div class="panel-body">
                <ul class="nav nav-pills nav-justified" id="student_form">
                    <li class="active">
                        <a data-toggle="tab"  href="#account_detail"><span id="number">1.</span> Account Detail</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#personal_detail">  <span id="number">2.</span> Personal Details</a>
                    </li>
                    <li>
                        <a data-toggle="tab"  href="#grade_detail"><span id="number">3.</span> Grade Detail</a>
                    </li>
                </ul>
                <div class="tab-content">

                    @include('student.create-include.account-detail')

                    @include('student.create-include.personal-detail')

                    @include('student.create-include.grade-detail')

                </div>
            </div>
        </div>
    </create-student>
@endsection