<?php
    include 'libraries/database.php';
    include 'libraries/login-check.php';

    include 'template/header.php';

    $notes = get_notes_for_user($_COOKIE["id"]);

    $index = 1;
?>

<header class="page-header row no-gutters py-4 border-bottom">
    <div class="col-12">
        <h3 class="text-center text-md-left">Notes</h3>
    </div>
</header>

<div class="card col-sm-11 p-0">
    <div class="row p-3">
        <h5 class="p-3">My notes</h5>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="card-header border-bottom-1 col">
                <ul class="list-group list-group-flush">
<?php while($row = mysqli_fetch_assoc($notes)): ?>
                 <button>
                    <li class="list-group-item">NOTE <?php echo $index ?>
<?php $index++ ?>
                      <p><small><?php echo substr($row['text'],0,50) ?>...</small></p>
                    </li>
                </button>
<?php endwhile; ?>
                </ul>
            </div>
        </div>
        <div class="col-8">
            <div>
                <tbody>
                    <tr>
                        <td><span class="counter"></span></td>
                        <td>
                            <form action="notes-add-process.php" method="post">
                                <div class="row">
                                    <div class="col note-title">
                                        <h5>New Note</h5>
                                    </div>
                                    <div class="col">
                                        <input class="btn btn-link" type="submit" value="done">
                                    </div>

                                </div>
                                <div class="row">
                                    <input type="text" name="note-text"><br>
                                </div>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </div>
            <!-- Upload Attachment -->
            <!-- Change the appearance as this needs to be an icon -->
            <div>
                <form>
                    <div class="form-group pt-5">
                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
