@extends('layout.app')
@section('page-title','All Subjects')
@section('setup','active')
@section('subject','active')

@section('content')
    <manage-subject inline-template>
        <div class="panel" v-cloak>
            <delete-modal @input="performdelete"></delete-modal>
            <action :subject="subject" :isedit="isedit" @success="successdata"></action>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="m-b-30">
                            <a   class="btn btn-primary btn-sm" @click="showAddModal">  <i class="fa fa-plus"></i> Add Subject</a>
                        </div>
                    </div>
                    <div class="col-sm-4 pull-right">
                        <div class="form-group m-b-30 ">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Type to search" v-model="filtertext">
                                <span class="input-group-btn"> <button type="submit" class="btn btn-primary" @click="searchClick">Search</button> </span>
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
                                    <th style="width: 30%;text-align: center">Subject</th>
                                    <th style="width: 50%;text-align: center">Description</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="sub,index in subjects">
                                    <td>@{{pagination.from+index}}</td>
                                    <td style="width: 30%;text-align: center">@{{sub.subjectName}}</td>
                                    <td style="width: 50%;text-align: center">@{{sub.description}}</td>
                                    <td>
                                        <a @click="showEditModal(sub)" data-toggle="modal" data-target="#mymodal" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                        <a @click="showDeleteModal(sub.id)" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
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
    </manage-subject>
@endsection