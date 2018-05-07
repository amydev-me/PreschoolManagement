@extends('layout.app')

@section('payment_setup','active')
@section('payment-list','active')

@section('content')
    <invoice-list inline-template>
    <div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-toolbar" role="toolbar">
                    <h3 class="pull-left m-t-5 m-b-10">Invoice</h3>
                    <div class="pull-right">
                        <a :href="'/admin/send-overdue'" class="btn btn-purple" v-if="status=='overdue'"> <span>Send</span> <i class="fa fa-send m-l-10"></i> </a>
                    </div>
                </div>
            </div>
        </div>

            <div class="panel" v-cloak>
                <div class="panel-body">
                    <delete-modal @input="successdelete" :inputid="payment_id" :inputurl="removeUrl"></delete-modal>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="m-b-30">
                                <a   class="btn btn-primary btn-sm" :href="'/admin/payment/create'">  <i class="fa fa-plus"></i>Add a invoice</a>
                            </div>
                        </div>
                        <div class="col-sm-6" style="text-align:right;">

                            <div class="radio-inline">
                                <label class="cr-styled" for="example-radio4">
                                    <input type="radio" id="example-radio4" name="status-filter" v-model="status" value="paid" @change="loaddata">
                                    <i class="fa"></i>
                                    PAID
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label class="cr-styled" for="example-radio5">
                                    <input type="radio" id="example-radio5" name="status-filter" v-model="status" value="unpaid" @change="loaddata">
                                    <i class="fa"></i>
                                    UNPAID
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label class="cr-styled" for="example-radio6">
                                    <input type="radio" id="example-radio6" name="status-filter" v-model="status" value="overdue" @change="loaddata">
                                    <i class="fa"></i>
                                    OVERDUE
                                </label>
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

                                        <th>Date</th>
                                        <th>Student</th>
                                        <th>Grade</th>
                                        <th>Term</th>
                                        <th>Amount</th>
                                        <th>Status</th>

                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="pay,index in payments">
                                        <td>@{{pagination.from+index}}</td>
                                        <td>@{{formatDate(pay.payment_date)}}</td>

                                        <td>@{{pay.student!=null?pay.student.fullName:''}}</td>
                                        <td>@{{pay.grade!=null?pay.grade.gradeName:''}}</td>
                                        <td>@{{pay.term!=null?pay.term.termName:''}}</td>
                                        <td>@{{formatNumber(pay.total)}}</td>
                                        <td>
                                            <p>
                                                <span class="label label-success" v-if="pay.status=='PAID'">@{{pay.status}}</span>
                                                <span class="label label-danger" v-if="!(pay.due_date< currentdate) && pay.status=='UNPAID'">@{{pay.status}}</span>
                                                <span class="label label-warning" v-if="pay.due_date< currentdate &&pay.status=='UNPAID'">OVERDUE</span>

                                            </p>
                                        </td>

                                        <td>
                                            <a class="label label-primary" :href="'/admin/payment/view?payment_id='+pay.id">view</a>
                                            <a class="label label-info" :href="'/admin/payment/edit?payment_id='+pay.id">edit</a>
                                            <a @click="showDeleteModal(pay.id)" class="label label-danger">delete</a>
                                            {{--<a @click="showDeleteModal(acad.id)" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>--}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <vue-pagination  :length.number="pagination.last_page" v-model="pagination.current_page" @input="loaddata"></vue-pagination>
                        </div>
                    </div>
                </div>
            </div>

    </div>

    </div>
    </invoice-list>
@endsection