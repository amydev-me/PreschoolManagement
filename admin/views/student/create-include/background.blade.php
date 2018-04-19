<div class="tab-pane edit-tab" id="background_tab" >
    <form class="form-horizontal  animated bounceInRight"  @submit.prevent="validateData('background_form')" data-vv-scope="background_form" autocomplete="off">
        <div class="form-group">
            <h2 class="panel-title">Educational Background#1</h2>
            <hr style="margin-bottom: 0px;margin-top: 0px;">
        </div>
        <div class="form-group">
            <label class="control-label">Previous Schools Attended :</label>
            <input type="text"  class="form-control"  v-model="education.previous_one"   placeholder="Enter Previous Schools">
        </div>
        <div class="form-group">
            <label class="control-label" for="join_date">Dates Attended:</label>
            <input type="text"  class="form-control"  v-model="education.one_date" placeholder="Enter Dates Attended">
        </div>
        <div class="form-group ">
            <label class="control-label">Attach:</label>
            <div class="fileUpload btn btn-default">
                <span>Upload</span>
                <input type="file" class="upload "  @change="inputFile($event,'edu_one')"/>
            </div>
        </div>
        <div class="form-group">
            <h2 class="panel-title m-t-30">Educational Background#2</h2>
            <hr style="margin-bottom: 0px;margin-top: 0px;">
        </div>
        <div class="form-group">
            <label class="control-label">Previous Schools Attended :</label>
            <input type="text"  class="form-control"  v-model="education.previous_two" placeholder="Enter Previous Schools">
        </div>
        <div class="form-group">
            <label class="control-label">Dates Attended:</label>
            <input type="text"  class="form-control"  v-model="education.two_date" placeholder="Enter Dates Attended">
        </div>
        <div class="form-group ">
            <label class="control-label">Attach:</label>
            <div class="fileUpload btn btn-default">
                <span>Upload</span>
                <input type="file" class="upload "  @change="inputFile($event,'edu_two')"/>
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary" type="button">Next</button>
        </div>
    </form>
</div>