let asyncurl=route.urls.category.asyncget;
module.exports = {

  props: ['value','sstyle'],
  template: `            
             <multiselect :class="customstyle" 
                placeholder="Select Category"  
                v-model="selectedValues"  
                label="categoryName"
           
                :options="collections"
                :multiple="false"
                :searchable="false"    
                :allow-empty="true"
                :internal-search="false"
                
             
                @select="onAuthorChange">                                                                          
              </multiselect>`,
  data: function () {
    return {
      isSingleLoading: false,
      collections: [],
      selectedValues: [],
      customstyle: '',
      isbind: false
    }
  },
  methods: {
    asyncGet () {
      axios.get(asyncurl).then(response => {
        this.collections = response.data;
        this.isSingleLoading = false;
      });

    },
    onAuthorChange () {
      let temp = null;

      if (this.isbind) {

        temp = this.value;
        this.selectedValues = this.value;
      } else {

        temp = this.selectedValues;
      }
      this.isbind = false;

      if (this.multi) {

        let _lists = [];

        for (var i = 0, n = temp.length; i < n; i++) {
          _lists.push(temp[i].id);
        }
        this.$emit('input', _lists);
      } else {

        let _id = null;
        if (temp != undefined) {
          _id = temp;
        }
        this.$emit('input', _id);
      }

    }
  },
  watch: {
    'value': function () {
      this.isbind = true;
      this.onAuthorChange();
    }
  },
  created: function () {
    this.customstyle = this.sstyle;
  },
  mounted () {
    this.asyncGet();
    this.selectedValues=this.value;
  }
}