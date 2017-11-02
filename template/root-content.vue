<template lang="html">
  <div class="root-content">
    <tips ref="tips"  v-if="showTips"></tips>
    <root-header></root-header>
    <root-list @modifyMsg="getMsg" @delSuccess="delSuccess" ref="rootList"></root-list>
    <root-dialog ref="rootDialog" @sendErrorMsg="getErrorMsg" @toggleToClose="toggle" v-if="toggleVal"></root-dialog>
    <button v-if="!toggleVal" @click="toggle" type="button" name="button" class="btn btn-success btn-block">添加</button>
    <button @click="random" type="button" name="button" class="btn btn-warning btn-block">乱序</button>
    <button @click="onlyMaleOrFemale('male')" type="button" name="button" class="btn btn-primary btn-block">只看男</button>
    <button @click="onlyMaleOrFemale('female')" type="button" name="button" class="btn btn-danger btn-block">只看女</button>
    <button @click="showAll" type="button" name="button" class="btn btn-block">查看全部</button>

  </div>
</template>

<script>
import rootHeader from "./root-header.vue";
import rootList from "./root-list.vue";
import rootDialog from "./root-dialog.vue";
import tips from "./tips.vue";
import {Bus} from "../bus.js";
export default {
  data(){
    return{
      toggleVal:false,
      showTips:false,
      newArr:[]
    }
  },
  components:{
    rootHeader,
    rootList,
    rootDialog,
    tips
  },
  methods:{
    toggle(val){
      this.toggleVal = !this.toggleVal;
    },
    getMsg(val){
      this.toggleVal = !this.toggleVal;
      this.$nextTick(function(){
        this.$refs.rootDialog.added_info = val;
        this.$refs.rootDialog.title = "修改成员信息";
      })
    },
    getErrorMsg(val){
      this.showTips=!this.showTips;
        let _this = this;
        let timer = setTimeout(function(){
        _this.showTips = false;
      },2000);
        this.$nextTick(function(){
          this.$refs.tips.tips = val;
        })
    },
      delSuccess(val){
          this.showTips=!this.showTips;
          let _this = this;
          let timer = setTimeout(function(){
              _this.showTips = false;
          },2000);
          this.$nextTick(function(){
              this.$refs.tips.tips = val;
          })
      },
    random(){
      this.$refs.rootList.peoples.sort(function(){
        return Math.random()>0.5?-1:1;
      })
    },
    onlyMaleOrFemale(sex){
        let peoplesData = this.$refs.rootList.peoples;
        let toFindIndexStr = "";
      for(let i=0;i<this.newArr.length;i++){
        peoplesData.push(this.newArr[i])
      }
      this.newArr=[];
      if(sex==="male"){
        peoplesData.sort(function(a,b){
          return (+a.sex) - (+b.sex)
        });

        peoplesData.forEach(function(v){
          toFindIndexStr+=v.sex
        });
        // toFindIndexStr.indexOf("1")!==-1&&peoplesData.splice(toFindIndexStr.indexOf("1"))
        if(toFindIndexStr.indexOf("1")!==-1){
          this.newArr = peoplesData.splice(toFindIndexStr.indexOf("1"))
        }
      }
      else{
        peoplesData.sort(function(a,b){
          return (+a.sex) - (+b.sex)
        }).reverse();
        peoplesData.forEach(function(v){
          toFindIndexStr+=v.sex
        });
        // toFindIndexStr.indexOf("0")!==-1&&peoplesData.splice(toFindIndexStr.indexOf("0"))
        if(toFindIndexStr.indexOf("0")!==-1){
          this.newArr = peoplesData.splice(toFindIndexStr.indexOf("0"))
        }
      }
    },
    showAll(){
        let peoplesData = this.$refs.rootList.peoples;
        for(let i=0;i<this.newArr.length;i++){
          peoplesData.push(this.newArr[i])
        }
        this.newArr=[];
    }
  }
}
</script>

<style lang="css" scoped>
.root-content{
  padding-top: 60px;
}
</style>
