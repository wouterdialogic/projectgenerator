<template>
  <div class="projects">
    <h1>Dragging</h1>
    <p>Here are some <a href="https://github.com/SortableJS/Sortable#options">options</a></p>
    <button @click="hide_menu">hide menu</button>
    <div class="min-w-full flex ">
    <!-- <img src="../assets/logo.png"> -->
        <MenuViewer
        class="w-1/4 shadow-lg pl-4 " 
        :class="menu_classes"
        msg="menu"
        :menu_items="menu_items"
        ></MenuViewer>
        <div 
        class="shadow-lg"
        :class="model_viewer_classes"
        >
        <pre>
        {{sortable}}</pre>
            <h1 class="m-4">Simple drag and drop</h1>
            <draggable v-model="sortable" animation="500" group="people" @start="drag=true" @end="drag=false">
                <div class="m-2 p-2 w-full bg-grey border-2 border-red" v-for="element in sortable" :key="element.id">{{element.name}}</div>
            </draggable>    

            <h1 class="m-4">Simple drag and drop - With transition</h1>
            <draggable animation="222" v-model="sortable2" ghostClass='bg-blue-lighter'>
                <transition-group class="hover:bg-blue">
                    <div class="m-2 p-2 w-full bg-yellow-lighter hover:bg-yellow border-2 border-blue" v-for="element in sortable2" :key="element.id">
                        {{element.name}}
                    </div>
                </transition-group>
            </draggable>

             <h1 class="m-4">Shared groups</h1>
             <div class="flex">
                <div class="w-1/2">
                    <h4 class="m-2 p-2 bg-grey-lighter">list 1</h4>
                    <ul class="">
                        <div v-for="item in sortable" :key="item.id">{{item.id}} - {{item.name}}</div>
                    </ul>
                </div>
                <div class="w-1/2">
                    <h4 class="m-2 p-2 bg-grey-lighter">list 2</h4>
                    <ul class="">
                        <div v-for="item in sortable2" :key="item.id">{{item.id}} - {{item.name}}</div>
                    </ul>
                </div>
             </div>
             <div class="flex">
            <draggable class="w-1/2" v-model="sortable" animation="500" group="shared" @start="drag=true" @end="drag=false">
                <div class="m-2 p-2 bg-blue-lighter border-2 border-blue" v-for="element in sortable" :key="element.id">{{element.name}}</div>
            </draggable>    
            <draggable class="w-1/2" v-model="sortable2" animation="500" group="shared" @start="drag=true" @end="drag=false">
                <div class="m-2 p-2 bg-red-lighter border-2 border-red" v-for="element in sortable2" :key="element.id">{{element.name}}</div>
            </draggable>    
             </div>

             <h1 class="m-4">Cloning</h1>
             <p>Here there is no moving, but only copying, made so by: :group="{ name: 'shared', pull: 'clone'}"</p>
             <div class="flex">
                <div class="w-1/2">
                    <h4 class="m-2 p-2 bg-grey-lighter">list 1</h4>
                    <ul class="">
                        <div v-for="item in sortable" :key="item.id">{{item.id}} - {{item.name}}</div>
                    </ul>
                </div>
                <div class="w-1/2">
                    <h4 class="m-2 p-2 bg-grey-lighter">list 2</h4>
                    <ul class="">
                        <div v-for="item in sortable2" :key="item.id">{{item.id}} - {{item.name}}</div>
                    </ul>
                </div>
             </div>
             <div class="flex">
            <draggable class="w-1/2" v-model="sortable" animation="500" :group="{ name: 'shared', pull: 'clone'}" @start="drag=true" @end="drag=false">
                <div class="m-2 p-2 bg-blue-lighter border-2 border-blue" v-for="element in sortable" :key="element.id">{{element.name}}</div>
            </draggable>    
            <draggable class="w-1/2" v-model="sortable2" animation="500" :group="{ name: 'shared', pull: 'clone'}" @start="drag=true" @end="drag=false">
                <div class="m-2 p-2 bg-red-lighter border-2 border-red" v-for="element in sortable2" :key="element.id">{{element.name}}</div>
            </draggable>    
             </div>

            <h1 class="m-4">Cloning with original source</h1>
            <p>Here the left side is static, you cant sort it (sort = false), you cant add items to it (put = false). But you can drag these item into the right side!</p><p>For now the docs say: :sortable="false" should do the trick, but that doesnt work</p><p>You can set a filter with :filter='"div"' but then you cant drag that item anymore. It would be good to use that as a seperator
             <div class="flex">
                <div class="w-1/2">
                    <h4 class="m-2 p-2 bg-grey-lighter">list 1</h4>
                    <ul class="">
                        <div v-for="item in sortable" :key="item.id">{{item.id}} - {{item.name}}</div>
                    </ul>
                </div>
                <div class="w-1/2">
                    <h4 class="m-2 p-2 bg-grey-lighter">list 2</h4>
                    <ul class="">
                        <div v-for="item in sortable2" :key="item.id">{{item.id}} - {{item.name}}</div>
                    </ul>
                </div>
             </div>
             <div class="flex">
            <draggable 
                class="w-1/2" 
                v-model="sortable" 
                 :filter='""'
                :group="{ name: 'shared', pull: 'clone', put: 'false'}" 
                sort="false"
                :sortable="false"
                @start="drag=true" 
                @end="drag=false"
            >
                <div class="m-2 p-2 bg-blue-lighter border-2 border-blue" v-for="element in sortable" :key="element.id">{{element.name}}</div>
            </draggable>    
            <draggable 
            class="w-1/2" 
            v-model="sortable2" 
            animation="500" 
            :group="{ name: 'shared', pull: 'clone'}" 
            @start="drag=true" 
            @end="drag=false">
                <div class="m-2 p-2 bg-red-lighter border-2 border-red" v-for="element in sortable2" :key="element.id">{{element.name}}</div>
            </draggable>    
            </div>

            <h3>Nested draggable</h3>
            <pre>
                {{tasks}}
            </pre>
            <draggable ghostClass='bg-blue-lighter' animation="550" :tag="'ul'" :list="tasks" class="dragArea shadow bg-white" :group="{name:'g1'}" > 
                <!-- <div class="m-4 border border-black bg-grey-lighter" v-for="el in tasks" :key="el.name"> -->
                <div class="mt-4 ml-4 mb-4 mr-4 border border-black" v-for="el in tasks" :key="el.name">
                    <p class="pt-1 pb-1 bg-orange-lighter border-b border-black">{{el.name}}</p>
                    <local-draggable 
                    :tasks="el.tasks"
                    :task_level="task_level"
                    ></local-draggable>
                </div>
            </draggable>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            <br/>
        </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import ModelViewer from '@/components/ModelViewer.vue'
