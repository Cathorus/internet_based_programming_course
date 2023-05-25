<!DOCTYPE html>
<html> 
<head>
  <title>Hospital Portal</title>
  <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
  <h1>Hospital Portal</h1>

  <?php
  session_start();

  if (!isset($_SESSION['username'])) {
    // User is not logged in
    header('location: login.php');
    exit();
  }

  echo "Welcome, " . $_SESSION['username'] . "!";

  $isAdmin = ($_SESSION['usertype'] === 'doctor') ? true : false;

  // Fetch announcements from the database
  // Add your own database connection and fetching logic here

  // Fetch prescribed medicines from the database
  // Add your own database connection and fetching logic here

  // Fetch messages from the database
  // Add your own database connection and fetching logic here
  ?>

  <div class="tab-links">
    <a href="#" class="tab-link active" onclick="openTab(event, 'announcement-tab')">Announcement</a>
    <a href="#" class="tab-link" onclick="openTab(event, 'medicine-tab')">Medicine</a>
    <a href="#" class="tab-link" onclick="openTab(event, 'message-tab')">Messages</a>
  </div>

  <div id="announcement-tab" class="tab active">
    <h2>Announcement</h2>
    <!-- Only show form if user is a doctor -->
    <?php if ($isAdmin): ?>
      <!-- Your form here -->
    <?php endif; ?>

    <div class="message-container">
      <h2>Announcements</h2>
      <?php foreach ($announcements as $announcement): ?>
        <h3><?php echo $announcement['title']; ?></h3>
        <p><?php echo $announcement['content']; ?></p>
      <?php endforeach; ?>
    </div>
  </div>

  <div id="medicine-tab" class="tab">
    <h2>Medicine</h2>
    <!-- Only show form if user is a doctor -->
    <?php if ($isAdmin): ?>
      <!-- Your form here -->
    <?php endif; ?>

    <div class="message-container">
      <h2>Prescribed Medicines</h2>
      <?php foreach ($prescribedMedicines as $medicine): ?>
        <h3><?php echo $medicine['patient']; ?></h3>
        <p>Medicine: <?php echo $medicine['medicine']; ?></p>
        <p>Dosage: <?php echo $medicine['dosage']; ?></p>
      <?php endforeach; ?>
    </div>
  </div>

  <div id="message-tab" class="tab">
    <h2>Messages</h2>
    <?php if ($isAdmin): ?>
      <!-- Your form here -->
    <?php else: ?>
      <!-- Show user-specific messages here -->
      <?php foreach ($messages as $message): ?>
        <?php if ($_SESSION['username'] === $message['sender'] || $_SESSION['username'] === $message['receiver']): ?>
          <h3>From: <?php echo $message['sender']; ?></h3>
          <p>To: <?php echo $message['receiver']; ?></p>
          <p><?php echo $message['content']; ?></p>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  <script src="main.js"></script>
</body>
</html>

