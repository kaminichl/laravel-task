@extends('frontend.layout')
{{-- Content --}}
@section('content')

<router-view :debug="debug" :films="films" :pagination="pagination" :busy="busy" :detailactive="detailactive"></router-view>

<script type="text/x-template" id="film-template">
<div class="overlay-photo overlay-edit" v-if="addScreen">
			<div class="container">
				
					
					{{ Form::open(['route' => 'api.frontend.film.create', '@submit.prevent'=>'createFilm','style' => 'display:inline', 'class'=>'form-horizontal', 'role' => 'form', 'method' => 'post']) }}
						<div class="well">
						<div class="row row-centered">
						<h3 class="text-center"><span>Enter Film details</span>
						<div class="pull-right">
						<button type="button"  class="btn btn-md btn-danger" @click="addScreen=false">&times;</button>
						</div>
						</h3><hr>
						<div class="form-group">
							<label class="col-md-4 control-label text-left">Film name</label>
							<div class="col-md-6 clearfix">
								<input class="form-control" type="text" id="name" name="name" value="" placeholder=">Film name"/>
							</div>
							<small v-if="errors.name!=''" class="col-md-offset-4 error-br text-danger"><i class="flaticon-warning" aria-hidden="true"></i> @{{errors.name}}</small>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label text-left">Film Description</label>
							<div class="col-md-6 clearfix">
							<textarea class="form-control" rows="5" id="description" name="description" placeholder="Description"></textarea>
							</div>
								<small v-if="errors.description!=''" class="col-md-offset-4 error-br text-danger"><i class="flaticon-warning" aria-hidden="true"></i> @{{errors.description}}</small>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label text-left">Release Date</label>
							<div class="col-md-6 clearfix">
							<div class="input-group date">
									<input type="text" name="release_date" id="release_date"  placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"  data-provide="datepicker" class=" form-control">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-th"></span>
								</div>
							</div>
							</div>
							<small v-if="errors.release_date!=''" class="col-md-offset-4 error-br text-danger"><i class="flaticon-warning" aria-hidden="true"></i> @{{errors.release_date}}</small>
						</div>
						
						<div class="form-group">
							<div data-rateyo-read-only="false" class="rateYo" ></div>
							<small v-if="errors.rating!=''" class="col-md-offset-4 error-br text-danger"><i class="flaticon-warning" aria-hidden="true"></i> @{{errors.rating}}</small>
						</div>	
						
						<div class="form-group">
							<label class="col-md-4 control-label text-left">Ticket Price</label>
							<div class="col-md-6 clearfix">
								<input class="form-control" type="text" id="ticket_price" name="ticket_price" value="" placeholder="Ticket Price"/>
							</div>
							<small v-if="errors.ticket_price!=''" class="col-md-offset-4 error-br text-danger"><i class="flaticon-warning" aria-hidden="true"></i> @{{errors.ticket_price}}</small>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label text-left">Country</label>
							<div class="col-md-6 clearfix">
								<input class="form-control" type="text" id="name" name="name" value="" placeholder=">Film name"/>
							</div>
							<small v-if="errors.name!=''" class="col-md-offset-4 error-br text-danger"><i class="flaticon-warning" aria-hidden="true"></i> @{{errors.name}}</small>
						</div>
						<div class="form-group">
						<label class="col-md-4 control-label text-left">Genre</label>
							<div class="col-md-6 clearfix">
								<?php $genreArray = ['Comedy','Thriller','Romance','Drama','Animation','Horror','Advemture','Crime','Action','Fiction','Documentary','Romantic Comedy'];?>
								<select id="genre" name="genre" class="form-control selectWidth">
								<option value="" class="">Select</option>
								@foreach($genreArray as $genre)
									<option value="{{$genre}}" class="">{{$genre}}</option>
								@endforeach
								</select>
							</div>
							<small v-if="errors.genre!=''" class="col-md-offset-4 error-br text-danger"><i class="flaticon-warning" aria-hidden="true"></i> @{{errors.genre}}</small>
						</div>
						
						<div class="form-group">
						<label class="col-md-4 control-label text-left" for="photo">Upload Photo</label>
							<div class="col-md-6 clearfix ">
								<input type="file" class="form-control-file" id="photo" name="photo">
							</div>
							<small v-if="errors.genre!=''" class="col-md-offset-4 error-br text-danger"><i class="flaticon-warning" aria-hidden="true"></i> @{{errors.genre}}</small>
						</div>
						
					
						
						<div class="col-lg-12 text-center ">
							<button type="submit" class="btn btn-primary btn-md " id="submit" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Adding">Submit</button>
							<div class="btn btn-danger btn-md" @click="addScreen=false">Cancel</div>
						</div>
						</div>
						</div>
					{{ Form::close() }}
				
				
				</div>
		</div>
		
