<<<<<<< HEAD
# Photographers-Website-
=======
# 📸 Malcolm Lismore Photography Website

Malcolm Lismore is a **freelance photographer** based on the **North West coast of Scotland**, with a passion for capturing the **natural world**, including the rugged Scottish landscape, wildlife, and coastal birds. This website serves as a professional showcase for his photography and provides a platform for potential clients to make enquiries about hiring him for **weddings, portraits, and special occasions**.

---

## 🌐 Project Overview

This project was developed as a **web-based solution** to promote Malcolm’s photography business online.  
It allows visitors to:
- Explore his work through a beautiful and structured photo gallery.
- Learn more about Malcolm and his passion for photography.
- View photography pricing packages.
- Contact Malcolm directly via an enquiry form.

---

## 🧭 Website Structure

The website consists of the following pages:

1. **Home Page (`index.php`)**  
   - Acts as the main entry point of the site.  
   - Provides quick navigation to all other pages.  
   - Communicates the website’s purpose clearly with visual appeal.

2. **About Page (`about.html`)**  
   - Shares information about Malcolm’s background, experience, and passion for photography.

3. **Pricing Page (`pricing.html`)**  
   - Lists the pricing details for different photography packages such as weddings, events, and portraits.

4. **Gallery Pages (`gallery-view1.html` – `gallery-view6.html`)**  
   - Display Malcolm’s photography work across several themed galleries (landscapes, wildlife, events, etc.).  
   - The gallery is designed for easy future expansion to accommodate more images.

5. **Enquiry Form (`enquiry.html` & `submit_enquiry.php`)**  
   - Allows clients to submit booking or photography-related enquiries.  
   - Includes fields for name, contact details, event location, and date.  
   - Form data is securely stored in a database through the PHP backend.

---

## Technologies Used

| Category | Tools / Languages |
|-----------|------------------|
| Frontend | HTML5, CSS3 |
| Backend | PHP |
| Database | MySQL |
| Local Server | MAMP / XAMPP |
| Version Control | Git & GitHub |

---

## Database Connection

The file `db_connect.php` handles the database connection for enquiry form submissions.

Example snippet;
```php
<?php
$conn = mysqli_connect("localhost", "root", "", "malcolm_photography");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
>>>>>>> b02d0946c316e89f235d830b4dd23fcb7d4ff274
