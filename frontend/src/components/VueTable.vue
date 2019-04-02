<template>
  <vuetable ref="vuetable"
    api-url="http://localhost:8080/api/projectsonly"
    :fields="[{
    name: 'name',
    sortField: 'name'
  }, 
  {
    name: 'description',
    title: 'Project description'
  }, 'order']"
    data-path=""
    pagination-path=""
  ></vuetable>
</template>

<script>
import Vuetable from 'vuetable-2'

export default {
  components: {
    Vuetable
  }
}
</script>