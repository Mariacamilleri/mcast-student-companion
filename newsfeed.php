<?php
    include 'libraries/database.php';

    include 'template/header.php';
?>

<header class="page-header row no-gutters py-4 border-bottom">
    <div class="col-12">
        <h3 class="text-center text-md-left">Newsfeed</h3>
    </div>
</header>

<div class="row">
    <div class="card col-sm-7 p-0">
        <div class="card-header border-bottom-1">
            <h5 class="m-0">Posts</h5>
        </div>

        <!--  TEXT AREA FORM FOR POSTS -->
        <form class="pr-5 pl-5">
            <div class="form-group" >
                <label for="exampleFormControlTextarea1"></label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                <!-- ADD ICONS TO TEXT AREA -->
            </div>
            <button type="button" class="btn btn-light mb-3 float-right">Post</button>
        </form>

        <!-- AREA FOR VIEWING POSTS -->
        <!-- CARD 1 -->
        <div class="card-group p-5">
          <div class="card">
            <!-- <img src="/Applications/XAMPP/xamppfiles/htdocs/php/mcast-student-companion/assets/imgs/image1.png" class="img-fluid" alt="Responsive image"> -->
            <div class="card-body row">
              <h5 class="card-title col-9">Title 1</h5>
              <small class="text-muted col-3">Last updated 3 mins ago</small>
              <p class="card-text p-3">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.</p>
            </div>
            <div class="card-footer">
                <a href="#" class="card-link"> LINK TO OTHER PHP PROCESS PG
                    <i class="far fa-heart"></i>
                </a>
                <a href="#" class="card-link">OPENS COMMENTS 'POP OVER'
                    <i class="far fa-comments"></i>
                </a>
            </div>
          </div>
        </div>

        <!-- CARD 2 -->
        <div class="card-group pr-5 pl-5 pb-5">
          <div class="card">
            <!-- <img src="/Applications/XAMPP/xamppfiles/htdocs/php/mcast-student-companion/assets/imgs/image1.png" class="img-fluid" alt="Responsive image"> -->
            <div class="card-body row">
              <h5 class="card-title col-9">Title 2</h5>
              <small class="text-muted col-3">Last updated 3 mins ago</small>
              <p class="card-text p-3">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.</p>
            </div>
            <div class="card-footer">
                <a href="#" class="card-link">
                    <i class="far fa-heart"></i>
                </a>
                <a href="#" class="card-link">
                    <i class="far fa-comments"></i>
                </a>
            </div>
          </div>
        </div>

        <!-- CARD 3 -->
        <div class="card-group pr-5 pl-5 pb-5">
          <div class="card">
            <!-- <img src="/Applications/XAMPP/xamppfiles/htdocs/php/mcast-student-companion/assets/imgs/image1.png" class="img-fluid" alt="Responsive image"> -->
            <div class="card-body row">
              <h5 class="card-title col-9">Title 3</h5>
              <small class="text-muted col-3">Last updated 3 mins ago</small>
              <p class="card-text p-3">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.</p>
            </div>
            <div class="card-footer">
                <a href="#" class="card-link">
                    <i class="far fa-heart"></i>
                </a>
                <a href="#" class="card-link">
                    <i class="far fa-comments"></i>
                </a>
            </div>
          </div>
        </div>
    </div>


    <!-- AREA FOR UPCOMING DEADLINES -->
    <div class="card col-sm-3 p-0">

        <!-- CARD UPCOMING HEADER -->
        <div class="card-header border-bottom-1">
            <h5 class="m-0">Upcoming</h5>
        </div>

        <!-- CARD PARAGRAPH BODY -->
        <div class="card-body">
          <h6 class="card-title border-bottom p-1">Monday 11th January 2019</h6>

          <!-- DEADLINE 1 -->
          <div class="row">
            <div class="col-sm-1">
                <i class="fas fa-book-open"></i>
            </div>
            <div class="col">
                <p class="card-text">APP DEVELOPMENT DEADLINE
                    <br>
                    <small class="text-muted">10:30pm</small>
                </p>
            </div>
          </div>

          <!-- DEADLINE 2 -->
          <div class="row">
            <div class="col-sm-1">
                <i class="fas fa-book-open"></i>
            </div>
            <div class="col">
                <p class="card-text">PHP & DATABASES DEADLINE
                    <br>
                    <small class="text-muted">12:00am</small>
                </p>
            </div>
          </div>
        </div>

    </div>
</div>
