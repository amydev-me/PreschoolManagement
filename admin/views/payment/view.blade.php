@extends('layout.app')

@section('payment','active')

@section('style')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #section-to-print, #section-to-print * {
                visibility: visible;

            }

        }
    </style>
@endsection
@section('content')
    <invoice-view inline-template>
        <div class="row" v-cloak>
            <div class="col-md-12">
                <div class="panel panel-default" id="section-to-print">
                    <!-- <div class="panel-heading">
                        <h4>Invoice</h4>
                    </div> -->
                    <div class="panel-body">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h1 class="text-right"><img v-show="parentData.logo!='null'" class="thumb-md" :src="getImage()">@{{ parentData.title }}

                                </h1>



                            </div>
                            <div class="pull-right">
                                <h4>Invoice # <br>
                                    <strong>@{{ payment.invoice }}</strong>
                                </h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="col-md-4 m-t-30 m-l-30">
                                   <h4 class="m-b-25">Invoice From</h4>
                                    <address>
                                        <strong>@{{ parentData.title }}</strong><br>
                                        @{{ parentData.address }}<br>
                                        <abbr title="Phone">P:</abbr>@{{ parentData.phone }}
                                    </address>

                                </div>
                                <div class="col-md-4 m-t-30">
                                    <h4 class="m-b-25">Invoice To</h4>
                                    <address>
                                        <strong>@{{ student.fullName }}</strong><br>
                                        @{{ student.address }}<br>
                                        <abbr title="Phone">P:</abbr>@{{ student.phone }}
                                    </address>

                                </div>
                                <div class="pull-right m-t-30">
                                    <p><strong>Date: </strong> @{{ formatDate(payment.payment_date) }}</p>
                                    <p class="m-t-10"><strong>Status: </strong>
                                        <span class="label label-success" v-if="payment.status=='PAID'">@{{payment.status}}</span>
                                        <span class="label label-danger"  v-if="payment.due_date> currentdate && payment.status=='UNPAID'">@{{payment.status}}</span>
                                        <span class="label label-warning" v-if="payment.due_date< currentdate &&payment.status=='UNPAID'">OVERDUE</span>

                                    </p>
                                    {{--<p class="m-t-10"><strong>Order ID: </strong> #123456</p>--}}
                                </div>
                            </div>
                        </div>
                        <div class="m-h-50"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table m-t-30">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Description</th>
                                                <th style="text-align: right">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td>1</td>
                                                <td>
                                                    <span>@{{grade.academic.academicName +' '+term.termName}}</span><br>

                                                    <span>@{{grade.gradeName+' ('+testFormat(term.start_date)+' - '+testFormat(term.end_date)+')'}}</span>
                                                </td>

                                                <td style="text-align: right">@{{ formatNumber(payment.amount) }}</td>
                                            </tr>
                                            <tr v-for="fee,index in fees">
                                                <td>@{{index+2 }}</td>
                                                <td>@{{ fee.feeName+ (fee.description?(' ('+ fee.description +') '):'')}}</td>
                                                <td style="text-align: right">@{{formatNumber(fee.pivot.amount) }}</td>

                                            </tr>
                                        <tr>


                                            <td></td>
                                            <td></td>

                                            <td style="text-align: right"></td>

                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="border-radius: 0px;">
                            <div class="col-md-3 col-md-offset-9">
                                <h3 class="text-right" style="margin-right: 10px;"><span>$</span> @{{ formatNumber(payment.total) }}</h3>
                                <hr>

                                {{--<p class="text-right" style="margin-right: 10px;">Receipt Amount: @{{ formatNumber(payment.total-payment.balance) }}</p>--}}


                            </div>
                        </div>

                    </div>
                </div>
                <div class="hidden-print m-t-30">
                    <div class="pull-right">
                        <button @click="print" class="btn btn-inverse" style="margin-right: 30px;"><i class="fa fa-print"></i> Print</button>
                    </div>
                </div>
            </div>
        </div>
    </invoice-view>

@endsection