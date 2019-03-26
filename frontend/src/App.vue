<template>
  <div id="app" class="container mx-auto px-4">
    <div id="nav" class="center">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link> |
      <router-link to="/lalala">Lalala</router-link> | 
      <router-link to="/projects">Projects</router-link>
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
