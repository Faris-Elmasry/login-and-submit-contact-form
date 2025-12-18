<?php
 require_once '../classes/User.php';
 require_once '../classes/Contact.php';
$user = new User("user123", "pass123");
  // Check if user is logged in
if (!$user->isLoggedIn()) {
    header("Location: ../index.php?error=notloggedin");
    exit();
}
 
// Handle logout
if (isset($_POST['logout'])) {
    $user->logout();
    header("Location: ../index.php?logout=success");
    exit();
}

// Handle contact form submission

$contact_message = "";
$errors = array();
$json_data ;
$contact = new Contact();



if (isset($_POST['submit_contact'])) {



  
    $formaData = array(
        'firstname' => trim($_POST['firstname']),
        'lastname' => trim($_POST['lastname']),
        'country' => $_POST['country'],
        'subject' => trim($_POST['subject']),
        'email' => trim($_POST['email'])
        );

  // Validation and sanitization   
        if ($contact->validate($formaData)) {
 $contact->save($formData);

//  
if (isset($_SESSION['contact_message'])) {
    $contact_message = $_SESSION['contact_message'];
    unset($_SESSION['contact_message']);
    header("Location: contact.php");
    exit();
} else {
        $errors = $contact->getErrors();
    }
        }
            
 
     
    
   
   
 
}



$contacts = $contact->getAll();
?>  


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Contact form</title>
</head>
<body>
    

<div class="contact">

<div class="contact-header">
    <form action="" method="post" style="display: inline;">
        <button type="submit" class="logout" name="logout">Log Out</button>
    </form>
    <button><a href="showdata.php">Track Cookies & Sessions</a></button>
</div>

<?php if (!empty($contacts)): ?>
<table>
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Country</th>
    <th>Subject</th>
    <th>Date</th>
  </tr>
  <?php foreach ($contacts as $contact): ?>
  <tr>
    <td><?php echo htmlspecialchars($contact['firstname']) . " " . htmlspecialchars($contact['lastname']); ?></td>
    <td><?php echo htmlspecialchars($contact['email']); ?></td>
    <td><?php echo htmlspecialchars($contact['country']); ?></td>
    <td><?php echo htmlspecialchars($contact['subject']); ?></td>
    <td><?php echo htmlspecialchars($contact['date']); ?></td>
  </tr>
  <?php endforeach; ?>
</table>
<?php endif; ?>

    <h1>Contact Us</h1>
    
    <?php if ($contact_message): ?>
        <div class="message success-message"><?php echo $contact_message; ?></div>
    <?php endif; ?>
    
    <?php if (!empty($errors)): ?>
        <div class="message error-message">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
<div class="container">
  <form action="" method="post">
    <label for="fname">First Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Your name.." required>

    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name.." required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Your email.." required>

    <label for="country">Country</label>
    <select id="country" name="country">
      <option value="australia">Australia</option>
      <option value="canada">Canada</option>
      <option value="usa">USA</option>
    </select>

    <label for="subject">Subject</label>
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px" required></textarea>

    <input type="submit" name="submit_contact" value="Submit">
  </form>
</div>

    </div>
           <script src="../assets/main.js"></script>
</body>
</html>