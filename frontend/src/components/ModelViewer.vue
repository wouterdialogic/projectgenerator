<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
    <h2>{{ model_name }}</h2>
    <pre>{{ fields}}</pre>
    <div v-for="model of models" v-bind:key="model.id">
      
      <h3>{{model.name}}</h3>
      <form class="w-full max-w-md">
      
      <template v-for="item of fields">
        <div v-bind:key="item.id" v-if="item.visible" class="md:flex md:items-center mb-6">
          
          <div class="md:w-1/4">
            <label class="block text-grey font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
              {{item.to_user_name}}
            </label>
          </div>

          <div class="md:w-3/4">    

            <template v-if="item.element == 'textarea'">
              <textarea @keyup="throttledMethod2(model_name, model.id, item.database_name, model[item.database_name])" class="m-2 p-2 border shadow" v-model="model[item.database_name]"></textarea>
            </template>

            <template v-if="item.element == 'input'">
              <input @keyup="throttledMethod2(model_name, model.id, item.database_name, model[item.database_name])" class="m-2 p-2 border shadow" v-model="model[item.database_name]">
            </template>

          </div>
        </div>

        <!-- <input v-bind:key="item.database_name" class="m-2 p-2 border shadow" :type="item.html_type" :value="model[item.database_name]"> -->
        </template>
        </form>
      <!-- <p > {{model}} </p> -->
    </div>
  </div>
</template>

<script>
import _ from 'lodash'
import axios from 'axios';

export default {
  props: {
    model_name: String,
    classes: String,
  },

  name: 'ModelViewer',

  data () {
    return {
      msg: '',
      models: '',
      fields: '',
      reserved: [],
      errors: [],
    }
  },

  methods: {

    on_succes(message) {
      this.msg = message;
    },

  //   throttledMethod2(model_name, model_id, key, value) 
    
  //   _.debounce((model_name, model_id, key, value) => {
  //     //this.update_model(model_name, model_id, key, value)
  //     console.log('model: ' + model_name + ' - id: ' + model_id +  ' - key: ' + key + ' - value: ' + value);
  //     console.log('I only get fired once every two seconds, max!')
      
  //     let self = this;
  //     console.log(self);
  //     console.log(this);

  //     axios.post(`/api/projects/save`, {
  //         model_name: model_name, 
  //         model_id: model_id, 
  //         key: key, 
  //         value: value,
  //       })
  //       .then(response => {
  //         console.log(response.data);
  //         //this.msg = response.data.log_message;
  //         this.msg = "wouter is gek";
  //       })
  //       .catch(e => {
  //         this.errors.push(e)
  //       })
  //   }, 500).bind(this)
  // },

    throttledMethod1: _.debounce((model_name, model_id, key, value) => {
      //this.update_model(model_name, model_id, key, value)
      console.log('model: ' + model_name + ' - id: ' + model_id +  ' - key: ' + key + ' - value: ' + value);
      console.log('I only get fired once every two seconds, max!')
      
      let self = this;
      console.log(self);
      console.log(this);

      axios.post(`/api/projects/save`, {
          model_name: model_name, 
          model_id: model_id, 
          key: key, 
          value: value,
        })
        .then(response => {
          console.log(response.data);
          //this.msg = response.data.log_message;
          this.msg = "wouter is gek";
        })
        .catch(e => {
          this.errors.push(e)
        })
    }, 500).bind(this)
  },

  created () {
    fetch('/api/mock').then(res => res.json()).then(({ msg }) => {
      this.msg = msg
    })

    fetch('/api/projects').then(res => res.json()).then(({ models, fields }) => {
      this.models = models;
      this.fields = fields;
    })   


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
