<?php
include "db.php"; // Include your database connection file

if (isset($_GET['query'])) {
    $search_query = $_GET['query'];
    $sql = "SELECT product_id, product_title FROM products WHERE product_title LIKE ?";
    $stmt = $con->prepare($sql);
    $search_param = "%$search_query%";
    $stmt->bind_param("s", $search_param);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = ['id' => $row['product_id'], 'title' => $row['product_title']];
    }

    echo json_encode($products);
}
?>

