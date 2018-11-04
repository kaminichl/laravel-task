<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'createFilm'}" class="btn btn-success">Create new film</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><h2 class="text-center">Films list</h2></div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Rating</th>
                       
                        <th width="100">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="film, index in films">
                        <td>
							<router-link :to="{name: 'viewFilm', params: {slug: film.slug}}">
								<img :src="film.photo_url" class="img-fulid" style="max-width:200px"/>
								<br/>
								{{ film.name }}
							</router-link>
						</td>
                        <td>{{ film.descripion }}</td>
                        <td>{{ film.rating }}</td>
                       
                        <td>
							<router-link :to="{name: 'editFilm', params: {slug: film.slug}}" class="text-dark">
                                <i class="fa fa-edit"></i>
                            </router-link>
                            <router-link :to="{name: 'viewFilm', params: {slug: film.slug}}" class="text-info">
                                <i class="fa fa-eye"></i>
                            </router-link>
							<span class="text-danger" @click="DeleteFilm(index,film.id)">
                                <i class="fa fa-trash"></i>
                            </span>
                           
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                films: []
            }
        },
        mounted() {
            var app = this;
            axios.get('api/films')
                .then(function (resp) {
                    app.films = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load films");
                });
        },
        methods: {
            DeleteFilm(index,id) {
				var app = this;
				if (confirm('Are You Sure ?')){
				   axios.delete('api/film/' + id)
                    .then(function (resp) {
                        Vue.delete(app.films, index);
						 
                    })
                    .catch(function (error) {
                       // console.log(error.response.data);
					   
						
                       alert("Could not delete");
                    });
				}
				
				
			
			} 
        }
    }
</script>
