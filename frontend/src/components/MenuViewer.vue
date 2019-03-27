<template>
  <div class="menuviewercomponent h-full ">
    <h3>{{msg}}</h3>
    <div v-for="item of menu_items" :key="item.name">
      <p class="text-black">{{item.name}}</p>
    </div>
  </div>
</template>

<script>
export default {
  name: "MenuViewer",
  props: {
    msg: String,
    menu_items: Array,
  },
  data: function() {
    return {
    };
  }
};
</script>

<style>
</style>
