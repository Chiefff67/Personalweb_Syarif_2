<!-- content -->
<div class="container">
    <div class="row">
        <!-- main content -->
        <div class="col-md-9 content">
            <?php
            if ($pageinfo == "Biography") {
                include("content-bio.php");
            } elseif ($pageinfo == "Biography-form") {
                include("content-bio-form.php");
            }elseif ($pageinfo == "User") {
                include("content-user.php");
            } elseif ($pageinfo == "User-form") {
                include("content-user-form.php");
            } elseif($pageinfo == "Portfolio"){
                include("content-porto.php");
            }elseif ($pageinfo == "contact") {
                include("content-contact.php");
            }elseif ($pageinfo == "Portfolio Form") {
                include("content-porto-form.php");
            }elseif ($pageinfo == "login") {
                include("content-login.php");
            }
            ?>
        </div>
        <!-- main content end -->

        <!-- sidebar content -->
        <div class="col-md-3">
            <ul class="list-group">
                <li class="list-group-item">tr3s tras ono</li>
                <li class="list-group-item">tr3s tras ono</li>
                <li class="list-group-item">tr3s tras ono</li>
                <li class="list-group-item">tr3s tras ono</li>
            </ul>
        </div>
        <!-- sidebar content end -->
    </div>
</div>

<!-- content end -->