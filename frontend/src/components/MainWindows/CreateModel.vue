<template>
  <div class="viewAsEditable">
    <h2>{{ model_name }}</h2>
    <button class="m-2 p-2 bg-blue-light hover:bg-green" @click="save_new_model">add model</button>
    <p>{{fields}}</p>
    <template v-for="item of fields">
      <div v-bind:key="item.id" v-if="item.visible" class="md:flex md:items-center mb-2">
          
        <div class="md:w-1/4">
          <label class="block text-grey font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
              {{item.to_user_name}}
          </label>
        </div>

        <div class="md:w-3/4">   
          <template v-if="item.element == 'textarea'">
              <textarea class="m-2 p-2 border shadow" v-model="new_model[item.database_name]"></textarea>
          </template>

          <template v-if="item.element == 'input'">
              <input class="m-2 p-2 border shadow" v-model="new_model[item.database_name]">
          </template>
        </div>

      </div>
    </template>
  </div>
</template>

<script>
import _ from 'lodash'
import axios from 'axios';

export default {
  props: [
    "model_name", 'fields'
    
  ],

  name: 'CreateModel',

  data () {
    return {
      new_model: {},
    }
  },

  methods: {
    save_new_model() {
      var self = this;

      console.log(window.location.pathname)

      let save_location = window.location.pathname;

      axios.post(save_location, {
        model_name: this.model_name, 
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
  },
  retrieve_models() {
   fetch('/api/'+this.model_name+'s').then(res => res.json()).then(({ models, fields }) => {
     //this.models = models;
     //this.original_models = JSON.parse(JSON.stringify(models)); 
     //this.fields = fields;
   })
  },

    created () {
      // this.retrieve_models();
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
