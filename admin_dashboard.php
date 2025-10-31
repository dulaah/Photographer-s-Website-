<?php
include 'db_connect.php';

// Search input for users
$search_user = isset($_GET['user_search']) ? trim($_GET['user_search']) : '';

// Fetch Enquiries
$sql_enquiries = "SELECT id, name, email, phone, location, event_date, package, message, submitted_at AS book_date FROM enquiries ORDER BY event_date DESC";
$result_enquiries = $conn->query($sql_enquiries);

// Fetch Contact Messages
$sql_messages = "SELECT id, name, email, message, submitted_at FROM contact_messages ORDER BY submitted_at DESC";
$result_messages = $conn->query($sql_messages);

// Fetch Registered Users
$sql_users = "SELECT id, username, gender, country, email FROM users";
if ($search_user !== '') {
  $search_user_escaped = $conn->real_escape_string($search_user);
  $sql_users .= " WHERE username LIKE '%$search_user_escaped%' OR email LIKE '%$search_user_escaped%'";
}
$sql_users .= " ORDER BY id DESC";
$result_users = $conn->query($sql_users);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Malcolm Lismore Photography</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #f4f4f4;
    }
    header {
      background-color: #333;
      color: white;
      padding: 20px;
      text-align: center;
    }
    h1, h2 {
      margin: 0;
    }
    .container {
      padding: 30px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background: white;
    }
    th, td {
      padding: 12px;
      border: 1px solid #ccc;
      text-align: left;
    }
    th {
      background-color: #333;
      color: white;
    }
    tr:hover {
      background-color: #f1f1f1;
    }
    .btn-logout {
      float: right;
      margin-top: -40px;
      margin-right: 20px;
      padding: 8px 15px;
      background-color: #d9534f;
      color: white;
      text-decoration: none;
      border-radius: 4px;
    }
    .btn-logout:hover {
      background-color: #c9302c;
    }
    .section-title {
      margin-top: 40px;
      border-bottom: 2px solid #ccc;
      padding-bottom: 5px;
    }
    form {
      margin-top: 15px;
    }
    input[type="text"] {
      padding: 8px;
      width: 300px;
      margin-right: 10px;
    }
    button {
      padding: 8px 12px;
    }
    .clear-search {
      margin-left: 10px;
      color: red;
      text-decoration: none;
    }
    .clear-search:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <header>
    <h1>Welcome Admin</h1>
    <a href="index.php" class="btn-logout">Back to Site</a>
  </header>

  <div class="container">

    <!-- Enquiries Section -->
    <h2 class="section-title">Enquiries</h2>
    <?php if ($result_enquiries && $result_enquiries->num_rows > 0): ?>
      <table>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Location</th>
          <th>Event Date</th>
          <th>Package</th>
          <th>Message</th>
          <th>Book Date</th>
        </tr>
        <?php while($row = $result_enquiries->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row["id"]) ?></td>
            <td><?= htmlspecialchars($row["name"]) ?></td>
            <td><?= htmlspecialchars($row["email"]) ?></td>
            <td><?= htmlspecialchars($row["phone"]) ?></td>
            <td><?= htmlspecialchars($row["location"]) ?></td>
            <td><?= htmlspecialchars($row["event_date"]) ?></td>
            <td><?= htmlspecialchars($row["package"]) ?></td>
            <td><?= htmlspecialchars($row["message"]) ?></td>
            <td><?= htmlspecialchars($row["book_date"]) ?></td>
          </tr>
        <?php endwhile; ?>
      </table>
    <?php else: ?>
      <p>No enquiries found.</p>
    <?php endif; ?>

    <!-- User Messages Section -->
    <h2 class="section-title">User Messages</h2>
    <?php if ($result_messages && $result_messages->num_rows > 0): ?>
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Submitted At</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($msg = $result_messages->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($msg['id']) ?></td>
              <td><?= htmlspecialchars($msg['name']) ?></td>
              <td><?= htmlspecialchars($msg['email']) ?></td>
              <td><?= nl2br(htmlspecialchars($msg['message'])) ?></td>
              <td><?= htmlspecialchars($msg['submitted_at']) ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>No messages found from users.</p>
    <?php endif; ?>

    <!-- Registered Users Section -->
    <h2 class="section-title">Registered Users</h2>

    <!-- Search Form -->
    <form method="GET">
      <input type="text" name="user_search" placeholder="Search users by username or email" value="<?= htmlspecialchars($search_user) ?>">
      <button type="submit">Search</button>
      <?php if ($search_user !== ''): ?>
        <a href="admin_dashboard.php" class="clear-search">Clear Search</a>
      <?php endif; ?>
    </form>

    <?php if ($result_users && $result_users->num_rows > 0): ?>
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Username</th>
            <th>Gender</th>
            <th>Country</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($user = $result_users->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($user['id']) ?></td>
              <td><?= htmlspecialchars($user['username']) ?></td>
              <td><?= htmlspecialchars($user['gender']) ?></td>
              <td><?= htmlspecialchars($user['country']) ?></td>
              <td><?= htmlspecialchars($user['email']) ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>No registered users found.</p>
    <?php endif; ?>

  </div>
</body>
</html>

<?php
$conn->close();
?>
