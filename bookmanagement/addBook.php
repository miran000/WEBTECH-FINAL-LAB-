<?php

    if(isset($_POST['submit'])){

        $title = $_POST['title'];
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $quantity = $_POST['quantity'];
        $category = $_POST['category'];

        $problematic = false;
        $pattern = "/^[a-zA-Z0-9\s]+$/";
        if(!preg_match($pattern, $title)){
            echo "Invalid Book Title!";
            exit();
        }
        
        $pattern = "/^[a-zA-Z\s\-\.]+$/";
        if(!preg_match($pattern, $author)){
            echo "Invalid Author Name!";
            exit();
        }

        $pattern = "/^\d+$/";
        if(!preg_match($pattern, $isbn)){
            echo "Invalid ISBN!";
            exit();
        }

        if(!is_numeric($quantity)){
            echo "Quantity must be a number!";
            exit();
        }

        $pattern = "/^[a-zA-Z\s\-\.]+$/";
        if(!preg_match($pattern, $category)){
            echo "Invalid Category!";
            exit();
        }


        include 'db_connection.php';
        
        $sql = "INSERT INTO books (title, author, isbn, quantity, category) VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssds", $title, $author, $isbn, $quantity, $category); // 'sssds' corresponds to the data types: string, string, string, double, string

            try {
                if ($stmt->execute()) {
                    echo "Book added successfully!";
                }
            } catch (mysqli_sql_exception $e) {
                echo "Error executing statement: " . $e->getMessage();
            }
            
            $stmt->close();
            $conn->close();

        }
        else {
            echo "Error preparing statement: " . $conn->error;
        }

    }

    else{
        echo "Book form wasn't submitted!";
    }


?>