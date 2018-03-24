module.exports={
    template:`
	
      <ul class="pagination pull-right" v-show="length>1">
        <li>
          <a href="#!" v-bind:class="{ 'pagination__navigation--disabled': value === 1 }" v-on:click.prevent="$emit('input', value - 1)">   <i class="fa fa-angle-left"></i></span></a>
        </li>    
        <li v-for="n in items" :class="{ 'active': n === value }" > 
          <a href="#!" v-if="!isNaN(n)" v-on:click.prevent="$emit('input', n)" v-text="n" ></a>
          <span v-if="isNaN(n)" v-text="n" class="pagination__more"></span>
        </li>
        <li>
          <a href="#!" v-bind:class="{ 'pagination__navigation--disabled': value === length }" v-on:click.prevent="$emit('input', value + 1)"><span class="fa fa-angle-right"></span></a>
        </li>
      </ul>
	   `
    ,
    props: {
        length: {
            type: Number,
            default: 0
        },

        value: {
            type: Number,
            default: 0
        }
    },

    watch: {
        value () {
            this.init()
        }
    },

    computed: {
        items () {

            if (this.length <= 10) {
                return this.range(1, this.length)
            }

            let min = this.value - 3
            min = min > 0 ? min : 1

            let max = min + 11
            max = max <= this.length ? max : this.length

            if (max === this.length) {
                min = this.length - 11
            }

            const range = this.range(min, max)

            if (this.value >= 4 && this.length > 6) {

                range.splice(0, 2, 1, '...')
            }

            if (this.value + 3 < this.length && this.length > 6) {

                range.splice(range.length - 2, 2, '...', this.length)
            }

            return range
        }
    },

    methods: {
        init () {
            this.selected = null

            // Change this
            setTimeout(() => (this.selected = this.value), 100)
        },

        range (from, to) {
            const range = []

            from = from > 0 ? from : 1

            for (let i = from; i <= to; i++) {
                range.push(i)
            }

            return range
        }
    }

};
/**
 *Pagination style
 **/
// .pagination__navigation--disabled {
//         opacity: .6;
//         pointer-events: none;
//     }
//     .pagination__more {
//         pointer-events: none;
//
//     }