
@extends('layout.app')
@section('page-title','Invoice')

@section('payment','active')

@section('content')

    <invoice-list inline-template>
        <div class="panel" v-cloak>
            <div class="panel-body">
                <delete-modal @input="successdelete" :inputid="payment_id" :inputurl="removeUrl"></delete-modal>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="m-b-30">
                            <a   class="btn btn-primary btn-sm" :href="'/admin/payment/create'">  <i class="fa fa-plus"></i>Add a invoice</a>
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
                                        <a class="label label-primary" :href="'/admin/payment/view?payment_id='+pay.id" target="_blank">view</a>
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
                        {{--<vue-pagination  :length.number="pagination.last_page" v-model="pagination.current_page" @input="searchClick"></vue-pagination>--}}
                    </div>
                </div>
            </div>
        </div>
    </invoice-list>

@endsection