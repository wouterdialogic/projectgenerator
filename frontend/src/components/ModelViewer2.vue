<template>
  <div class="modelviewer p-3">



    <!-- TABLE, -->
    <table role="table">
      <thead role="rowgroup">
        <tr role="row">
          <template v-for="item of fields" >
            <th 
              v-bind:key="item.id"
              role="columnheader" 
              v-if="item.visible" 
              class="bg-grey-lighter border-l border-black border-r">
              {{item.to_user_name}}
            </th>
          </template>
        </tr>
      </thead>
      <tbody role="rowgroup">
        <template v-for="model of models">
          <tr role="row" v-bind:key="model.id">
          <template v-for="item of fields">
            <td 
              v-bind:key="item.id"
              v-if="item.visible"
              role="cell"
              class=""
              >
                <template v-if="item.element == 'textarea'">
                  <textarea @keyup="throttledMethod1(model_children_name, model.id, item.database_name, model[item.database_name]) " class="" v-model="model[item.database_name]"></textarea>
                </template>

                <template v-if="item.element == 'input'">
                  <input @keyup="throttledMethod1(model_children_name, model.id, item.database_name, model[item.database_name])" class="" v-model="model[item.database_name]">
                </template>
            </td>
          </template>
            </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>

<script>
import _ from 'lodash'
import axios from 'axios';

export default {
  props: {
    model_parent_name: String,
    model_children_name: String,
    classes: String,
  },

  name: 'ModelViewer2',

  data () {
    return {
      msg: '',
      model_parent: {},
      original_models: '',
      models: '',
      fields: '',
      reserved: [],
      errors: [],
      new_model: {},
      parent_id: null,
    }
  },


  methods: {
  cancel_saved() {
    var self = this;

    axios.post(`/api/project/save`, {
      model_parent_name: this.model_parent_name, 
      models: this.original_models,
    })
    .then(response => {
      self.msg = response.data;
      this.models = JSON.parse(JSON.stringify(this.original_models));
    })
    .catch(e => {
      self.errors.push(e)
    });
  },

  save_new_model() {
    var self = this;

    if (this.model_parent) {
      this.new_model[this.model_parent_name+'_id'] = this.model_parent.id;
    }

    axios.post('/api/'+this.model_children_name+'/create', {
      model_parent_name: this.model_children_name, 
      new_model: this.new_model,
    })
    .then(function (response) {
      console.log(response.data);
      self.retrieve_models();
      self.msg = "model created";
    })
    .catch(e => {
      this.errors.push(e)
    });
  },

  save_models() {
    var self = this;

    axios.post(`/api/project/save`, {
      model_parent_name: this.model_parent_name, 
      models: this.models,
    })
    .then(function (response) {
      console.log(response.data);
      
      self.msg = "wouter is gek";
    })
    .catch(e => {
      this.errors.push(e)
    });
  },

  load_new_model(model_parent_name, model_id) {
    console.log("loading ", model_parent_name, model_id)
    fetch('/api/'+model_parent_name+'/'+model_id).then(res => res.json()).then((res) => {
      console.log(res);
      for (var key in res) {
          if (res.hasOwnProperty(key)) {
              this[key] = res[key];
              console.log(key + " -> " + res[key]);
          }
      }
      //this.models = res.models;
      //this.original_models = JSON.parse(JSON.stringify(res.models)); 
      //this.fields = res.fields;
    })   
  },

  retrieve_models() {
    fetch('/api/'+this.model_children_name+'s').then(res => res.json()).then(({ models, fields }) => {
      this.models = models;
      this.original_models = JSON.parse(JSON.stringify(models)); 
      this.fields = fields;
    })
  },

  throttledMethod1: _.debounce(function (model_children_name, model_id, key, value) {
    let self = this;
    axios.post(`/api/`+model_children_name+`/save`, {
        model_parent_name: model_children_name, 
        model_id: model_id, 
        key: key, 
        value: value,
      })
      .then(function (response) {
        self.msg = response.data.log_message;
      })
      .catch(e => {
        self.errors.push(e)
      })
    }, 500)
  },

  created () {
    fetch('/api/mock').then(res => res.json()).then(({ msg }) => {
      this.msg = msg
    })

    this.retrieve_models();
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
/*
	Max width before this PARTICULAR table gets nasty. This query will take effect for any screen smaller than 760px and also iPads specifically.
	*/
	@media
	  only screen 
    and (max-width: 760px), (min-device-width: 768px) 
    and (max-device-width: 1024px)  {

      
		/* Force table to not be like tables anymore */
		table, thead, tbody, th, td, tr {
			display: block;
		}



		/* Hide table headers (but not display: none;, for accessibility) */
		thead tr {
			position: absolute;
			top: -9999px;
			left: -9999px;
		}

    td {
      border: 1px;
      border-color: red;
    }

    tr {
      margin: 0 0 1rem 0;
    }
      
    tr:nth-child(odd) {
      background: #ccc;
    }
    
		td {
			/* Behave  like a "row" */
			border: none;
			border-bottom: 1px solid #eee;
			position: relative;
			padding-left: 50%;
		}

		td:before {
			/* Now like a table header */
			position: absolute;
			/* Top/left values mimic padding */
			top: 0;
			left: 6px;
			width: 45%;
			padding-right: 10px;
			white-space: nowrap;
		}

		/*
		Label the data
    You could also use a data-* attribute and content for this. That way "bloats" the HTML, this way means you need to keep HTML and CSS in sync. Lea Verou has a clever way to handle with text-shadow.
		*/
		td:nth-of-type(1):before { content: "First Name"; }
		td:nth-of-type(2):before { content: "Last Name"; }
		td:nth-of-type(3):before { content: "Job Title"; }
		td:nth-of-type(4):before { content: "Favorite Color"; }
		td:nth-of-type(5):before { content: "Wars of Trek?"; }
		td:nth-of-type(6):before { content: "Secret Alias"; }
		td:nth-of-type(7):before { content: "Date of Birth"; }
		td:nth-of-type(8):before { content: "Dream Vacation City"; }
		td:nth-of-type(9):before { content: "GPA"; }
		td:nth-of-type(10):before { content: "Arbitrary Data"; }
	}

  
</style>
