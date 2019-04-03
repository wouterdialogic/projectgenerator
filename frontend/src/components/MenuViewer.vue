<template>
  <div class="menuviewercomponent h-full ">
    <h3>{{msg}}</h3>
    <div v-for="item of menu_items" :key="item.name">
      <p class="text-black">{{item.name}}</p>
      <button v-on:click="$emit('set_active_menu_items', item.id)">
  Enlarge text
</button>
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
       menu_items: [
            {
                id: "1",
                name: "link 1",
                href: "qwd wqdwq dwqd ",
                active: true,
            },
            {
                id: "2",
                name: "link 2",
                href: "qwddssddwqd ",
            },
            {
                id: "3",
                name: "link 3",
                href: "qwd wqdwq dwqd ",
            },
        ],
    };
  }
};
</script>

<style>
</style>
