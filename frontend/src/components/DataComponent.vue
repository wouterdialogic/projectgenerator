<template>
  <div id="datacomponent">
    <div>
      <p class="bg-white">Here is some data</p>
    </div>

    <!-- <input class="m-4 p-2 bg-white border" v-model="textBoxClasses" placeholder="edit me"> -->
    <p>{{ textBoxClasses }}</p>
  <input class="m-4 p-2 bg-white border" @keyup="updateComponentClasses('TextComponent')" v-model="textBoxClasses">
      <p>{{ boxClasses }}</p>
  <input class="m-4 p-2 bg-white border" @keyup="updateComponentClasses('BoxComponent')" v-model="boxClasses">
    <!-- <p>{{datacomponent.texts}}</p>
    <div v-for="component of datacomponent.texts" :key="component.key">
      <p>{{component.content}}raar hoor</p>
      <component v-bind:is="component.type" :msg="component.content"></component>
    </div> -->

    <button class="bg-white p-4 m-4 border border-black" @click="changeComponentTypes">verander</button>

    <Waterfall :line-gap="200" :watch="datacomponent.texts" :width="800" :height="800">
      <!-- each component is wrapped by a waterfall slot -->
      <WaterfallSlot class="p-1 border"
        v-for="(component) in datacomponent.texts"
        :width="component.width"
        
        :height="component.height"
        :order="component.key"
        :key="component.key"
      >
        <component v-bind:is="component.type" :msg="component.content" :classes="component.classes"></component>
      </WaterfallSlot>
    </Waterfall>
  </div>
</template>

<script>
import TextComponent from "@/components/TextComponent";
import BoxComponent from "@/components/BoxComponent";
// import WaterFallComponent from "@/components/WaterFallComponent";
// import WaterFallSlotComponent from "@/components/WaterFallSlotComponent";
import Waterfall from 'vue-waterfall/lib/waterfall'
import WaterfallSlot from 'vue-waterfall/lib/waterfall-slot'
// import Waterfall from "vue-waterfall/lib/waterfall";
// import WaterfallSlot from "vue-waterfall/lib/waterfall-slot";


export default {
  name: "DataComponent",
  components: {
    TextComponent,
    BoxComponent,
    Waterfall,
    WaterfallSlot,
    // WaterFallComponent,
    // WaterFallSlotComponent,
    // Waterfall,
    // WaterfallSlot
  },
  props: {},
  data: function() {
    return {
        textBoxClasses: '',
        boxClasses: '',
      datacomponent: {
        // zxcc: zxccs,
        texts: [
          {
            key: 1,
            type: "BoxComponent",
            name: "there",
            content: "there is so much... BLUE!!",
            classes: "bg-blue border-red",
            width: 200,
            height: 300
          },
          {
            key: 2,
            type: "TextComponent",
            name: "there",
            classes: "bg-blue border-red",
            content: "there is so much.. lala...... BLUE",
            width: 200,
            height: 180
          }
        ]
      }
    };
  },
  methods: {
    changeComponentTypes: function() {
    //   console.log(this.datacomponent);
      var test = this.datacomponent.texts
      for (var component of test) {
        // console.log(component);
        // console.log(component.type);
        if (component.type == "TextComponent") {
          component.type =  "BoxComponent";
        } else {
          component.type = "TextComponent";        }
      }
    },

    updateComponentClasses: function(component_type) {
        console.log("hi")
    //   console.log(this.datacomponent);
      var test = this.datacomponent.texts
      for (var component of test) {
        // console.log(component);
        // console.log(component.type);
        if (component.type == 'BoxComponent') {
          component.classes =  this.boxClasses + ' ';
        } else {
          component.classes = this.textBoxClasses +  ' ';

        }
      }
    }
  },

  mounted() {
    //   let newkey = 0
      for (var i = 3; i < 21; i ++) {
          var component_type;

          if (i % 2) {
            component_type = 'TextComponent';
          } else {
            component_type = 'BoxComponent';

          }

          this.datacomponent.texts.push({
              key: i,
              type: component_type,
              name: 'monkey',
              classes: "",
              content: 'this is some random content: ' + i,
              width: Math.floor(Math.random() * 18) + 10 * 10,
              height: Math.floor(Math.random() * 60) + 7 * 10,
          });
      }

    //   console.log(this.datacomponent.texts);
  }
};

</script>

<style>
</style>
