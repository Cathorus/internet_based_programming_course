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
  $announcements = [
    ["id" => 1, "title" => "Announcement 1", "content" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit."],
    ["id" => 2, "title" => "Announcement 2", "content" => "Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
    // ...
  ];

  // Fetch prescribed medicines from the database
  $prescribedMedicines = [
    ["id" => 1, "patient" => "John Doe", "medicine" => "Medicine 1", "dosage" => "2 pills daily"],
    ["id" => 2, "patient" => "Jane Smith", "medicine" => "Medicine 2", "dosage" => "1 pill every 12 hours"],
    // ...
  ];
  // Fetch messages from the database
  $messages = [
    ["id" => 1, "sender" => "Admin", "receiver" => "John Doe", "content" => "Message 1: Lorem ipsum dolor sit amet, consectetur adipiscing elit."],
    ["id" => 2, "sender" => "John Doe", "receiver" => "Admin", "content" => "Message 2: Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
    // ...
  ]
  ?>

  <div class="tab-links">
    <a href="#" class="tab-link active" onclick="openTab('announcement-tab')">Announcement</a>
    <a href="#" class="tab-link" onclick="openTab('medicine-tab')">Medicine</a>
    <a href="#" class="tab-link" onclick="openTab('message-tab')">Messages</a>
  </div>

  <div id="announcement-tab" class="tab active">
    <h2>Announcement</h2>
    <?php if ($isAdmin): ?>
      <!-- Only show form if user is a doctor -->
      <!-- Your form here -->
      <form action="post_announcement.php" method="POST">
        <label for="announcement">Announcement:</label>
        <textarea id="announcement" name="announcement" rows="4" required></textarea><br>
        <input type="submit" value="Post Announcement">
      </form>
    <?php endif; ?>
    <div class="message-container">
      <?php foreach ($announcements as $announcement): ?>
        <h3><?php echo $announcement['title']; ?></h3>
        <p><?php echo $announcement['content']; ?></p>
      <?php endforeach; ?>
    </div>
  </div>

  <div id="medicine-tab" class="tab">
    <h2>Medicine</h2>
    <?php if ($isAdmin): ?>
      <!-- Only show form if user is a doctor -->
      <form action="prescribe_medicine.php" method="POST">
        <label for="patient">Patient:</label>
        <select id="patient" name="patient" required>
          <!-- Populate options dynamically -->
          <?php
          // Fetch patient list from the database and populate the select options accordingly
          $patients = [
            ["id" => 1, "name" => "John Doe"],
            ["id" => 2, "name" => "Jane Smith"],
            // ...
          ];
          foreach ($patients as $patient) {
            echo '<option value="' . $patient["id"] . '">' . $patient["name"] . '</option>';
          }
          ?>
        </select><br>

        <label for="medicine">Medicine:</label>
        <input type="text" id="medicine" name="medicine" required><br>

        <label for="dosage">Dosage:</label>
        <input type="text" id="dosage" name="dosage" required><br>

        <input type="submit" value="Prescribe Medicine">
      </form>
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
      <!-- Only show form if user is a doctor -->
      <form action="send_message.php" method="POST">
        <label for="receiver">Receiver:</label>
        <select id="receiver" name="receiver" required>
          <!-- Populate options dynamically -->
          <?php
          // Fetch user list from the database and populate the select options accordingly
          $users = [
            ["id" => 1, "username" => "John Doe"],
            ["id" => 2, "username" => "Jane Smith"],
            // ...
          ];

          foreach ($users as $user) {
            echo '<option value="' . $user["username"] . '">' . $user["username"] . '</option>';
          }
          ?>
        </select><br>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" required></textarea><br>

        <input type="submit" value="Send Message">
      </form>
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
    <div class="message-container">
      <h2>Inbox</h2>
      <?php foreach ($messages as $message): ?>
        <?php if ($_SESSION['username'] === $message['receiver']): ?>
          <h3>From: <?php echo $message['sender']; ?></h3>
          <p><?php echo $message['content']; ?></p>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
  <script src="main.js"></script>
</body>
</html>

