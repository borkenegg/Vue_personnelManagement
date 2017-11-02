<template lang="html">
<div class="root-list">
<table class="table">
  <thead v-if="peoples.length>0">
    <tr>
      <td class="text-center">姓名</td>
      <td class="text-center">性别</td>
      <td class="text-center">电话</td>
      <td class="text-center">操作</td>
    </tr>
  </thead>
  </table>
    <transition-group name="delete">
      <ul :key="people.tel" class="dataUl" v-for="(people,index) in peoples">
        <li class="text-center">{{people.name}}</li>
        <li class="text-center">{{people.sex|toSex}}</li>
        <li class="text-center">{{people.tel}}</li>
        <li class="text-center">
          <button @click="modify(index)" type="button" class="btn btn-primary btn-xs">修改</button>
          <button @click="del(index)" type="button" class="btn btn-danger btn-xs">删除</button>
        </li>
      </ul>
    </transition-group>

</div>
</template>

<script>
import {Bus} from "../bus.js";
export default {
  data(){
    return{
      peoples:[]
    }
  },

  methods:{
    modify(index){
      this.$emit("modifyMsg",this.peoples[index]);
    },
    del(index){
      let _this =this;
        let del_name = this.peoples[index].name;
        _this.$http.get("./php/delete.php",{
            params:{
                name:del_name
            }
        }).then(function (response) {
            if(response.data==1){
                _this.$emit("delSuccess","删除成功!")
            }
        },function (error) {
            console.log(error);
        });
      this.peoples.splice(index,1);
    }
  },
  created:function(){
    const _this = this;
    Bus.$on("peopleData",function(val){
      _this.peoples.push(val)
    });
      _this.$http.get("./php/getData.php").then(function (response) {
          for(let i=0;i<response.data.user.length;i++){
              _this.peoples.push(response.data.user[i])
          }
      },function (error) {
          console.log(error);
      })
  }
}
</script>

<style lang="css" scoped>
    table{
      margin-bottom: 10px;
    }
    ul{
      height: 30px;
      border-bottom: 1px solid #ccc
    }
    li{
      list-style: none;
      float: left;
      width: 25vw;
    }
    .delete-leave{
         position: relative;
         left: 0;
     }
     .delete-leave-to{
         position: relative;
         left: 100vw;
     }
     .delete-leave-active{
         transition: all .4s ease-in-out;
     }
     .delete-enter{
          position: relative;
          top: 50px;
          opacity: 0
      }
      .delete-enter-to{
          position: relative;
          top: 0;
          opacity: 1
      }
      .delete-enter-active{
          transition: all .4s ease-in-out;
      }
        .dataUl{
            transition: all .5s ease-in-out;
        }
</style>
