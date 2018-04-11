
@extends('layout.app')
@section('page-title','Edit Invoice')
@section('payment','active')

@section('style')
    <style>
        .form-horizontal .control-label{
            text-align: right !important;
        }
        .input-group .form-control {
            position: unset !important;
        }
        .multiselect__option--group {
            background: #e3f2fd !important;
            color: #708690 !important;

        }
        .multiselect--disabled .multiselect__current, .multiselect--disabled .multiselect__select, .multiselect__option--disabled{
            background: #e3f2fd !important;
            color: #708690 !important;
            font-weight: 800;
        }
    </style>
@endsection
@section('content')
    <edit-payment inline-template>

        <div class="panel" v-cloak>
            <div class="panel-body">
                <div class="form">
                    <form class="cmxform form-horizontal tasi-form" role="form" @submit.prevent="submitdata">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Grade :</label>
                            <div class="col-sm-10">
                                <multiselect v-model="selected_grade" :options="grades" :multiple="false" group-values="grades"
                                             group-label="categoryName" :group-select="false" placeholder="Select grade"
                                             label="gradeName"  @input="selectedGradeChange" :disabled="true">
                                    <span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
                                </multiselect>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Student :</label>
                            <div class="col-sm-10">
                                <multiselect
                                        placeholder="Select student"
                                        v-model="selected_student"
                                        label="fullName"
                                        :options="students"
                                        :multiple="false"
                                        :searchable="true"
                                        :disabled="true"
                                        :internal-search="false"
                                        @search-change="asyncstudentbygrade">

                                </multiselect>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Term :</label>
                            <div class="col-sm-10">
                                <multiselect
                                        placeholder="Select term"
                                        v-model="selected_term"
                                        label="termName"
                                        :options="terms"
                                        :multiple="false"
                                        :allow-empty="false"
                                        :disabled="true"
                                        :internal-search="false" @input="selectedTermChange">
                                </multiselect>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Term Fees :</label>
                            <div class="col-sm-10">
                                <numeric-input  mask-type="currency"     v-model="performdata.amount"> </numeric-input>
                                {{--<input type="text" class="form-control"  v-model="performdata.amount">--}}
                            </div>
                        </div>
                        <div class="form-group" v-for="fee,index in fees">
                            <label class="col-sm-2 control-label">@{{ fee.feeName }}:</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <input  type="checkbox" class="cr-styled" v-model="fee.ischecked">
                                        </span>
                                    <numeric-input  mask-type="currency"    v-model="fee.amount" :disabled="!fee.ischecked"> </numeric-input>
                                    {{--<input type="text" class="form-control" id="example-input3-group2" v-model="fee.amount" :disabled="!fee.ischecked">--}}
                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                </div>
                            </div>
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<label class="col-sm-2 control-label" for="example-input1-group2">Fine :</label>--}}
                            {{--<div class="col-sm-10">--}}

                                {{--<numeric-input  mask-type="currency"    v-model="performdata.fine"> </numeric-input>--}}
                                {{--<input type="text" class="form-control"  v-model="performdata.fine">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="example-input1-group2" >Total :</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <numeric-input  mask-type="currency"   :disabled="true"   :value="totalvalue"> </numeric-input>
                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="example-input1-group2">Receipt :</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <numeric-input  mask-type="currency"      v-model="performdata.receipt_amount"> </numeric-input>
                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="pull-right m-r-10">

                                <a :href="'/admin/payment'" class="btn btn-default" type="button">Cancel</a>
                                <button class="btn btn-info" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </edit-payment>


@endsection