<div id="email_setting" class="tab-pane p-0">
    <div class="user-profile-content">
        <div class="col-sm-12">
            <form class="form-horizontal animated bounceInRight"  @submit.prevent="submit('email_form')" enctype="multipart/form-data" data-vv-scope="email_form" autocomplete="off">
                <div class="form-group">
                    <label class="control-label col-sm-2">From mail:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control"  v-model="info.email" name="email"  placeholder="Enter Email">

                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Host:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  v-model="info.email_host" name="email_host"  placeholder="Enter Host">

                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Port:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  v-model="info.email_port" name="email_port" placeholder="Enter Port">

                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Encryption:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  v-model="info.email_encryption" name="email_encryption"  placeholder="Enter Encryption">

                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email_password">Email Password:</label>
                    <div class="col-sm-10">
                        <input type="password" id="email_password"  class="form-control"  v-model="info.email_password" name="email_password"  placeholder="Enter Mail Password">
                    </div>
                </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="email_subject">Subject:</label>
                <div class="col-sm-10">
                    <input type="text" id="email_subject"  class="form-control"  v-model="info.email_subject" name="email_subject"  placeholder="Enter Subject">

                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email_text">Email Text:</label>
                <div class="col-sm-10">
                    <textarea class="wysihtml5 form-control" rows="9" id="email_text"></textarea>
                </div>
            </div>


            <div class="text-right">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>