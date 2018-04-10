<div ref="thismodel" id="mymodal" class="modal fade modal-dialog-center" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@{{ isedit?'Edit Term':'Add  New Term' }}</h4>
            </div>
            <form class="form-horizontal" role="form" @submit.prevent="submitdata">

                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Year :</label>
                        <div class="col-sm-8">
                            <academic-select  @input="selectedAcadmiceChange" :value="selected_academic" data-vv-name="academic" v-validate="'required'"></academic-select>
                            <div  v-show="errors.has('academic')"><span class="error">Required year.</span></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Category :</label>
                        <div class="col-sm-8">
                            <category-select  @input="selectedCategoryChange" :value="selected_category" data-vv-name="category" v-validate="'required'"></category-select>
                            <div  v-show="errors.has('category')"><span class="error">Required category.</span></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Term :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="termName" v-model="performdata.termName"  v-validate="'required'">
                            <div v-show="errors.has('termName')"><span class="error">Required term.</span></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Start Date :</label>
                        <div class="col-sm-8">
                            <datepicker v-model="performdata.start_date" :value="performdata.start_date" data-vv-name="start_date" v-validate="'required'" ></datepicker>
                            <div  v-show="errors.has('start_date')"><span class="error">Required end date.</span></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">End Date :</label>
                        <div class="col-sm-8">
                            <datepicker v-model="performdata.end_date" :value="performdata.end_date" data-vv-name="end_date" v-validate="'required'" ></datepicker>
                            <div  v-show="errors.has('end_date')"><span class="error">Required end date.</span></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Due Date :</label>
                        <div class="col-sm-8">
                            <datepicker v-model="performdata.due_date" :value="performdata.due_date" data-vv-name="due_date" v-validate="'required'" ></datepicker>
                            <div  v-show="errors.has('due_date')"><span class="error">Required due date.</span></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>