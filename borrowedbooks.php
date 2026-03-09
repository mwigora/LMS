<?php
// Include the database connection
include 'db_connection.php';

// Query to fetch borrowed books
$sql = "SELECT book_loans.id, books.title, books.author, book_loans.loan_date, book_loans.due_date
        FROM book_loans
        JOIN books ON book_loans.book_id = books.id
        WHERE book_loans.user_id = ? AND book_loans.return_date IS NULL"; // Adjust query based on your structure

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']); // Assuming user_id is stored in session
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Book Title</th>
                <th>Author</th>
                <th>Loan Date</th>
                <th>Due Date</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['title']}</td>
                <td>{$row['author']}</td>
                <td>{$row['loan_date']}</td>
                <td>{$row['due_date']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "You have no borrowed books.";
}
?>
