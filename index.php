<?php
session_start();
include 'db_connect.php';

$feedbackMsg = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        $feedbackMsg = "<p style='color: green;'>Thank you! Your message has been sent.</p>";
    } else {
        $feedbackMsg = "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malcolm Lismore Photography</title>
    <link rel="stylesheet" href="style.css">

    <style>
      /* Mobile menu styling */
      .menu-toggle {
    display: none;
    font-size: 18px;
    cursor: pointer;
    color: rgb(184, 184, 65); /* Yellow color */
    z-index: 1000;
    position: fixed; /* Ensures the icon stays in place */
    top: 15px; /* Adjusted to move the icon closer to the top */
    right: 10px; /* Moves the icon further to the right */
}
@media screen and (max-width: 768px) {
    /* Display navigation on mobile */
    nav {
        display: none;
        flex-direction: column;
        background-color: #333; /* Dark background for the mobile menu */
        position: absolute;
        top: 70px;
        left: 0;
        width: 100%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        z-index: 999;
    }
    .menu-toggle {
        display: block;
        font-size: 18px; /* Icon size */
        position: fixed; /* Fixes the position on screen */
        top: 15px; /* Adjust the top distance */
        right: 15px; /* Adjust the right distance */
    }
    nav ul {
        flex-direction: column;
        margin: 0;
        padding: 0;
    }

    nav ul li {
        text-align: center;
        padding: 12px 0;
    }

    nav ul li a {
        color: #fff; /* White color for links in the mobile menu */
        text-decoration: none;
        padding: 10px 20px;
        display: block;
    }

    nav ul li a:hover {
        background-color: #FF5733; /* Highlight color on hover */
        color: #fff; /* Ensure text remains white on hover */
    }

    nav.show {
        display: flex;
    }

    .sign-in-link {
        display: none;
    }

    /* Ensure the header title is visible on mobile */
    header h1 {
        font-size: 24px;
        text-align: center;
        margin-top: 10px;
    }

    .menu-toggle {
        display: block;
        position: absolute;
        top: 20px;
        right: 20px;
    }
}

        
    </style>
</head>

<body>
    <header>
        <h1>Malcolm Lismore Photography</h1>
        <button class="menu-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </button>
        <nav>
            <ul id="navList">
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="pricing.html">Pricing</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li><a href="enquiry.html">Enquiry</a></li>
                <li><a href="signin.php"><button class="sign-in-btn">Sign In</button></a></li>
            </ul>
        </nav>
    </header>

    <section id="home">
        <div class="cover">
            <img src="pexels-peng-liu-45946-169647.jpg" alt="Cover Photo of Scottish Landscape">
            <div class="cover-text">
                <h2>Welcome to Malcolm Lismore Photography</h2>
                <p>Capturing the beauty of Scotland’s landscapes, wildlife, and special moments.</p>
            </div>
        </div>
    </section>

    <section id="about" class="about">
        <h2>About Malcolm Lismore</h2>
        <p>Malcolm Lismore is a professional photographer based in Scotland, specializing in breathtaking landscape, wildlife, and event photography. With over 10 years of experience, Malcolm captures the essence of nature through his lens, bringing out the true beauty in every shot.</p>
    </section>

    <section id="services" class="services">
        <h2>Our Services</h2>
        <ul>
            <li>Landscape Photography</li>
            <li>Wildlife Photography</li>
            <li>Event Photography</li>
            <li>Custom Portraits</li>
            <li>Wedding Photography</li>
        </ul>
    </section>

    <!-- Contact Us Section -->
    <section id="contact" class="contact">
        <h2>Contact Us</h2>
        <p>Have any questions, inquiries, or just want to get in touch? Fill out the form below and we’ll get back to you soon.</p>

        <form id="feedback-form" action="index.php" method="POST">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required>

            <label for="email">Your Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address" required>

            <label for="message">Your Message</label>
            <textarea id="message" name="message" placeholder="Type your message here..." rows="5" required></textarea>

            <button type="submit">Send Message</button>
        </form>

        <!-- Show success/error message -->
        <?php echo $feedbackMsg; ?>
    </section>

    <footer>
        <p>&copy; 2025 Malcolm Lismore Photography. All rights reserved.</p>
        <div class="contact-details">
            <p>Contact Us:</p>
            <p>Email: <a href="mailto:info@malcolmlismorephoto.com">info@malcolmlismorephoto.com</a></p>
            <p>Phone: +44 123 456 789</p>
            <p>Address: 123 Photography St, Edinburgh, Scotland</p>
        </div>
        <div class="social-media">
            <p>Follow Us:</p>
            <a href="https://www.facebook.com" target="_blank" class="social-icon"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="https://www.twitter.com" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="https://www.linkedin.com" target="_blank" class="social-icon"><i class="fab fa-linkedin"></i></a>
        </div>
    </footer>

    <script>
        const toggle = document.getElementById('menuToggle');
        const nav = document.querySelector('nav');

        toggle.addEventListener('click', () => {
            nav.classList.toggle('show');
        });
    </script>
</body>
</html>
