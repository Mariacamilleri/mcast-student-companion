<?php
    include 'libraries/database.php';

    include 'template/header.php';
?>

<head>
    <link href="css/calendar.css" type="text/css" rel="stylesheet" />
</head>

<header class="page-header row no-gutters py-4 border-bottom">
    <div class="col-12">
        <h3 class="text-center text-md-left">Calendar</h3>
    </div>
</header>

    <div class="card col-sm-7 p-0">
        <!-- ROW FOR HEADER AND CANCEL BUTTON -->
        <div class="row">
            <div class="col-2 card-header border-bottom-1">
                <button type="button" class="btn btn-link">Cancel</button>
            </div>
            <div class="col card-header border-bottom-1">
                <h5 class="m-0">New Event</h5>
            </div>
        </div>

        <!-- ROW FOR FORM CONTENT AND CREATE BUTTON -->
        <div class="p-3 row">
            <div class="col">
                <form>
                    <div class="form-group">
                        <input type="title" class="form-control" id="exampleInputTitle" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <input type="Location" class="form-control" id="exampleInputLocation" placeholder="Location">
                    </div>
                    <!-- Start+ End DATE & TIME PICKER !!!! -->
                    <!-- <div>
                    <input type="text" id="date" data-format="DD-MM-YYYY" data-template="D MMM YYYY" name="date" value="09-01-2013">
                        <script>
                            $(function(){
                            $('#date').combodate();
                            });
                        </script>

                    <input type="text" id="time" data-format="HH:mm" data-template="HH : mm" name="datetime">
                        <script>
                            $(function(){
                                $('#time').combodate({
                                    firstItem: 'name', //show 'hour' and 'minute' string at first item of dropdown
                                    minuteStep: 1
                                });
                            });
                        </script>
                    </div> -->
                    <div class="form-group">
                        <select id="inputRepeat" class="form-control">
                            <option selected>Alert</option>
                            <option>None</option>
                            <option>5 mins before</option>
                            <option>10 mins before</option>
                            <option>15 mins before</option>
                            <option>20 mins before</option>
                            <option>30 mins before</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="inputRepeat" class="form-control">
                            <option selected>Show As</option>
                            <option>...</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="col">
                <button type="create" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
