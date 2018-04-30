<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{URL::asset('css/invoice.css')}}">

</head>
<body >
<div style="display: block" class="bb">
    <div class="clearfix">
            <div class="logostyle">
                <div style="float: left;">
                <img src="{{storage_path().'/app/images/business/'.$info->invoice_logo}}" style="width: 64px;height: 64px;float:left;">
                </div>
                <div style="float: right;">
                    <h1 style="margin-top: 0px;margin-left:5px;padding: 0px;">
                        {{ $info->title }}<span style="font-size: 18px;margin-left: 5px;font-weight: 600;">Preschool</span>
                    </h1>
                </div>
            </div>
            <div class="infostyle">
                    {{ $info->address }}<br>
                <abbr title="Phone">P:</abbr>{{ $info->phone }}<br>
                    {{ $info->email }}<br>
                    {{ $info->website }}
            </div>

    </div>
    <hr class="linestyle">
    <div class="clearfix">
        <div class="parentstyle">
            Invoice To <br>
            {{$guardian->name}}
            <br>
            {{$guardian->email}}
                <br>
            {{$guardian->address}}
                <br>
                <abbr title="Phone">P:</abbr>   {{$guardian->phone}}

        </div>
        <div class="invoiceinfo">
            <p>
           Invoice Number:  {{$payment->invoice}}
            </p>

            <br>
            <p>
           Invoice Date: {{$payment->payment_date->format('Y-m-d')}}
            </p>

            <br>
            @if($payment->status !='PAID')
            <p >
           Due Date: {{$payment->due_date->format('Y-m-d')}}
            </p>
            @endif

            <br>
            <p>
            Status:
                @if($payment->status =='PAID')
                    <span class="label label-success">PAID</span>
                @elseif( !($payment->status =='UNPAID' && $payment->due_date< \Carbon\Carbon::today()))
                            <span class="label label-danger">UNPAID</span>
                @elseif( ($payment->status =='UNPAID' && $payment->due_date< \Carbon\Carbon::today()))
                    <span class="label label-warning">OVERDUE</span>
                @endif
            </p>

        </div>

    </div>
    <table class="table m-t-30">
        <thead>
        <tr>
            <th style="width:5%;">#</th>
            <th style="width: 75%;">Description</th>
            <th style="text-align: right;width: 20%;">Amount</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>
                <span>{{$payment->grade->academic->academicName}}</span>
                <span>{{$payment->term->termName}}</span>
                <br>

                <span>{{$payment->grade->gradeName}}</span>
                <span>({{$payment->term->start_date->format('F d,Y') .'-'.$payment->term->end_date->format('F d,Y')}})</span>
            </td>
            <td style="text-align: right">{{number_format($payment->amount)}}</td>
        </tr>
        @foreach($payment->fees as $index=>$fee )
        <tr>
                <td>{{$index+2 }}</td>
                <td>{{ $fee->feeName. ($fee->description?(' ('. $fee->description .') '):'')}}</td>
                <td style="text-align: right">{{number_format($fee->pivot->amount) }}</td>

        </tr>
        @endforeach
        <tr>
            <td></td>
            <td style="text-align: right;"><h3>Total </h3></td>
            <td style="text-align: right;"><h3><span>$</span>{{number_format($payment->total)}}</h3></td>
        </tr>
        </tbody>
    </table>


    <div class="row">
        <div style="margin-top:10px;margin-left: 10px;margin-right:10px;border:1px;border:1px solid #E3E5E6;">
            <h4 style="margin-left: 10px;">Instruction</h4><br>
            <div style="margin-left: 20px;margin-bottom: 20px;">
                {!! $info->instruction !!}
            </div>


        </div>
    </div>
</div>
</body>
</html>


