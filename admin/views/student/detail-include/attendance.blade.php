<div id="attendance" class="tab-pane">
        <div class="user-profile-content">
            <div class="row">
                <attendance-chart>
                </attendance-chart>
            </div>
            <div class="row">
                <attendance-detail inline-template>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive m-t-10 m-b-10" v-for="a,key in attv">
                                <h3>@{{ key }}</h3>
                                <table class="table table-bordered" id="datatable-normal" >
                                    <caption></caption>
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>5</th>
                                        <th>6</th>
                                        <th>7</th>
                                        <th>8</th>
                                        <th>9</th>
                                        <th>10</th>
                                        <th>11</th>
                                        <th>12</th>
                                        <th>13</th>
                                        <th>14</th>
                                        <th>15</th>
                                        <th>16</th>
                                        <th>17</th>
                                        <th>18</th>
                                        <th>19</th>
                                        <th>20</th>
                                        <th>21</th>
                                        <th>22</th>
                                        <th>23</th>
                                        <th>24</th>
                                        <th>25</th>
                                        <th>26</th>
                                        <th>27</th>
                                        <th>28</th>
                                        <th>29</th>
                                        <th>30</th>
                                        <th>31</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr v-for="att in attv[key]">
                                         <td style="font-weight: 800;">@{{ att.monthname }}</td>
                                         <td style="font-weight: 800;" >@{{ att.d1 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d2 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d3 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d4 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d5 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d6 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d7 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d8 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d9 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d10 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d11 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d12 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d13 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d14 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d15 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d16 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d17 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d18 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d19 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d20 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d21}}</td>
                                         <td style="font-weight: 800;">@{{ att.d22 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d23 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d24 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d25 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d26 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d27 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d28 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d29 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d30 }}</td>
                                         <td style="font-weight: 800;">@{{ att.d31 }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                </attendance-detail>
            </div>
        </div>
</div>



{{--<div class="col-md-12 col-sm-12 col-xs-12">--}}

{{--<div class="table-responsive">--}}

{{--<table class="table table-bordered" id="datatable-normal">--}}
{{--<thead>--}}
{{--<tr>--}}
{{--<th>#</th>--}}
{{--<th>1</th>--}}
{{--<th>2</th>--}}
{{--<th>3</th>--}}
{{--<th>4</th>--}}
{{--<th>5</th>--}}
{{--<th>6</th>--}}
{{--<th>7</th>--}}
{{--<th>8</th>--}}
{{--<th>9</th>--}}
{{--<th>10</th>--}}
{{--<th>11</th>--}}
{{--<th>12</th>--}}
{{--<th>13</th>--}}
{{--<th>14</th>--}}
{{--<th>15</th>--}}
{{--<th>16</th>--}}
{{--<th>17</th>--}}
{{--<th>18</th>--}}
{{--<th>19</th>--}}
{{--<th>20</th>--}}
{{--<th>21</th>--}}
{{--<th>22</th>--}}
{{--<th>23</th>--}}
{{--<th>24</th>--}}
{{--<th>25</th>--}}
{{--<th>26</th>--}}
{{--<th>27</th>--}}
{{--<th>28</th>--}}
{{--<th>29</th>--}}
{{--<th>30</th>--}}
{{--<th>31</th>--}}
{{--</tr>--}}
{{--</thead>--}}
{{--<tbody>--}}

{{--<tr v-for="att in attendances">--}}
{{--<td>@{{ att.monthname }}</td>--}}
{{--<td>@{{ att.d1 }}</td>--}}
{{--<td>@{{ att.d2 }}</td>--}}
{{--<td>@{{ att.d3 }}</td>--}}
{{--<td>@{{ att.d4 }}</td>--}}
{{--<td>@{{ att.d5 }}</td>--}}
{{--<td>@{{ att.d6 }}</td>--}}
{{--<td>@{{ att.d7 }}</td>--}}
{{--<td>@{{ att.d8 }}</td>--}}
{{--<td>@{{ att.d9 }}</td>--}}
{{--<td>@{{ att.d10 }}</td>--}}
{{--<td>@{{ att.d11 }}</td>--}}
{{--<td>@{{ att.d12 }}</td>--}}
{{--<td>@{{ att.d13 }}</td>--}}
{{--<td>@{{ att.d14 }}</td>--}}
{{--<td>@{{ att.d15 }}</td>--}}
{{--<td>@{{ att.d16 }}</td>--}}
{{--<td>@{{ att.d17 }}</td>--}}
{{--<td>@{{ att.d18 }}</td>--}}
{{--<td>@{{ att.d19 }}</td>--}}
{{--<td>@{{ att.d20 }}</td>--}}
{{--<td>@{{ att.d21}}</td>--}}
{{--<td>@{{ att.d22 }}</td>--}}
{{--<td>@{{ att.d23 }}</td>--}}
{{--<td>@{{ att.d24 }}</td>--}}
{{--<td>@{{ att.d25 }}</td>--}}
{{--<td>@{{ att.d26 }}</td>--}}
{{--<td>@{{ att.d27 }}</td>--}}
{{--<td>@{{ att.d28 }}</td>--}}
{{--<td>@{{ att.d29 }}</td>--}}
{{--<td>@{{ att.d30 }}</td>--}}
{{--<td>@{{ att.d31 }}</td>--}}
{{--</tr>--}}
{{--</tbody>--}}
{{--</table>--}}
{{--</div>--}}
{{--</div>--}}