<div class="container">
	<nav class="navbar navbar-default navbar-info selectedBox" v-show="photoChecked.length">
		<div class="container-fluid">
			<ul class="nav navbar-nav navbar-left photo-actions list-inline">
				<li><a @click="deselect('photoChecked')"><i class="fa fa-times"></i></a></li>
				<li><a>@{{photoChecked.length}} selected</a></li>
				<li class="pull-right visible-xs-block action" v-if="photoChecked.length==1">
					<div class="dropdown" style="padding-top:15px;">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-share margin-r-5"></i> <b>Share</b> </a>
					<ul class="dropdown-menu social-dropdown-menu bg-grey">
        				<li class="link-black">
							 <social-shares inline-template :url.sync="'<?php echo URL::to('picture/');?>/'+photoChecked[0]">
								<facebook>
									<i class="fa fa-facebook"></i>
								</facebook>
								<twitter>
									<i class="fa fa-twitter"></i>
								</twitter>
								<whatsapp>
									<i class="fa fa-whatsapp"></i>
								</whatsapp>
							</social-shares>
						</li>
					</ul>
					</div>
					</li>
				<li class="pull-right visible-xs-block"><a @click="showModalAlbum()"> <i class="fa fa-plus"></i></a></li>
				<li class="pull-right visible-xs-block"><a @click="destroy()"> <i class="fa fa-trash"></i></a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right photo-actions list-inline hidden-xs">
			<li class="action" v-if="photoChecked.length==1">
					<div class="dropdown" style="padding-top:15px;">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-share margin-r-5"></i> <b>Share</b> </a>
					<ul class="dropdown-menu social-dropdown-menu bg-grey">
        				<li class="link-black">
							 <social-shares inline-template :url.sync="'<?php echo URL::to('picture/');?>/'+photoChecked[0]">
								<facebook>
									<i class="fa fa-facebook"></i>
								</facebook>
								<twitter>
									<i class="fa fa-twitter"></i>
								</twitter>
								<whatsapp>
									<i class="fa fa-whatsapp"></i>
								</whatsapp>
							</social-shares>
						</li>
					</ul>
					</div>
					</li>
				<li class="pull-right action"><a @click="showModalAlbum()"> <i class="fa fa-plus"></i> Add to Album</a></li>
				<li class="pull-right action"><a @click="destroy()"> <i class="fa fa-trash"></i> Delete</a></li>
			</ul>
		</div>
	</nav>
	<div id="photosDiv">
	<div class="row">
		<div class="col-lg-12">
			<h3><i class="fa fa-picture-o"></i> Pictures <small>(@{{pagination.total}})</small></h3>
			<hr>		
		</div>
	</div>
		<div class="row row-centered">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 thumb">
				<div class="doodler-photo">
					<div class="overlay" v-show="photobusy"></div>
					<div class="doodler-shot">
						<div class="doodler-img">
						
						</div>
					</div>
				</div>
			</div>
			<div v-for="img in previewimageSrc" class="col-lg-3 col-md-4 col-sm-4 col-xs-6 thumb">
				<div class="doodler-photo">
					<div v-if="img.error != 'false'">
						<div class="overlay">
							<div class="help-block-photo">
								<small>@{{ img.error }}</small>
								<button v-on:click="remove(img.id)" class="btn btn-sm btn-danger">Ok</button>
							</div>
						</div>
					</div>
					<div v-else>
						<div class="overlay">
							<div class="loadicon la-ball-fall">
							  <div></div>
							  <div></div>
							  <div></div>
							</div>
						</div>
					</div>
					<div class="doodler-shot">
						<div class="doodler-img">
							<img :src="img.image" class="img-responsive  center-block">
						</div>
					</div>
				</div>
			</div>	
		</div>
		<div class="row row-centered">
			<div v-show="pagination.first" class="overlay">
				<i class="fa fa-spinner fa-spin"></i>
			</div>
			<div v-for="(month,monthPhotos) in organizedPhotos" :id="'photo_'+photo.photokey" class="">
				<div class="clearfix"></div>
			<div class="col-lg-12 text-left ">
				<h4 class="btn btn-md btn-grey"><i class="fa fa-calendar" aria-hidden="true"></i> @{{month}}</h4>
				<hr>
			</div>
				<div v-for="photo in monthPhotos" track-by="photokey" class="col-lg-3 col-md-4 col-sm-4 col-xs-6 thumb">
					
					<div class="doodler-photo">
					<div v-if="photo.is_contest=='0'" class="checkbox checkbox-success checkbox-circle checkbox-photo">
						<input :id="'check_'+photo.photokey"  :value="photo.photokey" type="checkbox" v-model="photoChecked" >
						<label class="album-checkbox-label" :for="'check_'+photo.photokey">
							<div class="label_mini photo-title">
								 @{{photo.title}}
							</div>
						</label>
						<span @click="editPhototitle(photo)" class="action pull-right edit_icon" v-if="photo.is_contest=='0'">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</span>
					</div>
					<div class="checkbox-photo" v-else >
					<label class="album-checkbox-label">
						<div class="label_mini photo-title">
								@{{photo.title}}
							</div>
					</label>
					</div>
						<!--<div class="checkbox checkbox-success checkbox-circle photo-checkbox" v-if="!photo.is_contest">
						<input class="checkbox_select" :id="'check_'+photo.photokey"  :value="photo.photokey" type="checkbox" v-model="photoChecked" >
						<label :for="'check_'+photo.photokey">
						</label>
						</div>-->
						<div class="overlay overlay-select" v-if="photoChecked.length > 0" v-on:click="((photoChecked.length > 0) ? selectCheckbox('check_'+photo.photokey,photo.photokey): null)"></div>
						
						 
						
						<!--<div class="overlay" v-if="photoChecked.indexOf(photo.photokey) !== -1">
						</div>-->
						

						<div class="doodler-shot" id="photoselect_@{{photo.photokey}}" >
							<div class="doodler-img">
							<!--<a class="action" :id="photo.photokey" @click="showDetail(photo.photokey)">-->
							<a class="doodler-img-bg" style="background-image: url('@{{photo.thumbnail}}')" class="action" :id="photo.photokey" v-link="{ name: 'picture.show', params: { picturekey: photo.photokey }}">
							<div v-if="photo.is_contest=='1'" class="ribbon base"><span><strong>Contest picture</strong></span></div>
							</a>
							</div>

							<ul class="list-inline tools">
								<li>
									<i class="fa fa-heart"></i>
									<a href="#"> @{{photo.likes_count}}</a>
								</li>
								<li class="cmnt"><i class="fa fa-comment"></i> <span original-title="">@{{photo.comments_count}}</span></li>
								<li class="views"><i class="fa fa-eye"></i> <span>@{{photo.views_count}}</span></li>
							</ul>
						</div>
						
					</div>
					<!--<div class="pull-right">
					<a v-link="{ name: 'picture.show', params: { picturekey: photo.photokey }}" data-toggle="tooltip" title="Detailed view" class="btn btn-default btn-md border-top-no grey-text">
					<i class="fa fa-link" aria-hidden="true"></i></a>
					<a  href="#" data-toggle="tooltip" title="Zoom"  class="btn btn-default btn-md border-top-no grey-text">
					<i class="fa fa-search-plus" aria-hidden="true"></i></a>
					</div>-->
				</div>
			</div>

		</div>
	</div>
	<nav>
		<div class="text-center">
			<ul class="pagination">
				<li v-show="pagination.next" class="next">
					<span class="btn btn-grey btn-md" @click="paginate('next'), pagination.triggred = true;" class="page-scroll">
						<div class="overlay" v-show="busy">
							<i class="fa fa-spinner fa-spin"></i>
						</div>
						Load more pictures
					</span>
				</li>
			</ul>
		</div>	
	</nav>
	
	

	<modal :list="albums" v-show="showModal" @close="showModal = false" :busy="busy" v-on:add="addtoAlbum" v-on:createalbum="submitAlbum">
	</modal>
	
	<div class="overlay-photo animated" v-if="slideactive" >
			<button type="button" class="close overlay_close" @click="destroyOverlay" aria-label="Close">
				<span aria-hidden="true">
				{{ Html::image('img/close.png', '&times;') }}
				</span>
			</button>
		<div class="overlay-photo-content">
			<div class="row">  
				<div class="col-lg-6" style="float:none; display: block;position: relative; margin-left: auto; margin-right:auto">
					<div class="panel panel-primary box box-default" style="background: transparent;">
						<div class="loading-overlay" v-show="busy" class="blue-text">
							<i class="fa fa-spinner fa-spin"></i>
						</div>
						<div class="panel-body box-body">
							<div class="text-center">
								<img :src="photoDetail.large" class="img-responsive center-block">
							</div>
						</div>
					</div>
				</div>
			</div>
			<a class="left carousel-control" role="button" @click="showDetail(previousItem)" v-if="(previousItem != null)">
				<!--<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>-->
				{{ Html::image('img/prev.png', 'Previous',['class' => 'icon-prev']) }}
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" role="button" @click="showDetail(nextItem)" v-if="(nextItem != null && !(busy))">
				<!--<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>-->
				{{ Html::image('img/next.png', 'Previous',['class' => 'icon-next']) }}
				<span class="sr-only">Next</span>
			</a>
		</div>

		</div>
