<template>
  <div class="about">
    <h1>This is an awdawd page</h1>

    <div class="text-black sm:bg-green md:bg-blue md:text-yellow lg:bg-red xl:bg-orange">
  Test

</div>
  <DataComponent></DataComponent>

  </div>
</template>

<script>
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue'

import DataComponent from "@/components/DataComponent";
import TextComponent from "@/components/TextComponent";
import BoxComponent from "@/components/BoxComponent.vue";

export default {
  name: 'home',
  components: {
    HelloWorld,
    DataComponent,
    TextComponent,
    BoxComponent
  }
}
</script>

