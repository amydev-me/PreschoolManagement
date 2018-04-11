@extends('layout.app')
@section('user','active')

@section('page-title','All Users')
@section('style')

    <style>
        select{
            min-width:auto !important;
        }
    </style>
@endsection
@section('content')
    <all-user inline-template>
        <div class="panel" v-cloak>
            <div class="panel-body">
                <delete-modal @input="successdelete" :inputid="user_id" :inputurl="removeUrl"></delete-modal>
                <create-user @input="getUser" inline-template>
                    <div ref="usmodal" id="usermodal" class="modal fade modal-dialog-center" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Add new user</h4>
                            </div>
                            <form class="form-horizontal" role="form" @submit.prevent="submitdata('userform')" data-vv-scope="userform">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="username">Username:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="username" v-model="user.username" name="username" v-validate="'required|verify_user'" placeholder="Enter User Name">
                                            <div v-show="errors.has('userform.username')"><span class="error">@{{ errors.first('userform.username') }}</span></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="password">Password:</label>
                                        <div class="col-sm-8">

                                            <input type="password" class="form-control" id="password"  v-model="user.password" name="password" v-validate="'required'" placeholder="Enter Password">
                                            <div v-show="errors.has('userform.password')"><span class="error">@{{ errors.first('userform.password') }}</span></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="confirm_password">Confirm Password:</label>
                                        <div class="col-sm-8">

                                            <input v-model="password_confirmation" v-validate="'required|confirmed:password'" id="confirm_password" name="password_confirmation" type="password" class="form-control"  data-vv-as="password" placeholder="Enter Confirm Password">
                                            <div v-show="errors.has('userform.password_confirmation')"><span class="error">@{{ errors.first('userform.password_confirmation') }}</span></div>
                                        </div>
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
                </create-user>
                <change-password :userid="user_id" inline-template>
                    <div id="passwordmodal" ref="thismodel" class="modal fade modal-dialog-center" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Change Password</h4>
                            </div>
                            <form class="form-horizontal" role="form" @submit.prevent="changesubmit('passwordform')" data-vv-scope="passwordform">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="passwords">Password:</label>
                                        <div class="col-sm-8">

                                            <input type="password" class="form-control" id="passwords"  v-model="changepassword.password" name="user_password" v-validate="'required'" placeholder="Enter Password">
                                            <div v-show="errors.has('passwordform.user_password')"><span class="error">@{{ errors.first('passwordform.user_password') }}</span></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="confirm_passwordu">Confirm Password:</label>
                                        <div class="col-sm-8">
                                            <input v-model="chu_password"  v-validate="'required|confirmed:user_password'"  id="confirm_passwordu" name="password_confirmation" type="password" class="form-control" placeholder="Confirm password" data-vv-as="user_password">
                                            <div v-show="errors.has('passwordform.password_confirmation')"><span class="error">@{{ errors.first('passwordform.password_confirmation') }}</span></div>
                                        </div>
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
                </change-password>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <div class="m-b-30">

                                <a  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#usermodal">  <i class="fa fa-plus"></i> Add User</a>
                            </div>
                        </div>
                        {{--<div class="col-sm-6 m-b-30" >--}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-sm-2 col-sm-push-4 control-label" style="text-align: right;margin-top:7px;">User</label>--}}
                                {{--<div class="col-sm-6 col-sm-push-4">--}}
                                    {{--<select class="form-control"  v-model="selected_user" name="batch_id" v-on:change="selectedValueChange">--}}
                                        {{--<option v-for="user in usertypes" :value="user">@{{ user.text }}</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table" id="datatable-normal">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 80%;text-align: center;">Username</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="user,index in users">
                                    <td>@{{pagination.from+index}}</td>

                                    <td style="width: 80%;text-align: center;">@{{user.username}}</td>

                                    <td class="">
                                        <a @click="showEditModal(user)" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                        <a  @click="showDeleteModal(user.id)" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <vue-pagination  :length.number="pagination.last_page" v-model="pagination.current_page" @input="getUser"></vue-pagination>
                    </div>
                </div>
            </div>
        </div>
    </all-user>
@endsection