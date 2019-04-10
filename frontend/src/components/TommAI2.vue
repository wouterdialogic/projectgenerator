<template>
  <div class="textcomponent shadow-md w-full h-full  " :class="classes">
    <div class="p-4 m-4"></div>
     <div class="min-w-full flex flex justify-center">
        <div class="" v-for="item in menu_items" :key="item.id">
        <template v-if="active_item == item.id">
            <p class="ml-1 mr-1 p-1 pl-3 pr-3 font-bold border-b">{{item.name}}</p>
        </template>
        <template v-else>
            <button @click="make_active(item.id)" class="ml-1 mr-1 p-1 pl-3 pr-3 ">{{item.name}}</button>
        </template>
        </div>
    </div>
    <div class="p-4 m-4"></div>
    <input @keydown="searchmongrol" class="w-1/2 m-2 p-2 bg-white" v-model="searchword" placeholder="search">
    <div class="p-4 m-4"></div>
    <!-- <div>
      <p class="text-black">{{msg}} - count: {{count}}</p>
    </div> -->
    <!-- <p> {{ questions }} </p> -->
    <ModalComponent
  
    :title="'my modal'"
    :visible="false"
    >
        <p>hi there</p>
        <p>this is some info</p>
        <p>hi there</p>
        <p>this is some info</p>

            <ModalComponent
                :visible="false"
                :title="'my modal 2'"
                :classes="''"
                >
                <p>hi there</p>
                <p>this is some info</p>
                    <h2 class="bg-grey-lighter p-2 mb-2 mt-2">deep shit</h2>
                    <p>hi there</p>
                <p>this is some info</p>
            </ModalComponent>

            <h2 class="bg-grey-lighter p-2 mb-2 mt-2">deep shit</h2>
            <p>hi there</p>
            <p>this is some info</p>
                <h2 class="bg-grey-lighter p-2 mb-2 mt-2">deep shit</h2>
                <p>hi there</p>
            <p>this is some info</p>
        </ModalComponent>

    <template v-if="add_tag_popup">
        <ModalComponent 
            :title="'Add tags'"
            :visible="true"
            :classes="''"
        >
            <div class="mt-2">
                <template v-for="question in questions">
                    <template v-for="tag in question.tags" > 
                        <template v-if="current_question_id == question.id">
                            <button :key="tag.id+question.id"
                            @click="store_toggle_tag(question.id, tag.id)">
                            <TagComponent :key="tag.id+question.id"
                                
                                :title="tag.tag"
                                :title_classes="'flex-item px-4 py-1 bg-green-light text-sm'"
                            ></TagComponent>
                            </button>
                        </template>
                        <template v-else>
                            <button :key="tag.id+question.id"
                            @click="store_toggle_tag(question.id, tag.id)">
                            <TagComponent :key="tag.id+question.id"
                                
                                @click="store_toggle_tag(question.id, tag.id)"
                                :title="tag.tag"
                                :title_classes="'flex-item px-4 py-1 bg-grey-light text-sm'"
                            ></TagComponent>
                            </button>
                        </template>
                    </template>
                </template>
            </div> 
        </ModalComponent>
    </template>

    <div v-for="question in questions" :key="question.id">
        
        <p @click="show_question_details(question.id)" class="mt-2 mt-4 w-full p-2 text-bold text-lg font-bold">{{question.question}}</p>    
        <template v-for="tag in question.tags" >
            <button :key="tag.id"
                @click="enable_tag(question.id, tag.id)"
            >
            <TagComponent :key="tag.id"
               
                :title="tag.tag"
                :title_classes="'px-4 py-1 bg-grey-light text-sm'"
            ></TagComponent>
            </button>
        </template>

        <button @click="toggle_tag(question.id)" class="inline-block mb-1 bg-grey-light rounded-full px-3 pt-1 pb-1 font-semibold text-grey-darkest mr-2">
            <span class="text-sm"> + </span>
        </button>
        <button @click="toggle_tag(question.id)" class="inline-block mb-1 bg-grey-light rounded-full px-3 pt-1 pb-1 font-semibold text-grey-darkest mr-2">
            <span class="text-sm"> + </span>
        </button>
        <button @click="toggle_tag(question.id)" class="inline-block mb-1 bg-grey-light rounded-full px-3 pt-1 pb-1 font-semibold text-grey-darkest mr-2">
            <span class="text-sm"> + </span>
        </button>

        <TagComponent
            :title="'monkeys'"
            :title_classes="'px-4 pt-4 pb-4 bg-red text-sm'"
        ></TagComponent>

        <p class="giveMeEllipsis m-2 w-full p-2 border-b border-grey">{{question.answer}}</p>    
    </div>
  </div>
</template>

<script>
import ModalComponent from '@/components/ModalComponent.vue'
import TagComponent from '@/components/TagComponent.vue'

export default {
  name: "TommAI2",
  components: {
      ModalComponent,
      TagComponent
  },
  props: {

  },
  data: function() {
    return {
        // searchClient: algoliasearch(
        //     'ACOG42IYW7',
        //     '01c59572ad3c43a5632deaf54e05beac'
        // ),
        classes: "bg-grey-lighter",
        msg: "hi",
        searchword: '',
        active_item: 3,
        current_question_id: 3,
        add_tag_popup: true,
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
  },
    computed: {
        count () {
            return this.$store.state.count
        },
        questions () {
            return this.$store.state.questions;
        },
        // current_popup() {
        //     return this.add_tag_popup;
        // },
    },
  methods: {
      toggle_tag(question_id) {
          this.current_question_id = question_id;
          console.log(this.add_tag_popup);
          this.add_tag_popup = !this.add_tag_popup;
      },
      store_toggle_tag(q_id, t_id) {
        console.log("fire")
        this.$store.dispatch('toggle_question_tag', {
            question_id: q_id,
            tag_id: t_id
        })
      },
      disable_tag(q_id, t_id) {
        console.log("fire")
        this.$store.dispatch('toggle_question_tag', {
            question_id: q_id,
           tag_id: t_id
        })
      },
      enable_tag(q_id, t_id) {
        console.log("fire")
        this.$store.dispatch('toggle_question_tag', {
           question_id: q_id,
           tag_id: t_id
        })
      },
      searchmongrol() {
          //console.log("searchmongrol")
          this.$store.dispatch('getAllQuestions');
      },
      make_editable() {

      },
      show_question_details(question_id) {
          //make modal visible
      },
      make_active(id) {
          this.active_item = id;
      },
  },
  created: function() {
      this.$store.dispatch('getAllQuestions')
      this.$store.commit('increment')
      this.$store.commit('increment')
      this.$store.commit('increment')
  }
};
</script>

<style>
.giveMeEllipsis {
   overflow: hidden;
   /* text-overflow: ellipsis; */
   display: -webkit-box;
   -webkit-box-orient: vertical;
   -webkit-line-clamp: 2; /* number of lines to show */
   line-height: 25px;        /* fallback */
   max-height: 150px;       /* fallback */
}
</style>
