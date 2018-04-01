<div id="aboutme" class="tab-pane active">


        <div v-cloak>
            <delete-modal @input="successdelete" :inputid="teacher_id" :inputurl="removeUrl"></delete-modal>

            <div class="profile-desk  animated bounceInRight" >
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th colspan="2"><span class="h4">Contact Information</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><b>ID</b></td>
                        <td>@{{ teacher.teacherCode }}</td>
                    </tr>
                    <tr>
                        <td><b>Email</b></td>
                        <td>@{{ teacher.personal_email }}</td>
                    </tr>
                    <tr>
                        <td><b>Date Of Birth</b></td>
                        <td>@{{ formatDate(teacher.dateofbirth) }}</td>
                    </tr>
                    <tr>
                        <td><b>Joined Date</b></td>
                        <td>@{{ formatDate(teacher.join_date) }}</td>
                    </tr>
                    <tr>
                        <td><b>NRC/Passport</b></td>
                        <td>@{{ teacher.nrc }}</td>
                    </tr>
                    <tr>
                        <td><b>Nationality</b></td>
                        <td>@{{ teacher.nationality }}</td>
                    </tr>
                    <tr>
                        <td><b>Phone</b></td>
                        <td>@{{ teacher.phone }}</td>
                    </tr>

                    <tr>
                        <td><b>Qualification</b></td>
                        <td>@{{ teacher.degree }}</td>
                    </tr>
                    <tr>
                        <td><b>Salary</b></td>
                        <td>@{{ teacher.salary }}</td>
                    </tr>
                    <tr>
                        <td><b>Benefit</b></td>
                        <td>@{{ teacher.benefit }}</td>
                    </tr>
                    <tr>
                        <td><b>Address</b></td>
                        <td>@{{ teacher.address }}</td>
                    </tr>
                    <tr>
                        <td><b>Contact Name</b></td>
                        <td>@{{ (teacher.contactFirstName==null?' ':teacher.contactFirstName)+' '+(teacher.contactLastName==null?' ':teacher.contactLastName) }}</td>
                    </tr>
                    <tr>
                        <td><b>Contact Email</b></td>
                        <td>@{{ teacher.contactEmail }}</td>
                    </tr>
                    <tr>
                        <td><b>Contact Phone</b></td>
                        <td>@{{ teacher.contactphone }}</td>
                    </tr>
                    <tr>
                        <td><b>Contact Relation</b></td>
                        <td>@{{ teacher.contactrelation }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <div class="pull-right m-b-10">
                    <a @click="showDeleteModal" class="btn btn-danger" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                        <i class="fa fa-close"></i>  Delete
                    </a>
                </div>
            </div>
        </div>


</div>