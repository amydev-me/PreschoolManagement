@extends('layout.app')

@section('payment','active')

@section('style')
    <style>
        .page-title{
            padding:0px 0px 0px;
        }

        @media print {

            aside.left-panel.collapsed{
                display: none;
            }
            
            body * {
                -webkit-print-color-adjust: exact;
                visibility: hidden;
                size: portrait;
            }
            #section-to-print, #section-to-print * {
                visibility: visible;
            }

            aside.left-panel,footer,header {
                display: none;
            }

            .content{margin-left: 0px !important;}

            @page {
                margin: 0.2cm;
            }
            #not-print{
                display:none;
            }


            .status-color{
                color: #ebc142;
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
                            <a class="btn btn-purple" id="sa-basic" :href="'/admin/invoice?payment_id='+payment.id"> <span>Send</span> <i class="fa fa-send m-l-10"></i> </a>
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
                                    <img style="float: left;margin-top:15px;" v-show="parentData.invoice_logo!=null" class="thumb-md" :src="getImage()">
                                    <h1 style="float: right;margin-left: 5px;">
                                        @{{ parentData.title }}
                                        <br>
                                        <span style="font-size: 18px;margin-left: 2px;font-weight: 600;">  @{{ parentData.business_type }}</span>
                                    </h1>
                                </div>
                                <div class="pull-right" style="width: 250px;text-align: right;">
                                    <address>
                                       @{{ parentData.address }}<br>
                                        <abbr title="Phone"></abbr>@{{ parentData.phone }}<br>
                                        @{{ parentData.email }}<br>
                                        @{{ parentData.website }}
                                    </address>
                                </div>
                                {{--<div class="pull-left" style="width: 200px;">--}}
                                    {{--<address>--}}
                                        {{--<strong>@{{ parentData.title }}</strong>--}}
                                        {{--<br>--}}
                                        {{--@{{ parentData.address }}--}}
                                        {{--<br>--}}
                                        {{--<abbr title="Phone">P:</abbr>@{{ parentData.phone }}--}}
                                    {{--</address>--}}
                                    {{--<h4>Invoice # <br>--}}
                                        {{--<strong>@{{ payment.invoice }}</strong>--}}
                                    {{--</h4>--}}

                                {{--</div>--}}
                            </div>

                            <hr style="margin-top: 10px;">
                            <div class="row">
                                <div class="pull-left" style="margin-left: 30px;width: 200px;">
                                    <h4 class="m-b-25">Invoice To</h4>
                                    <address >
                                        <strong>@{{ student.fullName }}</strong>
                                        <br>
                                        @{{ student.student_guardian.g_one_address }}
                                        <br>
                                        <abbr title="Phone">P:</abbr>@{{ student.student_guardian.g_one_mobile }}
                                    </address>

                                </div>
                                <div class="pull-right" style="display: flex;flex-direction: row;margin-right:20px;">
                                    <div class="m-t-10 " >
                                        <p><strong>Invoice Number &nbsp&nbsp&nbsp</strong>  <strong>@{{ payment.invoice }}</strong> </p>
                                        <p><strong>Invoice Date &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</strong>   @{{ formatDate(payment.payment_date) }}</p>
                                        <p v-if="payment.status != 'PAID'"><strong>Due Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>   @{{ formatDate(term.due_date) }}</p>

                                        <p class="m-t-10 "><strong>Status &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                            <span class="label label-success"  style="background-color: #5cb85c !important;color:#fff !important;border-color:#5cb85c !important;" v-if="payment.status=='PAID'">@{{payment.status}}</span>
                                            <span class="label label-danger"  style="background-color: #d9534f !important;color:#fff !important;border-color:#d9534f !important;"  v-if="!(term.due_date< currentdate) && payment.status=='UNPAID'">@{{payment.status}}</span>
                                            <span class="label label-warning"   style="background-color: #f0ad4e !important;color:#fff !important;border-color:#f0ad4e !important;" v-if="term.due_date< currentdate &&payment.status=='UNPAID'">OVERDUE</span>
                                        </p>
                                        {{--<p><strong>Invoice Date: </strong> @{{ formatDate(payment.payment_date) }}</p>--}}
                                        {{--<p v-if="payment.status != 'PAID'"><strong>Due Date: </strong> @{{ formatDate(payment.due_date) }}</p>--}}
                                        {{--<p class="m-t-10"><strong>Status: </strong>--}}
                                        {{--<span class="label label-success" style="background-color:#2eb398 " v-if="payment.status=='PAID'">@{{payment.status}}</span>--}}
                                        {{--<span class="label label-danger"  style="background-color: #FF6C60" v-if="!(payment.due_date< currentdate) && payment.status=='UNPAID'">@{{payment.status}}</span>--}}
                                        {{--<span class="label label-warning" style="background-color:#ebc142 " v-if="payment.due_date< currentdate &&payment.status=='UNPAID'">OVERDUE</span>--}}
                                        {{--</p>--}}
                                    </div>
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
                                                    <span>@{{grade.academic.academicName?grade.academic.academicName:''}}</span>
                                                    <span>@{{ term.termName}}</span>
                                                    <br>

                                                    <span>@{{grade.gradeName?grade.gradeName:''}}</span>
                                                    <span>@{{ ' ('+testFormat(term.start_date)+' - '+testFormat(term.end_date)+')' }}</span>
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
                                                <td style="text-align: right;"><strong>Discount:</strong></td>
                                                <td style="text-align: right;">@{{ formatNumber(payment.discount) }}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td style="text-align: right;"><h3>Total </h3></td>
                                                <td style="text-align: right;"><h3><span>$</span> @{{ formatNumber(payment.total) }}</h3></td>
                                            </tr>
                                            <tr >
                                            <td ></td>
                                           <td></td>
                                                <td></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-if="parentData.instruction !=null">
                                <div style="margin-top:10px;margin-left: 10px;margin-right:10px;border:1px;border:1px solid #E3E5E6;">
                                    <h4 style="margin-left: 10px;">Instruction</h4><br>
                                    <div style="margin-left: 20px;margin-bottom: 20px;" v-html="parentData.instruction">

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </invoice-view>
@endsection
