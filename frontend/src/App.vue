<template>
  <div id="app" class="container mx-auto px-4">
    <div id="nav" class="center">
      <router-link to="/">Home</router-link> |
      <router-link to="/TommAI">TommAI</router-link> |
      <router-link to="/about">About</router-link> |
      <router-link to="/tiptap">TipTap</router-link> |
      <router-link to="/lalala">Lalala</router-link> | 
      <router-link to="/projects">Projects</router-link> | 
      <router-link to="/MultipleViews">MultipleViews</router-link> | 
      <router-link to="/dragging">Dragging</router-link> | 
      <router-link to="/BasicApplication">Basic Application</router-link>
    </div>
    
    <router-view/>

    
    
  </div>
</template>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  /*margin-top: 60px;*/
}


</style>
