<?php include __DIR__.'/includes/header.php'; ?>

<?php
// generate CSRF token once per session
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$submitted = isset($_GET['submitted']) && $_GET['submitted'] === '1';
$error = $_GET['error'] ?? '';
?>

<section class="section">
  <h2>Admissions</h2>
  <p>Start your application below. Choose the right program and submit your details.</p>

  <?php if ($submitted): ?>
    <div class="alert success">✅ Application submitted successfully. We’ll contact you by email.</div>
  <?php elseif (!empty($error)): ?>
    <div class="alert error">❌ <?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <div class="cards">
    <a class="card" href="#apply"><h4>Apply Now</h4><p>UG, PG, and Doctoral</p></a>
    <a class="card" href="#eligibility"><h4>Eligibility</h4><p>Program-wise criteria</p></a>
    <a class="card" href="#schedule"><h4>Schedule & Fees</h4><p>Dates and fee details</p></a>
    <a class="card" href="#docs"><h4>Documents</h4><p>What to keep ready</p></a>
  </div>
</section>

<section id="eligibility" class="section">
  <h3>Eligibility</h3>
  <ul class="list">
    <li><strong>Undergraduate:</strong> HSC or equivalent.</li>
    <li><strong>Postgraduate:</strong> Relevant UG degree with minimum marks.</li>
    <li><strong>Doctoral:</strong> Master’s degree; entrance/qualifying test as applicable.</li>
  </ul>
</section>

<section id="schedule" class="section">
  <h3>Admission Schedule & Fee Details</h3>
  <ul class="list">
    <li><strong>Applications Open:</strong> Ongoing</li>
    <li><strong>Orientation:</strong> Refer announcements</li>
    <li><strong>Fee Payment:</strong></li>
    <div class="info-box">
      <h3>Fee Structure</h3>
      <p>Click below to view the detailed fee structure for all programs.</p>
      <a href="fees.php" class="btn primary">View Fee Structure</a>
    </div>
  </ul>
</section>

<section id="docs" class="section">
  <h3>Required Documents</h3>
  <ul class="list">
    <li><strong>ID Proof:</strong> Aadhaar Card</li>
    <li><strong>Marksheets:</strong> 10th, 12th, Graduation (as applicable)</li>
    <li><strong>Photos:</strong> Passport size photograph</li>
  </ul>
</section>

<section id="apply" class="section">
  <h3>Apply Now</h3>
  <form class="form" method="POST" action="process/admission_process.php" novalidate>
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <div class="grid-2">
      <div>
        <label for="fullname">Full Name</label>
        <!-- ✅ Fixed name attribute -->
        <input id="fullname" name="full_name" type="text" required>
      </div>
      <div>
        <label for="email">Email</label>
        <input id="email" name="email" type="email" required>
      </div>
      <div>
        <label for="phone">Phone</label>
        <input id="phone" name="phone" type="tel" required>
      </div>
      <div>
        <label for="program">Program</label>
        <select id="program" name="program" required>
          <option value="">Select</option>
          <option>Undergraduate</option>
          <option>Postgraduate</option>
          <option>Doctoral</option>
        </select>
      </div>
      <div class="full">
        <label for="course">Course</label>
        <input id="course" name="course" type="text" placeholder="e.g., BSc IT" required>
      </div>
    </div>
    <button type="submit" class="btn primary">Submit Application</button>
  </form>
</section>

<?php include __DIR__.'/includes/footer.php'; ?>
