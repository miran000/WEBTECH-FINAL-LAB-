<?php
    if(isset($_POST['update'])) {
        // Include your database connection
        include 'db_connection.php';

        // Retrieve updated book data
        $bookId = $_POST['bookId'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $quantity = $_POST['quantity'];
        $category = $_POST['category'];

        // Update query
        $sql = "UPDATE books SET 
                title = ?, 
                author = ?, 
                quantity = ?, 
                category = ? 
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisi", $title, $author, $quantity, $category, $bookId);

        try {
            if ($stmt->execute()) {
                echo "Book information updated successfully!";
            }
        } catch (mysqli_sql_exception $e) {
            echo "Error updating book: " . $e->getMessage();
        }

        $stmt->close();
        $conn->close();
    }

    else if(isset($_POST['delete'])){
        include 'db_connection.php';

        $bookId = $_POST['bookId'];

        // Prepare the SQL query to delete the book
        $sql = "DELETE FROM books WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $bookId);

        try {
            if ($stmt->execute()) {
                echo "Book with ID $bookId deleted successfully!";
            }
        } catch (mysqli_sql_exception $e) {
            echo "Error deleting book: " . $e->getMessage();
        }

        $stmt->close();
        $conn->close();
    }
    else{
        echo "Book modification form was not submitted!";
    }
?>