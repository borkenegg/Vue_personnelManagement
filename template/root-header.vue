<template lang="html">
<div class="root-header">
  <span :class="[{'glyphicon glyphicon-menu-left':headerData.toBack},'col-xs-2','toBack']"></span>
  <span class="col-xs-8 text-center">{{headerData.title}}</span>
  <span class="col-xs-2"></span>
</div>
</template>

<script>
export default {
  data(){
    return{
      headerData:{
        toBack:true,
        title:"人员管理",
        information:false
      }
    }
  }
}
</script>

<style lang="css" scoped>
.root-header{
    height: 60px;
    background: #ccc;
    position: fixed;
    top: 0;
    left: 0;
    right:0;
}
.root-header span{
  height: 60px;
  display: inline-block;
  line-height: 60px;
  padding: 0;
  text-align: center;
}

</style>
