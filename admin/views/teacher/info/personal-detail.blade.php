<div class="tab-pane animated bounceInRight" id="personal_detail" :class="{'tab-pane active animated bounceInRight':isedit,'tab-pane animated bounceInRight':!isedit}">
    <form class="form-horizontal"  @submit.prevent="validateData('personal_detail_form')" data-vv-scope="personal_detail_form" autocomplete="off">


        <div class="form-group">
            <label class="control-label col-sm-2" for="firstName">First Name:</label>
            <div class="col-sm-10">
                <input type="text" id="firstName"  class="form-control"  v-model="teacher.firstName" name="firstName" v-validate="'required'" placeholder="Enter First Name">
                <div v-show="errors.has('personal_detail_form.firstName')"><span class="error">@{{ errors.first('personal_detail_form.firstName') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="lastName">Last Name:</label>
            <div class="col-sm-10">
                <input type="text" id="lastName"  class="form-control"  v-model="teacher.lastName" name="lastName" v-validate="'required'" placeholder="Enter Last Name">
                <div v-show="errors.has('personal_detail_form.lastName')"><span class="error">@{{ errors.first('personal_detail_form.lastName') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="phone">Phone:</label>
            <div class="col-sm-10">
                <input type="text" id="phone"  class="form-control"  v-model="teacher.phone" name="phone" v-validate="'required'" placeholder="Enter Phone No">
                <div v-show="errors.has('personal_detail_form.phone')"><span class="error">@{{ errors.first('personal_detail_form.phone') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="personal_email">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="personal_email" v-model="teacher.personal_email" name="email" v-validate="'required|email'" placeholder="Enter Email">
                <div v-show="errors.has('personal_detail_form.email')"><span class="error">@{{ errors.first('personal_detail_form.email') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="gender">Gender</label>
            <div class="radio-inline">
                <label class="cr-styled" for="male">
                    <input type="radio" id="male" name="gender" value="Male" v-model="teacher.gender">
                    <i class="fa"></i>
                    Male
                </label>
            </div>
            <div class="radio-inline">
                <label class="cr-styled" for="female">
                    <input type="radio" id="female" name="gender" value="Female" v-model="teacher.gender">
                    <i class="fa"></i>
                    Female
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="dateofbirth">Date Of Birth:</label>
            <div class="col-sm-10">
                <datepicker data-vv-scope="personal_detail_form" v-validate="'required'" v-model="teacher.dateofbirth" v-validate="'required'" data-vv-value-path="value" data-vv-name="dateofbirth"></datepicker>
                <div v-show="errors.has('personal_detail_form.dateofbirth')"><span class="error">@{{ errors.first('personal_detail_form.dateofbirth') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="nrc">NRC/Passport:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nrc" v-model="teacher.nrc"  name="nrc" v-validate="'required'" placeholder="Enter NRC/Passport">
                <div v-show="errors.has('personal_detail_form.nrc')"><span class="error">@{{ errors.first('personal_detail_form.nrc') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="nationality">Nationality:</label>
            <div class="col-sm-10">
                <multiselect    data-vv-scope="personal_detail_form" v-validate="'required'" data-vv-name="nationality" v-model="teacher.nationality" :options="countries" placeholder="Type to search country" open-direction="bottom"></multiselect>


                <div v-show="errors.has('personal_detail_form.nationality')"><span class="error">@{{ errors.first('personal_detail_form.nationality') }}</span></div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="address">Address:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="address" rows="1" v-model="teacher.address" name="address" v-validate="'required'" placeholder="Enter Address"></textarea>
                <div v-show="errors.has('personal_detail_form.address')"><span class="error">@{{ errors.first('personal_detail_form.address') }}</span></div>
            </div>
        </div>
        <div class="form-group ">

            <label class="control-label col-sm-2" for="profile">Profile:</label>
            <div class="col-sm-10 ">
                <div class="fileUpload btn btn-default">
                    <span>Upload</span>
                    <input type="file" class="upload" id="profile"  @change="newProfile"  name="profile" v-validate="'image'"/>

                </div>
                <div v-show="errors.has('personal_detail_form.profile')"><span class="error">@{{ errors.first('personal_detail_form.profile') }}</span></div>
            </div>


        </div>
        <div class="text-right">
            <button id="previous_account"  class="btn btn-primary" type="button" @click="personal_back_click" v-if="!isedit">Previous</button>
            <button type="submit" class="btn btn-primary">Next</button>
        </div>
    </form>
</div>