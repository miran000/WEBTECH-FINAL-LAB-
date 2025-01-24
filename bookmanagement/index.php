<!DOCTYPE html>
<html lang="en">
<head>
   <title>Book Borrowing Management</title>
   <link rel="stylesheet" href="style.css"> 
</head>

<body>

    <img src="miran.PNG">

    <h1> BOOK BORROWING MANAGEMENT</h1>
    <div class="miran">
       <div class="leftsidebar">
       <ol>
                    <?php
                        $json = json_decode(json: file_get_contents(filename: "usedTokens.json"));
                        foreach($json[0]->usedTokens as $token){
                            echo "<li>";
                            echo $token;
                            echo "</li>";      
                        }
                    ?>
                </ol>
        </div>
        <div class="content">
           <div class="Sec1">
           <?php
                            include 'db_connection.php';
                            $sql = "SELECT * FROM books";
                            $result = $conn->query($sql);
                        ?>
                        
                        <h4 style="text-align: center;">Book List</h4>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>ISBN</th>
                                    <th>Quantity</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                                <td>{$row['id']}</td>
                                                <td>{$row['title']}</td>
                                                <td>{$row['author']}</td>
                                                <td>{$row['isbn']}</td>
                                                <td>{$row['quantity']}</td>
                                                <td>{$row['category']}</td>
                                            </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6' style='text-align: center;'>No books found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                            $conn->close();
                        ?> 
            </div>
            <div class="Sec2">
            <h3>Book ID: </h3>
                            
                            <form action="" method="get">
                                <input type="text" name="bookId">
                                <br><br>
                                <input type="submit" name="submit" value="submit">
                            </form>
                            <?php

                                if (isset($_GET['submit'])) {
                                    include 'db_connection.php';
                                    $bookId = $_GET['bookId'];

                                    $stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
                                    $stmt->bind_param("i", $bookId); 
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        $book = $result->fetch_assoc();
                                        echo "<h3>Book Information:</h3>";
                                        echo "<form action='updateBook.php' method='POST'>";
                                        echo "<label for='title'><strong>Title:</strong></label><br>";
                                        echo "<input type='text' id='title' name='title' value='" . htmlspecialchars($book['title']) . "'><br><br>";
                                    
                                        echo "<label for='author'><strong>Author:</strong></label><br>";
                                        echo "<input type='text' id='author' name='author' value='" . htmlspecialchars($book['author']) . "'><br><br>";
                                    
                                        echo "<label for='isbn'><strong>ISBN:</strong></label><br>";
                                        echo "<input type='text' id='isbn' name='isbn' value='" . htmlspecialchars($book['isbn']) . "' readonly><br><br>";
                                    
                                        echo "<label for='quantity'><strong>Quantity:</strong></label><br>";
                                        echo "<input type='number' id='quantity' name='quantity' value='" . htmlspecialchars($book['quantity']) . "'><br><br>";
                                    
                                        echo "<label for='category'><strong>Category:</strong></label><br>";
                                        echo "<input type='text' id='category' name='category' value='" . htmlspecialchars($book['category']) . "'><br><br>";
                                    
                                        echo "<input type='hidden' name='bookId' value='" . htmlspecialchars($book['id']) . "'>"; // Include the book ID to identify the record
                                        echo "<input type='submit' name='update' value='Update'>";
                                        echo " <input type='submit' name='delete' value='Delete'>";
                                        echo "</form>";
                                    }
                                    $conn->close();
                                }

                                // Close the connection
                                
                            ?>            </div>
            <div class="Sec3">
       
                <div class="column1"><br>
                <img src="12.jpeg">

                </div>

                <div class="column2"><br>
                <img src="13.jpg">
                </div>
               
                <div class="column3"><br>

                <img src="14.jpg">

                </div>
            </div>
            <div class="sec4">
            <h3>Add New Book</h3>
                        <form action="addBook.php" method="post">
                            <label for="title">Book Title: </label> 
                            <input type="text" name="title"><br><br>
                            <label for="author">Author Name: </label> 
                            <input type="text" name="author"><br><br>
                            <label for="isbn">ISBN: </label> 
                            <input type="text" name="isbn"><br><br>
                            <label for="quantity">Quantity: </label> 
                            <input type="text" name="quantity"><br><br>
                            <label for="category">Category: </label> 
                            <input type="text" name="category"><br><br>

                            <br><br>
                            <input type="submit" name="submit" value="submit">
                         </form>            </div>
            <div class="sec5">
               
               <div class="info">Book Register
                   <form id="book_form" class="bookForm" action="process.php" method="post">
                       <br><label for="name">Ful Name: </label>
                       <input type="text" id="fullName" name="fullName">
                       <br><label for="name">Student Id: </label>
                       <input type="text" id="id" name="id">
                       <br><label for="email">E-mail: </label>
                       <input type="email" id="email" name="email">
                       <br><label for="books">Choose Book: </label>
                       <select id="books" name="books" class="customSelector">
                           <option value="Dracula">Dracula </option>
                           <option value="Madame Bovary">Madame Bovary</option>
                           <option value="War and Peace">War and Peace</option>
                           <option value="The Great Gatsbyc">The Great Gatsbyc</option>
                           <option value="Adventures of Huckleberry">Adventures of Huckleberry</option>
                           <option value="GOPALVAR">GOPALVAR</option>
                           <option value=" Middlemarch"> Middlemarch</option>
                           <option value="In Search of Lost Thee">In Search of Lost Thee</option>
                           <option value=" Hamlet"> Hamlet</option>
                           <option value="Lolita">Lolita</option>
                        </select><br>
                        <br><label for="Token">Token Number: </label>
                        <input type="text" id="token" name="token">
                        <br><label for="borrowDate">Borrow Date: </label>
                        <input type="date" id="borrowDate" name="borrowDate">
                        <br><label for="returnDate">Return Date: </label>
                        <input type="date" id="returnDate" name="returnDate">
                        <input type="submit" id="submit" name="submit" onclick="setTimeout(() => document.getElementById('book_form').reset(), 50);">

                    </form>
                </div>
                <div class="form">Token<br>
                    <ol>
                    <?php
                            $json = json_decode(json: file_get_contents(filename: "token.json"));
                            foreach($json[0]->token as $token){
                                echo "<li>";
                                echo $token;
                                echo "</li>";      
                            }
                        ?>
                    </ol>
                </div>
            </div>
        </div>
        <div class="leftsidebar">
           Right Sidebar
        </div>
    </div>
   
</body>
</html>

