 <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register_btn"])) {
            $fullName = $_POST["fulname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirm"];

            // Perform input validation
            $errors = array();
            if (empty($fullName) || empty($email) || empty($password) || empty($confirmPassword)) {
                $errors[] = "All fields are required.";
            } elseif ($password !== $confirmPassword) {
                $errors[] = "Passwords do not match.";
            } else {
                // Validate email format (you can use a regex or filter_var)
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Invalid email format.";
                }

                // Perform additional validation if needed

                // Send confirmation email (You'll need to set up email sending)
                $to = $email;
                $subject = "Registration Confirmation";
                $message = "Thank you for registering!";
                $headers = "From: your@example.com";

                if (mail($to, $subject, $message, $headers)) {
                    echo '<div class="confirmation-message">';
                    echo '<p>Registration successful! Confirmation email sent.</p>';
                    echo '</div>';
                } else {
                    echo '<div class="error-message">';
                    echo '<p>Error sending confirmation email.</p>';
                    echo '</div>';
                }
            }

            if (!empty($errors)) {
                echo '<div class="error-message">';
                foreach ($errors as $error) {
                    echo '<p>' . $error . '</p>';
                }
                echo '</div>';
            }
        }
        ?>
    