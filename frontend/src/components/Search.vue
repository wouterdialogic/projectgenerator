<template>
  <div class="SearchComponent w-full h-full  " :class="classes">

    <div class="p-4 m-4"></div>
    <input @keydown="searchmongrol" class="w-1/2 m-2 p-2 bg-white" v-model="searchword" placeholder="search">
    
    <div class="p-4 m-4"></div>
    store level:{{current_store_level}}
    <br/>
    modals: {{modals}}
    <template v-if="add_tag_popup">
        <ModalComponent 
            :title="'Add tags'"
            :visible="true"
            :classes="''"
        >
            <ToggleTags>
            </ToggleTags>
        </ModalComponent>
    </template>
    
    <div v-for="question in questions" :key="question.id">
        
        <p @click="show_question_details(question.id)" class="mt-2 mt-4 w-full p-2 text-bold text-lg font-bold">{{question.question}}</p>    
        <template v-for="tag in question.tags" >
            <button :key="tag.id"
                @click="toggle_modal(question.id, tag.id)"
            >
            <TagComponent :key="tag.id"
               
                :title="tag.tag"
                :title_classes="'px-4 py-1 bg-grey-light text-sm'"
            ></TagComponent>
            </button>
        </template>

        <button @click="update_tags(question.id)" class="inline-block mb-1 bg-grey-light rounded-full px-3 pt-1 pb-1 font-semibold text-grey-darkest mr-2">
            <span class="text-sm"> + </span>
        </button>

        <p class="giveMeEllipsis m-2 pl-32 pr-32 w-full p-2 border-b border-grey">{{question.answer}}</p>    
    </div>
  </div>
</template>

<script>
import ModalComponent from '@/components/ModalComponent.vue'
import TagComponent from '@/components/TagComponent.vue'
import ToggleTags from '@/components/ToggleTags.vue'

export default {
  name: "TommAI2",
  components: {
      ModalComponent,
      TagComponent,
      ToggleTags,
  },
  props: {

  },
  data: function() {
    return {
        classes: "bg-grey-lighter",
        msg: "hi",
        searchword: '',
        active_item: 3,
        current_question_id: 3,
        add_tag_popup: false,
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
        current_store_level: function() {
            return this.$store.state.current_store_level
        },
        modals: function() {
            return this.$store.state.Modals
        },
        total_store () {
            return this.$store.state.Modals;
        },
        count () {
            return this.$store.state.count
        },
        questions () {
            return this.$store.state.questions;
        },
        current_question () {
            return this.$store.state.current_question;
        },
        tags () {
            return this.$store.state.tags;
        },
        show_popup: function() {
            if (this.current_store_level == 1) {
                return false;
            } else {
                return true;
            }
        }
    },
  methods: {
    tag_in_question(tag_id, question_id) {

        if (!this.current_question) {
            return;
        }

        if (this.current_question.tags.length == 0) {
            console.log("EXIT");
            return;
        }

        for (var tag of this.current_question.tags) {
            if (tag_id == tag.id) {
                console.log("TRUE");
                return true;
            }
        }
    },

    get_current_question() {
        for (var question of this.questions) {
            if (question.id == this.current_question_id) {
                return question;
            }
        }
    },

    update_tags(question_id) {
        this.current_question_id = question_id;
        this.$store.commit('set_current_question', question_id)
        this.$store.commit('setAllTags');
    },

    toggle_modal(question_id) {
        this.current_question_id = question_id;
        this.$store.commit('set_current_question', question_id)
        this.add_tag_popup = true;
        this.$store.commit('setAllTags');
    },

    store_toggle_tag(q_id, t_id) {
        this.$store.dispatch('toggle_question_tag', {
            question_id: q_id,
            tag_id: t_id
        })
        this.$store.dispatch('getAllQuestions');
        this.current_question_id = q_id;
        this.$store.commit('set_current_question', q_id)
        this.$store.commit('setAllTags');
    },

    searchmongrol() {
        this.$store.dispatch('getAllQuestions');
    },

    show_question_details(question_id) {
        //make modal visible
    },
    make_active(id) {
        this.active_item = id;
    },
  },
  created: function() {
      this.$store.commit(Modals['PUSH_MODAL'], "daar")
      this.$store.commit(Modals['PUSH_MODAL'], "waar")
      this.$store.dispatch('getAllQuestions')
      this.$store.dispatch('getAllTags')
  }
};
</script>

<style>

</style>
