<?php
include('includeClasses/crud.php');
// Check if the store ID is provided
if (isset($_POST['storeID'])) {
    $storeID = $_POST['storeID'];
    // $delete_operation_rating = "DELETE FROM rating WHERE store_id = $storeID";
    // $result_delete_rating = mysqli_query($con, $delete_operation_rating);
    // $delete_operation = "DELETE FROM stores WHERE store_id = $storeID";
    // $result_delete = mysqli_query($con, $delete_operation);
    $crud = new Crud;
    $result_delete = $crud->deleteStore($storeID);

    // Check if the delete operation was successful
    if ($result_delete) {
        // Send a success response


        echo 'success';
    } else {
        // Send an error response
        echo 'error';
    }
} else {
    // Send an error response
    echo 'store ID not found.';
}

?>