let prefix='/admin/';
let _user='user/';
let _academic='academic-year/';
let _term='term/';
let _category='category/';
let _fee='feetype/';
let _subject='subject/';
let _grade='grade/';
let _teacher='teacher/';
let _assignteacher='assign_teacher/';
let _guardian='guardian/';
let _student='student/';
module.exports = {
  urls: {
    login: '/login',
    student_image:'/image/student/',
    teacher_image:'/image/teacher/',
    // grade
    get_ac: '/get-academic-category',
    get_active_category: '/get-active-category',
    checkuser:'/checkuser/',
    user: {

      create: prefix + _user + 'create',
      update: prefix + _user + 'update',
      delete: prefix + _user + 'delete/',
    },
    academic: {
      getdata: prefix + _academic + 'get-data?page=',
      create: prefix + _academic + 'create',
      update: prefix + _academic + 'update',
      remove: prefix + _academic + 'delete/',
      filter_name: prefix + _academic + 'filter-name/',
      asyncget: prefix + _academic + 'async-get',
    },
    term:{
      getdata: prefix + _term + 'get-data',
      getby_academic: prefix + _term + 'getby-academic?academic_id=',
      getby_category: prefix + _term + 'get-bycategory?academic_id=',
      getby_grade: prefix + _term + 'get-bygrade?grade_id=',
      create: prefix + _term + 'create',
      update: prefix + _term + 'update',
      remove: prefix + _term + 'delete/',
    },
    category: {
      getdata: prefix + _category + 'get-data?page=',
      create: prefix + _category + 'create',
      update: prefix + _category + 'update',
      remove: prefix + _category + 'delete/',
      filter_name: prefix + _category + 'filter-name/',
      asyncget: prefix + _category + 'async-get',
    },
    fee: {
      getdata: prefix + _fee + 'get-data?page=',
      create: prefix + _fee + 'create',
      update: prefix + _fee + 'update',
      remove: prefix + _fee + 'delete/',
      filter_name: prefix + _fee + 'filter-name/',
      asyncget: prefix + _fee + 'async-get',
    },
    subject: {
      getdata: prefix + _subject + 'get-data?page=',
      create: prefix + _subject + 'create',
      update: prefix + _subject + 'update',
      remove: prefix + _subject + 'delete/',
      filter_name: prefix + _subject + 'filter-name/',
      asyncget: prefix + _subject + 'async-get',
    },
    grade: {
      indexpage:prefix+'grade',
      create: prefix + _grade + 'create',
      update: prefix + _grade + 'update',
      remove: prefix + _grade + 'delete/',
      getdata: prefix + _grade + 'get-data',
      getgrade:prefix+_grade+'get-grade',
      get_bycategory:prefix+_grade+'get-bycategory?category_id='
    },

    teacher:{
      indexpage:prefix+'teacher',
      create: prefix + _teacher + 'create',
      update: prefix + _teacher + 'update',
      remove: prefix + _teacher + 'delete/',
      getdata: prefix + _teacher + 'get-data?page=',
      details:prefix+_teacher+'get-detail/',
      detailView:prefix+_teacher+'detail-view?teacher_id=',
      asyncget: prefix + _teacher + 'async-get/',
    },
    assign_teacher:{
      indexpage:prefix+'teacher',
      create: prefix + _assignteacher + 'create',
      update: prefix + _assignteacher + 'update',
      remove: prefix + _assignteacher + 'delete/',
      getdata: prefix + _assignteacher + 'get-data?page=',
      getbycategorygrade: prefix + _assignteacher + 'getby-category-grade?',
      getbycategory: prefix + _assignteacher + 'getby-category?category_id=',
      getbyteacher: prefix + _assignteacher + 'getby-teacher?teacher_id=',
    },
    guardian:{
      indexpage:prefix+'guardian',
      create: prefix + _guardian + 'create',
      update: prefix + _guardian + 'update',
      remove: prefix + _guardian + 'delete/',
      getdata: prefix + _guardian + 'get-data?page=',
      details:prefix+_guardian+'get-detail/',
      detailView:prefix+_guardian+'view-detail?guardian_id=',
      asyncget:prefix+_guardian+'async-get/'
    },
    student:{
      indexpage:prefix+'student',
      create: prefix + _student + 'create',
      update: prefix + _student + 'update',
      remove: prefix + _student + 'delete/',

    }
  }
};