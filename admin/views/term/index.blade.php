@extends('layout.app')
@section('page-title','Terms')
@section('setup','active')
@section('term','active')
@section('style')
    <style>
        .input-group .form-control {
            position: unset !important;
        }
    </style>

    @endsection
@section('content')
    <manage-term inline-template>
        <div class="panel" v-cloak>
            <delete-modal @input="successdelete" :inputid="term_id" :inputurl="removeUrl"></delete-modal>
            <action  :term="term" :isedit="isedit" @success="successdata" :academics="academics" inline-template>
                @include('term.create')
            </action>
            <div class="panel-body">

                <div class="row">
                    <div class="col-sm-8">
                        <a   class="btn btn-primary btn-sm  m-b-30" @click="showAddModal">  <i class="fa fa-plus"></i> Add Term</a>
                    </div>
                    <div class="col-sm-4 m-b-30">
                        <multiselect
                                placeholder="Select year"
                                v-model="active_academic"
                                label="academicName"
                                :options="academics"
                                :multiple="false"
                                :searchable="false"
                                :allow-empty="false"
                                :show-labels="false"
                                :internal-search="false"
                                :custom-label="customLabel"
                                @input="selectedAcadmiceChange">
                        </multiselect>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table" id="datatable-normal">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Term</th>
                                    <th>Category</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Due Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="term,index in terms">
                                    <td>@{{index+1}}</td>
                                    <td>@{{term.termName}}</td>
                                    <td>@{{term.category?term.category.categoryName:''}}</td>
                                    <td>@{{testFormat(term.start_date)}}</td>
                                    <td>@{{testFormat(term.end_date)}}</td>
                                    <td>@{{testFormat(term.due_date)}}</td>
                                    <td>
                                        <a @click="showEditModal(term)"  class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                        <a @click="showDeleteModal(term.id)" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </manage-term>
@endsection