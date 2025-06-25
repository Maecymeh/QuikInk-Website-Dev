// Toggle mobile menu
document.getElementById("menuToggle").addEventListener("click", () => {
    document.getElementById("navLinks").classList.toggle("active");
  });
  
  // Show contact form success/fail messages
  document.addEventListener("DOMContentLoaded", () => {
    const query = new URLSearchParams(window.location.search);
    const status = query.get("status");
  
    if (status === "success" || status === "fail") {
      const messageDiv = document.createElement("div");
      messageDiv.textContent =
        status === "success"
          ? "✅ Your message has been sent successfully."
          : "❌ Message failed to send. Please try again later.";
  
      messageDiv.style.cssText =
        "text-align:center; color:" +
        (status === "success" ? "limegreen" : "red") +
        "; margin-top:20px; font-weight:bold;";
  
      const contactForm = document.querySelector("main.contact-form");
      if (contactForm) {
        contactForm.prepend(messageDiv);
      }
  
      // Remove ?status=... from URL without reloading
      window.history.replaceState({}, document.title, window.location.pathname);
    }
  });
