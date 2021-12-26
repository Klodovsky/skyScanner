<template>
    <div class="container" v-if="typeof weather !== 'undefined'">
        <div class="weather-side">
            <div class="weather-gradient"></div>
            <div class="date-container">
                <h2 class="date-dayname">{{ getDate.weekday }}</h2>
                <span class="date-day">{{ getDate.date }}</span>
                <span class="location">{{ weather.name }}, </span>
                <span class="location">{{ currentWeather.country }} </span>
            </div>
            <div class="weather-container">
                <div>
                    <img
                        :src="currentWeather.icon"
                        width="70px"
                        height="70px"
                    />
                </div>
                <h1 class="weather-temp">{{ currentWeather.actual }}°C</h1>
                <h3 class="weather-desc">
                    {{ currentWeather.summary }}
                </h3>
            </div>
        </div>

        <div class="info-side">
            <div class="today-info-container">
                <div class="today-info">
                    <div class="humidity">
                        <span class="title">HUMIDITY</span
                        ><span class="value">
                            {{ currentWeather.humidity }} %</span
                        >
                        <div class="clear"></div>
                    </div>
                    <div class="wind">
                        <span class="title">WIND</span
                        ><span class="value">
                            {{ currentWeather.wind }} km/h</span
                        >
                        <div class="clear"></div>
                    </div>
                    <div class="feels">
                        <span class="title">FEELS LIKE</span
                        ><span class="value">
                            {{ currentWeather.feels }} °C</span
                    >
                        <div class="clear"></div>
                    </div>
                </div>
            </div>

            <div class="location-container">
                <form @submit.prevent="changeLocation()" accept-charset="utf-8">
                    <input
                        v-model="query"
                        type="search"
                        id="address"
                        class="form-control"
                        placeholder="Search .."
                    />

                     <p v-if="this.location.city !== ''">Selected city: <strong>{{ this.location.city }}</strong></p>
                    <p v-else>Selected city: <strong id="address-value">none</strong></p>
                    <button type="submit" class="location-button">
                        <i class="location-icon fas fa-map-marker-alt"></i>
                        <span>Change location</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "App",

    data: () => ({
        query: "",
        weather: {},
        currentWeather: {
            actual: "",
            feels: "",
            summary: "",
            icon: "",
            humidity: "",
            wind: "",
            country: "",
        },
        location:{
            city:"",
            lat:0.0,
            lon:0.0,
        },
        iconLink: "http://openweathermap.org/img/wn/",
    }),

    methods: {
        getGeo() {
             new Promise(resolve => {
               axios
                    .get("/api/get-user-location-data")
                    .then((resp) => {

                        resolve( this.location.city = resp.data.city);
                        resolve( this.location.lat = resp.data.latitude);
                        resolve(this.location.lon = resp.data.longitude);
                        this.loadWeather();
                    })
                    .catch(() => {
                        resolve('rejected');
                    });
            });
        },
        async loadWeather() {
            let skycons = new Skycons({ color: "white" });

            fetch(`/api/forecast?q=${this.location.city}`)
                .then((response) => response.json())
                .then((data) => {
                    this.weather = data;
             if (typeof data !== 'undefined'){

                    this.currentWeather.actual = Math.round(data.main.temp);
                    this.currentWeather.feels =  Math.round(data.main.feels_like);
                    this.currentWeather.summary =data.weather[0].description;
                    this.currentWeather.humidity = data.main.humidity;
                    this.currentWeather.wind = data.wind.speed;
                    this.currentWeather.country = data.sys.country;
                    this.currentWeather.icon =this.iconLink + data.weather[0].icon + ".png";

                    skycons.add("iconCurrent", this.currentWeather.icon);
                    skycons.play();
             }
                });
        },
        changeLocation(){
            this.location.city = this.query;
            console.log(' changeLocation this.query suggestion => ',this.query);
            this.loadWeather();
        },

    },
    computed: {
        getDate: function () {
            const d = new Date();
            const monthNames = [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ];
            const month = monthNames[d.getMonth()];
            console.log("month ==>", month);
            const weekday = [
                "Sunday",
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
            ][d.getDay()];
            console.log("weekday ==>", weekday);
            const date = `${d.getDate()}, ${
                monthNames[d.getMonth()]
            } ${d.getFullYear()}`;
            return { date, weekday };
        },
    },

    mounted() {

        // Places.js
        var placesAutocomplete = places({
            container: document.querySelector("#address"),
        });

        var $address = document.querySelector("#address-value");
        placesAutocomplete.on("change", function (e) {
            if ($address) {
                $address.textContent = e.suggestion.value;
                this.query = `${e.suggestion.name}, ${e.suggestion.country}`;
                console.log(' this.query sugg',this.query);

            }
        });

        placesAutocomplete.on("clear", function () {
            $address.textContent = "none";
        });

    },
    created() {

        this.getGeo();
    },
};
</script>