</div>
</script>

<script type="text/x-template" id="photo-detail-view-template">
<modal :list="albums" v-show="showModal" @close="showModal = false" :busy="busy" v-on:add="addtoAlbum" v-on:createalbum="submitAlbum">
	</modal>
		
<div class="overlay" v-show="busy"><i class="fa fa-spinner fa-spin"></i></div>
<div v-if="error.show">
<h1> @{{error.msg}} </h1>
</div>
	<div v-else >
	<div class="overlay" v-show="busy">
		<i class="fa fa-spinner fa-spin"></i>
	</div>
	<div v-if="error.show">
	<!--<h1> @{{error.msg}} </h1>-->
	</div>
	<div :id="'div_'+photodetail.photokey"  v-else>

	<div class="photos-container">
	<div class="col-xs-2 col-sm-1">
	<a class="pull-left white-text back btn  btn-xs btn-circle" v-link="{ name: 'picture.index'}">
		<i class="fa fa-arrow-left" aria-hidden="true"></i>
		</a>
	</div>	
	
	
	<div class="container">
		<div class="col-xs-10 col-sm-11">	
			<a title="Preview this picture" class="white-text btn action-btn" :href="photodetail.url" target="_blank">
				<i class="fa fa-eye"></i><span>Preview</span>
			</a>
			<div class="dropdown" style="display:inline">
				<a href="#" class="white-text btn action-btn"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-share margin-r-5"></i> <span>Share</span> </a>
				<ul class="dropdown-menu social-dropdown-menu">
					<li>
						 <social-shares inline-template :url.sync="photodetail.url">
							<facebook>
								<i class="fa fa-facebook"></i>
							</facebook>
							<twitter>
								<i class="fa fa-twitter"></i>
							</twitter>
							<whatsapp>
								<i class="fa fa-whatsapp"></i>
							</whatsapp>
						</social-shares>
					</li>
				</ul>
			</div>
			<button v-if="photodetail.is_contest!=1"  @click="showModalAlbum()" type="button" class="white-text btn  btn-primary action-btn">
				<i class="fa fa-plus"></i> <span>Add to Album</span> 
			</button>
			<button v-else type="button" class="white-text btn action-btn btn-primary">
				<i class="fa fa-info"></i> <span>Contest picture </span>
			</button>
		</div>
	</div>
	<div class="row album_photo_container" > 
		
		<div class="col-lg-12">
				<div class="text-center">
					<img :src="photodetail.medium" class="img-responsive box-detail-img center-block album_image">
				</div>
				
				
	<a class="left carousel-control control-page" role="button"  v-link="{ name: 'picture.show', params: { picturekey: previous }}" v-if="(previous != null)">
				<!--<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>-->
				{{ Html::image('img/prev.png', 'Previous',['class' => 'icon-prev']) }}
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control control-page
			" role="button" v-link="{ name: 'picture.show', params: { picturekey: next }}" v-if="(next != null)">
				<!--<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>-->
				{{ Html::image('img/next.png', 'Previous',['class' => 'icon-next']) }}
				<span class="sr-only">Next</span>
			</a>
		</div>
			</div>
			<div class="container">
			  <div class="row album_thumb_row">
				<div class="col-md-12">
					<div class="album_thumb_slider">
						<div :class="(photodetail.photokey == photo.photokey) ? 'slide_photo active': 'slide_photo'" v-for="photo in photos">
							<a :id="photo.photokey" class="album_preview_thumb" style="background-image: url('@{{photo.thumbnail}}')" role="button" v-link="{ name: 'picture.show', params: { picturekey: photo.photokey }}">
							</a>
						</div>
					</div>
				</div>
			  </div>
			</div>	
		</div>
		<div class="container">
		<div class="page-header">
	
	<div class="row">  
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		
		<div class="user-block">
						
                  
                        <span class="username alone">
						
                         @{{photodetail.title}}
                         
                        </span>
                    <span class="description alone"> by <a href="#">you</a>
					on @{{photodetail.month}}
					</span>
                  </div>
		
			
		</div>
	


	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	
			<ul class="list-inline center-block-xs display-btn">
				<li>
					<a href="#" class="link-black">
					@{{photodetail.views_count}}<span>Views</span>
					</a>
				</li>
				<li>
					<a href="#" class="link-black">
					@{{photodetail.likes_count}}<span>Likes</span>
					</a>
				</li>
				<li>
					<a :href="'#comments_'+photodetail.photokey" class="link-black">
				  @{{photodetail.comments_count}}<span>Comments</span>
					</a>
				</li>
            </ul>
    
	</div>
	</div>
	</div>	
		<div class="row" :id="'comments_'+photodetail.photokey">
		<div class="col-lg-6">
			
		</div>
		</div>	
		</div>	
