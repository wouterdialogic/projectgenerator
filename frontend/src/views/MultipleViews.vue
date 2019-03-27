<template>
  <div class="projects">
    <h1>Projects and menu</h1>
    <button @click="hide_menu">hide menu</button>
    <div class="min-w-full flex ">
    <!-- <img src="../assets/logo.png"> -->
    <MenuViewer
    class="w-1/4 shadow-lg pl-4 " 
    :class="menu_classes"
     msg="menu"
     :menu_items="menu_items"
    ></MenuViewer>
    <ModelViewer 
    class="shadow-lg"
    :class="model_viewer_classes"
    model_parent_name="project"
    model_children_name="project"
    msg="Welcome to Your Vue.js App"/>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import ModelViewer from '@/components/ModelViewer.vue'
import MenuViewer from '@/components/MenuViewer.vue'

export default {
  name: 'projects',
  components: {
    ModelViewer,
    MenuViewer,
  },
  data () {
    return {
      menu_items: [
            {
                name: "link 1",
                href: "qwd wqdwq dwqd ",
            },
            {
                name: "link 2",
                href: "qwd wqdwq dwqd ",
            }
        ],
        menu_classes: '',
        model_viewer_classes: 'w-full',
    }
  },

  methods: {
      hide_menu() {
          console.log("hide")
          if (this.menu_classes == '') {
              this.menu_classes = 'hidden';
              this.model_viewer_classes = ' w-full'
          } else {
              this.menu_classes = '';
              this.model_viewer_classes = ' w-3/4'
          }
      },
  },
}
</script>
