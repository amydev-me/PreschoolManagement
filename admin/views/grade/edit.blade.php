@extends('layout.app')
@section('page-title','Manage Grade')
@section('setup','active')
@section('grade','active')
@section('style')
    <style>
        .form-horizontal .control-label{
            text-align: right !important;
        }
    </style>
@endsection
@section('content')
    <edit-grade inline-template>
        <div class="panel" v-cloak>
            <div class="panel-body">
                <div class="form">
                    <form class="cmxform form-horizontal tasi-form" role="form" @submit.prevent="submitdata">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Year :</label>
                            <div class="col-sm-10">
                                <academic-select :empty="false" @input="selectedAcadmiceChange" :value="selected_academic" data-vv-name="academic" v-validate="'required'"></academic-select>
                                <div  v-show="errors.has('academic')"><span class="error">Required year.</span></div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Category :</label>
                            <div class="col-sm-10">
                                <category-select @input="selectedCategoryChange" :value="selected_category"></category-select>

                            </div>
                            <div class="col-sm-push-2 col-sm-9" v-show="errors.has('category')"><span class="error">Required category.</span></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Grade :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="gradeName" v-model="performdata.gradeName" v-validate="'required'">
                            </div>
                            <div class="col-sm-push-2 col-sm-9" v-show="errors.has('gradeName')"><span class="error">Required grade name.</span></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description :</label>
                            <div class="col-sm-10">
                                <textarea type="text" rows="1" class="form-control" name="description" v-model="performdata.description"></textarea>
                            </div>
                        </div>
                        <div class="form-group" v-for="term,index in terms">
                            <label class="col-md-2 control-label" for="example-input1-group2">@{{ term.termName }}:</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <input  type="checkbox" class="cr-styled" v-model="term.ischecked" @click="checkedChanged(term,index)">
                                        </span>
                                    <input type="text" class="form-control" id="example-input3-group1" v-model="term.amount" :disabled="!term.ischecked">
                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="pull-right m-r-10">

                                <button class="btn btn-default" type="button">Cancel</button>
                                <button class="btn btn-info" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </edit-grade>


@endsection