<?php
include('includeClasses/crud.php');
// Check if the category ID is provided
if (isset($_POST['categoryId'])) {
    $categoryId = $_POST['categoryId'];
    $crud = new Crud();
    $result_delete = $crud->deleteCategory($categoryId);

    // Perform the delete operation using the provided category ID
    // $delete_operation = "DELETE FROM categories WHERE category_id = $categoryId";
    // $result_delete = mysqli_query($con, $delete_operation);

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
    echo 'Category ID not found.';
}
?>