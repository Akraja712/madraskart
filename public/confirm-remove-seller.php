<div id="content" class="container col-md-12">
    <?php
    include_once('includes/custom-functions.php');
    $fn = new custom_functions;

    if (isset($_POST['btnDelete'])) {
        if (defined('ALLOW_MODIFICATION') && ALLOW_MODIFICATION == 0) {
            echo '<label class="alert alert-danger">This operation is not allowed in demo panel!.</label>';
            return false;
        }

        // $ID = (isset($_GET['id'])) ? $db->escapeString($fn->xss_clean($_GET['id'])) : "";
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $ID = $db->escapeString($fn->xss_clean($_GET['id']));
        } else { ?>
            <script>
                alert("Something went wrong, No data available.");
                window.location.href = "sellers.php";
            </script>
    <?php
        }

        // delete data from menu table
        $sql_query = "DELETE FROM seller WHERE id =" . $ID;
        $db->sql($sql_query);
        $delete_result = $db->getResult();
        if (!empty($delete_result)) {
            $delete_result = 0;
        } else {
            $delete_result = 1;
        }
        // if delete data success back to reservation page
        if ($delete_result == 1) {
            header("location: sellers.php");
        }
    }

    if (isset($_POST['btnNo'])) {
        header("location: sellers.php");
    }
    if (isset($_POST['btncancel'])) {
        header("location: sellers.php");
    }

    ?>
    <?php
    if ($permissions['locations']['delete'] == 1) { ?>
        <h1>Confirm Action</h1>
        <hr />
        <form method="post">
            <p>Are you sure want to delete this Seller?</p>
            <input type="submit" class="btn btn-primary" value="Delete" name="btnDelete" />
            <input type="submit" class="btn btn-danger" value="Cancel" name="btnNo" />
        </form>
        <div class="separator"> </div>
    <?php } else { ?>
        <div class="alert alert-danger topmargin-sm">You have no permission to delete sellers.</div>
        <form method="post">
            <input type="submit" class="btn btn-danger" value="Back" name="btncancel" />
        </form>
    <?php } ?>
</div>

<?php $db->disconnect(); ?>