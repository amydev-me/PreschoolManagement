<div class="tab-pane edit-tab active " id="personal_tab" >
    <form class="form-horizontal  animated bounceInRight"  @submit.prevent="validateData('personal_info_form')" data-vv-scope="personal_info_form" autocomplete="off">
        <div class="form-group" v-if="!isedit" >
            <label class="control-label">Year:</label>
            <multiselect v-validate="'required'" data-vv-scope="personal_info_form" data-vv-name="academic"
                    placeholder="Select year"
                    v-model="selected_academic"
                    label="academicName"
                    :options="academics"
                    :multiple="false"
                    :searchable="false"
                    :allow-empty="false"
                    :show-labels="false"
                    :internal-search="false"
                    :custom-label="customLabel"
                         open-direction="bottom"
                    @input="selectedAcadmiceChange">
            </multiselect>
            <div v-show="errors.has('personal_info_form.academic')"><span class="error">@{{ errors.first('personal_info_form.academic') }}</span></div>
        </div>




        <div class="form-group" v-if="!isedit">
            <label class="control-label">Grade:</label>
            <multiselect v-model="selected_grade" :options="grades" :multiple="false" group-values="grades"  v-validate="'required'" data-vv-scope="personal_info_form" data-vv-name="grade"
                         group-label="categoryName" :group-select="false" placeholder="Select grade"   open-direction="bottom"
                         label="gradeName">
                <span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
            </multiselect>
            <div v-show="errors.has('personal_info_form.grade')"><span class="error">@{{ errors.first('personal_info_form.grade') }}</span></div>
        </div>

        <div class="form-group">
            <label class="control-label" for="join_date">Join Date:</label>
            <datepicker  v-model="student.join_date" v-validate="'required'" data-vv-scope="personal_info_form" data-vv-name="join_date"></datepicker>
            <div v-show="errors.has('personal_info_form.join_date')"><span class="error">@{{ errors.first('personal_info_form.join_date') }}</span></div>
        </div>

        <div class="form-group">
            <label class="control-label">Name <span style="font-size: 12px;">(First,Middle,Last)</span>:</label>
            <input type="text" class="form-control"  v-model="student.fullName" name="fullName" v-validate="'required'" placeholder="Enter Name">
            <div v-show="errors.has('personal_info_form.fullName')"><span class="error">@{{ errors.first('personal_info_form.fullName') }}</span></div>
        </div>

        <div class="form-group">
            <label class="control-label">Other Names:</label>
            <input type="text" class="form-control"  v-model="student.otherName"  placeholder="Enter Other Names">

        </div>

        <div class="form-group">
            <label class="control-label" for="dateofbirth">Date Of Birth:</label>
            <datepicker v-model="personal_info.dateofbirth" v-validate="'required'" data-vv-scope="personal_info_form" data-vv-name="dateofbirth"></datepicker>
            <div v-show="errors.has('personal_info_form.dateofbirth')"><span class="error">@{{ errors.first('personal_info_form.dateofbirth') }}</span></div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3" for="gender">Gender:</label>
            <div class="radio-inline">
                <label class="cr-styled" for="male">
                    <input type="radio" id="male" name="gender" value="Male" v-model="personal_info.gender">
                    <i class="fa"></i>
                    Male
                </label>
            </div>
            <div class="radio-inline">
                <label class="cr-styled" for="female">
                    <input type="radio" id="female" name="gender" value="Female" v-model="personal_info.gender">
                    <i class="fa"></i>
                    Female
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="pof">Place of Birth :</label>
            <input type="text" id="pof"  class="form-control"  v-model="personal_info.placeofbirth"  placeholder="Enter Place Of Birth">

        </div>

        <div class="form-group">
            <label class="control-label" for="nationality">Nationality:</label>
            <multiselect
                    data-vv-scope="personal_info_form"
                    v-validate="'required'"
                    data-vv-name="nationality"
                    v-model="personal_info.nationality"
                    :options="countries"
                    placeholder="Type to search country"
                    open-direction="bottom"></multiselect>
            <div v-show="errors.has('personal_info_form.nationality')"><span class="error">@{{ errors.first('personal_info_form.nationality') }}</span></div>
        </div>

        <div class="form-group">
            <label class="control-label" for="lsah">Language(s) Spoken at Home :</label>
            <input type="text" id="lsah"  class="form-control"  v-model="personal_info.langhome"  placeholder="Language(s) Spoken at Home">

        </div>

        <div class="form-group">
            <label class="control-label">Which address does the student live at? :</label>
            <input type="text" class="form-control"  v-model="student.student_live"  placeholder="Which address does the student live at?">

        </div>

        <div class="form-group">
            <label class="control-label" for="lsah">Religion :</label>
            <input type="text" id="lsah"  class="form-control"  v-model="personal_info.religion"  placeholder="Enter Religion">

        </div>

        <div class="form-group ">
            <label class="control-label" for="email">Profile:</label>
            <div class="fileUpload btn btn-default">
                <span>Upload</span>
                <input type="file" class="upload "  @change="inputFile($event,'profile')"  name="history"/>
            </div>
            <div v-show="errors.has('personal_info_form.profile')"><span class="error">Profile image Required.</span></div>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary" type="button">Next</button>
        </div>
    </form>
</div>