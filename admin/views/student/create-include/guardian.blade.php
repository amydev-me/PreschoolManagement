<div class="tab-pane edit-tab" id="guardian_tab" >
    <form class="form-horizontal  animated bounceInRight"  @submit.prevent="validateData('guardian_form')" data-vv-scope="guardian_form" autocomplete="off">

        <div class="form-group">
            <h2 class="panel-title">Parent/Guardian 1</h2>
            <hr style="margin-bottom: 0px;margin-top: 0px;">
        </div>
        <div class="form-group">
            <label class="control-label">Relationship to student :</label>
            <input type="text"  class="form-control"  v-model="guardian.g_one_name"   placeholder="Enter Relation">
        </div>
        <div class="form-group">
            <label class="control-label ">Name <span style="font-size: 12px;">(First,Middle,Last)</span>:</label>
            <input type="text" class="form-control"  v-model="guardian.g_one_relation" placeholder="Enter Name">
        </div>
        <div class="form-group ">
            <label class="control-label ">Email:</label>
            <input type="text" class="form-control"  v-model="guardian.g_one_email" placeholder="Enter Name">
        </div>
        <div class="form-group ">
            <label class="control-label ">Occupation:</label>
            <input type="text" class="form-control"  v-model="guardian.g_one_occupation" placeholder="Enter Name">
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Address:</label>
            <textarea class="form-control"  rows="1"  placeholder="Enter Address" v-model="guardian.g_one_address"></textarea>
        </div>
        <div class="form-group ">
            <label class="control-label ">Mobile Number:</label>
            <input type="text" class="form-control"  v-model="guardian.g_one_mobile" placeholder="Enter Mobile Number">
        </div>
        <div class="form-group ">
            <label class="control-label ">Home Number:</label>
            <input type="text" class="form-control"  v-model="guardian.g_one_home" placeholder="Enter Home Number">
        </div>
        <div class="form-group ">
            <label class="control-label ">Work Number:</label>
            <input type="text" class="form-control"  v-model="guardian.g_one_work" placeholder="Enter Work Number">
        </div>

        <div class="form-group">
            <h2 class="panel-title m-t-30">Parent/Guardian 2</h2>
            <hr style="margin-bottom: 0px;margin-top: 0px;">
        </div>
        <div class="form-group">
            <label class="control-label ">Relationship to student :</label>
            <input type="text"  class="form-control"  v-model="guardian.g_two_name"   placeholder="Enter Relation">
        </div>
        <div class="form-group">
            <label class="control-label ">Name <span style="font-size: 12px;">(First,Middle,Last)</span>:</label>
            <input type="text" class="form-control"  v-model="guardian.g_two_relation" placeholder="Enter Name">
        </div>
        <div class="form-group ">
            <label class="control-label ">Email:</label>
            <input type="text" class="form-control"  v-model="guardian.g_two_email" placeholder="Enter Name">
        </div>
        <div class="form-group ">
            <label class="control-label ">Occupation:</label>
            <input type="text" class="form-control"  v-model="guardian.g_two_occupation" placeholder="Enter Name">
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Address:</label>
            <textarea class="form-control"  rows="1"  placeholder="Enter Address" v-model="guardian.g_two_address"></textarea>
        </div>
        <div class="form-group ">
            <label class="control-label ">Mobile Number:</label>
            <input type="text" class="form-control"  v-model="guardian.g_two_mobile" placeholder="Enter Mobile Number">
        </div>
        <div class="form-group ">
            <label class="control-label ">Home Number:</label>
            <input type="text" class="form-control"  v-model="guardian.g_two_home" placeholder="Enter Home Number">
        </div>
        <div class="form-group ">
            <label class="control-label ">Work Number:</label>
            <input type="text" class="form-control"  v-model="guardian.g_two_work" placeholder="Enter Work Number">
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary" type="button">Save</button>
        </div>
    </form>
</div>