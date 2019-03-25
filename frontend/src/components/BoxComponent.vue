<template>
  <div class="boxcomponent shadow-lg m-4 p-4" :class="classes"> 
    <div>
      <p class="">{{msg}} boxie</p>
    </div>
  </div>
</template>

<script>
export default {
  name: "BoxComponent",
  props: {
    msg: String,
    classes: String,
  },
  data: function() {
    return {
      datacomponent: {
        texts: [
          {
            key: 1,
            type: "textComponent",
            name: "there",
            content: "there is so much..."
          },
          {
            key: 2,
            type: "textComponent",
            name: "there",
            content: "there is so much.. lala."
          }
        ]
      }
    };
  }
};
</script>

<style>
</style>
