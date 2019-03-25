<template>
  <div class="textcomponent shadow-lg w-full h-full  " :class="classes">
    <div>
      <p class="text-black">{{msg}}</p>
    </div>
  </div>
</template>

<script>
export default {
  name: "TextComponent",
  props: {
    msg: String,
    classes: String,
  },
  data: function() {
    return {
    //   datacomponent: {
    //     texts: [
    //       {
    //         key: 1,
    //         type: "textComponent",
    //         name: "there",
    //         content: "there is so much..."
    //       },
    //       {
    //         key: 2,
    //         type: "textComponent",
    //         name: "there",
    //         content: "there is so much.. lala."
    //       }
    //     ]
    //   }
    };
  }
};
</script>

<style>
</style>