</div>
</script>


<script type="text/x-template" id="modal-template">
	<div class="modal fade" role="dialog">
		<div class="modal-dialog modal-action modal-sm">
			<!-- Modal content--> 
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add to Album</h4>
				</div>
				<div class="modal-body modal-body-action">
					<ul class="list-group">
						<li class="list-group-item action no-border blue-text" v-on:click="createalbum"><i class="fa fa-folder"></i> New album</li>
						<li class="list-group-item action no-border" v-for="album in list" v-on:click="add(album.albumkey)">
							<span v-if="album.coverphoto[0]">
								<img :src="album.coverphoto[0].thumbnail" width="40"/>
							</span>
							<span v-else>
							<i class="fa fa-folder"></i> 
							</span>
							@{{album.title}}
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</script>
@endsection

{{-- Scripts --}}
@section('after-scripts-end')
<script>
	var commonMethods = {
	  created: function () {
	  },
	  methods: {
		selectCheckbox: function (id,targetId) {
			//$('#photoselect_'+targetId).toggleClass('active');
			$("input[id="+id+"]").click();
		},
		deselect: function(value) {
			this[value] = [];
		},
	  }
	}

	var App = Vue.extend({
		data: function() {
			return {
				debug:{},
				films: [],
				busy: false,
				slideactive: false,
				pagination: {
					first: false,
					page: 1,
					total:0,
					triggred: true,
					previous: false,
					next: false,
					offset: 0
				},
			};
		},
		created: function () {
			var self = this;
			this.pagination.first = true;
			this.getFilms();
			
		},
		ready: function() {
			var vm = this;
			$(window).scroll(function() {
			if($(window).scrollTop() + $(window).height() >= $(document).height()) {
				if(vm.busy === false && vm.pagination.next!= null && vm.pagination.triggred===true && vm.pagination.first===false && vm.detailactive===false) {
					vm.paginate('next');
				}
			}
		});
		},
		methods: { 
			
			
			 paginate: function(direction,from) {
				if (direction === 'previous') {
					--this.pagination.page;
				}
				else if (direction === 'next') {
					++this.pagination.page;
				}
				this.getPhotos(this.pagination.page,this.pagination.offset);
			},
			getFilms: function(page,offset){
				this.busy = true;
				var self = this;
				
				this.$http.get('films',{page: this.pagination.page,offset:this.pagination.offset}, function (data, status, request) {
				var response = data;
					var length = response.data.length;
						for( k=0; k<response.data.length; k++) {
							var newelement = response.data[k];
								//alert(vm.detailactive);
							if(k==0 && self.detailactive==true) {
								self.$broadcast('overlayupdated',response.data[k].photokey );
							}
							self.$dispatch('films.created', newelement);
							self.pagination.offset++;
						}
						self.busy = false;
						self.pagination.first = false;
						self.pagination.previous = response.prev_page_url;
						self.pagination.next = response.next_page_url;
						self.pagination.total =response.total;
				  }).error(function(data, status, request) {
						console.log("Error:" + JSON.stringify(data));
						vm.busy = false;
						vm.pagination.first = false;
				});
				
			},
			
			
		},
		events: {
			'photos.created': function (photo) {
				this.photos.push(photo);
				this.urls.push(photo.url);
			},
			
			'paginate.next':function() {
				this.paginate('next');
			},
			'slide.active':function(value) {
				this.slideactive = value;
			},
			
			
		   
		}
	});

	var modal = Vue.extend({
		template: '#modal-template',
		props: ['list'],
		methods: {
			createalbum: function(){
				this.$emit('createalbum');
			},
			add: function(albumid){
				this.$emit('add',albumid);
			}
		}
	});
	
	
