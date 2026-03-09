<?php

$activeTab = $_POST['tab'] ?? 'borrowed';

if ($activeTab === 'borrowed') {
    echo '<h1>Borrowed Books</h1>';
    include 'borrowedbooks.php';
}

elseif ($activeTab === 'overdue') {
    echo '<h1>Overdue Books</h1>';
    include 'overduebooks.php';
}

elseif ($activeTab === 'add') {
    echo '<h1>Add Books to Loan</h1>';
    echo '<form method="POST" action="add_books.php">
            <label for="book_id">Book ID:</label>
            <input type="text" id="book_id" name="book_id" required><br>
            <label for="loan_date">Loan Date:</label>
            <input type="date" id="loan_date" name="loan_date" required><br>
            <label for="due_date">Due Date:</label>
            <input type="date" id="due_date" name="due_date" required><br>
            <button type="submit" name="add_book">Add Book</button>
          </form>';
}
?>
