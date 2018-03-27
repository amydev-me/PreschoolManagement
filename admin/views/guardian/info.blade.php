<div id="aboutme" class="tab-pane active">

    <guardian-info :guardian="guardian" inline-template>
        <div v-cloak>
            {{--<delete-modal @input="performdelete"></delete-modal>--}}
            <div class="profile-desk animated bounceInRight">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th colspan="2"><span class="h4">Contact Information</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><b>Name</b></td>
                        <td>@{{ guardian.fullName}}</td>
                    </tr>
                    <tr>
                        <td><b>Phone</b></td>
                        <td>@{{ guardian.phone }}</td>
                    </tr>
                    <tr>
                        <td><b>Email</b></td>
                        <td>@{{ guardian.email }}</td>
                    </tr>
                    <tr>
                        <td><b>Occupation</b></td>
                        <td>@{{ guardian.occupation }}</td>
                    </tr>
                    <tr>
                        <td><b>Address</b></td>
                        <td>@{{ guardian.address }}</td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <div class="pull-right m-b-10 m-t-5">
                    <a @click="showDeleteModal(guardian.id)" class="btn btn-danger" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                        <i  class="fa fa-close"></i>  Delete
                    </a>
                </div>
            </div>
        </div>
    </guardian-info>
</div>