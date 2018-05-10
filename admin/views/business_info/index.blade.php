@extends('layout.app')

@section('setup','active')
@section('setting','active')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" />

@endsection
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
@section('script')
    <script type="text/javascript" src="{{URL::asset('assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}"></script>
    <script>
      $(document).ready(function(){
        $('#instruction_text').wysihtml5({
          "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
          "emphasis": true, //Italics, bold, etc. Default true
          "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
          "html": false, //Button which allows you to edit the generated HTML. Default false
          "link": true, //Button to insert a link. Default true
          "image": false, //Button to insert an image. Default true,
          "color": false, //Button to change color of font
          "blockquote": true, //Blockquote
          "stylesheets": false
        });
        $('#email_text').wysihtml5({
          "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
          "emphasis": true, //Italics, bold, etc. Default true
          "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
          "html": false, //Button which allows you to edit the generated HTML. Default false
          "link": true, //Button to insert a link. Default true
          "image": false, //Button to insert an image. Default true,
          "color": false, //Button to change color of font
          "blockquote": true, //Blockquote
          "stylesheets": false
        });
      });

    </script>
    @endsection