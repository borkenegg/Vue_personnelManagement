<template lang="html">
<div id="container">
  <root-content></root-content>
</div>
</template>

<script>
import rootContent from "./root-content.vue"
export default {
  components:{
    rootContent
  }
}
</script>

<style lang="css" scoped>
  #container{
    width: 100vw;
    overflow: hidden;
  }
</style>
