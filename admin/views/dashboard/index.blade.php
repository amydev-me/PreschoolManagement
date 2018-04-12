@extends('layout.app')
@section('dashboard','active')


@section('content')

    <dashboard inline-template>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="widget-panel widget-style-2 white-bg">
                    <i class="fa fa-graduation-cap text-pink"></i>
                    <h2 class="m-0 counter">{{$studentcount}}</h2>
                    <div>Students</div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="widget-panel widget-style-2 white-bg">
                    <i class="fa  fa-group text-warning"></i>
                    <h2 class="m-0 counter">{{$guardiancount}}</h2>
                    <div>Guardians</div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="widget-panel widget-style-2 white-bg">
                    <i class="fa  fa-group text-success"></i>
                    <h2 class="m-0 counter">{{$teachercount}}</h2>
                    <div>Teachers</div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="widget-panel widget-style-2 white-bg">
                    <i class="ion-ios7-bookmarks text-purple"></i>
                    <h2 class="m-0 counter">{{$subjectcount}}</h2>
                    <div>Subjects</div>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="portlet"><!-- /primary heading -->
                    <div class="portlet-heading">
                        <h3 class="portlet-title text-dark">Yearly Student Chart</h3>
                        <div class="portlet-widgets">
                            <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                        </div>
                        {{--<div class="clearfix"></div>--}}
                    </div>
                    <div id="portlet2" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <canvas width="400" height="200" id="planet-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="portlet"><!-- /primary heading -->
                    <div class="portlet-heading">
                        <h3 class="portlet-title text-dark">Yearly Income Chart</h3>
                        <div class="portlet-widgets">
                            <a data-toggle="collapse" data-parent="#accordion1" href="#portlet1"><i class="ion-minus-round"></i></a>
                        </div>
                        {{--<div class="clearfix"></div>--}}
                    </div>
                    <div id="portlet1" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <canvas width="400" height="200" id="income-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </dashboard>

@endsection
