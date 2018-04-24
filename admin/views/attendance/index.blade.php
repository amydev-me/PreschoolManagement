@extends('layout.app')
@section('page-title','Attendance')
@section('attendance','active')
@section('style')
    <style>
        .btn-primary.active, .btn-primary:active, .open>.dropdown-toggle.btn-primary{
            background-color:red;
            border-color:red;
            color:white;
        }
        .btn-primary.active.focus{
            background-color:red;
            border-color:red;
            color:white;
        }
        .btn-primary.active.focus, .btn-primary.active:focus, .btn-primary.active:hover, .btn-primary:active.focus, .btn-primary:active:focus, .btn-primary:active:hover, .open>.dropdown-toggle.btn-primary.focus, .open>.dropdown-toggle.btn-primary:focus, .open>.dropdown-toggle.btn-primary:hover{
            background-color:red;
            border-color:red !important;
            color:white;
        }
        .btn.active.focus, .btn.active:focus, .btn.focus, .btn:active.focus, .btn:active:focus, .btn:focus{
            outline: none;
        }

    </style>
    @endsection
@section('content')
    <attendance inline-template>
        <div v-cloak>

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-body p-t-0">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <label class="col-sm-3 control-label" style="text-align: right;margin-top:7px;">Grade :</label>
                                        <div class="col-sm-9">
                                            <multiselect v-model="selected_grade" :options="grades" :multiple="false" group-values="grades"
                                                         group-label="categoryName" :group-select="false" placeholder="Select grade"
                                                         label="gradeName"  @input="selectedGradeChange">
                                                <span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
                                            </multiselect>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="control-label col-sm-3 " style="text-align: right;margin-top:7px;">Term :</label>
                                        <div class="col-sm-9">
                                            <multiselect
                                                         placeholder="Select term"
                                                         v-model="selected_term"
                                                         label="termName"
                                                         :options="terms"
                                                         :multiple="false"
                                                         :allow-empty="false"
                                                         :searchable="false"
                                                         :internal-search="false" @input="selectedTermChange">
                                            </multiselect>

                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="join_date"  style="text-align: right;margin-top:7px;">Date:</label>
                                            <div class="col-sm-9">
                                                <datepicker  v-model="filter_date" id="join_date" @input="selectedTermChange"></datepicker>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel" v-if="students.length>0">
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table" id="datatable-normal">
                                    <thead>
                                    <tr>
                                        <th style="width:40%;">Student</th>
                                        <th style="text-align: center;">
                                           Attendance

                                        </th>

                                        <th>Remark</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="student,index in students">
                                        <td>@{{student.fullName}}</td>

                                        <td class="mail-select" style="text-align: center;">
                                            <div class="btn-group" data-toggle="buttons"  v-if="!visiblechecked">
                                                <label class="btn btn-primary active" @click="checkboxchecked(index,'P')">
                                                    <input type="radio" :name="'attendance'+student.id"    > Present
                                                </label>
                                                <label class="btn btn-primary" @click="checkboxchecked(index,'A')">
                                                    <input type="radio" :name="'attendance'+student.id"    > Absent
                                                </label>
                                                <label class="btn btn-primary" @click="checkboxchecked(index,'L')">
                                                    <input type="radio" :name="'attendance'+student.id"    > Leave
                                                </label>
                                            </div>

                                            <span class="label label-success" v-if="visiblechecked&&student.status=='P'">Present</span>
                                            <span class="label label-danger" v-if="visiblechecked&&student.status=='A'">Absent</span>
                                            <span class="label label-warning" v-if="visiblechecked&&student.status=='L'">Leave</span>
                                            {{--<i :class="{ 'fa fa-circle text-success' :student.status=='P'}"  v-if="visiblechecked"></i>--}}
                                            {{--<i :class="{ 'fa fa-circle text-danger' :student.status=='A'}"  v-if="visiblechecked"></i>--}}
                                            {{--<i :class="{ 'fa fa-circle text-warning' :student.status=='L'}"  v-if="visiblechecked"></i>--}}
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" v-model="student.remark"  v-if="!visiblechecked">
                                            <span v-if="visiblechecked">@{{ student.remark }}</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <ul id="contextMenu" class="dropdown-menu" role="menu">
                                    <li><a tabindex="-1" href="#" class="payLink">Pay</a></li>
                                    <li><a tabindex="-1" href="#" class="delLink">Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="hidden-print m-t-30">
                        <div class="pull-right">
                            <button @click="save" class="btn btn-inverse" style="margin-right: 30px;" v-show="!visiblechecked"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </attendance>
@endsection
@section('script')
    <script>

    </script>
    @endsection