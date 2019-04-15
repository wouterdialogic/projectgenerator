<template>
  <div class="ToggleTagsComponent " :class="classes"> 
    <!-- <div>
      <p class="">question:  {{current_question.tags}}</p>
    </div>
    <div>
      <p class="">tags:  {{tags}}</p>
    </div>
    <div>
      <p class="">toggledTags:  {{toggledTags}}</p>
    </div> -->
   
    <template v-for="tag in tags">
      <template v-if="toggledTags.includes(tag.id)">
        <button :key="tag.id"
          @click="toggle_tag(tag.id)">
          <TagComponent :key="tag.id"
              :title="tag.tag"
              :title_classes="'flex-item px-4 py-1 bg-green-light text-sm'"
          ></TagComponent>
        </button>
      </template>
      <template v-else>
          <button :key="tag.id"
          @click="toggle_tag(tag.id)">
          <TagComponent :key="tag.id"
              :title="tag.tag"
              :title_classes="'flex-item px-4 py-1 bg-grey-light text-sm'"
          ></TagComponent>
        </button>
      </template>
    </template>

    <button class="m-2 p-2 bg-grey-lighter hover:bg-blue-light border border-black"
      @click="save_buttons"
    >
      save
    </button>

  </div>
</template>

<script>

import TagComponent from '@/components/TagComponent.vue'

export default {
  name: "ToggleTagsComponent",
  components: {
    TagComponent
  },
  props: {
    msg: String,
    classes: String,
  },

  data: function() {
    return {
      toggledTags: [],
    };
  },

  computed: {
    current_question () {
      return this.$store.state.current_question;
    },
    
    tags () {
      return this.$store.state.tags;
    },
  },

  created: function() {
    this.ininitial_states();
  },

  methods: {
    save_buttons: function() {
      this.$store.dispatch('getAllQuestions');
    },

    toggle_tag: function(tag_id) {
      if (this.toggledTags.includes(tag_id)) {
        this.toggledTags = this.toggledTags.filter(function(e) { return e !== tag_id })
      } else {
        this.toggledTags.push(tag_id);
      }
      this.save_toggled_tag(tag_id);
      this.$store.commit('set_current_question', q_id)
    },

    save_toggled_tag: function(tag_id) {
      this.$store.dispatch('toggle_question_tag', {
        question_id: this.current_question.id,
        tag_id: tag_id
      })
    },

    ininitial_states: function() {
      for (var tag of this.current_question.tags) {
        this.toggledTags.push(tag.pivot.tag_id);
      }
    },
  },
};
</script>

<style>
</style>
