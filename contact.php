<?php
include __DIR__ . '/includes/header.php';

echo '
<section class="contact-hero">
  <div class="hero-overlay">
    <img src="assets/icons/health-center.png" alt="Health Center" class="amenity-icon">
    <h3>Health Center</h3>
    <h1>Get In Touch With Us</h1>
  </div>
</section>

<section class="contact-section">
  <h2 class="section-title">Contact Us</h2>
  <p class="section-subtitle">
    If you have any questions, please do not hesitate to send us a message. 
    We reply within 24 hours!
  </p>

  <div class="contact-container">

    <div class="contact-info-box">
      <h3>Address</h3>
      <p>
        S.I.W.S. College, Plot No. 337, Sewree Wadala Estate,
        Major R. Parameshwaran Marg,<br>
        Mumbai – 400 031
      </p>

      <h3>Contact Us</h3>
      <p><i class="fa fa-phone"></i> 022 2418 0390</p>
      <p><i class="fa fa-envelope"></i> siws@siwscollege.edu.in</p>

      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3772.1613729704193!2d72.85442367496354!3d19.01833655304289!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7cf1dbebaf9cf%3A0x75f3c145b870e2ea!2sSIWS%20College!5e0!3m2!1sen!2sin!4v1709018571769!5m2!1sen!2sin" 
        width="100%" 
        height="250" 
        style="border:0; border-radius: 10px;" 
        allowfullscreen 
        loading="lazy">
      </iframe>
    </div>

    <div class="contact-form-box">
      <form action="submit_contact.php" method="post" class="contact-form">

        <div class="form-row">
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" placeholder="Your Name" required>
          </div>

          <div class="form-group">
            <label>Contact No.</label>
            <input type="text" name="contact" placeholder="Contact No." required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Your Email" required>
          </div>

          <div class="form-group">
            <label>Passed out from</label>
            <input type="text" name="passed_from" placeholder="Your School / College">
          </div>
        </div>

        <div class="form-group">
          <label>In the Year</label>
          <select name="year">
            <option value="">Select Year</option>
';

for ($y = date("Y"); $y >= 2000; $y--) {
    echo "<option>$y</option>";
}

echo '
          </select>
        </div>

        <div class="form-group">
          <label>Comments</label>
          <textarea name="comments" placeholder="Suggestions, if any"></textarea>
        </div>

        <div class="form-group checkbox">
          <label><input type="checkbox" name="newsletter"> Sign up for periodic newsletter</label>
        </div>

        <button type="submit" class="btn primary">Submit</button>

      </form>
    </div>

  </div>
</section>
';

include __DIR__ . '/includes/footer.php';
?>
