<div id="edit-profile" class="tab-pane">
    <div class="user-profile-content">

        <form class="form-horizontal  animated bounceInRight"  @submit.prevent="submit" autocomplete="off">
            <div class="form-group">
                <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="email" v-model="guardian.email" v-validate="'required|email'" placeholder="Enter Email">
                    <div  v-show="errors.has('email')"><span class="error">Required email.</span></div>
                </div>

            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">First Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="firstName" v-model="guardian.firstName" v-validate="'required'" placeholder="Enter Last Name">
                    <div v-show="errors.has('firstName')"><span class="error">Required first name.</span></div>
                </div>

            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Last name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="lastName" v-model="guardian.lastName" v-validate="'required'" placeholder="Enter Last Name">
                    <div  v-show="errors.has('lastName')"><span class="error">Required last name.</span></div>
                </div>

            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Relation</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="realation" v-model="guardian.realation" v-validate="'required'" placeholder="Enter Relation">
                    <div  v-show="errors.has('realation')"><span class="error">Required relation.</span></div>
                </div>

            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Occupation</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="occupation" v-model="guardian.occupation" v-validate="'required'" placeholder="Enter Occupation">
                    <div v-show="errors.has('occupation')"><span class="error">Required occupation.</span></div>
                </div>

            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Phone</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="phone" v-model="guardian.phone" v-validate="'required'" placeholder="Enter Phone">
                    <div  v-show="errors.has('phone')"><span class="error">Required phone.</span></div>
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Address</label>
                <div class="col-sm-9">
                    <textarea rows="1" type="text" class="form-control" name="address" v-model="guardian.address" v-validate="'required'" placeholder="Enter Address"></textarea>
                    <div  v-show="errors.has('address')"><span class="error">Required address.</span></div>
                </div>
            </div>


            <div class="text-right">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>