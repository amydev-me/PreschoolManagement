<div class="tab-pane edit-tab" id="medical_tab" >
    <form class="form-horizontal  animated bounceInRight"  @submit.prevent="validateData('medical_form')" data-vv-scope="medical_form" autocomplete="off">
        <div class="form-group">
            <label class="control-label">Asthma :</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <input  type="checkbox" class="cr-styled" v-model="medical.asthma">
                </span>
                <input type="text"  class="form-control"  v-model="medical.asthma_remark"   placeholder="Enter Remark">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Allergies :</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <input  type="checkbox" class="cr-styled" v-model="medical.asthma">
                </span>
                <input type="text"  class="form-control"  v-model="medical.firstName"   placeholder="Enter Remark">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">Diabetes :</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <input  type="checkbox" class="cr-styled" v-model="medical.asthma">
                </span>
                <input type="text"  class="form-control"  v-model="medical.firstName"   placeholder="Enter Remark">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Epilepsy :</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <input  type="checkbox" class="cr-styled" v-model="medical.asthma">
                </span>
                <input type="text"  class="form-control"  v-model="medical.firstName"   placeholder="Enter Remark">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Tuberculosis :</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <input  type="checkbox" class="cr-styled" v-model="medical.asthma">
                </span>
                <input type="text"  class="form-control"  v-model="medical.firstName"   placeholder="Enter Remark">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Others :</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <input  type="checkbox" class="cr-styled" v-model="medical.asthma">
                </span>
                <input type="text"  class="form-control"  v-model="medical.firstName"   placeholder="Enter Remark">
            </div>
        </div>
        <div class="form-group ">
            <label class="control-label">Does your child take regular medication?</label>
            <input type="text"  class="form-control"  v-model="medical.medication"   placeholder="Enter Remark">
        </div>
        <div class="form-group ">
            <label class="control-label">Is your child immunized? (Please attach a copy of the immunization history)
            </label>
            <input type="text"  class="form-control"  v-model="medical.immunized_remark"   placeholder="Enter Remark">
            <div class="fileUpload btn btn-default m-t-5">
                <span>Upload</span>
                <input type="file" class="upload "  @change="inputFile($event,'medical')"/>
            </div>
        </div>
        <div class="form-group ">
            <label class="control-label">Does your child have special needs,
                either emotional or physical?

            </label>
            <input type="text"  class="form-control"  v-model="medical.emotional"   placeholder="Enter Remark">
        </div>
        <div class="form-group ">
            <label class="control-label">Does your child have any learning
                disabilities/difficulties?

            </label>
            <input type="text"  class="form-control"  v-model="medical.disabilities"   placeholder="Enter Remark">
        </div>
        <div class="form-group ">
            <label class="control-label">Does your child have any behavioral
                problems?
            </label>
            <input type="text"  class="form-control"  v-model="medical.behavioral"   placeholder="Enter Remark">
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary" type="button">Next</button>
        </div>
    </form>
</div>