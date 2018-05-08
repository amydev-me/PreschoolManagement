<div id="info_setting" class="tab-pane active p-0">
    <div class="user-profile-content">
        <div class="col-sm-12">
            <form class="form-horizontal animated bounceInRight" @submit.prevent="submit('info_form')" enctype="multipart/form-data" data-vv-scope="info_form" autocomplete="off">
            <div class="form-group">
                <label class="control-label col-sm-2">Name:</label>
                <div class="col-sm-10">
                    <input type="text"   class="form-control"  v-model="info.title" name="name" v-validate="'required'" placeholder="Enter Name">
                    <div v-show="errors.has('info_form.name')"><span class="error">@{{ errors.first('info_form.name') }}</span></div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" >Business Type:</label>
                <div class="col-sm-10">
                    <input type="text"   class="form-control"  v-model="info.business_type"  placeholder="Enter Business Type">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="phone">Phone:</label>
                <div class="col-sm-10">
                    <input type="text" id="phone"  class="form-control"  v-model="info.phone" name="phone" placeholder="Enter Phone No">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="address">Address:</label>
                <div class="col-sm-10">
                    <textarea id="address" class="form-control" rows="1" v-model="info.address" name="address"  placeholder="Enter Address"></textarea>

                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="website">Website:</label>
                <div class="col-sm-10">
                    <input type="text" id="website"  class="form-control"  v-model="info.website" name="website"  placeholder="Enter Website Name">

                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="facebook">Facebook:</label>
                <div class="col-sm-10">
                    <input type="text" id="facebook"  class="form-control"  v-model="info.facebook" name="facebook"  placeholder="Enter Facebook Page">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="fax">Fax:</label>
                <div class="col-sm-10">
                    <input type="text" id="fax"  class="form-control"  v-model="info.fax" name="fax"  placeholder="Enter Fax">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="login_text">Login Text:</label>
                <div class="col-sm-10">
                    <input type="text" id="login_text"  class="form-control"  v-model="info.login_text" name="login_text"  placeholder="Enter Login text">

                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="footer">Footer:</label>
                <div class="col-sm-10">
                    <input type="text" id="footer"  class="form-control"  v-model="info.footer" name="footer"  placeholder="Enter Footer">

                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="note">Note:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="1" v-model="info.note" name="note" placeholder="Enter Note" id="note"></textarea>
                </div>
            </div>
            <div class="form-group ">
                <label class="control-label col-sm-2" for="email">Logo:</label>
                <div class="col-sm-10 ">
                    <div class="fileUpload btn btn-default">
                        <span>Upload</span>
                        <input type="file" class="upload "  @change="newProfile"  name="logo" v-validate="'image|dimensions:32,32'"/>
                    </div>
                    <a @click="removelogo" v-show="showremove"> <span class="error"><i class="fa fa-remove"></i>Remove Logo</span></a>
                    <div v-show="errors.has('info_form.logo')"><span class="error">@{{ errors.first('info_form.logo')}}</span></div>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>