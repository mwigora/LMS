<?php
// Include the database connection
include 'db_connection.php';

// Get the current date
$currentDate = date('Y-m-d');

// Query to fetch overdue books
$sql = "SELECT book_loans.id, books.title, books.author, book_loans.due_date
        FROM book_loans
        JOIN books ON book_loans.book_id = books.id
        WHERE book_loans.user_id = ? AND book_loans.due_date < ? AND book_loans.return_date IS NULL";

$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $_SESSION['user_id'], $currentDate); // Assuming user_id is stored in session
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Book Title</th>
                <th>Author</th>
                <th>Due Date</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['title']}</td>
                <td>{$row['author']}</td>
                <td>{$row['due_date']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No overdue books.";
}
?>
