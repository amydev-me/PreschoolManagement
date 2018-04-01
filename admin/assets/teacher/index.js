const VuePagination = resolve => require(['../core/VuePagination'], resolve);
let _detailview=route.urls.teacher.detailView;
let _getdata=route.urls.teacher.getdata;
let _teacherimage=route.urls.teacher_image;
module.exports= {
  components:{VuePagination},
  data: function () {
    return {
      pagination: {
        total: 0,
        per_page: 2,
        from: 1,
        to: 0,
        current_page: 1,
        last_page: 1,
      },
      teachers: [],

      filterValue: null
    }
  },

  methods: {
    getImage (profile) {
      if(profile==null) return;
      return _teacherimage + profile;
    },

    goDetailView (id) {
      return _detailview +  id;
    },

    getData (url) {
      axios.get(url + this.pagination.current_page).then(({data}) => {
        this.pagination = data;
        this.teachers = data.data;
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else {
          Notification.error('Error occured while loading data.');
        }
      });
    },

    searchClick () {

    }
  },

  mounted () {
    this.getData(_getdata);
  }
}