<template>
    <!-- <div class="flex"> -->
        <!-- <div class="w-1/2"> -->
            <!-- <draggable  animation="550" :tag="'ul'" :list="tasks" class="dragArea" :group="{ name:'g1'}" ghostClass='bg-blue-lightest'> 
                <div class="m-4 border border-black bg-grey-lighter" v-for="el in tasks" :key="el.name">
                    <p class="bg-blue-lighter border-b border-black">{{el.name}}</p>
                    <local-draggable class="bg-white" :tasks="el.tasks"></local-draggable>
                </div>
            </draggable> -->
        <!-- </div> -->

        <!-- <div class="w-1/2"> -->
            <draggable  animation="550" :tag="'ul'" :list="tasks" class="dragArea" :group="{ name:'g1'}" ghostClass='bg-blue-lightest'> 
                <!-- <div class="m-4 border border-black bg-grey-lighter" v-for="el in tasks" :key="el.name"> -->
                <div :class="'bg-blue'+level_to_color" class="mt-4 mb-4 ml-4 mr-0 border-b border-l border-t border-black" v-for="el in tasks" :key="el.name">
                    <p :class="'bg-orange'+level_to_color" class="pt-1 pb-1 border-b border-black">{{level_plus_one}} - {{el.name}}</p>
                    <local-draggable 
                     :task_level="level_plus_one"
                     :tasks="el.tasks"></local-draggable>
                </div>
            </draggable>
        <!-- </div> -->
    <!-- </div> -->
</template>

<script>
import draggable from 'vuedraggable'

export default {
    name: "LocalDraggable",
    components: {
        draggable,
    },
    props: ['tasks', 'task_level'],
    data: function() {
        return {
        };
    },
    computed: {
        level_plus_one: function() {
            return this.task_level + 1;
        },
        level_to_color: function() {
            if (this.task_level == 1) {
                return "-lighter";
                // return "-lightest";
            } else if (this.task_level == 2) {
                return "-light";
            } if (this.task_level == 3) {
                return "";
            } if (this.task_level == 4) {
                return "-dark";
            } if (this.task_level == 5) {
                window.alert("\r\nYOU FUCKING IDIOT! \r\n \r\nEhrm... What i meant to say... think of the users please.\r\nGoing deeper than 3 levels should be avoided.")
                return "-darker text-white";

            } if (this.task_level == 6) {
                return "-darkest text-white";
            } else {
                return "-darkest text-white";
            }
        },
    },
    
};
</script>

<style>
.dragArea {
      /* padding: 5px; */
      padding: 0px;
    /* margin: 5px; */
  min-height: 50px;
  /* outline: 1px dashed; */
}
</style>
