<template>
    <div class="card chat-box">
        <p v-for="message in messages" :key="message.id" class="px-2 py-2" :class="{'text-end':(message.to_user === to_user)}"><span class="p-2 bg-primary text-white" :class="{'text-end bg-info text-white':(message.to_user === to_user)}">{{message.message}}</span></p>
    </div>
</template>

<script>
    export default {
        props:["messages","from_user","to_user"],  // these properties will be retrived from the parent component
    }
</script>

<style>
 .chat-box{
    min-height: 400px;
    max-height: 400px;
    overflow-y: scroll;
 }
</style>