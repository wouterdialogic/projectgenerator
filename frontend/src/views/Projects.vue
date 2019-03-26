<template>
  <div class="projects">
    <h1>Projects</h1>
    <!-- <img src="../assets/logo.png"> -->
    <ModelViewer 
    model_name="project"
    msg="Welcome to Your Vue.js App"/>
  </div>
</template>

<script>
// @ is an alias to /src
import ModelViewer from '@/components/ModelViewer.vue'

export default {
  name: 'projects',
  components: {
    ModelViewer
  }
}
</script>
