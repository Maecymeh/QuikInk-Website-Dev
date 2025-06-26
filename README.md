# QuikInk Tattoo Website (Development Version)

Welcome to the official development repository for **QuikInk Tattoo**, a modern-classic tattoo shop based in Novaliches, Quezon City.

This is the source code for the tattoo shop's static website, designed to showcase sample works, introduce the artist, and allow clients to send booking inquiries via a contact form.

---

## 🖥️ Website Overview

**Pages included:**

- **Home**  
  A video hero landing page highlighting the studio vibe and giving visitors instant navigation to samples and booking.

- **Sample Tattoos**  
  A simple, clean image gallery showcasing sample tattoo works.

- **About Me**  
  A personal introduction from the artist (Fernando), with a focus on style, story, and shop values.

- **Contact Me**  
  A contact form with file upload (optional image reference), PHPMailer backend, and auto-reply feature.

---

## 🛠️ Tech Stack

- **Frontend:**  
  HTML5, CSS3 (Responsive, with dark minimalist theme), JavaScript (for mobile nav toggle)

- **Backend (for contact form only):**  
  PHP 8+  
  PHPMailer  
  Gmail SMTP (secured through config file)

---

## 📧 Contact Form Configuration

- SMTP email details (Gmail app password and email) are stored securely in `config.php` (excluded from version control for security).
- The PHP contact form handles both admin notification and automatic reply to the client.

---

## 📂 Folder Structure

QuickInk Website/
├── css/
│ └── style.css
├── images/
├── js/
│ └── main.js
├── php/
│ ├── contact.php
│ └── config.php (NOT included in Git for security)
├── videos/
├── index.html
├── tattoos.html
├── about.html
├── contact.html
└── README.md


---

## 🚀 How to Run Locally

1. Place the project inside your local web server directory:  
   Example for XAMPP:  

2. Start **Apache** in XAMPP.

3. Open your browser and go to:  
http://localhost/QuickInk Website/


4. Test the contact form (SMTP requires working Gmail App Password).

---

## 🌐 Deployment Note

This is the **development version**.  
For production deployment:  
- Replace any localhost paths.
- Move images and assets to a live server.
- Use HTTPS.

---

## 📎 Author

**Fernando (QuikInk Tattoo)**  
Website by **Michael Diaz**

---

## 📌 Disclaimer

This website is only a self project (Michael) and I made this for educational and business demo purposes only. to incraese my skills in web development.
Email credentials and sensitive data should never be exposed in public repositories.

---
