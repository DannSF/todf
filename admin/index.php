<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <header class="admin-header">
        <h1>Admin Panel</h1>
        <button id="logout">Log Out</button>
    </header>
    <main>

        <section class="admin-categories container">
            <div class="header">
                <h2>Categories</h2>
                <button class="add-category-btn">+ Category</button>
            </div>
            <table class="categories-table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Technology</td>
                        <td>
                            <button class="edit-btn">Edit</button>
                            <button class="delete-btn">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Science</td>
                        <td>
                            <button class="edit-btn">Edit</button>
                            <button class="delete-btn">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="admin-categories container">
            <div class="header">
                <h2>Subcategories</h2>
                <button class="add-category-btn">+ Category</button>
            </div>
            <table class="categories-table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Technology</td>
                        <td>Computers</td>
                        <td>
                            <button class="edit-btn">Edit</button>
                            <button class="delete-btn">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Science</td>
                        <td>Moleculas</td>
                        <td>
                            <button class="edit-btn">Edit</button>
                            <button class="delete-btn">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section class="admin-questions container">
            <div class="header">
                <h2>Questions</h2>
            </div>
            <table class="questions-table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Question</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Technology</td>
                        <td>Web Development</td>
                        <td>What is HTML?</td>
                        <td class="pending">Pending</td>
                        <td>
                            <button class="approve-btn">Approve</button>
                            <button class="reject-btn">Reject</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Science</td>
                        <td>Physics</td>
                        <td>What is gravity?</td>
                        <td class="approved">Approved</td>
                        <td>
                            <button class="approve-btn" disabled>Approve</button>
                            <button class="reject-btn">Reject</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="admin-answers container">
            <div class="header">
                <h2>Answers</h2>
            </div>
            <table class="answers-table">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>What is HTML?</td>
                        <td>HTML is a markup language used for creating web pages.</td>
                        <td class="pending">Pending</td>
                        <td>
                            <button class="approve-btn">Approve</button>
                            <button class="reject-btn">Reject</button>
                        </td>
                    </tr>
                    <tr>
                        <td>What is gravity?</td>
                        <td>Gravity is a natural phenomenon by which all things attract one another.</td>
                        <td class="approved">Approved</td>
                        <td>
                            <button class="approve-btn" disabled>Approve</button>
                            <button class="reject-btn">Reject</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>


    </main>
    <footer>
        <p>Admin Panel &copy; 2024</p>
    </footer>
</body>

</html>