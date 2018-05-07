<div id="edit-profile" class="tab-pane p-0">
    <div class="user-profile-content">
        <edit-component v-if="editview" :isedit="true"  @input="editSuccess" inline-template>

            <div>
                <div class="col-sm-3">
                    <ul class="nav nav-pills nav-stacked " id="student_form">

                        <li class="active">
                            <a data-toggle="tab" href="#personal_tab">  <span id="number">1.</span> Personal Info</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#background_tab">   <span id="number">2.</span> Educational Background</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#sibling_tab">  <span id="number">3.</span> Siblings’ Info</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#medical_tab">  <span id="number">4.</span> Medical History</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#em_tab">  <span id="number">5.</span> Emergency Contact</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#guardian_tab">  <span id="number">6.</span> Guardians Info</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-9">
                    <div class="panel edit-panel">
                        <div class="panel-body edit-panel">
                            <div class="tab-content active">
                                @include('student.create-include.personal-info')
                                @include('student.create-include.background')
                                @include('student.create-include.siblings-info')
                                @include('student.create-include.medical')
                                @include('student.create-include.emergency-contact')
                                @include('student.create-include.guardian')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </edit-component>
    </div>
</div>