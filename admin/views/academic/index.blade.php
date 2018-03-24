@extends('layout.app')
@section('page-title','Academic Years')
@section('setup','active')
@section('academic','active')

@section('content')
<academic-year inline-template>
    <div class="panel" v-cloak>
        <delete-modal @input="performdelete"></delete-modal>
        <action :academic="academic" :isedit="isedit" @success="successdata"></action>
        <div class="panel-body">

        <div class="row">
            <div class="col-sm-6">
                <div class="m-b-30">
                    <a   class="btn btn-primary btn-sm" @click="showAddModal">  <i class="fa fa-plus"></i> Add Year</a>
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
                                <th>Year</th>
                                <th>Start At</th>
                                <th>End At</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="acad,index in academics">
                                <td>@{{pagination.from+index}}</td>
                                <td>@{{acad.academicName}}

                                <td>@{{formatDate(acad.start_date)}}</td>
                                <td>@{{formatDate(acad.end_date)}}</td>
                                <td>@{{acad.active_year?'Yes':'No'}}</td>
                                <td>
                                    <a @click="showEditModal(acad)" data-toggle="modal" data-target="#mymodal" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                    <a @click="showDeleteModal(acad.id)" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
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
</academic-year>
@endsection