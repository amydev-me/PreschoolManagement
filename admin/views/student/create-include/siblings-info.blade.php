<div class="tab-pane edit-tab" id="sibling_tab" >
    <form class="form-horizontal  animated bounceInRight"  @submit.prevent="validateData('sibling_form')" data-vv-scope="sibling_form" autocomplete="off">

        <div class="form-group">
            <h2 class="panel-title">Siblings’ Information#1</h2>
            <hr style="margin-bottom: 0px;margin-top: 0px;">
        </div>
        <div class="form-group">
            <label class="control-label">Name :</label>
            <input type="text" class="form-control"  v-model="sibling_info.sb_one_name"  placeholder="Enter Name">
        </div>

        <div class="form-group">
            <label class="control-label">Date Of Birth:</label>
            <datepicker v-model="sibling_info.sb_one_dob"></datepicker>
        </div>
        <div class="form-group">
            <label class="control-label">Gender:</label>
            <div class="radio-inline">
                <label class="cr-styled">
                    <input type="radio" name="s_one_gender" value="Male" v-model="sibling_info.sb_one_gender">
                    <i class="fa"></i>
                    Male
                </label>
            </div>
            <div class="radio-inline">
                <label class="cr-styled">
                    <input type="radio"  name="s_one_gender" value="Female" v-model="sibling_info.sb_one_gender">
                    <i class="fa"></i>
                    Female
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">School :</label>
            <input type="text"   class="form-control"  v-model="sibling_info.sb_one_school"  placeholder="Enter School">
        </div>
        <div class="form-group">
            <h2 class="panel-title m-t-30">Siblings’ Information#2</h2>
            <hr style="margin-bottom: 0px;margin-top: 0px;">
        </div>
        <div class="form-group">
            <label class="control-label">Name :</label>
            <input type="text" class="form-control"  v-model="sibling_info.sb_two_name"  placeholder="Enter Name">
        </div>

        <div class="form-group">
            <label class="control-label">Date Of Birth:</label>
            <datepicker v-model="sibling_info.sb_two_dob"></datepicker>
        </div>
        <div class="form-group">
            <label class="control-label">Gender:</label>
            <div class="radio-inline">
                <label class="cr-styled">
                    <input type="radio"  name="s_two_gender" value="Male" v-model="sibling_info.sb_two_gender">
                    <i class="fa"></i>
                    Male
                </label>
            </div>
            <div class="radio-inline">
                <label class="cr-styled">
                    <input type="radio" name="s_two_gender" value="Female" v-model="sibling_info.sb_two_gender">
                    <i class="fa"></i>
                    Female
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">School :</label>
            <input type="text"   class="form-control"  v-model="sibling_info.sb_two_school"  placeholder="Enter School">
        </div>
        <div class="form-group">
            <h2 class="panel-title m-t-30">Siblings’ Information#3</h2>
            <hr style="margin-bottom: 0px;margin-top: 0px;">
        </div>
        <div class="form-group">
            <label class="control-label">Name :</label>
            <input type="text" class="form-control"  v-model="sibling_info.sb_three_name"  placeholder="Enter Name">
        </div>

        <div class="form-group">
            <label class="control-label">Date Of Birth:</label>
            <datepicker v-model="sibling_info.sb_three_dob"></datepicker>
        </div>
        <div class="form-group">
            <label class="control-label">Gender:</label>
            <div class="radio-inline">
                <label class="cr-styled">
                    <input type="radio" name="s_three_gender" value="Male" v-model="sibling_info.sb_three_gender">
                    <i class="fa"></i>
                    Male
                </label>
            </div>
            <div class="radio-inline">
                <label class="cr-styled">
                    <input type="radio" name="s_three_gender" value="Female" v-model="sibling_info.sb_three_gender">
                    <i class="fa"></i>
                    Female
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">School :</label>
            <input type="text"   class="form-control"  v-model="sibling_info.sb_three_school"  placeholder="Enter School">
        </div>

        <div class="text-right">
            <button  class="btn btn-primary" type="button" @click="sib_back">Previous</button>
            <button type="submit" class="btn btn-primary" type="button">Next</button>
        </div>
    </form>
</div>