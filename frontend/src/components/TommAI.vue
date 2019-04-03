<template>
  <div class="textcomponent shadow-lg w-full h-full  " :class="classes">
    <!-- <div> -->
      <!-- <p class="text-black">{{msg}}</p> -->
    <!-- </div> -->
    <ais-instant-search :search-client="searchClient" index-name="Questions" class="w-full h-full">
        <ais-search-box class="w-full p-4 bg-yellow-lighter" />
        <ais-hits>
            <div slot="item" slot-scope="{ item }" class="m-2 py-4 border-b  border-grey">
            <!-- {{item}} -->
                <h2 @click="make_editable()" class="color-black  bg-grey-lighter">{{ item.question }}</h2>
                <h3 class="color-black bg-grey-lighter">{{ item.answer }}</h3>
            </div>
        </ais-hits>
    </ais-instant-search>
  </div>
</template>

<script>
import algoliasearch from 'algoliasearch/lite';
// import 'instantsearch.css/themes/algolia-min.css';

export default {
  name: "TommAI",
  components: {
      //InstantSearch
  },
  props: {

  },
  data: function() {
    return {
        searchClient: algoliasearch(
            'ACOG42IYW7',
            '01c59572ad3c43a5632deaf54e05beac'
        ),
        classes: "bg-grey-lighter",
        msg: "hi",
    };
  },
  methods: {
      make_editable() {

      },
  }
};
</script>

<style>
</style>
