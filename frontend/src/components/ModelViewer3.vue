<template>
    <div class="modelviewer p-3"> 
        <!-- <p>{{editable_model_id}} - {{editable_item_id}}</p> -->

        <div class="wrapper">
            
            <!--HEADERS -->
            <div class="row " >
                <template v-for="item of fields">
                    <b><div 
                        v-bind:key="item.id"
                        v-if="item.visible"
                        class="box pt-2  pb-2 mb-2 bg-grey-light"
                        v-html="item.database_name"
                        >
                    </div></b>
                </template>
            </div>

            <!-- CONTENT -->
            <template v-for="model of models">
                <div class="row w-full h-full py-3 mb-1 " v-bind:key="model.id">
                    <template v-for="item of fields">
                        <div v-bind:key="item.database_name"  v-if="item.visible" >
                            <template v-if="element_type(model.id, item.database_name) == 'textarea'">
                                 <textarea
                                 autofocus
                                  @keyup="throttledMethod1(model_children_name, model.id, item.database_name, model[item.database_name]) " 
                                   
                                   class=" box w-full h-full border border-blue-light"  
                                  v-model="model[item.database_name]"></textarea>
                            </template>
                            <template v-else>
                                <component 
                                    :is="element_type(model.id, item.database_name)" 
                                    @click="make_editable(model.id, item.database_name)" 
                                    @keyup="throttledMethod1(model_children_name, model.id, item.database_name, model[item.database_name]) "
                                    class="box p-1 pt-2 pb-2 mb-1 w-full h-full text-left bg-grey-lighter" 
                                    v-html="model[item.database_name]">
                             
                                </component>
                            </template>
                        </div>
                    </template>
                </div>
            </template>

        </div>



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
      editable_model_id: '',
      editable_item_id: '',
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

    computed: {
        
    },

  methods: {
      element_type(model_id, item_id) {
            if (model_id == this.editable_model_id && item_id == this.editable_item_id) {
                return 'textarea';
            } else {
                return 'p';
            } 
        },
      make_editable(model_id, item_id) {
          console.log(model_id, item_id);
          this.editable_model_id = model_id;
          this.editable_item_id = item_id;
      },

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
.wrapper {
  display: grid;
  grid-template-columns: repeat(4, minmax(50px, 1fr));
  color: #444;
  max-width: 100%;
}

.row {
  grid-column: 1 / -1;
  display: grid;
  grid-template-columns: repeat(4, minmax(50px, 1fr));
}

/* div:nth-child(5) { grid-row-start: 4; } */
/* div:nth-child(6) { grid-row-start: 5; } */

textarea { 
    resize:vertical; 
    columns: 55;
    rows: 55;
}

/* textarea.vert { resize:vertical; } */
/* textarea.noResize { resize:none; } */

.box {
  /* background-color: #444;
  color: #fff; */
  /* border-radius: 5px; */
  /* padding: 20px; */
  /* font-size: 150%; */
}

</style>