<style lang="scss">
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
@import url("https://fonts.googleapis.com/css?family=Montserrat:400,700,900&display=swap");
:root {
    --gradient: linear-gradient(135deg, #72edf2 10%, #5151e5 100%);
}
* {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    line-height: 1.25em;
}
.clear {
    clear: both;
}
body {
    margin: 0;
    width: 100%;
    height: 100vh;
    font-family: "Montserrat", sans-serif;
    background-color: #343d4b;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
}
.container {
    border-radius: 25px;
    -webkit-box-shadow: 0 0 70px -10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 0 70px -10px rgba(0, 0, 0, 0.2);
    background-color: #222831;
    color: #ffffff;
    height: 500px;
}
.weather-side {
    position: relative;
    height: 100%;
    border-radius: 25px;
    background-image: url("https://image.freepik.com/free-vector/storm-concept-illustration_114360-6585.jpg");
    width: 400px;
    -webkit-box-shadow: 0 0 20px -10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 0 20px -10px rgba(0, 0, 0, 0.2);
    float: left;
    -webkit-transform: scale(1.1) perspective(1500px) rotateY(10deg);
    transform: scale(1.1) perspective(1500px) rotateY(10deg);
}
.weather-gradient {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-image: var(--gradient);
    border-radius: 25px;
    opacity: 0.8;
}
.date-container {
    position: absolute;
    top: 25px;
    left: 25px;
}
.date-dayname {
    margin: 0;
}
.date-day {
    display: block;
}
.location {
    display: inline-block;
    margin-top: 10px;
}
.location-icon {
    display: inline-block;
    font-size: 1em;
    margin-right: 7px;
}
.weather-container {
    position: absolute;
    bottom: 25px;
    left: 25px;
}
.weather-icon {
    font-size: 60px;
}
.weather-temp {
    margin: 0;
    font-weight: 700;
    font-size: 4em;
}
.weather-desc {
    margin: 0;
}
.info-side {
    position: relative;
    float: left;
    height: 100%;
    padding-top: 25px;
    min-width: 330px;
}
.info-logo {
    display: block;
    margin: 0 auto;
    margin-top: -140px;
    padding-bottom: 20px;
}
.today-info {
    padding: 15px;
    margin: 0 25px 25px 25px;
    /* 	box-shadow: 0 0 50px -5px rgba(0, 0, 0, 0.25); */
    border-radius: 10px;
}

.today-info > div .title {
    float: left;
    font-weight: 700;
}
.today-info > div .value {
    float: right;
}

.location-container {
    padding: 25px 35px;
}
.location-button {
    outline: none;
    width: 100%;
    box-sizing: border-box;
    border: none;
    margin-top: 10px;
    border-radius: 25px;
    padding: 10px;
    font-family: "Montserrat", sans-serif;
    background-image: var(--gradient);
    color: #ffffff;
    font-weight: 700;
    box-shadow: 0 0 30px -5px rgb(0 0 0 / 25%);
    cursor: pointer;
    transition: transform 200ms ease;
}
.location-input {
    outline: none;
    width: 100%;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    border-radius: 25px;
    padding: 10px 20px;
    font-family: "Montserrat", sans-serif;
    color: #ffffff;
    background: none;
    font-weight: 700;
    border: 2px solid rgba(#72edf2, 0.5);
    margin-bottom: 15px;
}
.location-input:focus {
    border-color: rgba(#72edf2, 0.8);
}
.location-button:hover {
    -webkit-transform: scale(0.95);
    -ms-transform: scale(0.95);
    transform: scale(0.95);
}
.location-button .feather {
    height: 1em;
    width: auto;
    margin-right: 5px;
}

.ap-input,
.ap-hint {
    width: 100%;
    padding-right: 35px;
    padding-left: 16px;
    line-height: 40px;
    color: black;
    height: 40px;
    border: 1px solid #ccc;
    border-radius: 3px;
    outline: none;
    font: inherit;
    box-sizing: border-box;
}

.ap-suggestion {
    cursor: pointer;
    height: 46px;
    line-height: 46px;
    padding-left: 18px;
    overflow: hidden;
    color: #4a5568;
}
.ap-input-icon .ap-icon-pin{
    display: none !important;
}

</style>
