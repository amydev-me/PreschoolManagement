<div id="payment-info" class="tab-pane p-0">
    <div class="user-profile-content">
        <payment-list inline-template>
            <div class="row">
                <div ref="thismodel"  id="courseteacher-modal" class="modal fade modal-dialog-center" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <form class="form-horizontal" role="form" @submit.prevent="submitdata">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Date :</label>
                                        <div class="col-sm-10">
                                            <datepicker v-model="performdata.payment_date" :value="performdata.payment_date" data-vv-name="payment_date" v-validate="'required'" ></datepicker>
                                            <div  v-show="errors.has('payment_date')"><span class="error">Required date.</span></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Term :</label>
                                        <div class="col-sm-10">
                                            <multiselect data-vv-name="term" v-validate="'required'"
                                                         placeholder="Select term"
                                                         v-model="selected_term"
                                                         label="termName"
                                                         :options="terms"
                                                         :multiple="false"
                                                         :allow-empty="false"
                                                         :searchable="false"
                                                         :internal-search="false" @input="selectedTermChange">
                                            </multiselect>
                                            <div  v-show="errors.has('term')"><span class="error">Required term.</span></div>
                                        </div>
                                    </div>
                                    <div class="form-group" v-if="terms.length>0">
                                        <label class="col-sm-2 control-label" for="example-input1-group2">Term Fees :</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <numeric-input  mask-type="currency"     v-model="performdata.amount"> </numeric-input>
                                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" v-for="fee,index in fees">
                                        <label class="col-sm-2 control-label" for="example-input1-group2">@{{ fee.feeName }}:</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                        <span class="input-group-addon">
                                            <input  type="checkbox" class="cr-styled" v-model="fee.ischecked"  @click="feeCheckedChanged(index)">
                                        </span>
                                                <numeric-input  mask-type="currency"    v-model="fee.amount"  :disabled="!fee.ischecked"> </numeric-input>
                                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="example-input1-group2" >Total :</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <numeric-input  mask-type="currency"   :disabled="true"   :value="totalvalue"> </numeric-input>
                                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-info">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="pull-right m-b-10">
                        <a @click="showAddModal"  class="btn btn-primary btn-sm">  <i class="fa fa-plus"></i> Add Invoice</a>
                    </div>
                </div>
                <delete-modal @input="successdelete" :inputid="payment_id" :inputurl="removeUrl" :id="'payment_deletemodal'"></delete-modal>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table class="table" id="datatable-normal">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Grade</th>
                                <th>Term</th>
                                <th>Amount</th>
                                <th>Paid Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="pay,index in payments">
                                <td>@{{index+1}}</td>
                                <td>@{{formatDate(pay.payment_date)}}</td>
                                <td>@{{pay.grade!=null?pay.grade.gradeName:''}}</td>
                                <td>@{{pay.term!=null?pay.term.termName:''}}</td>
                                <td>@{{formatNumber(pay.total)}}</td>
                                <td>@{{formatNumber(pay.receipt_amount)}}</td>
                                <td>
                                    <p v-if="pay.term">
                                        <span class="label label-success" v-if="pay.status=='PAID'">@{{pay.status}}</span>
                                        <span class="label label-danger" v-if="!(pay.term.due_date< currentdate) && pay.status=='UNPAID'">@{{pay.status}}</span>
                                        <span class="label label-warning" v-if="pay.term.due_date< currentdate &&pay.status=='UNPAID'">OVERDUE</span>

                                    </p>
                                </td>

                                <td>
                                    <a class="label label-primary" :href="'/admin/payment/view?payment_id='+pay.id">view</a>
                                    <a class="label label-info" :href="'/admin/payment/edit?payment_id='+pay.id">edit</a>
                                    <a @click="showDeleteModal(pay.id)" class="label label-danger">delete</a>
                                    {{--<a @click="showDeleteModal(acad.id)" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>--}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </payment-list>
    </div>
</div>