import MenuViewer from '@/components/MenuViewer.vue'
import draggable from 'vuedraggable'
import LocalDraggable from '@/components/LocalDraggable';
//import nestedDraggable from "./infra/nested";

export default {
  name: 'projects',
  components: {
    ModelViewer,
    MenuViewer,
    draggable,
    LocalDraggable,
    //nestedDraggable,
  },
  data () {
    return {
        "task_level": 1,
        "tasks": [
            {
            "name": "task 1",
            "tasks": [
                {
                "name": "task 1 - sub task 1",
                "tasks": []
                },
                 {
                "name": "task 1 - sub task 2",
                "tasks": [
                    {
                    "name": "task 1 - sub task 1 1",
                    "tasks": []
                    },
                    {
                    "name": "task 1 - sub task 1 2",
                    "tasks": [
                        {
                        "name": "task 1 - sub task 1 1 1",
                        "tasks": []
                        },
                        {
                        "name": "task 1 - sub task 1 1 2",
                        "tasks": []
                        }
                        ]
                    }
                ]
                }
            ]
            },
            {
            "name": "task 2",
            "tasks": [
                {
                "name": "task 2 - sub task 1",
                "tasks": []
                }
            ]
            },
            {
            "name": "task 3 - no children for now, but might have in the future",
                    "tasks": [
            ]
            }
        ],
      menu_items: [
            {
                name: "link 1",
                href: "qwd wqdwq dwqd ",
                order: 1,
            },
            {
                name: "link 2",
                href: "qwd wqdwq dwqd ",
                order: 2,
            }
        ],
        sortable: [
            {
                id: 1,
                name: "link 1",
                order: 1,
            },
            {
                id: 2,
                name: "link 2",
                order: 2,
            },
            {
                id: 3,
                name: "link 3",
                order: 3,
            }
        ],
        sortable2: [
            {
                id: 1,
                name: "link 4",
                order: 1,
            },
            {
                id: 2,
                name: "link 5",
                order: 2,
            },
            {
                id: 3,
                name: "link 6",
                order: 3,
            }
        ],

        menu_classes: '',
        model_viewer_classes: 'w-full',
    }
  },

  methods: {
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
}
</script>
<style scoped>
.active_dragging {
    border: 6px;
    background-color: red;
}
.dragArea {
    /* padding: 10px; */
    padding: 0px;
    /* margin: 20px; */
  /* min-height: 150px; */
  /* outline: 1px dashed; */
}
</style>
