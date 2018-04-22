
@extends('layout.app')
@section('page-title','Create Invoice')
@section('payment_setup','active')
@section('add-payment','active')
@section('style')
    <style>
        .form-horizontal .control-label{
            text-align: right !important;
        }
        .input-group .form-control {
            position: unset !important;
        }

    </style>
@endsection
@section('content')
    <create-payment inline-template>

        <div class="panel" v-cloak>
            <div class="panel-body">
                <div class="form">
                    <form class="cmxform form-horizontal tasi-form" role="form" @submit.prevent="submitdata">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Date :</label>
                            <div class="col-sm-10">
                                <datepicker v-model="performdata.payment_date" :value="performdata.payment_date" data-vv-name="payment_date" v-validate="'required'" ></datepicker>
                                <div  v-show="errors.has('payment_date')"><span class="error">Required date.</span></div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Grade :</label>
                            <div class="col-sm-10">
                                <multiselect v-model="selected_grade" :options="grades" :multiple="false" group-values="grades" data-vv-name="grade" v-validate="'required'"
                                             group-label="categoryName" :group-select="false" placeholder="Select grade"
                                             label="gradeName"  @input="selectedGradeChange">
                                    <span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
                                </multiselect>
                                <div  v-show="errors.has('grade')"><span class="error">Required grade.</span></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Student :</label>
                            <div class="col-sm-10">
                                <multiselect data-vv-name="student" v-validate="'required'"
                                        placeholder="Select student"
                                        v-model="selected_student"
                                        label="fullName"
                                        :options="students"
                                        :multiple="false"
                                        :searchable="true"

                                        :internal-search="false"
                                        @search-change="asyncstudentbygrade">

                                </multiselect>
                                <div  v-show="errors.has('student')"><span class="error">Required student.</span></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Term :</label>
                            <div class="col-sm-10">
                                <multiselect data-vv-name="term" v-validate="'required'"
                                        placeholder="Select term"
                                        v-model="selected_term"
                                        label="termName"
                                        :options="terms"
                                        :multiple="false"
                                        :allow-empty="false"

                                        :internal-search="false" @input="selectedTermChange">
                                </multiselect>
                                <div  v-show="errors.has('term')"><span class="error">Required term.</span></div>
                            </div>
                        </div>
                        <div class="form-group" v-if="terms.length>0">
                            <label class="col-sm-2 control-label" for="example-input1-group2">Fees :</label>
                            <div class="col-sm-10">
                                <numeric-input  mask-type="currency"    v-model="performdata.amount"> </numeric-input>
                                {{--<input type="text" class="form-control"  v-model="performdata.amount">--}}
                            </div>
                        </div>
                        <div class="form-group" v-for="fee,index in fees">
                            <label class="col-sm-2 control-label" for="example-input1-group2">@{{ fee.feeName }}:</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <input  type="checkbox" class="cr-styled" v-model="fee.ischecked"  @click="feeCheckedChanged(index)">
                                        </span>
                                    <numeric-input  mask-type="currency"    v-model="fee.amount"  :disabled="!fee.ischecked"> </numeric-input>
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
    </create-payment>


@endsection