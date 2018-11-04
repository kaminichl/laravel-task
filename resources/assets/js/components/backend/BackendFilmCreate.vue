
<template>
    <div class="row">
	<div class="col-12">
	 <router-link to="/" class="btn btn-dark pull-left">Back</router-link>
	</div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-12 mx-auto">
       
        
        <div class="card card-default">
            <div class="card-heading text-center">
			
			<br/><h3>Create new film</h3></div>
            <div class="card-body col-lg-12 mx-auto">
                <form id="create-film" v-on:submit="saveForm()"  enctype="multipart/form-data">
				<div class="form-group row row">
							<label class="col-md-4">Film name</label>
							<div class="col-md-6 clearfix">
								<input class="form-control" type="text" name="name" v-model="film.name" value="" placeholder="Film name"/>
								<small class="col-md-offset-4 error-br text-danger" v-text="errors.get('name')"></small>
							</div>
							
						</div>
						
						<div class="form-group row">
							<label class="col-md-4 control-label text-left">Film descripion</label>
							<div class="col-md-6 clearfix">
								<textarea class="form-control" name="descripion"  rows="5" v-model="film.descripion" placeholder="descripion"></textarea>
								<small class="col-md-offset-4 error-br text-danger" v-text="errors.get('descripion')"></small>
							</div>
								
						</div>
						
						<div class="form-group row">
							<label class="col-md-4 control-label text-left">Release Date</label>
							<div class="col-md-6 clearfix">
								<div class="input-group date">
								<datepicker class="datepick" format="yyyy-MM-dd" name="release_date"  v-model="film.release_date"></datepicker>
									
									<div class="input-group-addon">
										<span class="fa fa-calendar"></span>
									</div>
								</div>
								<small class="col-md-offset-4 error-br text-danger" v-text="errors.get('release_date')"></small>
							</div>
							
						</div>
						<div class="form-group row">
							<label class="col-md-4 control-label text-left">Rating</label>
							<div class="col-md-6 clearfix">
								<star-rating v-model="film.rating" name="rating" ></star-rating>
								
								<small class="col-md-offset-4 error-br text-danger" v-text="errors.get('rating')"></small>
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-md-4 control-label text-left">Ticket Price</label>
							<div class="col-md-6 clearfix">
								<input class="form-control" name="ticket_price" type="text"  v-model="film.ticket_price"  value="" placeholder="Ticket Price"/>
								<small class="col-md-offset-4 error-br text-danger" v-text="errors.get('ticket_price')"></small>
							</div>
							
							
						</div>
						<div class="form-group row">
							<label class="col-md-4 control-label text-left">Country</label>
							<div class="col-md-6 clearfix">
								
								<multiselect  name="country" v-model="film.country" :options="countries"></multiselect>
								<small class="col-md-offset-4 error-br text-danger" v-text="errors.get('country')"></small>
							</div>
							
							
						</div>
						<div class="form-group row">
						<label class="col-md-4 control-label text-left">Genre</label>
							<div class="col-md-6 clearfix">
								
								
								 <multiselect  name="genre"  :multiple="true" v-model="film.genre" :options="generes"></multiselect>
								
								<small class="col-md-offset-4 error-br text-danger" v-text="errors.get('genre')"></small>
							</div>
							
							
						</div>
						
						
						
					
						<div class="form-group row">
						
							<div class="col-12 text-center ">
								<div>
								<h4>Upload Photo</h4>
								<div v-if="image">
								<img :src="image" class="img-fluid mx-auto"/>
								<button @click="removeImage">Remove</button>
								</div>
								<input id="photo"  name="photo"  type="file" @change="onFileChange"  ref="fileInput">
							  </div>
							  
							  <small class="col-md-offset-4 error-br text-danger" v-text="errors.get('photo')"></small>
							</div>
							
							
						</div>
						
					
                    
                    
                        <div class="col-xs-12 form-group row">
                            <button class="btn btn-success btn-block col-6 mx-auto">Create</button>
                        </div>
                   
                </form>
            </div>
        </div>
    </div>
	</div>
</template>

<script>
 var moment = require('moment')
   
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
           
			$('.datepick').find('input').addClass('form-control').css('width','100%');	
        },
        data: function () {
            return {
                film: {
                    name: '',
                    descripion: '',
					release_date: '',
                    rating: 0,
					genre: [],
					ticket_price: '',
					country: '',
					photo: '',
                },
				image: '',
				errors: new Errors(),
				generes: ['Comedy','Thriller','Romance','Drama','Animation','Horror','Advemture','Crime','Action','Fiction','Documentary','Romantic Comedy'],
				countries: ["Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"] 
            }
        },
		
		
        methods: {
		
			
			 onFileChange(e) {
				  var files = e.target.files || e.dataTransfer.files;
				  
				  if (!files.length)
					return;
				  this.createImage(files[0]);
			},
			createImage(file) {
				  var image = new Image();
				  var reader = new FileReader();
				  var vm = this;

				  reader.onload = (e) => {
					vm.image = e.target.result;
				  };
				  reader.readAsDataURL(file);
			},
			removeImage: function (e) {
				this.image = '';
				event.preventDefault();
			},
            saveForm() {
                event.preventDefault();
                var app = this;
				app.film.release_date = moment(app.film.release_date).format('YYYY-MM-DD');
				
				app.film.photo = app.image;
			
                var newFilm = app.film;
				
				var data = new FormData();
				data.append('name', app.film.name);
				data.append('descripion', app.film.descripion);
				data.append('release_date', app.film.release_date);
				data.append('rating', app.film.rating);
				data.append('genre', app.film.genre);
				data.append('ticket_price', app.film.ticket_price);
				data.append('country', app.film.country);
				
				var file = this.$refs.fileInput.files[0]
				data.append('photo', file)
				console.log(data);
				
                axios.post('api/films', data)
                    .then(function (resp) {
                        app.$router.push({path: '/backend'});
                    })
                    .catch(function (error) {
                       // console.log(error.response.data);
						if (error.response.status = 422) {
							app.errors.record(error.response.data.errors);
							//console.log(app.errors);                             
						}
                       //alert("Could resp create your film");
                    });
            }
        }
    }
</script>
