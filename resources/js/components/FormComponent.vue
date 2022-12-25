<template>
    <form @submit.prevent>
      <div class="input-group">  
        <input type="text" name="message" class="form-control" v-model="newMessage" placeholder="Type your message here...." />
        <div class="input-group-append">
        <button class="btn btn-md btn-primary" v-on:click="savemessage()">SEND</button>
        
        </div>
      </div>  
      <p v-if="error" class="text-danger mt-2">{{ error }}</p>
    </form>    
</template>

<script>
export default {
    props:['user','to_user'],
    data:function(){
        return{
        newMessage:'',
        error:' ',
        }
    },
    methods:{
    savemessage(e){
        if(this.to_user == ''){   // this code would return an error if any logged in user do not select the 'user to chat with' and try to send messge
            this.error = 'Please Select a User';
            e.preventDefault();
        }
        this.$emit('chatmessage',{to_user:this.to_user,from_user:this.user,message:this.newMessage});  // this code will emit to_user,from_user and message to the app component
        this.newMessage = '';
    }
    }
}
</script>

<style>

</style>