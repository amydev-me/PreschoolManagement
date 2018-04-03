<div id="edit-profile" class="tab-pane  animated bounceInRight" >
    <div class="user-profile-content">
        <edit-component :teacher="edit_teacher"  @input="editSuccess" inline-template v-if="editclick">
            <div>
                <ul class="nav nav-pills nav-justified" id="teacher_form">
                    <li class="active">
                        <a data-toggle="tab" href="#personal_detail"> <span id="number">1.</span>Personal Details</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#employee_detail"><span id="number">2.</span> Employment Details</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#contact_info"> <span id="number">3.</span>Contact Person</a>
                    </li>
                </ul>
                <div class="tab-content">
                    @include('teacher.info.personal-detail')
                    @include('teacher.info.employee-detail')
                    @include('teacher.info.contact-person')
                </div>
            </div>
        </edit-component>
    </div>
</div>