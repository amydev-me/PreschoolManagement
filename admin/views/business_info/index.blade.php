@extends('layout.app')

@section('setup','active')
@section('setting','active')

@section('content')
<div class="row m-t-30" >
    <div class="col-sm-12">
            <div class="panel panel-default p-0" v-cloak >

                <business-info inline-template>
                    <div class="panel-body p-0">
                        <ul class="nav nav-tabs profile-tabs">
                            <li class="active"><a data-toggle="tab" href="#info_setting">App Setting</a></li>
                            <li class=""><a data-toggle="tab" href="#invoice_setting">Invoice Setting</a></li>
                            <li class=""><a data-toggle="tab" href="#email_setting">Email Setting</a></li>


                        </ul>
                        <div class="tab-content m-0">

                            @include('business_info.info')
                            @include('business_info.invoice-setting')
                            @include('business_info.email-setting')

                        </div>
                    </div>
                </business-info>
            </div>
        </div>
    </div>
</div>

@endsection
