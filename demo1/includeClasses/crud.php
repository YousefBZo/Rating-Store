<?php
include_once 'DB.php';
class Crud extends DB
{

    public function __construct()
    {
        parent::__construct();
    }
    public function getNumCategories()
    {
        $select_count_categories = "SELECT COUNT(*) FROM categories";
        $result_count_categories = $this->connection->query($select_count_categories);
        $count = $result_count_categories->fetch_row()[0];
        return $count;
    }

    public function getNumStores()
    {
        $select_count_stores = "SELECT COUNT(*) FROM stores";
        $result_count_stores = $this->connection->query($select_count_stores);
        $count = $result_count_stores->fetch_row()[0];
        return $count;
    }
    public function getNumStoresWithCondition($cat_id)
    {
        $select_count_stores = "SELECT COUNT(store_id) FROM stores WHERE category_id = ?";

        // Prepare the statement
        $stmt = $this->connection->prepare($select_count_stores);

        // Bind the parameter
        $stmt->bind_param("i", $cat_id);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result_count_stores = $stmt->get_result();

        // Fetch the count
        $count = $result_count_stores->fetch_row()[0];

        // Close the statement
        $stmt->close();

        return $count;
    }

    public function insertCategory($value)
    {

        $insert = "INSERT INTO categories (category_name) VALUES ('$value')";
        $result = $this->connection->query($insert);

        if ($result) {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6"></script>';
            echo '<script>';
            echo 'Swal.fire({';
            echo '    title: "Good job!",';
            echo '    text: "Category added successfully!",';
            echo '    icon: "success",';
            echo '    confirmButtonText: "OK"';
            echo '});';
            echo '</script>';
        }
    }
    public function getCategories()
    {
        $select_cat = "SELECT * FROM categories";
        $result_cat = $this->connection->query($select_cat);

        // Check if the query was successful
        if (!$result_cat) {
            // Handle the error (e.g., return an empty array or show an error message)
            return [];
        }

        // Fetch all rows from the result as an associative array
        $rows = $result_cat->fetch_all(MYSQLI_ASSOC);

        // Free the result set
        $result_cat->free_result();

        // Return the fetched rows
        return $rows;
    }
    public function getCategoriesFilter($category_id, $startFrom, $storesPerPage)
    {
        $select_stores = "SELECT * FROM stores where category_id=$category_id limit $startFrom,$storesPerPage";
        $result_cat = $this->connection->query($select_stores);

        // Check if the query was successful
        if (!$result_cat) {
            // Handle the error (e.g., return an empty array or show an error message)
            return [];
        }

        // Fetch all rows from the result as an associative array
        $rows = $result_cat->fetch_all(MYSQLI_ASSOC);

        // Free the result set
        $result_cat->free_result();

        // Return the fetched rows
        return $rows;
    }
    public function createStore($store_name, $store_phone, $store_address, $store_category)
    {
        if (!empty($store_name) && !empty($store_phone) && !empty($store_address) && !empty($store_category)) {
            if (isset($_FILES['store_image'])) {
                $store_image = $_FILES['store_image']['name'];
                $store_image_tmp = $_FILES['store_image']['tmp_name'];

                // Get the file extension
                $fileExtension = strtolower(pathinfo($store_image, PATHINFO_EXTENSION));

                // Define the accepted file extensions
                $acceptedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

                // Check if the file extension is in the accepted extensions array
                if (in_array($fileExtension, $acceptedExtensions)) {
                    // Generate a unique name for the image file
                    $uniqueImageName = generateUniqueImageName($store_image);

                    // Determine the destination path
                    $destination = "images/$uniqueImageName";

                    // Move the uploaded file to the destination
                    if (move_uploaded_file($store_image_tmp, $destination)) {
                        $insert = "INSERT INTO stores (`store_name`, `store_phone`, `store_address`, `category_id`, `store_image`) VALUES ('$store_name','$store_phone','$store_address','$store_category','$uniqueImageName')";
                        $result = $this->connection->query($insert);
                        if ($result) {
                            ?>
                            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6'></script>
                            <script>
                                Swal.fire({
                                    title: 'Good job!',
                                    text: 'Stores added successfully!',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                            </script>
                            <?php
                        } else {
                            ?>
                            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                            <script>
                                swal("Error", "Stores failed to add", "error");
                            </script>
                            <?php
                        }
                    } else {
                        ?>
                        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                        <script>
                            swal("Error", "Failed to move the uploaded image.", "error");
                        </script>
<?php
                    }
                } else {
                    // The file is not accepted, show an error message
                    ?>
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script>
                        swal("Error", "Image not accepted. Please choose a JPG, JPEG, PNG, or GIF file.", "error");
                    </script>
<?php
                }
            } else {
                ?>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script>
                    swal("Error", "Please select an image.", "error");
                </script>
<?php
            }
        } else {
            ?>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal("Error", "Please fill in all the input fields.", "error");
            </script>
<?php
        }
    }
    private function generateUniqueImageName($imageName)
    {
        $extension = pathinfo($imageName, PATHINFO_EXTENSION);
        $basename = basename($imageName, '.' . $extension);
        $uniqueName = $basename . '_' . uniqid() . '.' . $extension;

        // Check if the file already exists
        while (file_exists('images/' . $uniqueName)) {
            $uniqueName = $basename . '_' . uniqid() . '.' . $extension;
        }

        return $uniqueName;
    }
    public function deleteCategory($categoryId)
    {
        $delete_operation = "DELETE FROM categories WHERE category_id = $categoryId";
        return $this->connection->query($delete_operation);
    }

    public function showCategories()
    {
        $select = "SELECT * FROM categories";
        $result = $this->connection->query($select);
        if (!$result) {
            // Handle the error (e.g., return an empty array or show an error message)
            return [];
        }

        // Fetch all rows from the result as an associative array
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Free the result set
        $result->free_result();

        // Return the fetched rows
        return $rows;
    }
    public function showCategoriesWithCondition($category_id)
    {
        $select = "SELECT * FROM categories WHERE category_id = $category_id";
        $result = $this->connection->query($select);
        if (!$result) {
            // Handle the error (e.g., return an empty array or show an error message)
            return [];
        }

        // Fetch all rows from the result as an associative array
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Free the result set
        $result->free_result();

        // Return the fetched rows
        return $rows;
    }
    public function showStores()
    {
        $select_name_store = "SELECT * FROM stores";
        $result = $this->connection->query($select_name_store);
        if (!$result) {
            // Handle the error (e.g., return an empty array or show an error message)
            return [];
        }

        // Fetch all rows from the result as an associative array
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Free the result set
        $result->free_result();

        // Return the fetched rows
        return $rows;
    }
    public function showStoresWithCondition($store_id)
    {
        $select_name_store = "SELECT * FROM stores WHERE store_id = $store_id";
        $result = $this->connection->query($select_name_store);
        if (!$result) {
            // Handle the error (e.g., return an empty array or show an error message)
            return [];
        }

        // Fetch all rows from the result as an associative array
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Free the result set
        $result->free_result();

        // Return the fetched rows
        return $rows;
    }
    public function numOfStoresFollowCategory($cat_id)
    {
        $select_stores = "SELECT * FROM stores WHERE category_id = $cat_id";
        $result_stores = $this->connection->query($select_stores);
        return $result_stores->num_rows;

    }
    // public function showStores()
    // {
    //     $select = "SELECT * FROM categories";
    //     $result = $this->connection->query($select);
    //     if (!$result) {
    //         // Handle the error (e.g., return an empty array or show an error message)
    //         return [];
    //     }

    //     // Fetch all rows from the result as an associative array
    //     $rows = $result->fetch_all(MYSQLI_ASSOC);

    //     // Free the result set
    //     $result->free_result();

    //     // Return the fetched rows
    //     return $rows;
    // }

    public function numTotalPagesStores($storesPerPage): int
    {
        $query_pagination = "SELECT COUNT(store_id) as total FROM stores";
        $result_pagination = $this->connection->query($query_pagination);
        $row_pagination = $result_pagination->fetch_all(MYSQLI_ASSOC);
        $totalStores = $row_pagination[0]['total'] ?? 0; // Use index 0 to access the first row
        return ceil($totalStores / $storesPerPage);
    }

    public function numTotalPagesStoresSearch($storesPerPage, $search_value): int
    {
        $query_pagination = "SELECT COUNT(store_id) as total FROM stores WHERE store_name LIKE '%$search_value%'";
        $result_pagination = $this->connection->query($query_pagination);
        $row_pagination = $result_pagination->fetch_all(MYSQLI_ASSOC);
        $totalStores = $row_pagination[0]['total'];
        return ceil($totalStores / $storesPerPage);
    }
    public function showStorePerPage($startFrom, $storesPerPage)
    {
        $select = "SELECT * FROM stores ORDER BY store_id LIMIT $startFrom, $storesPerPage";
        $result = $this->connection->query($select);
        if (!$result) {
            // Handle the error (e.g., return an empty array or show an error message)
            return [];
        }

        // Fetch all rows from the result as an associative array
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Free the result set
        $result->free_result();

        // Return the fetched rows
        return $rows;
    }
    public function showStorePerPageSearch($startFrom, $storesPerPage, $search_value)
    {
        $select = "SELECT * FROM stores WHERE store_name LIKE '%$search_value%' order by store_id limit $startFrom,$storesPerPage ";
        $result = $this->connection->query($select);
        if (!$result) {
            // Handle the error (e.g., return an empty array or show an error message)
            return [];
        }

        // Fetch all rows from the result as an associative array
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Free the result set
        $result->free_result();

        // Return the fetched rows
        return $rows;
    }
    public function editCategory($cat_name, $cat_id)
    {
        $update = "UPDATE categories SET category_name='$cat_name' WHERE category_id='$cat_id'";
        $result = $this->connection->query($update);
        if ($result) {
            ?>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6'></script>
    <script>
        Swal.fire({
            title: 'Good job!',
            text: 'Category updated successfully!',
            icon: 'success',
            confirmButtonText: 'OK'
        });  
    </script>
    <?php
        } else {
            ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Error", "There was an error updating the category.", "error");
        </script>
        <?php
        }

    }
    public function updateStoreInDatabase($store_id, $store_name, $store_phone, $store_address, $store_category, $uniqueImageName)
    {
        $update = "UPDATE stores SET `store_name`='$store_name', `store_phone`='$store_phone', `store_address`='$store_address', `category_id`='$store_category', `store_image`='$uniqueImageName' WHERE store_id=$store_id";
        $result = $this->connection->query($update);

        if ($result) {
            echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6'></script>
                <script>
                    Swal.fire({
                        title: 'Good job!',
                        text: 'Store updated successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                </script>
            ";
        } else {
            echo "
                <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
                <script>
                    swal('Error', 'Failed to update the store', 'error');
                </script>
            ";
        }
    }
    public function deleteStore($storeID)
    {
        $delete_operation_rating = "DELETE FROM rating WHERE store_id = $storeID";
        $this->connection->query($delete_operation_rating);
        $delete_operation = "DELETE FROM stores WHERE store_id = $storeID";
        return $this->connection->query($delete_operation);
    }
    public function showRating($store_id)
    {
        $select_ratings = "SELECT * FROM rating WHERE store_id=$store_id";
        $result = $this->connection->query($select_ratings);
        if (!$result) {
            // Handle the error (e.g., return an empty array or show an error message)
            return [];
        }

        // Fetch all rows from the result as an associative array
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Free the result set
        $result->free_result();

        // Return the fetched rows
        return $rows;
    }
    public function isLogin($username, $password)
    {
        $select = "SELECT * FROM login WHERE username='$username' AND password='$password'";
        $result = $this->connection->query($select);
        return $result->num_rows;
    }
    public function category_name($category_id)
    {
        $category_name_query = "SELECT category_name FROM categories WHERE category_id=$category_id";
        $result_cat_name = $this->connection->query($category_name_query);

        if ($result_cat_name && $result_cat_name->num_rows > 0) {
            $row = $result_cat_name->fetch_assoc();
            return $row['category_name'];
        }

        return null; // Return null if no category name found
    }
    public function ratingUser($user_ip, $store_id)
    {
        $select_check_ip = "SELECT * FROM rating WHERE user_ip='$user_ip' and store_id=$store_id";
        $result = $this->connection->query($select_check_ip);
        if (!$result) {
            // Handle the error (e.g., return an empty array or show an error message)
            return [];
        }

        // Fetch all rows from the result as an associative array
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Free the result set
        $result->free_result();

        // Return the fetched rows
        return $rows;
    }
    public function insertRate($rating, $user_ip, $store_id)
    {
        $insert = "INSERT INTO rating (`rating_value`, `user_ip`, `store_id`) VALUES ($rating, '$user_ip', $store_id)";
        $result_insert = $this->connection->query($insert);
        if ($result_insert) {
            ?>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6'></script>
            <script>
                Swal.fire({
                    title: 'Good job!',
                    text: 'Your Rating added successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload(); // Refresh the page
                });
            </script>
            <?php
        }
    }
}