<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 text-center">
                <h1>ThumbsUp</h1>
                <h3>Tell us how you really feel about movies.</h3>
                <div class="jumbotron">
                    <p v-if="!movies.length">No movies have been added yet! Add one?</p>
                    <p v-else>Don't see what you're looking for? Add a movie to our database!</p>
                    <form class="form-inline justify-content-center" @submit.prevent="create">
                      <label class="sr-only" for="inlineFormInputName2">Name</label>
                      <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Put your movie title here!" v-model="name" required>

                      <button type="submit" class="btn btn-primary mb-2">Add Movie</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card bg-light mb-3 text-left" v-for="movie in movies" :key="movie.id">
                        <div class="card-body">
                            <h5 class="card-title">{{ movie.movie_name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">This movie has a rating of {{ (movie.up_votes - movie.down_votes) }} / {{ movie.up_votes + movie.down_votes }} 
                            </h6>
                                <div class="card-text">
                                    <p>Did you like this movie? Tell us how you feel by clicking the links below.</p>
                                    <p class="text-center">
                                        {{ movie.up_votes }} people said yes <button @click="add(movie.id)" class="btn btn-success btn-sm">Vote Up</button>
                                        {{ movie.down_votes }} people said no <button @click="subtract(movie.id)" class="btn btn-danger btn-sm">Vote Down</button>
                                    </p>
                                </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                movie: {},
                movies: [],
                name: '',
                
            }
        },
        mounted() {
            this.read();
        },
        methods: {
            read(){
                axios.get('api/movies').then(response => { 
                    this.movies = response.data.data; 
                });
            },
            create(){
                axios.post('api/movies', {name: this.name}).then(response => {
                    //this.movies.push(response.data.data);
                    this.name = '';
                    this.read();
                }).catch(e => {
                    console.log(e);
                });
            },
            add(id){
                axios.put('api/movies/'+ id +'/add').then(response => {
                    this.read();
                }).catch(e => {
                    console.log(e);
                });

            },
            subtract(id){
                axios.put('api/movies/'+ id +'/subtract',).then(response => {
                    this.read();
                }).catch(e => {
                    console.log(e);
                });
            }
        },
    }
</script>
