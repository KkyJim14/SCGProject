<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <h1 class="text-center">Restaurant Searching</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form>
                    <div class="form-group">
                        <label>Place Name</label>
                        <input type="text" class="form-control" placeholder="Please fill name of a place" v-model="destination">
                        <a v-on:click="searchRes()" class="btn btn-success form-control mt-2">Search</a>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 mb-3" v-for="geo in this.place.results">
                <div class="card">
                    <div v-for="last in geo.photos">
                    <img alt="Restaurant_img" class="card-img" v-bind:src="'https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference='+last.photo_reference+'&key=AIzaSyCxWJuVBao6hFOx__vGQdzLsFnGZ7jfnlw'">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{geo.name}}</h5>
                        <p>Address: {{geo.formatted_address}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.card-img {
    width:100%;
    height:200px;
    object-fit:cover;
}
</style>

<script>
    export default {
        mounted() {
            this.getPlaceData();
        },
        data()  {
            return {
                place:[],
                destination:'ฺBangsue',
            }
        },
        methods: {
            getPlaceData()  {
                axios.get('/api/place').then(response=>{
                    this.place=response.data;
                });
            },
            searchRes() {
                axios.post('/api/place/',{
                    destination:this.destination
                }).then(response=>{
                    this.place=response.data;
                });
            }
        }
    }
</script>
