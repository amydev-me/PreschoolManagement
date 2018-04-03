@extends('layout.app')

@section('guardian','active')
@section('page-title','Guardian List')
@section('style')
    <style>
        body.modal-open {
            overflow: hidden;
        }
        .modal .modal-dialog .modal-content .modal-body{
            padding-bottom: 5px !important;
        }
        .tab-content>.tab-pane{
            padding-bottom: 20px !important;
        }
    </style>
@endsection
@section('content')
    <all-guardian inline-template>
        <div class="panel" v-cloak>
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
                <div class="row">
                    <div class="col-sm-8">
                        <div class="m-b-30">
                            <a   class="btn btn-primary btn-sm"  @click="showAddModal">  <i class="fa fa-plus"></i> Add New Guardian</a>
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
                                    <th data-priority="1">Name</th>
                                    <th data-priority="1">Email</th>
                                    <th data-priority="1">Occupation</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="guardian,index in guardians">
                                    <td>@{{pagination.from+index}}</td>
                                    <td>@{{guardian.fullName}}</td>
                                    <td>@{{guardian.email}}</td>
                                    <td>@{{guardian.occupation}}</td>
                                    <td>
                                        <a :href="goDetailView(guardian.id)" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
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
    </all-guardian>
@endsection
