<template lang="html">
  <transition name="showTips">
    <div class="tips">
      {{tips}}
    </div>
  </transition>
</template>

<script>
import {Bus} from "../bus.js";
export default {
  data(){
    return{
      tips:""
    }
  }
}
</script>

<style lang="css">
  .tips{
    height: 40px;
    width: 90vw;
    margin: auto;
    position: absolute;
    border-radius: 0 0 10px 10px;
    left: 5vw;
    top: 0;
    z-index: 999;
    background: rgba(119,136,153, 1);
    text-align: center;
    line-height: 40px;
    color: white;
  }
  .showTips-enter{
    top:-40px;
  }
  .showTips-enter-to{
    top:0;
  }
  .showTips-enter-active{
    transition: all .5s ease-in-out
  }

  .showTips-leave{
    top:0;
  }
  .showTips-leave-to{
    top:-40px;
  }
  .showTips-leave-active{
    transition: all .5s ease-in-out
  }
</style>
