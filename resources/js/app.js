/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: axios } = require('axios');

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('message-component', require('./components/MessageComponent.vue').default);
Vue.component('form-component',require('./components/FormComponent.vue').default);
Vue.component('user-component',require('./components/UserComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data:{
        users: [],
        from_user_id:'',
        to_user_id:'',
        messages:[],
    },
    
    created(){
        axios.get('/users').then(response => {    // this will retrive all users except logged in user and assign it to the users array
             this.users = response.data;  
        });

        axios.get('/get_user').then(response => {
            this.from_user_id = response.data;
        });

        // echo will listen to the ChatMessage event on private chat-channel 
        window.Echo.private('chat-channel')   
		  .listen('ChatMessage', (e) => {
			this.messages.push({
                to_user:e.message.to_user,
                from_user:e.message.from_user,
                message:e.message.message,
            });
		});

    },

    methods:{
        addmessage(message){
            this.messages.push(message);  // this would push the newly typed and emited message (from form-component) into the messages array
            // below axios post would save the message in database
            axios.post('/messages',{msg:message.message,user:message.from_user,to_user:message.to_user}).then(response => {
                console.log(response.data);
            });
        },

        selectcurrentuser(user){
            this.to_user_id = user;   // this will store the emited user (from user-component) into to_user_id
            
            // below would pass the selected user and will retrive messages between selected user and logged in user
            axios.post('/user_messages',{to_user:this.to_user_id}).then(response => {
                this.messages = response.data;
                console.log(response.data);
            });
        }
    }
});
