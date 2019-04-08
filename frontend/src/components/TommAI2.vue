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
    <input @keydown="searchmongrol" class="w-1/2 m-2 p-2 bg-white" v-model="searchword" placeholder="search"></input>
    <div class="p-4 m-4"></div>
    <!-- <div>
      <p class="text-black">{{msg}} - count: {{count}}</p>
    </div> -->
    <!-- <p> {{ questions }} </p> -->
    <ModalComponent
  
    :title="'my modal'"
    :visable="false"
    >
        <p>hi there</p>
        <p>this is some info</p>
        <p>hi there</p>
        <p>this is some info</p>

            <ModalComponent
                :visable="false"
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
    
    <div v-for="question in questions" :key="question.id">
        <p @click="show_question_details(question.id)" class="mt-2 mt-4 w-full p-2 text-bold text-lg font-bold">{{question.question}}</p>    
        <template v-for="tag in question.tags" >
            <button class="inline-block mb-1 bg-grey-light rounded-full px-3 pt-1 pb-1 font-semibold text-grey-darkest mr-2" :key="tag.id">
                <span class="text-sm">{{tag.tag}}</span>
            </button>
        </template>
        <p class="giveMeEllipsis m-2 w-full p-2 border-b border-grey">{{question.answer}}</p>    
    </div>
  </div>
</template>

<script>
import ModalComponent from '@/components/ModalComponent.vue'

export default {
  name: "TommAI2",
  components: {
      ModalComponent
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
        active_item: 1,
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

        }
    },
  methods: {
      searchmongrol() {
          console.log("searchmongrol")
          this.$store.dispatch('getAllQuestions')
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
