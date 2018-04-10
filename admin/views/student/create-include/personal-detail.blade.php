<div class="tab-pane active1" id="personal_detail">

    <form class="form-horizontal  animated bounceInRight"  @submit.prevent="validateData('personal_detail_form')" data-vv-scope="personal_detail_form">

        <div class="form-group">
            <label class="control-label col-sm-2" for="join_date">Join Date:</label>
            <div class="col-sm-10">
                <datepicker  v-model="student.join_date" v-validate="'required'" data-vv-scope="personal_detail_form" data-vv-name="join_date"></datepicker>
                <div v-show="errors.has('personal_detail_form.join_date')"><span class="error">@{{ errors.first('personal_detail_form.join_date') }}</span></div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="firstName">First Name:</label>
            <div class="col-sm-10">
                <input type="text" id="firstName"  class="form-control"  v-model="student.firstName" name="firstName" v-validate="'required'" placeholder="Enter First Name">
                <div v-show="errors.has('personal_detail_form.firstName')"><span class="error">@{{ errors.first('personal_detail_form.firstName') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="lastName">Last Name:</label>
            <div class="col-sm-10">
                <input type="text" id="lastName"  class="form-control"  v-model="student.lastName" name="lastName" v-validate="'required'" placeholder="Enter Last Name">
                <div v-show="errors.has('personal_detail_form.lastName')"><span class="error">@{{ errors.first('personal_detail_form.lastName') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
                <input type="email" id="email"  class="form-control"  v-model="student.email" name="email" v-validate="'email'" placeholder="Enter Email">
                <div v-show="errors.has('personal_detail_form.email')"><span class="error">@{{ errors.first('personal_detail_form.email') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="phone">Phone:</label>
            <div class="col-sm-10">
                <input type="text" id="phone"  class="form-control"  v-model="student.phone" name="phone" v-validate="'required'" placeholder="Enter Phone No">
                <div v-show="errors.has('personal_detail_form.phone')"><span class="error">@{{ errors.first('personal_detail_form.phone') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="gender">Gender</label>
            <div class="radio-inline">
                <label class="cr-styled" for="male">
                    <input type="radio" id="male" name="gender" value="Male" v-model="student.gender">
                    <i class="fa"></i>
                    Male
                </label>
            </div>
            <div class="radio-inline">
                <label class="cr-styled" for="female">
                    <input type="radio" id="female" name="gender" value="Female" v-model="student.gender">
                    <i class="fa"></i>
                    Female
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="dateofbirth">Date Of Birth:</label>
            <div class="col-sm-10">
                <datepicker v-model="student.dateofbirth" v-validate="'required'" data-vv-scope="personal_detail_form" data-vv-name="dateofbirth"></datepicker>
                <div v-show="errors.has('personal_detail_form.dateofbirth')"><span class="error">@{{ errors.first('personal_detail_form.dateofbirth') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="nrc">NRC/Passport:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nrc" v-model="student.nrc"  name="nrc" v-validate="'required'" placeholder="Enter NRC/Passport">
                <div v-show="errors.has('personal_detail_form.nrc')"><span class="error">@{{ errors.first('personal_detail_form.nrc') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="nationality">Nationality:</label>
            <div class="col-sm-10">
                <multiselect
                        data-vv-scope="personal_detail_form"
                        v-validate="'required'"
                        data-vv-name="nationality"
                        v-model="student.nationality"
                        :options="countries"
                        placeholder="Type to search country"
                        open-direction="bottom"></multiselect>
                <div v-show="errors.has('personal_detail_form.nationality')"><span class="error">@{{ errors.first('personal_detail_form.nationality') }}</span></div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="address">Address:</label>
            <div class="col-sm-10">
                <textarea id="address" class="form-control" rows="1" v-model="student.address" name="address" v-validate="'required'" placeholder="Enter Address"></textarea>
                <div v-show="errors.has('personal_detail_form.address')"><span class="error">@{{ errors.first('personal_detail_form.address') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="meal_preferences">Meal Preferences:</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="1" v-model="student.meal_preferences" name="meal_preferences" v-validate="'required'" placeholder="Enter Meal Preferences"></textarea>
                <div v-show="errors.has('personal_detail_form.meal_preferences')"><span class="error">@{{ errors.first('personal_detail_form.meal_preferences') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="allergies">Allergies:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="allergies" rows="1" v-model="student.allergies" name="allergies" v-validate="'required'" placeholder="Enter Allergies"></textarea>
                <div v-show="errors.has('personal_detail_form.allergies')"><span class="error">@{{ errors.first('personal_detail_form.allergies') }}</span></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="guardian">Guardian</label>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-11">

                        <multiselect
                                label="fullName"
                                open-direction="bottom"
                                placeholder="Type to search guardian"
                                v-validate="'required'"
                                v-model="selected_guardian"
                                data-vv-name="guardian"
                                data-vv-scope="personal_detail_form"

                                :options="guardians"
                                :multiple="false"
                                :searchable="true"

                                @search-change="asyncFindGuardian"></multiselect>
                    </div>
                    <div class="col-sm-1 m-t-5">
                        <button style="height: 35px;" data-toggle="modal" data-target="#guardian-modal" type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div  v-show="errors.has('personal_detail_form.guardian')"><span class="error">The guardian field is required.</span></div>
            </div>
        </div>
        <div class="form-group ">
            <label class="control-label col-sm-2" for="email">Profile:</label>
            <div class="col-sm-10 ">
                <div class="fileUpload btn btn-default">
                    <span>Upload</span>
                    <input type="file" class="upload "  @change="newProfile"  name="profile" v-validate="'image'"/>
                </div>
                <div v-show="errors.has('personal_detail_form.profile')"><span class="error">Profile image Required.</span></div>
            </div>
        </div>
        <div class="form-group ">
            <label class="control-label col-sm-2" for="email">History:</label>
            <div class="col-sm-10 ">
                <div class="fileUpload btn btn-default">
                    <span>Upload</span>
                    <input type="file" class="upload "  @change="newHistory"  name="history"/>
                </div>
            </div>
        </div>
        <div class="text-right">
            <button class="btn btn-primary" type="button" @click="personal_back_click">Previous</button>
            <button type="submit" class="btn btn-primary" type="button">Next</button>
        </div>
    </form>
</div>