<template>
    <div class="row">
	<div class="col-12">
	 <router-link to="/" class="btn btn-dark pull-left">Back</router-link>
	</div>
        <div class="  col-lg-9 col-md-9 col-sm-12 col-12 mx-auto">
       
        
       <div class="card">
	   <br/>
		  <img class="img-thumbnail img-fulid mx-auto" :src="film.photo_url"  :alt="film.name">
		  <div class="card-body">
			<h5 class="card-title text-center">{{film.name}}</h5>
			<p class="card-text">{{film.descripion}}</p>
		  </div>
		  <ul class="list-group list-group-flush">
			<li class="list-group-item">Release Date <span class="float-right">{{film.release_date}}</span></li>
			<li class="list-group-item">Rating <span class="float-right"><star-rating v-model="film.rating" name="rating" ></star-rating></span></li>
			<li class="list-group-item">Genre <span class="float-right">{{film.genre}}</span></li>
			<li class="list-group-item">Country <span class="float-right">{{film.country}}</span></li>
			<li class="list-group-item">Ticket Price<h4 class="float-right">${{film.ticket_price}}</h4></li>
		  </ul>
		  
		</div>
		
		<br/>
			<div class="card card-default">
            <div class="card-heading text-center">
			
			<br/><h3>Comments ({{commentsData.length}})</h3></div>
            <div class="card-body col-lg-12 mx-auto">
		   <!-- From -->
		   
		       <form class="form" name="form">
					 <div class="form-group row">
		               <input class="form-control" name="name" placeholder="Name" type="text" v-model="comment.name" >
						<small class="col-md-offset-4 error-br text-danger" v-text="errors.get('name')"></small>
		           </div>
		           <div class="form-group row">
		               <textarea class="form-control" placeholder="Write comment..." required v-model="comment.comments"></textarea>
		               
						<small class="col-md-offset-4 error-br text-danger" v-text="errors.get('comments')"></small>
		           </div>
		          
		           <div class="form-group row">
		               <input type="button" class="btn btn-success" @click="saveComment" value="Add Comment">
		           </div>
		       </form>
		   </div>
		   <!-- Comments List -->
		   <div class="comments" v-if="comments" v-for="(comment,index) in commentsData">
		       <!-- Comment -->
		       <div class="card">
		           <!-- Comment Box -->
		           <div class="card-body">
		               <div class="card-title">{{comment.comments}}</div>
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

            </div>
        </div>
    </div>
	
</template>

<script>

class Errors {
	constructor() {
		this.errors = {};
	}
	get(field) {
		if(this.errors[field]) {
			return this.errors[field][0];
		}
	}
	record(errors) {
		this.errors = errors;
	}
}
 
    export default {
        mounted() {
            let app = this;
            let slug = app.$route.params.slug;
            app.slug = slug;
            axios.get('api/film/' + slug)
                .then(function (resp) {
                    app.film = resp.data;
					app.fetchComments();
					})
                .catch(function () {
                    alert("Could not load film")
                });
				
        },
		
        data: function () {
            return {
                slug: null,
                film: {
                    name: '',
                    descripion: '',
					release_date: '',
                    rating: 0,
					genre: [],
					ticket_price: '',
					country: '',
					photo: ''
                },
				commentsData: {
					name: '',
					comments: '',
					created_at: '',
					user_id:'',
				},
				comment: {
					name: '',
					comments: '',
				},
				errors: new Errors(),
				comments: false
            }
        },
		
        methods: {
            saveComment() {
				 event.preventDefault();
                var app = this;
				
                var newComment = app.comment;
				
				var data = new FormData();
				data.append('comments', app.comment.comments);
				data.append('name', app.comment.name);
				data.append('user_id', 1);
				
				//alert(app.film.id);
                axios.post('api/comments/'+app.film.id, data)
                    .then(function (resp) {
						 app.commentsData.push(resp.data);
						 app.comment.name = '';
						 app.comment.comments = '';
                    })
                    .catch(function (error) {
                       // console.log(error.response.data);
						if (error.response.status = 422) {
							app.errors.record(error.response.data.errors);
						}
                       //alert("Could post comment");
                    });
					
			
	       },
			fetchComments() {
				//alert(this.film.id);
				axios.get('api/comments/'+this.film.id).then(resp => {
	               this.commentsData = resp.data;
					this.comments = true;
	           }); 
			}
			
        }
    }
</script>
