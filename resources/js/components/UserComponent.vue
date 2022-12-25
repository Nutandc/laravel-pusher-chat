<template>
  <ul class="col-md-4">
    <!-- on click of each li, selectmember method would be called   -->
    <li class="row border border-primary py-2" :class="{active:(user.id === activeId )}" v-for="user in users" :key="user.id" v-on:click="selectmember(user.id)">  
                <div class="col-md-4">
                <!-- if user has not been appeared since last 2 minutes, 'dot' class would present the user as inactive     -->
                <span style="float:left; display:inline;" :class="[user.time_difference > 2 ? 'dot' : 'active-dot']"> </span><span style="float:left; display:inline;"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle img-fluid float-left" style="max-width:65px;"> </span>
                </div>
                <div class="col-md-4 ">
                    <span class="align-middle">{{ user.name }}</span>
                </div>    
                <div class="col-md-4 align-middle">
                    <p class="mb-0">Last seen : </p>
                    <span class="align-middle">{{ user.last_seen }}</span>
                </div>    
    </li>
    
  </ul>   
</template>

<script>
export default {
    mounted(){
        this.get_online_users();
        setInterval(() => { this.get_online_users(); },20000);   // at the interval of 20 seconds, this method will keep getting online users
    },
    methods:{
    selectmember(id) {
         this.activeId = id;
         this.$emit('selectuser',id); // this code would emit the selected user id to the parant component
    },
    get_online_users(){       // this method would be called when the component is mounted and at each 20 seconds there after
        axios.get('/online-users').then(response => {
            this.users = response.data;
            console.log(this.users);
        });
    }
    },
    data:function(){
        return {
            activeId: 0,
            users:[''],
            currenttime:'',
        }
    },
    
}
</script>

<style>
.active{
    background:#ccc;
}
.dot {
  height: 20px;
    width: 20px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
    margin-top: 20px;
    margin-right: 5px;
}
.active-dot{
    height: 20px;
    width: 20px;
    background-color: green;
    border-radius: 50%;
    display: inline-block;
    margin-top: 20px;
    margin-right: 5px;
}
</style>