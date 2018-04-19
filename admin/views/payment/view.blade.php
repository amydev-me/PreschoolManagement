@extends('layout.app')

@section('payment','active')

@section('style')
    <style>
        .page-title{
            padding:0px 0px 0px;
        }
        @media print {
            body * {
                visibility: hidden;
                size: portrait;
            }
            #section-to-print, #section-to-print * {
                visibility: visible;
            }

            aside {
                display: none;
            }
            .content{margin-left: 0px;}
            footer {
                display: none;
            }
            header {
                display: none;
            }
            @page {
                margin: 0.5cm;
            }
            #not-print{
                display:none;
            }
        }
    </style>
@endsection
@section('content')
    <invoice-view inline-template>
        <div class="wraper container-fluid" v-cloak>
            <div class="row"  id="not-print">
                <div class="col-md-12">
                    <div class="btn-toolbar" role="toolbar">
                        <div class="pull-right">
                            <button  @click="print" class="btn btn-inverse m-r-5 m-b-10" ><span>Print</span><i class="fa fa-print m-l-10" ></i></button>
                            <button class="btn btn-purple" id="sa-basic" > <span>Send</span> <i class="fa fa-send m-l-10"></i> </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default" >
                        <!-- <div class="panel-heading">
                            <h4>Invoice</h4>
                        </div> -->
                        <div class="panel-body" id="section-to-print">
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
                            <hr style="margin-top: 20px;">
                            <div style="display: flex;flex-direction: row">
                                <div class="m-t-30"  style="width: 30%;margin-right: 30px !important;">
                                    <h4 class="m-b-25">Invoice From</h4>
                                    <address>
                                        <strong>@{{ parentData.title }}</strong><br>
                                        @{{ parentData.address }}<br>
                                        <abbr title="Phone">P:</abbr>@{{ parentData.phone }}
                                    </address>

                                </div>
                                <div class="m-t-30"  style="width: 30%">
                                    <h4 class="m-b-25">Invoice To</h4>
                                    <address>
                                        <strong>@{{ student.fullName }}</strong><br>
                                        @{{ student.address }}<br>
                                        <abbr title="Phone">P:</abbr>@{{ student.phone}}
                                    </address>
                                </div>
                                <div class="m-t-30" style="width: 40%;text-align: right;">
                                    <p><strong>Invoice Date: </strong> @{{ formatDate(payment.payment_date) }}</p>
                                    <p v-if="payment.status != 'PAID'"><strong>Due Date: </strong> @{{ formatDate(payment.due_date) }}</p>
                                    <p class="m-t-10"><strong>Status: </strong>
                                        <span class="label label-success" style="background-color:#2eb398 " v-if="payment.status=='PAID'">@{{payment.status}}</span>
                                        <span class="label label-danger"  style="background-color: #FF6C60" v-if="!(payment.due_date< currentdate) && payment.status=='UNPAID'">@{{payment.status}}</span>
                                        <span class="label label-warning" style="background-color:#ebc142 " v-if="payment.due_date< currentdate &&payment.status=='UNPAID'">OVERDUE</span>
                                    </p>
                                </div>
                            </div>
                            <div class="m-h-20"></div>
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
                                                    <span>@{{grade.academic.academicName?grade.academic.academicName:'' +' '+term.termName}}</span><br>

                                                    <span>@{{grade.gradeName?grade.gradeName:''+' ('+testFormat(term.start_date)+' - '+testFormat(term.end_date)+')'}}</span>
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
                                    {{--<hr style="text-align: right;width: 80%;">--}}
                                    {{--<p class="text-right" style="margin-right: 10px;">Receipt Amount: @{{ formatNumber(payment.total-payment.balance) }}</p>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </invoice-view>
@endsection
