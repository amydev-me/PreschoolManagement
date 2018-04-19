<div id="aboutme" class="tab-pane p-0 active">
    <delete-modal @input="successdelete" :inputid="student_id" :inputurl="removeUrl"></delete-modal>
        <div class="profile-desk animated bounceInRight">
            <div class="panel-group panel-group-joined " id="accordion-test">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                Personal Information
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table table-bordered">

                                <tbody>
                                <tr>
                                    <td style="width:35%"><b>Name</b></td>
                                    <td>@{{ student.fullName }}</td>
                                </tr>
                                <tr>
                                    <td style="width:35%"><b>Other Names</b></td>
                                    <td>@{{ student.otherName }}</td>
                                </tr>
                                <tr>
                                    <td style="width:35%"><b>Date Of Birth</b></td>
                                    <td>@{{ student.student_personal_information.dateofbirth }}</td>
                                </tr>
                                <tr>
                                    <td style="width:35%"><b>Joined Date</b></td>
                                    <td>@{{ student.join_date }}</td>
                                </tr>
                                <tr>
                                    <td style="width:35%"><b>Gender</b></td>
                                    <td>@{{ student.student_personal_information.gender }}</td>
                                </tr>
                                <tr>
                                    <td style="width:35%"><b>Place of Birth</b></td>
                                    <td>@{{ student.student_personal_information.placeofbirth }}</td>
                                </tr>
                                <tr>
                                    <td style="width:35%"><b>Nationality</b></td>
                                    <td>@{{ student.student_personal_information.nationality }}</td>
                                </tr>
                                <tr>
                                    <td style="width:35%"><b>Language(s) Spoken at Home</b></td>
                                    <td>@{{ student.student_personal_information.langhome }}</td>
                                </tr>
                                <tr>
                                    <td style="width:35%"><b>Religion</b></td>
                                    <td>@{{ student.student_personal_information.religion }}</td>
                                </tr>
                                <tr>
                                    <td style="width:35%"><b>Which address does the student live at?</b></td>
                                    <td>@{{ student.student_live }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseTwo" class="collapsed">
                                Educational Background
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Previous Schools Attended</th>
                                    <th>Dates Attended</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>@{{ student.student_background.previous_one }}</td>
                                    <td>@{{ student.student_background.one_date }}
                                        <a  v-show="student.student_background.one_file!='null'&&student.student_background.one_file!=''" target="_blank" class="text-info" :href="getHistory(student.student_background.one_file)">
                                            <i class="fa fa-paperclip m-r-10 m-b-10"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>@{{ student.student_background.previous_two }}</td>
                                    <td>@{{ student.student_background.two_date }}
                                        <a  v-show="student.student_background.two_file!='null'&&student.student_background.two_file!=''" target="_blank" class="text-info" :href="getHistory(student.student_background.two_file)">
                                            <i class="fa fa-paperclip m-r-10 m-b-10"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseThree" class="collapsed">
                                Siblings’ Information
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr >
                                    <th rowspan="2" style="vertical-align: top;">Name</th>
                                    <th rowspan="2" style="vertical-align: top;">Gender</th>
                                    <th rowspan="2">Date of Birth <br><span style="font-size: 12px;font-weight: 300">(DD/MM/YYYY)</span></th>
                                    <th rowspan="2" style="vertical-align: top;">School</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>@{{ student.sibling_information.sb_one_name }}</td>
                                    <td>@{{ student.sibling_information.sb_one_gender }}</td>
                                    <td>@{{ student.sibling_information.sb_one_dob }}</td>
                                    <td>@{{ student.sibling_information.sb_one_school }}</td>
                                </tr>
                                <tr>
                                    <td>@{{ student.sibling_information.sb_two_name }}</td>
                                    <td>@{{ student.sibling_information.sb_two_gender }}</td>
                                    <td>@{{ student.sibling_information.sb_two_dob }}</td>
                                    <td>@{{ student.sibling_information.sb_two_school }}</td>
                                </tr>
                                <tr>
                                    <td>@{{ student.sibling_information.sb_three_name }}</td>
                                    <td>@{{ student.sibling_information.sb_three_gender }}</td>
                                    <td>@{{ student.sibling_information.sb_three_dob }}</td>
                                    <td>@{{ student.sibling_information.sb_three_school }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseFour" class="collapsed">
                                Medical History
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr >
                                    <th style="width: 40%"></th>
                                    <th style="width: 10%;text-align: center;">Yes/No</th>
                                    <th style="width: 50%;text-align: center;"> Remarks</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Asthma</td>
                                        <td style="text-align: center;">@{{ student.student_medical.asthma?'Yes':'No' }}</td>
                                        <td>@{{ student.student_medical.asthma_remark }}</td>
                                    </tr>
                                    <tr>
                                        <td>Allergies</td>
                                        <td style="text-align: center;">@{{ student.student_medical.allergies?'Yes':'No' }}</td>
                                        <td>@{{ student.student_medical.allergies_remark }}</td>
                                    </tr>
                                    <tr>
                                        <td>Diabetes</td>
                                        <td style="text-align: center;">@{{ student.student_medical.diabetes?'Yes':'No' }}</td>
                                        <td>@{{ student.student_medical.diabetes_remark }}</td>
                                    </tr>
                                    <tr>
                                        <td>Epilepsy</td>
                                        <td style="text-align: center;">@{{ student.student_medical.epilepsy?'Yes':'No' }}</td>
                                        <td>@{{ student.student_medical.epilepsy_remark }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tuberculosis</td>
                                        <td style="text-align: center;">@{{ student.student_medical.tuberculosis?'Yes':'No' }}</td>
                                        <td>@{{ student.student_medical.tuberculosis_remark }}</td>
                                    </tr>
                                    <tr>
                                        <td>Others</td>
                                        <td style="text-align: center;">@{{ student.student_medical.asthma?'Yes':'No' }}</td>
                                        <td>@{{ student.student_medical.asthma_remark }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Does your child take regular medication?</td>

                                        <td>@{{ student.student_medical.medication }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Is your child immunized? (Please attach a
                                            copy of the immunization history)
                                        </td>

                                        <td>@{{ student.student_medical.immunized_remark }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Does your child have special needs,
                                            either emotional or physical?</td>

                                        <td>@{{ student.student_medical.emotional }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Does your child have any learning
                                            disabilities/difficulties?
                                        </td>

                                        <td>@{{ student.student_medical.disabilities }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Does your child have any behavioral
                                            problems?
                                        </td>

                                        <td>@{{ student.student_medical.behavioral }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseFive" class="collapsed">
                                Emergency Contact
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table table-bordered">

                                <tbody>

                                    <tr>
                                        <td><b>Name</b></td>
                                        <td>@{{ student.em_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Relationship to Student</b></td>
                                        <td>@{{ student.em_relation }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Contact Number</b></td>
                                        <td>@{{ student.em_contact }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseSix" class="collapsed">
                                Parent/Guardian#1
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSix" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table table-bordered">

                                <tbody>

                                <tr>
                                    <td style="width: 30%;"><b>Relationship to Student</b></td>
                                    <td>@{{ student.student_guardian.g_one_relation }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;"><b>Name (First, Middle, Last)</b></td>
                                    <td>@{{ student.student_guardian.g_one_name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;"><b>Email Address</b></td>
                                    <td>@{{ student.student_guardian.g_one_email }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;"><b>Occupation</b></td>
                                    <td>@{{ student.student_guardian.g_one_occupation }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;"><b>Address</b></td>
                                    <td>@{{ student.student_guardian.g_one_address }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;"><b>Mobile Number</b></td>
                                    <td>@{{ student.student_guardian.g_one_mobile }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;"><b>Home Number</b></td>
                                    <td>@{{ student.student_guardian.g_one_home }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;"><b>Work Number</b></td>
                                    <td>@{{ student.student_guardian.g_one_work }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseSeven" class="collapsed">
                                Parent/Guardian#2
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSeven" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table table-bordered">

                                <tbody>

                                    <tr>
                                        <td style="width: 30%;"><b>Relationship to Student</b></td>
                                        <td>@{{ student.student_guardian.g_two_relation }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;"><b>Name (First, Middle, Last)</b></td>
                                        <td>@{{ student.student_guardian.g_two_name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;"><b>Email Address</b></td>
                                        <td>@{{ student.student_guardian.g_two_email }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;"><b>Occupation</b></td>
                                        <td>@{{ student.student_guardian.g_two_occupation }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;"><b>Address</b></td>
                                        <td>@{{ student.student_guardian.g_two_address }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;"><b>Mobile Number</b></td>
                                        <td>@{{ student.student_guardian.g_two_mobile }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;"><b>Home Number</b></td>
                                        <td>@{{ student.student_guardian.g_two_home }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;"><b>Work Number</b></td>
                                        <td>@{{ student.student_guardian.g_two_work }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        {{--</div>--}}
        {{--<div class="col-md-12">--}}
            {{--<div class="pull-right m-b-10 m-t-5">--}}
                {{--<a @click="showDeleteModal" class="btn btn-danger" data-placement="top" data-toggle="tooltip" data-original-title="Delete">--}}
                    {{--<i  class="fa fa-close"></i>  Delete--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--</div>--}}
</div>


</div>
