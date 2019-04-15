<template>
  <div class="projects bg-snow-light">
    <h1 class="m-1 p-1 text-polar-darker"  @click="hide_menu">TommAI</h1>
   
    <div class="min-w-full flex flex justify-center mb-4">
        <div class="" v-for="item in active_menu" :key="item.id">
        <template v-if="active_item == item.id">
            <p class="ml-1 pt-1 mr-1 p-1 pl-3 pr-3 bg-polar text-snow-light">{{item.name}}</p>
        </template>
        <template v-else>
            <button @click="make_active(item.id)" class="ml-1 mr-1 p-1 pl-3 pr-3  text-polar hover:bg-polar hover:text-snow-light">{{item.name}}</button>
        </template>
        
        <!-- <template v-if="active_item == item.id">
            <p class="ml-1 mr-1 p-1 pl-3 pr-3 shadow-md border-t-blue bg-blue-lighter border-b-blue-light border-t border-l border-r border-grey-darker">{{item.name}}</p>
        </template>
        <template v-else>
            <button @click="make_active(item.id)" class="ml-1 mr-1 p-1 pl-3 pr-3 border-t-blue-light border-b-blue-light bg-blue-lighter shadow border-b bg-blue-lightest border-grey-darker">{{item.name}}</button>
        </template> -->
        </div>
    </div>

    <!-- <button @click="set_active_menu_items(menu_items2)">make active</button> -->

    <div class="min-w-full flex ">
    <!-- <img src="../assets/logo.png"> -->
        <MenuViewer
            v-on:change_menu="postFontSize += 0.1"
            class="w-1/4 pl-4 " 
            :class="menu_classes"
            msg="menu"
            :menu_items="active_menu"
            v-on:set_active_menu_items="set_active_menu_items"
        ></MenuViewer>
        <component 
            v-bind:is="active_model"
            
            class=""
            :class="model_viewer_classes"
            model_parent_name="project"
            model_children_name="project"
            msg="Welcome to Your Vue.js App"> 
        </component>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
// import ModelViewer from '@/components/ModelViewer.vue'
// import ModelViewer2 from '@/components/ModelViewer2.vue'
// import ModelViewer3 from '@/components/ModelViewer3.vue'
import MenuViewer from '@/components/MenuViewer.vue'
// import TabsViewer from '@/components/TabsViewer.vue'
// import DataComponent from '@/components/DataComponent.vue'
// import VueTable from '@/components/VueTable.vue'
// import TommAI from '@/components/TommAI.vue'
import TommAI2 from '@/components/TommAI2.vue'
import Search from '@/components/Search.vue'
import QuestionShowComponent from '@/components/QuestionShowComponent.vue'
import ToggleTags from '@/components/ToggleTags.vue'
import { mapState, mapActions } from 'vuex'
import store from '@/store'

export default {
  name: 'projects',
  components: {
    // ModelViewer,
    // ModelViewer2,
    // ModelViewer3,
    MenuViewer,
    // // TabsViewer,
    // DataComponent,
    // VueTable,
    // TommAI,
    TommAI2,
    Search,
    QuestionShowComponent,
    ToggleTags,
    store,
  },
  data () {
    return {
      active_item: 7,
      //counter2: this.$store.counter,
      active_menu: [],
      menu_items1: [
          
            {
                id: "1",
                name: "Search",
                model: "Search",
            },
            {
                id: "2",
                name: "Browse",
                model: "Browse",
            },
            {
                id: "3",
                name: "Ask",
                model: "Ask",
            },
            {
                id: "4",
                name: "Answer",
                model: "Answer",
            },
            {
                id: "7",
                name: "TommAI2",
                model: "TommAI2",
            },
            {
                id: "8",
                name: "QuestionShowComponent",
                model: "QuestionShowComponent",
            },
            {
                id: "9",
                name: "ToggleTags",
                model: "ToggleTags",
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
