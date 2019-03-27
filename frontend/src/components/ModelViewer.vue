<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
    <h2>{{ model_parent_name }}</h2>
    <h3 v-if="model_children_name">{{ model_children_name }}</h3>
    <p>{{ new_model }}</p>
      <button class="m-2 p-2 bg-blue-light hover:bg-green" @click="save_new_model">add model</button>
      <template v-for="item of fields">
        <div v-bind:key="item.id" v-if="item.visible" class="md:flex md:items-center mb-2">
          
          <div class="md:w-1/4">
            <label class="block text-grey font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
              {{item.to_user_name}}
            </label>
          </div>

          <div class="md:w-3/4">    

            <p>{{new_model[item.database_name]}}</p>
            <template v-if="item.element == 'textarea'">
              <textarea class="m-2 p-2 border shadow" v-model="new_model[item.database_name]"></textarea>
            </template>

            <template v-if="item.element == 'input'">
              <input class="m-2 p-2 border shadow" v-model="new_model[item.database_name]">
            </template>

          </div>
        </div>
       </template>

    <!--SHOWING ALL CURRENT MODELS -->
    <button class="m-2 p-2 bg-green-light hover:bg-blue" @click="save_models">save</button>
    <button class="m-2 p-2 bg-red-light hover:bg-red" @click="cancel_saved">cancel</button>
    <p>models:</p>
    <div v-for="model of models" v-bind:key="model.id">
      <h3 class="m2 p-2 bg-grey border-4 hover:border-red-darker " @click="load_new_model(model_parent_name, model.id)">{{model.name}}</h3>
      
      <form class="w-full max-w-md">
      
      <template v-for="item of fields">
        <div v-bind:key="item.id" v-if="item.visible" class="md:flex md:items-center mb-2">
          
          <div class="md:w-1/4">
            <label class="block text-grey font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
              {{item.to_user_name}}
            </label>
          </div>

          <div class="md:w-3/4">    

            <template v-if="item.element == 'textarea'">
              <textarea @keyup="throttledMethod1(model_children_name, model.id, item.database_name, model[item.database_name])" class="m-2 p-2 border shadow" v-model="model[item.database_name]"></textarea>
            </template>

            <template v-if="item.element == 'input'">
              <input @keyup="throttledMethod1(model_children_name, model.id, item.database_name, model[item.database_name])" class="m-2 p-2 border shadow" v-model="model[item.database_name]">
            </template>

          </div>
        </div>
  
       </template>
      </form>

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

  name: 'ModelViewer',

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
      //_templateArray: [{ name: "TEST" }]
    }
  },

  methods: {

  // on_succes(message) {
  //   this.msg = message;
  // },

  cancel_saved() {
    self = this;

    axios.post(`/api/projects/save`, {
      model_parent_name: this.model_parent_name, 
      models: this.original_models,
    })
    .then(response => {
      self.msg = reponse.data;
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

    axios.post(`/api/projects/save`, {
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

  throttledMethod1: _.debounce((model_children_name, model_id, key, value) => {
    axios.post(`/api/`+model_children_name+`/save`, {
        model_parent_name: model_children_name, 
        model_id: model_id, 
        key: key, 
        value: value,
      })
      .then(function (response) {
        
      })
      .catch(e => {
        this.errors.push(e)
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
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  /* color: #42b983; */
}
</style>
