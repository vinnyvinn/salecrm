<template>
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <label>Location</label>
                <gmap-autocomplete
                        @place_changed="setPlace"
                        style="
                        display: block;width: 100%;
                        height: 34px;
                        padding: 6px 12px;
                        font-size: 14px;
                        line-height: 1.42857143;
                        color: #555;"
                        v-model="location.name"/>
                <input type="hidden" name="lat" v-model="location.lat">
                <input type="hidden" name="lng" v-model="location.lng">
            </div>
            <gmap-map
                    :center="location"
                    :zoom="9"
                    style="width:100%; height: 300px"
            >
                <gmap-marker
                        :key="index"
                        v-for="(m, index) in markers"
                        :position="location"
                        :clickable="true"
                        :draggable="true"
                        @place_changed="setPlace"
                        @position_changed="markerDrag($event)"
                        @click="center=m.position"
                ></gmap-marker>
            </gmap-map>
        </div>
    </div>
</template>

<script>
    export default {
        name: "location-picker",
        props: ['lat', 'lng'],
        created () {
            this.location.lat = parseFloat(this.lat);
            this.location.lng = parseFloat(this.lng);
        },
        data () {
            return {
                location: {
                    lat:parseFloat(this.lat),
                    lng:parseFloat(this.lng)
                },
                markers: [{
                    position: this.location
                }]
            }
        },

        methods: {
            setPlace(place) {
                this.location = {
                    lat: place.geometry.location.lat(),
                    lng: place.geometry.location.lng()
                };
                console.log(place);
            },

            markerDrag(position) {
                this.location = {
                    lat: position.lat(),
                    lng: position.lng()
                };
                console.log(this.location);
            }
        }
    }
</script>

<style scoped>

</style>