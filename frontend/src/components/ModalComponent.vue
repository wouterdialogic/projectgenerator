<template>
  <div class="ModalComponent"> 
    <div v-if="is_visable" class="fixed pin overflow-auto flex " :class="z_index + ' ' + 'bg-smoke'+level_to_transparancy">
        <div class="relative bg-white w-full max-w-lg m-auto shadow-lg flex-col flex pb-2 "  :class="classes" >
            <span class="absolute pin-t pin-r p-1" @click="close">
                <svg class="h-8 w-8 fill-current text-grey hover:text-grey-darkest" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>

            <h2 class="bg-grey-lighter p-2 mb-2">{{title}}</h2>
            
            <!-- <p>level: {{level}}</p> -->
            <p>z_index: {{z_index}}</p>
            <p>visable: {{visable}}</p>
            <p>is_visable: {{is_visable}}</p>

            <p>store_level_before_create: {{store_level_before_create}}</p>
            <p>store_level_after_create: {{store_level_after_create}}</p>

            <p>current_store_level: {{current_store_level}}</p>

            <p>level_to_transparancy: {{level_to_transparancy}}</p>

            <slot></slot>

        </div>
    </div>

  </div>
</template>

<script>

export default {
  name: "ModalComponent",

  props: {
    title: String,
    classes: String, //aplied to the content
    content: String,
    visable: Boolean, //should be true!
  },

  data: function() {
    return {
      //only use the input to determine this value, dont link to it
      is_visable: JSON.parse(this.visable),
    };
  },

  //retrieve the current level before we create the modal
  beforeCreate: function() {
    this.store_level_before_create = this.$store.state.modal_level;
    
    //if another modal will be opened, it will get a higher level
    this.$store.commit('open_modal');
    
  },
  created: function() {
    //this level will be used, if another modal will be openen (by this modal fe)
    this.store_level_after_create = this.$store.state.modal_level
  },

  methods: {
    close() {
      this.$store.commit('close_modal')
      this.is_visable = false;
    },
  },
  
  computed: {
    current_store_level: function() {
      return this.$store.state.modal_level
    },

    z_index() {
      return 'z-'+this.store_level_before_create * 50;
    },

    level_to_transparancy() {
      if (this.store_level_before_create == 1) {
        return "-lighter";
      } else if (this.store_level_before_create == 2) {
          return "-light";
      } else if (this.store_level_before_create == 3) {
          return "";
      } else if (this.store_level_before_create == 4) {
          return "-dark";
      } else if (this.store_level_before_create == 5) {
          return "-darker";
      } else if (this.store_level_before_create == 6) {
          return "-darkest";
      } else {
          return "-darkest";
      }
    },
  }
};
</script>

<style>
</style>
