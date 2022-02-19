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

My own version of twitter containing the basic features of Twitter such as tweeting and retweeting,following and unfollowing etc... 



<p align="right">(<a href="#top">back to top</a>)</p>


### Built With

* [Vue.js](https://vuejs.org/)
* [Laravel](https://laravel.com)
* [Jetstream](https://jetstream.laravel.com/2.x/introduction.html)
* [Inertia.js](https://inertiajs.com/)


<p align="right">(<a href="#top">back to top</a>)</p>



<!-- GETTING STARTED -->
## Getting Started

Clone or fork the project on your local machine.

### Installation

1. Clone the repo
   ```sh
   git clone https://github.com/Klodovsky/usergems.git
   ```
2. Install NPM packages
   ```sh
   npm install
   ```
3. Run composer install on your cmd or terminal.
   ```sh
   composer install
   ```
4. Copy .env.example file to .env on the root folder
  and change the values based on your DB configuration
 ```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=usergems_db
DB_USERNAME=root
DB_PASSWORD=4484
 ```

5. Run the migrations
   ```sh
   php artisan migrate
   ```

6. DB Factory is setup for seed if needed :
   ```sh
   php artisan db:seed
   ```

7. Run the dev server
   ```sh
   php artisan serve
   ```
   
<p align="right">(<a href="#top">back to top</a>)</p>


<!-- ROADMAP -->
## Roadmap

- [x] Signup, login and logout
- [x] Tweeting
- [x] Following
- [x] Profile page that shows the tweet of each individual user
- [x] Page that shows the tweets of the people I follow
- [x] Retweeting of other tweets
- [x] Tweet as Admin
- [ ] UI enhancements
- [ ] Chat
- [ ] Likes and notifications
- [ ] Hashtags and mentions
- [ ] Add a Built-in URL shortener


See the [open issues](https://github.com/Klodovsky/usergems/issues) for a full list of proposed features (and known issues).

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