var filmActions = Vue.extend({
template: '#album-template',
mixins: [commonMethods],
props: {
            albums: {
                sync: true
            },
			albumdetail: {
                sync: true
            },
			photos: {
				sync: true,
			},
			pagination: {
				sync: true
			},
			photospagination: {
				sync: true
			},
			busy: {
				sync: true
			}
        },
data: function() {
    return{
		albumChecked: [],
		showModal: false,
		modalbusy: false,
		albumList:[],
        addScreen: false,
		errors:{
				active: false,
				title:[],
				date:[],
				description:[],
				tags:[],
			},
		}
    },
	watch: {
   
	albumChecked: function (value) {
	  $('.doodler-shot').removeClass('active');
	_.forEach(value, function(val) {
		$('#albumselect_'+val).addClass('active');
	});

    }
	},
	 computed: {
    // a computed getter
    organizedAlbum: function () {
      var result = {};
        for (var i = 0; i < this.albums.length; i++) {
            var task = this.albums[i];
            var month = task.month;
            if (result[month]) {
                result[month].push(task);
            } else {
                result[month] = [task];
            }
        }
        return result;
    }
  },
	ready: function() {
		
		$('.datepicker').datepicker({
			format: 'mm/dd/yyyy'
		});
    },
    methods: {
		paginate: function(){
			this.$dispatch('paginate.next');
		},
		dothisaction: function() {
			this.addScreen=true;
			this.$nextTick(function () {
			
		$('#tags').tagsinput({
			  freeInput: true,
			  trimValue: true,
			  maxChars: 20,
			  maxTags: 5,
			  typeaheadjs: {
				name: 'tags',
				displayKey: 'text',
				valueKey: 'text',
				source: tags.ttAdapter()
			  }
			});
			});
		},
		removeAlbum : function(albumkey) {
			var index = _.findIndex(this.albums, function(album) { 
						return album.albumkey == albumkey; 
					});
					if(index != -1) {
						this.albums.splice(index,1);
						this.pagination.offset--;
						this.pagination.total--;
					}
		},
		deleteAlbums: function() {
			var self = this;
			var id = this.albumChecked;
			swal({
			  title: "Delete album ?",
			  text: "Album once deleted, cannot be restored !",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Delete!",
			  closeOnConfirm: false,
			  showLoaderOnConfirm: true,              
			},
			function(){
				self.$http.post('album/bulkdelete', {album_id: self.albumChecked}).then(function(response) {
				response = response.data;
				if(response.success == true) {
					// swal("Deleted!", response.message, "success");
					 swal.close();
					 toastr.success(response.message);
					 var length = response.albumIds.length;
					 for(var j = 0; j<length; j++) {
					  self.removeAlbum(response.albumIds[j]);
					 }
					 self.albumChecked = [];
					 } else {
					 swal("Sorry!", response.data, "error");
					 }

				  }, function(response) {
					swal("Sorry!",response.data,"error");
				  });
			   
			});
		},
		createAlbum: function() {
				this.errors.active = false;
				this.errors.title =[];
				this.errors.date =[];
				this.errors.description =[];
				this.errors.tags =[];
				
				var title = $('#title').val();
				var date = $('#date').val();
				var description = $('#description').val();
				//var tagsValue = $('#tags').val();
				if(title == '') {
					this.errors.title = 'Please enter the title';
				}
				if(date == '') {
					this.errors.date = 'Please select the date';
				}
				
				if(title != '' && date!='') {
					$('#submit').button('loading');
					var self = this;
					self.$http.post('album/create', {title: title,date:date,description:description,type:1}).then(function(response) {
					response = response.data;
					self.addScreen = false;
					if(response.success == true) {
						self.$dispatch('album.created',response.album);
						$('#submit').button('reset');
						toastr.success(response.message);
						self.$route.router.go('/achievement/'+response.album.albumkey+'/edit');
					}
					  }, function(response) {
						$('#submit').button('reset');
						var errors = response.data;
						self.errors.active=true;
						if (typeof errors.title !== 'undefined') { 
							self.errors.title =errors.title[0];
						}
						if (typeof errors.date !== 'undefined') { 
							self.errors.date= errors.date[0];
						}
						if (typeof errors.description !== 'undefined') { 
							self.errors.description= errors.description[0];
						}
						if (typeof errors.tags !== 'undefined') { 
							self.errors.tags= errors.tags[0];
						}
						
						//swal("Sorry!",'error occured',"error");
						// error callback
					  });
				}   
				
		}
		
		
    }
});
	
	
	var films = Vue.extend({
	template: '#films-template',
	mixins: [commonMethods],
	components: {
	'modal': modal
	},
	props: {
				
				films: {
					sync: true
				},
				pagination: {
					sync: true,
				},
				busy: {
					sync: true,
				},
				detailactive: {
					sync: true
				},
				
			},
	data: function() {
		return{
			filmDetail: [],
			nextItem: null,
			previousItem: null,
			showModal: false,
			photobusy: false,
		}	
		},
		
		events: {
		'slideupdated': function (photokey) {
			this.nextItem = photokey;
		},
	},
	
		ready: function() {
			
			
		},
		methods: {
		paginate: function(){
			this.$dispatch('paginate.next');
		},
		triggerpaginate: function(){
			this.$dispatch('paginate.next');
		},
		showDetail: function(slug) {
			var vm = this;
			this.filmDetail = _.find(this.films, function (film) {
				return film.slug == slug;
			});
			if (typeof this.filmDetail != 'undefined') {
				this.$dispatch('slide.active',true);
				var totalLength = this.films.length -1;
				var currentIndex = this.films.indexOf(this.filmDetail);
				
				if(currentIndex!=0) {
					var previousIndex = currentIndex-1;
					this.previousItem = this.films[previousIndex].slug;
				} else {
					this.previousItem = null;
				}
				if(currentIndex == totalLength) {
					if(this.pagination.next) {
						this.triggerpaginate();
					} else {
						this.nextItem = null;
					}
				} else {
					this.nextItem = this.films[currentIndex+1].slug;
				}
			} else {
				this.$route.router.go('/films');
			}			
		},
		destroyOverlay: function() {
			$(document.body).removeClass('noscroll');
			this.$dispatch('slide.active',false);
			this.photoDetail=[];
			//this.$route.router.go('/picture');
		},
		
			createAlbum: function() {
				this.errors.active = false;
				this.errors.title =[];
				this.errors.date =[];
				this.errors.description =[];
				this.errors.tags =[];
				
				var title = $('#title').val();
				var date = $('#date').val();
				var description = $('#description').val();
				//var tagsValue = $('#tags').val();
				if(title == '') {
					this.errors.title = 'Please enter the title';
				}
				if(date == '') {
					this.errors.date = 'Please select the date';
				}
				
				if(title != '' && date!='') {
					$('#submit').button('loading');
					var self = this;
					self.$http.post('album/create', {title: title,date:date,description:description,type:1}).then(function(response) {
					response = response.data;
					self.addScreen = false;
					if(response.success == true) {
						self.$dispatch('album.created',response.album);
						$('#submit').button('reset');
						toastr.success(response.message);
						self.$route.router.go('/achievement/'+response.album.albumkey+'/edit');
					}
					  }, function(response) {
						$('#submit').button('reset');
						var errors = response.data;
						self.errors.active=true;
						if (typeof errors.name !== 'undefined') { 
							self.errors.name =errors.name[0];
						}
						if (typeof errors.description !== 'undefined') { 
							self.errors.description= errors.description[0];
						}
						if (typeof errors.release_date !== 'undefined') { 
							self.errors.release_date= errors.release_date[0];
						}
						if (typeof errors.rating !== 'undefined') { 
							self.errors.rating= errors.rating[0];
						}
						if (typeof errors.ticket_price !== 'undefined') { 
							self.errors.ticket_price= errors.ticket_price[0];
						}
						if (typeof errors.country !== 'undefined') { 
							self.errors.country= errors.country[0];
						}
						if (typeof errors.genre !== 'undefined') { 
							self.errors.genre= errors.genre[0];
						}
						if (typeof errors.photo !== 'undefined') { 
							self.errors.photo= errors.photo[0];
						}
						
					  });
				}   
				
		},
		
		doUpload: function(formData,counter) {
		//console.log(formData);
		//	this.resource.save(formData, function (data) {
		var url = $('#imageuploadform').attr('action');
		var self = this;
		var formData = formData;
		this.$http.post(url, formData, function (data, status, request) {
			self.remove('image.'+data.tempId);
			self.photos.unshift(data);
			++self.pagination.offset;
			++self.pagination.total;
			//	window.location = '#photosDiv';
		 }).error(function (data, status, request) {
				
				if (typeof data.status != 'undefined') {
					
					formData.forEach(function(key, value) { 
						var matches = value.match(/\[(.*?)\]/);
						if (matches) {
								toastr.error('Error in uploading, Please try again');
								
						}
						
							
						});
					//toastr.error(index+'Error in uploading, Please try again');
										

					
				} else {
					var identity = Object.keys(data)[0];
						//alert(identity);
						for( k=self.previewimageSrc.length-1; k>=0; k--) {
							if( self.previewimageSrc[k].id == identity) 
							{
								//console.log(identity);
								self.previewimageSrc[k].error =data[identity];
								//setTimeout(this.previewimageSrc.splice(k,1), 5000)
								break;
							}
						}
					
				}	
			});
		},
		 createPhotos: function(event) {
			
			event.preventDefault();
				this.createPhoto.image = event.target.files || event.dataTransfer.files;
				var files = this.createPhoto.image;
				//var fileObj = [];
				//console.log(this.previewimageSrc);
				//console.log(this.createPhoto.image);
				
				var formDataArray=[];
				var self = this;
				if(this.createPhoto.image.length <= 10) {
				for(var count = 0; count<this.createPhoto.image.length; count++) {
				var p = count;
				 (function(p) {
					self.createImagePreview(self.createPhoto.image[p],self.uploadCounter);
					//fileObj.push({'counter': self.uploadCounter, 'file':files[p]});
					
					
					var formData = new FormData();
					formData.append('image[' + self.uploadCounter + ']', files[p]);
					formDataArray.push(formData);
					self.uploadCounter++;
					//self.doUpload(formData,p);
					})(p);
				}
				//var formData = new FormData();
				 this.$nextTick(function() {
					_.each(formDataArray, self.doUpload); 
				});
				} else {
					alert('Please select upto 10 pictures at a time');
				}
				
				
				//this.createPhoto.image = null;
		},
		
		
		
		}
	});





