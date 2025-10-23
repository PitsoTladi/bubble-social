<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Manage Account</title>
  <style>
    /* Basic page styling */
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background: #f9f9f9;
    }

    h1 {
      margin-bottom: 10px;
    }

    ul {
      list-style-type: none;
      padding-left: 0;
    }

    li {
      margin-bottom: 10px;
      font-size: 18px;
    }

    a {
      cursor: pointer;
    }

    /* Modal Styles */
    .modal {
      display: none; /* Hidden by default */
      position: fixed;
      z-index: 999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
      background-color: #fff;
      margin: 10% auto;
      padding: 20px 30px;
      border-radius: 5px;
      width: 90%;
      max-width: 400px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      position: relative;
    }

    .modal-content h2 {
      margin-top: 0;
    }

    .close {
      color: #aaa;
      position: absolute;
      right: 15px;
      top: 10px;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
      transition: color 0.3s ease;
    }

    .close:hover {
      color: black;
    }

    /* Links color */
    #open-delete {
      color: red;
    }
    #open-new-mail, #open-new-pass {
      color: blue;
    }
    #open-logout {
      color: orange;
    }

    /* Layout styling */
    .wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 30px;
      margin-top: 40px;
    }

    .box {
      background-color: white;
      border: 1px solid #ddd;
      padding: 20px 30px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      width: 90%;
      max-width: 500px;
    }
  </style>
</head>

<?php
  echo '<br>';
 include '../includes/navbar.php';

 ?>
<body>

  <div class="wrapper">
    <div class="acc_management box">
      <h1>Manage Account</h1>
      <ul>
        <li>Change Email address 
          <a href="#" id="open-new-mail" style="text-decoration: none;">new Email</a>
        </li>
        <li>Change password 
          <a href="#" id="open-new-pass" style="text-decoration: none;">new Password</a>
        </li>
        <li>Delete Account 
          <a href="#" id="open-delete" style="text-decoration: none;">Delete</a>
        </li>
        <li>Logout 
          <a href="#" id="open-logout" style="text-decoration: none;">Logout</a>
        </li>
      </ul>
    </div>

    <div class="Preferences box">
      <h1>Preferences</h1>
      <ul>
        <li>Theme</li>
        <li>Font size</li>
      </ul>
    </div>
  </div>

  <!-- New Email Modal -->
  <div id="modal-new-mail" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Change Email Address</h2>
      <form action="../includes/change_mail.php" method="POST">
        <label for="newEmail">New Email:</label><br />
        <input type="email" id="newEmail" name="newEmail" required /><br /><br />
        <?php if (isset($_GET['message']) && $_GET['message'] === 'success'): ?>
    <p style="color: green;">Email successfully updated!</p>
    <?php endif; ?>
        <button type="submit" name="newEmail_confirm" style="background-color: purple; color: white;padding:8px 16px; border:none; cursor:pointer;">Submit</button>

      </form>
    </div>
  </div>

   <!-- New Password Modal -->
  <div id="modal-new-pass" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Change Password</h2>
      <form action="../includes/change_password.php" method="POST">
        <label for="currentPass">Current Password:</label><br />
        <input type="password" id="currentPass" name="currentPass" required /><br /><br />

        <label for="newPass">New Password:</label><br />
        <input type="password" id="newPass" name="newPass" required /><br /><br />

        <label for="newPass-confirm">Confirm New Password:</label><br />
        <input type="password" id="newPass-confirm" name="newPass-confirm" required /><br /><br />

        <?php if (!empty($err_msg)): ?>
          <p style="color: red;"><?php echo htmlspecialchars($err_msg); ?></p>
        <?php endif; ?>

        <?php if (!empty($success_msg)): ?>
          <p style="color: green;"><?php echo htmlspecialchars($success_msg); ?></p>
        <?php endif; ?>

        <button type="submit" name="newpassbtn" style="background-color: purple; color: white;padding:8px 16px; border:none; cursor:pointer;">Submit</button>
      </form>
    </div>
  </div>

  <!-- Delete Account Modal -->
   <div id="modal-delete" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Delete Account</h2>
      <p>Are you sure you want to delete your account? This action cannot be undone.</p>
      <form action="../includes/deleteAccount.php" method="POST">
        <button type="submit" style="background-color:red; color:white; padding:8px 16px; border:none; cursor:pointer;" name = 'delete'>
          Yes, Delete My Account
        </button>
      </form>
    </div>
  </div>
  

  <!-- Logout Modal -->
   <div id="modal-logout" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Logout</h2>
        <p>Are you sure you want to logout?</p>
        <div style="text-align: right;">
          <form action = '../includes/logout.php' method="POST" style="display:inline;">
            <button type="submit" name="cancel" style="background-color: purple; color: white;padding:8px 16px; border:none; cursor:pointer; margin-right: 10px">Cancel</button>
          </form>
          <form action = '../includes/logout.php' method="POST" style="display:inline;">
            <button type="submit" name="logoutbtn" style="background-color: purple; color: white;padding:8px 16px; border:none; cursor:pointer;">Logout</button>
          </form>
        </div>
      </div>
    </div>
  

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const modals = {
        newMail: document.getElementById("modal-new-mail"),
        newPass: document.getElementById("modal-new-pass"),
        deleteAcc: document.getElementById("modal-delete"),
        logout: document.getElementById("modal-logout")
      };

      const openBtns = {
        newMail: document.getElementById("open-new-mail"),
        newPass: document.getElementById("open-new-pass"),
        deleteAcc: document.getElementById("open-delete"),
        logout: document.getElementById("open-logout")
      };

      const closeBtns = document.querySelectorAll(".modal .close");

      // Open modal when clicking link
      Object.keys(openBtns).forEach(key => {
        openBtns[key].addEventListener("click", (e) => {
          e.preventDefault();
          modals[key].style.display = "block";
        });
      });

      // Close modal on close button click
      closeBtns.forEach(btn => {
        btn.addEventListener("click", () => {
          btn.closest(".modal").style.display = "none";
        });
      });

      // Cancel buttons for logout and delete modals
      const cancelLogoutBtn = document.getElementById("cancel-logout");
      if (cancelLogoutBtn) {
        cancelLogoutBtn.addEventListener("click", () => {
          modals.logout.style.display = "none";
        });
      }

      const cancelDeleteBtn = document.getElementById("cancel-delete");
      if (cancelDeleteBtn) {
        cancelDeleteBtn.addEventListener("click", () => {
          modals.deleteAcc.style.display = "none";
        });
      }

      // Close modal when clicking outside modal content
      window.addEventListener("click", (e) => {
        Object.values(modals).forEach(modal => {
          if (e.target === modal) {
            modal.style.display = "none";
          }
        });
      });
    });
  </script>
</body>
</html>
