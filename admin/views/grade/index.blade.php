@extends('layout.app')
@section('page-title','Add New Grade')
@section('setup','active')
@section('grade','active')

@section('content')
    <manage-grade inline-template>
        <div class="panel panel-default">
            <action inline-template>
                <div>
                    <form class="form-horizontal" role="form" @submit.prevent="submitdata">
                        <div class="row">
                            <div class="col-sm-push-1 col-sm-10 col-sm-pull-1">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Year :</label>
                                    <div class="col-sm-10">
                                        <multiselect
                                                open-direction="bottom" v-validate="'required'" data-vv-name="year"
                                                label="academicName" v-model="selected_academic"
                                                :options="academics" :show-labels="false" placeholder="Select year">
                                        </multiselect>
                                    </div>
                                    <div class="col-sm-push-2 col-sm-10" v-show="errors.has('year')"><span class="error">Required year.</span></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Category :</label>
                                    <div class="col-sm-10">
                                        <multiselect
                                                open-direction="bottom" v-validate="'required'" data-vv-name="category"
                                                label="categoryName" v-model="selected_category"
                                                :options="categories" :show-labels="false" placeholder="Select category">
                                        </multiselect>
                                    </div>
                                    <div class="col-sm-push-2 col-sm-9" v-show="errors.has('category')"><span class="error">Required category.</span></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Grade :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="gradeName" v-model="formdata.grade.gradeName" v-validate="'required'">
                                    </div>
                                    <div class="col-sm-push-2 col-sm-9" v-show="errors.has('gradeName')"><span class="error">Required grade name.</span></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Description :</label>
                                    <div class="col-sm-10">
                                        <textarea type="text" rows="1" class="form-control" name="description" v-model="formdata.grade.description"></textarea>
                                    </div>
                                </div>
                                {{--Term1--}}
                                <div class="col-sm-6 m-t-30">
                                    <h3 class="panel-title">
                                        TERM #1
                                    </h3>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Start Date :</label>
                                        <div class="col-sm-8">
                                            <datepicker v-model="formdata.first_term.start_date" data-vv-name="start_date" v-validate="'required'" ></datepicker>
                                        </div>
                                        <div class="col-sm-push-3 col-sm-8" v-show="errors.has('start_date')"><span class="error">Required start date.</span></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">End Date :</label>
                                        <div class="col-sm-8">
                                            <datepicker v-model="formdata.first_term.end_date" data-vv-name="end_date" v-validate="'required'" ></datepicker>
                                        </div>
                                        <div class="col-sm-push-3 col-sm-8" v-show="errors.has('end_date')"><span class="error">Required end date.</span></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Full Time :</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" v-model="formdata.first_term.full.term_time" data-vv-name="ff_term_time" v-validate="'required'" >
                                        </div>
                                        <div class="col-sm-push-3 col-sm-8" v-show="errors.has('ff_term_time')"><span class="error">Required  time.</span></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Amount :</label>
                                        <div class="col-sm-8">
                                            <numeric-input  mask-type="currency"   v-model="formdata.first_term.full.amount" v-validate="'required'" data-vv-name="ff_term_amount"> </numeric-input>
                                        </div>
                                        <div class="col-sm-push-3 col-sm-8" v-show="errors.has('ff_term_amount')"><span class="error">Required  amount.</span></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Half Time :</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" v-model="formdata.first_term.half.term_time" data-vv-name="fh_term_time" data-vv-name="fh_term_time" v-validate="'required'" >
                                        </div>
                                        <div class="col-sm-push-3 col-sm-8" v-show="errors.has('fh_term_time')"><span class="error">Required time.</span></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Amount :</label>
                                        <div class="col-sm-8">
                                            <numeric-input  mask-type="currency"   v-model="formdata.first_term.half.amount" v-validate="'required'" data-vv-name="fh_term_amount"> </numeric-input>

                                        </div>
                                        <div class="col-sm-push-3 col-sm-8" v-show="errors.has('fh_term_amount')"><span class="error">Required amount.</span></div>
                                    </div>
                                </div>
                                {{--Term2--}}
                                <div class="col-sm-6 m-t-30">
                                    <h3 class="panel-title">
                                        TERM #2
                                    </h3>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Start Date :</label>
                                        <div class="col-sm-8">
                                            <datepicker v-model="formdata.second_term.start_date" data-vv-name="s_start_date" v-validate="'required'" ></datepicker>
                                        </div>
                                        <div class="col-sm-push-3 col-sm-8" v-show="errors.has('s_start_date')"><span class="error">Required start date.</span></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">End Date :</label>
                                        <div class="col-sm-8">
                                            <datepicker v-model="formdata.second_term.end_date" data-vv-name="s_end_date" v-validate="'required'" ></datepicker>
                                        </div>
                                        <div class="col-sm-push-3 col-sm-8" v-show="errors.has('s_end_date')"><span class="error">Required end date.</span></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Full Time :</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" v-model="formdata.second_term.full.term_time" data-vv-name="sf_term_time" v-validate="'required'" >
                                        </div>
                                        <div class="col-sm-push-3 col-sm-8" v-show="errors.has('sf_term_time')"><span class="error">Required  time.</span></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Amount :</label>
                                        <div class="col-sm-8">
                                            <numeric-input  mask-type="currency"   v-model="formdata.second_term.full.amount" v-validate="'required'" data-vv-name="sf_term_amount"> </numeric-input>
                                        </div>
                                        <div class="col-sm-push-3 col-sm-8" v-show="errors.has('sf_term_amount')"><span class="error">Required  amount.</span></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Half Time :</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" v-model="formdata.second_term.half.term_time" data-vv-name="sh_term_time" data-vv-name="sh_term_time" v-validate="'required'" >
                                        </div>
                                        <div class="col-sm-push-3 col-sm-8" v-show="errors.has('sh_term_time')"><span class="error">Required time.</span></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Amount :</label>
                                        <div class="col-sm-8">
                                            <numeric-input  mask-type="currency"   v-model="formdata.second_term.half.amount" v-validate="'required'" data-vv-name="sh_term_amount"> </numeric-input>

                                        </div>
                                        <div class="col-sm-push-3 col-sm-8" v-show="errors.has('sh_term_amount')"><span class="error">Required amount.</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Save changes</button>
                        </div>
                    </form>
                </div>
            </action>
        </div>
    </manage-grade>
@endsection