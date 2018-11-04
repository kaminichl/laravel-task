<template>

<div class="comments-app">
   <h1>Comments</h1>
   <!-- From -->
   <div class="comment-form">
       <form class="form" name="form">
           <div class="form-row">
               <textarea class="input" placeholder="Add comment..." required v-model="message"></textarea>
               <span class="input" v-if="errorComment" style="color:red">{{errorComment}}</span>
           </div>
           <div class="form-row">
               <input class="input" placeholder="Email" type="text" disabled >
           </div>
           <div class="form-row">
               <input type="button" class="btn btn-success" @click="saveComment" value="Add Comment">
           </div>
       </form>
   </div>
   <!-- Comments List -->
   <div class="comments" v-if="comments" v-for="(comment,index) in commentsData">
       <!-- Comment -->
       <div v-if="!spamComments[index] || !comment.spam" class="comment">
           <!-- Comment Box -->
           <div class="comment-box">
               <div class="comment-text">{{comment.comment}}</div>
               <div class="comment-footer">
                   <div class="comment-info">
                       <span class="comment-author">
                               <em>{{ comment.name}}</em>
                           </span>
                       <span class="comment-date">{{ comment.created_date}}</span>
                   </div>
               </div>
           </div>
           <!-- From -->
           </div>
	</div>
</div>

</template>

<script>

var _ = require('lodash');

export default {

   props: ['filmId'],

   data() {

       return {
           comments: [],
           comments: 0,
           message: null,
           commentsData: [],
           errorComment: null,
       }

   },

   methods: {
       fetchComments() {
           this.$http.get('comments/' + this.filmId).then(res => {
               this.commentsData = res.data;
               this.comments = 1;

           });   

       },
       saveComment() {
           if (this.message != null && this.message != ' ') {
               this.errorComment = null;
               this.$http.post('comments', {
                   film_id: this.filmId,
                   comment: this.message,
                   users_id: 1
               }).then(res => {
                   if (res.data.status) {
                       this.commentsData.push({ "commentid": res.data.commentId, "name": "Test", "comment": this.message});
                       this.message = null;
                   }
               });
           } else {
               this.errorComment = "Please enter a comment to save";
           }
       },

   },

   mounted() {

      console.log("mounted");

      this.fetchComments();

   }



}

</script>