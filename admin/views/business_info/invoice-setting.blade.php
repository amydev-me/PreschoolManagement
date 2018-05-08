<div id="invoice_setting" class="tab-pane p-0">
    <div class="user-profile-content">
        <div class="col-sm-12">
            <form class="form-horizontal animated bounceInRight"  @submit.prevent="submit('invoice_form')" enctype="multipart/form-data" data-vv-scope="invoice_form" autocomplete="off">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="instruction">Invoice Instruction:</label>
                    <div class="col-sm-10">
                        <textarea class="wysihtml5 form-control" rows="9" id="instruction_text"></textarea>
                    </div>
                </div>
                <div class="form-group ">
                    <label class="control-label col-sm-2" for="email">Invoice Logo:</label>
                    <div class="col-sm-10 ">
                        <div class="fileUpload btn btn-default">
                            <span>Upload</span>
                            <input type="file" class="upload "  @change="newInvoice"  name="invoice_logo" v-validate="'image|dimensions:64,64'"/>
                        </div>
                        <a @click="removeInvoiceLogo" v-show="showinvoice_remove"> <span class="error"><i class="fa fa-remove"></i>Remove Logo</span></a>
                        <div v-show="errors.has('invoice_logo')"><span class="error">@{{ errors.first('invoice_logo')}}</span></div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>