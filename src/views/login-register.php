  <div class="form-container container">
    <!-- Logo -->
    <div class="logo-container">
      <img src="assets/expat_tax_tools_logo.jpg" alt="Expat Tax Tools Logo" class="logo">
    </div>

    <!-- Tab header -->
    <div class="tabs">
      <div class="tab active" data-tab="register">Register</div>
      <div class="tab" data-tab="login">Login</div>
    </div>

    <!-- Alert Message -->
    <?php if (isset($_SESSION['message'])): ?>
      <div class="alert <?= htmlspecialchars($_SESSION['msg_type']); ?>">
        <?= htmlspecialchars($_SESSION['message']); ?>
      </div>
    <?php
      unset($_SESSION['message'], $_SESSION['msg_type']);
      endif;
     ?>



    <!-- Registration form -->
    <form id="registration-form" class="active" action="handle-register.php" method="POST">
      <h2>Register</h2>

      <!-- Contact information -->
      <label for="account_type">Account Type:</label>
      <select id="account_type" name="account_type" required>
        <option value="individual">Individual</option>
        <option value="company">Company</option>
      </select>

      <label for="full_name" id="name-label">Full Name:</label>
      <input type="text" name="full_name" required />


      <div id="contact-title-field" style="display: none;">
        <label for="contact_title">Contact Title:</label>
        <input type="text" name="contact_title" />
      </div>

      <label for="phone_number">Phone Number:</label>
      <input type="tel" name="phone_number" />
      
      <!-- Account information -->
      <label for="email">Email:</label>
      <input type="email" name="email" required />

      <label for="username">Username:</label>
      <input type="text" name="username" required />

      <label for="password">Password:</label>
      <input type="password" name="password" required />

      <button type="submit">Register</button>
    </form>

    <!-- Login form -->
    <form id="login-form" action="handle-login.php" method="POST">
      <h2>Login</h2>
      
      <label for="email">Email:</label>
      <input type="email" name="email" required />

      <label for="password">Password:</label>
      <input type="password" name="password" required />

      <button type="submit">Login</button>
    </form>
  </div>
