<div id="top"></div>
<!--
*** skyScanner is a simple laravel-vue weather app.
-->

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project

* Fetch weather based on user location by default using Openweathermap-API
* Lookup weather of other cities
* Places autocomplete using Algolia places
* Skycons based on weather icon

![image](https://user-images.githubusercontent.com/55706752/147460405-d0b4a6d5-4a54-40b1-9051-a3e659b546f8.png)


<p align="right">(<a href="#top">back to top</a>)</p>


### Built With

* [Vue.js](https://vuejs.org/)
* [Laravel](https://laravel.com)
* [Tailwindcss](https://tailwindcss.com/)

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- GETTING STARTED -->
## Getting Started

Clone or fork the project on your local machine.

### Installation

1. Get a free API Key at [https://openweathermap.org/](https://openweathermap.org/)
2. Clone the repo
   ```sh
   git clone https://github.com/Klodovsky/skyScanner.git
   ```
3. Install NPM packages
   ```sh
   npm install
   ```
4. Enter your API in `.env`
   ```js
   OPEN_WEATHER_API_KEY = 'ENTER YOUR API KEY';
   ```

5. Run the dev server
   ```sh
   php artisan serve
   ```
   
<p align="right">(<a href="#top">back to top</a>)</p>


<!-- ROADMAP -->
## Roadmap

- [x] Add user location
- [x] Add places autocomplete
- [x] Add weather icons
- [ ] Add hourly/weekly forecast
- [ ] Bookmark favorite cities
- [ ] Change background images based on temperature
- [ ] Multi-language Support based on client location

See the [open issues](https://github.com/Klodovsky/skyScanner/issues) for a full list of proposed features (and known issues).

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#top">back to top</a>)</p>


<!-- ACKNOWLEDGMENTS -->
## Acknowledgments

This space to list resources that was helpful and would like to give credit to. I've included a few of my favorites to kick things off!

* [Open weather map API](https://openweathermap.org/)
* [Skycons](https://darkskyapp.github.io/skycons/)
* [Freepik image](https://image.freepik.com/free-vector/storm-concept-illustration_114360-6585.jpg)
* [Laravel GeoLocation Package](https://github.com/adrianorsouza/laravel-geolocation)
* [Font Awesome](https://fontawesome.com)

<p align="right">(<a href="#top">back to top</a>)</p>
