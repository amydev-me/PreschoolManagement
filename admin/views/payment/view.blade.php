<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{URL::asset('img/logo.png')}}">

    <title>UNIVERSITY OF OXFORD</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">

    <!--Icon-fonts css-->
    <link href="{{URL::asset('css/myfonts.css')}}" rel="stylesheet" />

    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/bootstrap-reset.css')}}" rel="stylesheet">

    <!--Animation css-->
    <link href="{{URL::asset('css/animate.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/form-wizard/jquery.steps.css')}}" />
    <link href="{{URL::asset('css/csstyles.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/helper.css')}}" rel="stylesheet">
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
            header, aside {
                display:none;
            }
        }
        body, article {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        @page {
            margin-left: 2cm;
            margin-right: 2cm;
        }

    </style>
</head>
<body >

<div id="app">
    <invoice-view inline-template>
        <div class="wraper container-fluid" v-cloak>
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-toolbar" role="toolbar">
                        <div class="pull-right">
                            {{--<button type="button" class="btn btn-success m-r-5 m-b-10"><i class="fa fa-floppy-o"></i></button>--}}
                            {{--<button type="button" class="btn btn-success m-r-5 m-b-10"><i class="fa fa-trash-o"></i></button>--}}
                            <button @click="print" class="btn btn-inverse m-r-5 m-b-10"><i class="fa fa-print"></i>Print</button>

                            <button class="btn btn-purple" id="sa-basic"> <span>Send</span> <i class="fa fa-send m-l-10"></i> </button>
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
                                                <abbr title="Phone">P:</abbr>@{{ student.phone }}
                                            </address>

                                        </div>
                                        <div class="m-t-30" style="width: 40%;text-align: right;">
                                            <p><strong>Date: </strong> @{{ formatDate(payment.payment_date) }}</p>
                                            <p class="m-t-10"><strong>Status: </strong>
                                                <span class="label label-success" v-if="payment.status=='PAID'">@{{payment.status}}</span>
                                                <span class="label label-danger"  v-if="!(payment.due_date< currentdate) && payment.status=='UNPAID'">@{{payment.status}}</span>
                                                <span class="label label-warning" v-if="payment.due_date< currentdate &&payment.status=='UNPAID'">OVERDUE</span>

                                            </p>
                                            {{--<p class="m-t-10"><strong>Order ID: </strong> #123456</p>--}}
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
                                            <hr style="width: 50%;text-align: right;">

                                            {{--<p class="text-right" style="margin-right: 10px;">Receipt Amount: @{{ formatNumber(payment.total-payment.balance) }}</p>--}}


                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
        </div>
    </invoice-view>
</div>
<script src="{{URL::asset('js/jquery-3.1.1.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('js/manifest.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/vendor.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/app.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/pace.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/wow.min.js')}}"></script>
<script src="{{URL::asset('js/jquery.nicescroll.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/common.js')}}" type="text/javascript"></script>
@yield('script')
</body>
</html>


{{--<div class="hidden-print">--}}
    {{--<div class="pull-right">--}}
        {{--<button @click="print" class="btn btn-inverse" style="margin-right: 30px;"><i class="fa fa-print"></i> Print</button>--}}
    {{--</div>--}}
{{--</div>--}}