var showFlimDetail = Vue.extend({
	template: '#photo-detail-view-template',
	mixins: [commonMethods],
	components: {
	'modal': modal
	},
		props: {
				photos: {
					sync: true
				},
				albums: {
					sync: true
				},
				pagination: {
					sync: true,
				},
				busy: {
					sync: true,
				},
				detailactive: {
					sync: true
				},
				slideactive: {
					sync: true
				}
			},
	data: function() {
		return{
			photodetail: [],
			showcomment: false,
			error:[],
			busy: false,
			next: null,
			previous: null,
			showModal: false,
			slider: null,
		}
	},
	route: {
		data: function() {
			this.showDetail(this.$route.params.picturekey);
			
		}
	},
	/*route: {
		data: function() {
			var self = this;
			this.busy = true;
			this.photodetail = [];
			var pictureId = this.$route.params.picturekey;
			
			this.$http.get('picture/pictureId/'+pictureId, function (data, status, request) {
			self.photodetail = data;
			self.busy = false;
			
			}).error(function (data, status, request) {
			 //console.log("Error:" + JSON.stringify(data));
				self.busy = false;
				self.error.show = true;
				self.error.type = status;
				self.error.msg = request.statusText;
				
			});
		}
	},*/
	created: function () {
			
		},
	ready: function() {
			 this.slider = $('.album_thumb_slider').bxSlider({
				slideWidth: 50,
				minSlides: 4,
				maxSlides: 4,
				slideMargin: 10,
				infiniteLoop: false,
				pager: false,
			  });		
		},	
	watch: {
   
	photos: function () {
		var current = this.slider.getCurrentSlide();
		this.slider.reloadSlider();
		this.slider.goToSlide(current);
	}
	},	
		
		events: {
		'overlayupdated': function (photokey) {
			this.next = photokey;
		},
		},
	
	

	methods: {
		triggerpaginate: function(){
			this.$dispatch('paginate.next');
		},
		showDetail: function(photokey) {
		//console.log(photokey);
		
			var vm = this;
			this.photodetail = _.find(this.photos, function (photo) {
				return photo.photokey == photokey;
			});
			if (typeof this.photodetail != 'undefined') {
				this.$dispatch('detail.active',true);
				
				var totalLength = this.photos.length -1;
				var currentIndex = this.photos.indexOf(this.photodetail);
				
				if(currentIndex!=0) {
					var previousIndex = currentIndex-1;
					this.previous = this.photos[previousIndex].photokey;
				} else {
					this.previous = null;
				}
				if(currentIndex == totalLength) {
					if(this.pagination.next) {
						this.triggerpaginate();
					} else {
						this.next = null;
					}
				} else {
					this.next = this.photos[currentIndex+1].photokey;
				}
				this.$nextTick(function () {
						var current = vm.slider.getCurrentSlide();
						
						var activephotoindex = _.findIndex(vm.photos, function (photo) {
							return photo.photokey == photokey;
						});
						
						if (typeof activephotoindex != 'undefined') {
							var divison = (activephotoindex+1)/4;
							var tobeactive = Math.ceil(divison)-1;
							if(current != tobeactive) {
								vm.slider.goToSlide(tobeactive);
							}
						}
					//vm.showcomments();
					//vm.$broadcast('fb.comments');
				});
			} else {
				this.$route.router.go('/picture');
				//console.log(this.$router); 
				//window.location.href = '/'+this.$router._root+'/picture';
			}			
		},
		showModalAlbum: function() {
				this.showModal = true;
				$(".modal").modal("show");	
			},	
		addtoAlbum: function(albumid) {
				$(".modal").modal("hide");	
				var self = this;
				this.$http.post('album/list', {album_id: albumid,photo_ids: this.photodetail.photokey}).then(function(response) {
				response = response.data;
				if(response.success == true) {
					toastr.success(response.message);
				}
				  }, function(response) {
					swal("Sorry!",'error occured',"error");
					// error callback
				  });
		},
		submitAlbum: function() {
				var self = this;
				swal({
				  title: "Enter album title",
				  //text: "Write something interesting:",
				  type: "input",
				  showCancelButton: true,
				  closeOnConfirm: false,
				  showLoaderOnConfirm: true,
				},
				function(inputValue){
				  if (inputValue === false) return false;
				  
				  if (inputValue === "") {
					swal.showInputError("Please enter album title");
					return false
				  }
					self.$http.post('album/create', {title: inputValue,photo_ids: self.photodetail.photokey}).then(function(response) {
					response = response.data;
					if(response.success == true) {
						swal.close();
						$(".modal").modal("hide");	
						self.$dispatch('album.created',response.album);
						toastr.success(response.message);
					}
					  }, function(response) {
						swal("Sorry!",'error occured',"error");
						// error callback
					  });
				});
				//$.form('api/album/list', { photo_ids: this.photoChecked,_token:  $("meta[name=_token]").attr("content")}, 'POST').submit();
			}
		
	}
});	

	// Router for picture management
	router.map({
		'/films': {
			component: films,
			name: 'films.index',
				
		},
		'film/:slug': {
						component: showFlimDetail,
						name: 'film.show',
		},
		
});

router.start(App, '#js-app');
</script>
@endsection