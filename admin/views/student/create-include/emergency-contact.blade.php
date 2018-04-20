<div class="tab-pane edit-tab" id="em_tab" >
    <form class="form-horizontal  animated bounceInRight"  @submit.prevent="validateData('emergency_form')" data-vv-scope="emergency_form" autocomplete="off">
        <div class="form-group">
            <label class="control-label">Name:</label>
            <input type="text" class="form-control"  v-model="student.em_name" name="em_name" v-validate="'required'" placeholder="Enter Name">
            <div v-show="errors.has('emergency_form.em_name')"><span class="error">Emergency Name Field Required.</span></div>
        </div>

        <div class="form-group">
            <label class="control-label">Relationship to Student:</label>
            <input type="text" class="form-control"  v-model="student.em_relation" name="em_relation" v-validate="'required'" placeholder="Enter Relation">
            <div v-show="errors.has('emergency_form.em_relation')"><span class="error">Emergency Relation Field Required.</span></div>
        </div>

        <div class="form-group">
            <label class="control-label">Contact Number:</label>
            <input type="text" class="form-control"  v-model="student.em_contact" name="em_contact" v-validate="'required'" placeholder="Enter Contact Number">
            <div v-show="errors.has('emergency_form.em_contact')"><span class="error">Emergency Contact Field Required.</span></div>
        </div>

        <div class="text-right">
            <button  class="btn btn-primary" type="button" @click="em_back">Previous</button>
            <button type="submit" class="btn btn-primary" type="button">Next</button>
        </div>
    </form>
</div>