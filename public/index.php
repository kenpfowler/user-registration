<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Auth Tabs</title>
  <link rel="stylesheet" href="styles.css" />
</head>

<body>
  <div class="tabs">
    <div class="tab active" data-tab="register">Register</div>
    <div class="tab" data-tab="login">Login</div>
  </div>

  <div class="form-container">
    <form id="registration-form" class="active" action="handle-register.php" method="POST">
      <h2>Register</h2>

      <label for="account_type">Account Type:</label>
      <select id="account_type" name="account_type" required>
        <option value="individual">Individual</option>
        <option value="company">Company</option>
      </select>

      <div id="contact-title-field" style="display: none;">
        <label for="contact_title">Contact Title:</label>
        <input type="text" name="contact_title" />
      </div>
      
      <label for="username">Username:</label>
      <input type="text" name="username" required />

      <label for="email">Email:</label>
      <input type="email" name="email" required />

      <label for="password">Password:</label>
      <input type="password" name="password" required />

      <label for="full_name" id="name-label">Full Name:</label>
      <input type="text" name="full_name" required />

      <label for="phone_number">Phone Number:</label>
      <input type="tel" name="phone_number" />

      <button type="submit">Register</button>
    </form>

    <form id="login-form" action="handle-login.php" method="POST">
      <h2>Login</h2>

      <label for="email">Email:</label>
      <input type="email" name="email" required />

      <label for="password">Password:</label>
      <input type="password" name="password" required />

      <button type="submit">Login</button>
    </form>
  </div>
   <script src="script.js"></script>
</body>
</html>
