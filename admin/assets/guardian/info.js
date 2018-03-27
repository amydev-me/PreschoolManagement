// const DeleteModal = resolve => require(['../core/DeleteModal'], resolve);
// let remove=route.urls.guardian.remove;
// let indexpage=route.urls.guardian.indexpage;


module.exports={

  // components:{DeleteModal},
  props:['guardian'],
  data:function () {
    return{
      guardian_id:null
    }
  },
  methods:{
    // performdelete () {
    //   axios.get(remove + this.guardian_id).then(response => {
    //     window.location.href = indexpage;
    //
    //   }).catch(error => {
    //     if (error.response.status == 401 || error.response.status == 419) {
    //       window.location.href = route.urls.login;
    //     } else {
    //       Notification.error('Error occured while deleting data.');
    //     }
    //   });
    //   $('#deleteModal').modal('hide');
    // },
    // showDeleteModal (id) {
    //   this.guardian_id = id;
    //   $('#deleteModal').modal('show');
    // },
  }
}