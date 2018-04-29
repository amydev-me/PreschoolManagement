<div id="attendance" class="tab-pane">
        <div class="user-profile-content">
            <div class="row">
                <attendance-chart></attendance-chart>
            </div>

            <div class="row m-t-30">
                <attendance-detail inline-template>
                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                            <div class="row">
                                <h3 class="pull-left">Attendance Details</h3>
                                <div class="btn-group pull-right m-t-15" data-toggle="buttons">
                                    <label class="btn btn-primary active" @click="checkboxchecked('P')">
                                        <input type="radio" name="status"    > Present
                                    </label>
                                    <label class="btn btn-primary" @click="checkboxchecked('A')">
                                        <input type="radio" name="status"    > Absent
                                    </label>
                                    <label class="btn btn-primary" @click="checkboxchecked('L')">
                                        <input type="radio" name="status"    > Leave
                                    </label>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="m-t-10 m-b-10" v-for="a,key in attv">
                                    <h4>@{{ key }}</h4>
                                    <div class="table-responsive ">
                                        <table class="table table-bordered m-b-10 " id="datatable-normal">
                                            <caption></caption>
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="min-width: 38px;text-align:center;">1</th>
                                                <th style="min-width: 38px;text-align:center;">2</th>
                                                <th style="min-width: 38px;text-align:center;">3</th>
                                                <th style="min-width: 38px;text-align:center;">4</th>
                                                <th style="min-width: 38px;text-align:center;">5</th>
                                                <th style="min-width: 38px;text-align:center;">6</th>
                                                <th style="min-width: 38px;text-align:center;">7</th>
                                                <th style="min-width: 38px;text-align:center;">8</th>
                                                <th style="min-width: 38px;text-align:center;">9</th>
                                                <th style="min-width: 38px;text-align:center;">10</th>
                                                <th style="min-width: 38px;text-align:center;">11</th>
                                                <th style="min-width: 38px;text-align:center;">12</th>
                                                <th style="min-width: 38px;text-align:center;">13</th>
                                                <th style="min-width: 38px;text-align:center;">14</th>
                                                <th style="min-width: 38px;text-align:center;">15</th>
                                                <th style="min-width: 38px;text-align:center;">16</th>
                                                <th style="min-width: 38px;text-align:center;">17</th>
                                                <th style="min-width: 38px;text-align:center;">18</th>
                                                <th style="min-width: 38px;text-align:center;">19</th>
                                                <th style="min-width: 38px;text-align:center;">20</th>
                                                <th style="min-width: 38px;text-align:center;">21</th>
                                                <th style="min-width: 38px;text-align:center;">22</th>
                                                <th style="min-width: 38px;text-align:center;">23</th>
                                                <th style="min-width: 38px;text-align:center;">24</th>
                                                <th style="min-width: 38px;text-align:center;">25</th>
                                                <th style="min-width: 38px;text-align:center;">26</th>
                                                <th style="min-width: 38px;text-align:center;">27</th>
                                                <th style="min-width: 38px;text-align:center;">28</th>
                                                <th style="min-width: 38px;text-align:center;">29</th>
                                                <th style="min-width: 38px;text-align:center;">30</th>
                                                <th style="min-width: 38px;text-align:center;">31</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="att in attv[key]">
                                                <td style="font-weight: 800;">@{{ att.monthname }}</td>
                                                <td :style="getStyle(att.d1)"></td>
                                                <td :style="getStyle(att.d2)"></td>
                                                <td :style="getStyle(att.d3)"></td>
                                                <td :style="getStyle(att.d3)"></td>
                                                <td :style="getStyle(att.d4)"></td>
                                                <td :style="getStyle(att.d6)"></td>
                                                <td :style="getStyle(att.d7)"></td>
                                                <td :style="getStyle(att.d8)"></td>
                                                <td :style="getStyle(att.d9)"></td>
                                                <td :style="getStyle(att.d10)"></td>
                                                <td :style="getStyle(att.d11)"></td>
                                                <td :style="getStyle(att.d12)"></td>
                                                <td :style="getStyle(att.d13)"></td>
                                                <td :style="getStyle(att.d14)"></td>
                                                <td :style="getStyle(att.d15)"></td>
                                                <td :style="getStyle(att.d16)"></td>
                                                <td :style="getStyle(att.d17)"></td>
                                                <td :style="getStyle(att.d18)"></td>
                                                <td :style="getStyle(att.d19)"></td>
                                                <td :style="getStyle(att.d20)"></td>
                                                <td :style="getStyle(att.d21)"></td>
                                                <td :style="getStyle(att.d22)"></td>
                                                <td :style="getStyle(att.d23)"></td>
                                                <td :style="getStyle(att.d24)"></td>
                                                <td :style="getStyle(att.d25)"></td>
                                                <td :style="getStyle(att.d26)"></td>
                                                <td :style="getStyle(att.d27)"></td>
                                                <td :style="getStyle(att.d28)"></td>
                                                <td :style="getStyle(att.d29)"></td>
                                                <td :style="getStyle(att.d30)"></td>
                                                <td :style="getStyle(att.d31)"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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