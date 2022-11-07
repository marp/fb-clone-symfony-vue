<template>
  <div>
    <div class="postHeader"><router-link :to="{ name: 'profile', params: { id: author.id }}">{{ author.firstName + ' ' + author.lastName }}</router-link> {{ date }}</div>
    <div class="postContent">{{ content }}</div>
    <div class="postFooter"><button>Reply</button></div>
  </div>
</template>

<script>
export default {
  name: 'post',
  props: [
    'id',
    'author',
    'date',
    'content',
  ]
}
</script>

<style>
div{
  background-color: silver;
  border: 1px solid #1b1b1b;
}
.postHeader{
  border-bottom: 1px solid #1b1b1b;
  color: darkgray;
}
.postContent{
  border-bottom: 1px solid #1b1b1b;
}
</style>