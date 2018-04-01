
<div id="aboutme" class="tab-pane active">


    <delete-modal @input="successdelete" :inputid="teacher_id" :inputurl="removeUrl"></delete-modal>
            <div class="profile-desk animated bounceInRight">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th colspan="2"><span class="h4">Contact Information</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><b>ID</b></td>
                        <td>@{{ student.studentCode }}</td>
                    </tr>
                    <tr>
                        <td><b>Email</b></td>
                        <td>@{{ student.email }}</td>
                    </tr>
                    <tr>
                        <td><b>Date Of Birth</b></td>
                        <td>@{{ student.dateofbirth }}</td>
                    </tr>
                    <tr>
                        <td><b>Joined Date</b></td>
                        <td>@{{ student.join_date }}</td>
                    </tr>
                    <tr>
                        <td><b>NRC/Passport</b></td>
                        <td>@{{ student.nrc }}</td>
                    </tr>
                    <tr>
                        <td><b>Nationality</b></td>
                        <td>@{{ student.nationality }}</td>
                    </tr>
                    <tr>
                        <td><b>Phone</b></td>
                        <td>@{{ student.phone }}</td>
                    </tr>
                    <tr>
                        <td><b>Address</b></td>
                        <td>@{{ student.address }}</td>
                    </tr>
                    <tr>
                        <td><b>Contact Name</b></td>
                        <td>@{{ guardian.fullName }}</td>
                    </tr>
                    <tr>
                        <td><b>Contact Phone</b></td>
                        <td>@{{ guardian.phone }}</td>
                    </tr>
                    <tr>
                        <td><b>Contact Email</b></td>
                        <td>@{{ guardian.email }}</td>
                    </tr>

                    <tr>
                        <td><b>Contact Relation</b></td>
                        <td>@{{ guardian.realation }}</td>
                    </tr>
                    <tr>
                        <td><b>Contact Occupation</b></td>
                        <td>@{{ guardian.occupation }}</td>
                    </tr>
                    <tr>
                        <td><b>Contact Address</b></td>
                        <td>@{{ guardian.address }}</td>
                    </tr>
                    <tr>
                        <td><b>History</b></td>
                        <td>
                            <a  v-show="student.history!='null'&&student.history!=''" target="_blank" class="text-info" :href="getHistory(student.history)">
                                <i class="fa fa-paperclip m-r-10 m-b-10"></i> Attachments
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <div class="pull-right m-b-10 m-t-5">
                    <a @click="showDeleteModal" class="btn btn-danger" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                        <i  class="fa fa-close"></i>  Delete
                    </a>
                </div>
            </div>
</div>



