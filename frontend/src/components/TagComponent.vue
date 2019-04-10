<template>
  <button :class="title_classes" class="inline-block mb-1 rounded-full text-grey-darkest mr-2">
    <span >{{title}}</span>
  </button>
</template>

<script>
export default {
  name: "TagComponent",
  props: {
    title: String,
    title_classes: String,
    button_classes: String,
    background_color: String,
    height: String,
    margin: String,
    padding: String
  },
  data: function() {
    return {
    //   
    };
  },
  computed: {
    classes() {
      return this.background_color + " " + this.height + ' ' + this.margin + ' ' + this.padding;
    }
  }
};
</script>

<style>
</style>
