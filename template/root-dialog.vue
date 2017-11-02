<template lang="html">
<transition name="showDialog">
    <div class="dialog-mask">
        <form class="root-dialog form-herizontal">
          <h4 class="root-dialog-title">{{title}}</h4>
          <div class="form-group col-xs-12">
          <label class="col-xs-3 label-control" for="added_name">姓名:</label>
          <div class="col-xs-9">
            <input class="form-control" ref="_name" type="text" id="added_name" v-model.lazy="added_info.name" :value="added_info.name">
          </div>
          </div>
          <div class="form-group col-xs-12">
            <label class="col-xs-3 label-control">性别:</label>
            <div class="col-xs-9">
              <input id="male" class="sex"  type="radio" v-model="added_info.sex" name="sex" :value="0">
              <label class="chooseSex" for="male"></label><span class="maleOrFemale">男</span>
              <input id="female" class="sex"  type="radio" v-model="added_info.sex" name="sex" :value="1">
              <label  class="chooseSex" for="female"></label><span class="maleOrFemale">女</span>
            </div>
          </div>
          <div class="form-group col-xs-12">
            <label class="col-xs-3 label-control" for="added_tel">电话:</label>
            <div class="col-xs-9">
              <input class="form-control" type="text" id="added_tel" v-model.lazy="added_info.tel" :value="added_info.tel">
            </div>
          </div>
          <div class="btnBox text-center">
            <button type="button" class="btn btn-success" @click="comfirm">确定</button>
            <button type="button" class="btn btn-warning" @click="cancel">取消</button>
          </div>
          <p class="text-center text-danger">{{errorMsg}}</p>
        </form>
    </div>
</transition>
</template>

<script>
import {Bus} from "../bus.js";
import qs from "qs";
export default {
  data(){
    return{
      errorMsg:"",
      title:"添加新成员",
      added_info:{
        name:"",
        sex:"0",
        tel:""
      }
    }
  },
  methods:{
    comfirm:function(){
        let tel_true = /^1[3|5|7|8][0-9]{9}$/.test(this.added_info.tel);
        let name_true = /^[\u4e00-\u9fa5A-Za-z]+$/.test(this.added_info.name);
        
      if(this.title==="添加新成员"){
        if(this.added_info.name===""||this.added_info.tel===""){
          this.$emit("sendErrorMsg","请将信息填写完整")
        }
        else if(name_true==false){
          this.$emit("sendErrorMsg","姓名填写不规范")
        }
        else if(tel_true==false){
          this.$emit("sendErrorMsg","手机号码不正确")
        }
        else{
            let that = this;
            this.$http.post("./php/addMember.php",qs.stringify({
                user:JSON.stringify(that.added_info)
            })).then(function(data){
                console.log(data.data);
                if(data.data==1){
                    Bus.$emit("peopleData",that.added_info);
                    that.$emit("sendErrorMsg","提交成功!");
                }else{
                    that.$emit("sendErrorMsg","添加失败！");
                }
            });

            this.$emit("toggleToClose");
        }
      }
      else{
        if(this.added_info.name===""||this.added_info.tel===""){
          this.$emit("sendErrorMsg","请将信息填写完整")
        }
        else if(name_true==false){
          this.$emit("sendErrorMsg","姓名填写不规范")
        }
        else if(tel_true==false){
          this.$emit("sendErrorMsg","手机号码不正确")
        }
        else{
          this.$emit("toggleToClose");
        }
      }

    },
    cancel:function(){
      this.$emit("toggleToClose");
    }
  }
}
</script>

<style lang="css" scoped>
  .dialog-mask{
    position: absolute;
    top:0;
    bottom:0;
    left:0;
    right:0;
    background: rgba(0,0,0,.2);
  }
  .root-dialog{
    width: 80vw;
    height: 72vw;
    border-radius: 5px;
    position: absolute;
    left:0;
    right: 0;
    top:0;
    bottom: 0;
    margin: auto;
    background: #FFF;
  }
  .root-dialog-title{
    text-align: center;
    background: crimson;
    margin: 0 0 20px 0;
    height: 40px;
    line-height: 40px;
    border-radius: 5px 5px 0 0;
    color: white;
  }
  .label-control{
    padding: 7px;
  }
  .sex{
    margin: 10px 0 0 35px;
  }
  .btnBox button{
    margin:10px 0 0 40px;
  }
  .form-group{
    margin: 0
  }
  p{
    margin-top: 15px;
  }
  .showDialog-enter{
       top: -300px;
       opacity: 0
   }
   .showDialog-enter-to{
       top: 0;
       opacity: 1
   }
   .showDialog-enter-active{
       transition: all .4s ease-in-out;
   }
   .showDialog-leave{
        top: 0;
        opacity: 1
    }
    .showDialog-leave-to{
        top: -300px;
        opacity: 0
    }
    .showDialog-leave-active{
        transition: all .4s ease-in-out;
    }
    .maleOrFemale{
      display: inline-block;
    }


    input[type="radio"]{
      display: none;
    }
    .chooseSex{
      display: inline-block;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      border: 1px solid #ccc;
      position: relative;
      top: 7px;
      overflow: hidden;
      vertical-align:sub;
      margin-left: 30px;
    }
    .chooseSex:after{
      content: "";
      display: inline-block;
      width: 14px;
      height: 14px;
      background-color: crimson;
      border-radius: 50%;
      position: absolute;
      left: 2px;
      top:2px;
      transform:rotate(-180deg);
      transform-origin: -2px 50%;
      transition: transform .2s ease-in;
    }
    input[type="radio"]:checked + label:after{
      transform: rotate(0deg);
      transition: transform .2s ease-in;
    }



















</style>
