<template>
  <div class="projects">
    <h1>Projects and menu, counter: {{count}}</h1>
    <!-- <h3>counter 2: {{counter2}}</h3> -->
    <button @click="hide_menu">hide menu</button>
    <div class="min-w-full flex flex justify-center">
        <div class="border-b" v-for="item in active_menu" :key="item.id">
        <template v-if="active_item == item.id">
            <p class="ml-1 mr-1 p-1 pl-3 pr-3 shadow-md border-t-blue bg-blue-lighter border-b-blue-light border-t border-l border-r border-grey-darker">{{item.name}}</p>
        </template>
        <template v-else>
            <button @click="make_active(item.id)" class="ml-1 mr-1 p-1 pl-3 pr-3 border-t-blue-light border-b-blue-light bg-blue-lighter shadow border-b bg-blue-lightest border-grey-darker">{{item.name}}</button>
        </template>
        </div>
    </div>

    <button @click="set_active_menu_items(menu_items2)">make active</button>

    <div class="min-w-full flex ">
    <!-- <img src="../assets/logo.png"> -->
    <MenuViewer
    v-on:change_menu="postFontSize += 0.1"
    class="w-1/4 shadow-md pl-4 " 
    :class="menu_classes"
     msg="menu"
     :menu_items="active_menu"
     v-on:set_active_menu_items="set_active_menu_items"
    ></MenuViewer>
    <component 
    v-bind:is="active_model"
    
    class="shadow-md"
    :class="model_viewer_classes"
    model_parent_name="project"
    model_children_name="project"
    msg="Welcome to Your Vue.js App"> </component>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import ModelViewer from '@/components/ModelViewer.vue'
import ModelViewer2 from '@/components/ModelViewer2.vue'
import ModelViewer3 from '@/components/ModelViewer3.vue'
import MenuViewer from '@/components/MenuViewer.vue'
import TabsViewer from '@/components/TabsViewer.vue'
import DataComponent from '@/components/DataComponent.vue'
import VueTable from '@/components/VueTable.vue'
import TommAI from '@/components/TommAI.vue'
import TommAI2 from '@/components/TommAI2.vue'
import { mapState, mapActions } from 'vuex'
import store from '@/store'

export default {
  name: 'projects',
  components: {
    ModelViewer,
    ModelViewer2,
    ModelViewer3,
    MenuViewer,
    TabsViewer,
    DataComponent,
    VueTable,
    TommAI,
    TommAI2,
    store,
  },
  data () {
    return {
      active_item: 1,
      //counter2: this.$store.counter,
      active_menu: [],
      menu_items1: [
            {
                id: "1",
                name: "Projects",
                href: "qwd wqdwq dwqd ",
                model: "ModelViewer",
                active: true,
            },
            {
                id: "2",
                name: "Settings",
                model: "DataComponent",
                href: "qwddssddwqd ",
            },
            {
                id: "3",
                name: "Model viewer 2",
                href: "qwd wqdwq dwqd ",
                model: "ModelViewer2",
            },
            {
                id: "4",
                name: "VueTable",
                href: "qwd  dwqd ",
                model: "VueTable",
            },
            {
                id: "5",
                name: "ModelViewer3",
                model: "ModelViewer3",
            },
            {
                id: "6",
                name: "TommAI",
                model: "TommAI",
            },
            {
                id: "7",
                name: "TommAI2",
                model: "TommAI2",
            },
        ],
        menu_items2: [
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
        menu_classes: '',
        active_model: '',
        model_viewer_classes: 'w-full',
    }
  },
    computed: {
        count () {
        return store.state.count
        }
    },
//     counter: state => store.state.count,// this.$store.state.count,
//   },

  methods: {
      set_active_menu_items(menu_name) {
          this.active_menu = eval("this.menu_items"+menu_name);
      },

      make_active(item_id) {
        this.active_item = item_id;
        this.set_active_element(item_id)

      },

    set_active_element(id) {
         for (let item of this.active_menu) {
            if ( id  == item.id) {
                if (item.model) {
                    this.active_model = item.model;
                }
            }
        }
    },

      hide_menu() {
          if (this.menu_classes == '') {
              this.menu_classes = 'hidden';
              this.model_viewer_classes = ' w-full'
          } else {
              this.menu_classes = '';
              this.model_viewer_classes = ' w-3/4'
          }
      },
      
  },
  created() {
      this.active_menu = this.menu_items1;
       this.set_active_element(this.active_menu[0].id)
    //   console.log(this.menu_items[0].id);
  }
}
</script>
