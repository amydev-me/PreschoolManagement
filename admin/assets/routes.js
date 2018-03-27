let prefix='/admin/';
let _academic='academic-year/';
let _category='category/';
let _fee='feetype/';
let _subject='subject/';
let _grade='grade/';
let _user='user/';
let _guardian='guardian/';
module.exports = {
  urls: {
    login: '/login',
    // grade
    get_ac: '/get-academic-category',
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
      create: prefix + _grade + 'create',
      update: prefix + _grade + 'update',
      remove: prefix + _grade + 'delete/',
      getdata: prefix + _grade + 'get-data?page=',
    },
    guardian:{
      indexpage:prefix+'guardian',
      create: prefix + _guardian + 'create',
      update: prefix + _guardian + 'update',
      remove: prefix + _guardian + 'delete/',
      getdata: prefix + _guardian + 'get-data?page=',
      details:prefix+_guardian+'get-detail/',
      detailView:prefix+_guardian+'view-detail?guardian_id=',
    }
  }
};