<div class="tab-pane active" id="account_detail">
    <form class="form-horizontal  animated bounceInRight"  role="form" @submit.prevent="validateData('account-form')" data-vv-scope="account-form">
        <div class="form-group">
            <label class="control-label col-sm-2" for="susername">Username:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="susername" v-model="student.username" name="username" v-validate="'required|verify_user'" placeholder="Enter User Name">
                <div v-show="errors.has('account-form.username')"><span class="error">@{{ errors.first('account-form.username') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="spassword">Password:</label>
            <div class="col-sm-10">

                <input type="password" class="form-control" id="spassword"  v-model="student.password" name="password" v-validate="'required'" placeholder="Enter Password">
                <div v-show="errors.has('account-form.password')"><span class="error">@{{ errors.first('account-form.password') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="sconfirm_password">Confirm Password:</label>
            <div class="col-sm-10">

                <input v-validate="'required|confirmed:password'" id="sconfirm_password" name="password_confirmation" type="password" class="form-control" placeholder="Confirm password" data-vv-as="password" placeholder="Enter Confirm Password">
                <div v-show="errors.has('account-form.password_confirmation')"><span class="error">@{{ errors.first('account-form.password_confirmation') }}</span></div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary pull-right">Next</button>
    </form>
</div>