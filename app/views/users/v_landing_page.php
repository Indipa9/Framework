<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MelodyLink</title>
  <link rel="stylesheet" href="<?php echo URLROOT; ?>public/css/components/landing_page.css"></a>
</head>
<body>
  <!-- Hero Section -->
  <header class="hero">
    <nav class="navbar">
      <div class="logo">
        <img src="<?php echo URLROOT; ?>public/img/logo.png" alt="MelodyLink Logo" />
        <span>MelodyLink</span>
      </div>
      <ul class="nav-links">
        <li><a href="<?php echo URLROOT; ?>/events">Events</a></li>
        <li><a href="#">Marketplace</a></li>
        <li><a href="#">Suppliers</a></li>
        <li><a href="#">Artists</a></li>
        <li><a href="<?php echo URLROOT; ?>/users/login" class="sign-in">Sign In</a></li>
      </ul>
    </nav>

    <div class="hero-content">
      <h1>Everything About<br>Music In One Place</h1>
      <p>Connect with event organizers, artists, suppliers, and fellow music lovers in the ultimate music community platform.</p>
      <div class="hero-buttons">
        <a href="#" class="btn-primary">Get Started</a>
        <a href="#" class="btn-outline">Explore Events</a>
      </div>
    </div>
  </header>

  <!-- Features Section -->
  <section class="features">
    <h2>Everything You Need For Your Music Event</h2>
    <p class="subtitle">One platform, endless possibilities for your music journey</p>
    <div class="feature-cards">
      <div class="feature-card purple">
        <div class="icon">🎟️</div>
        <h3>Event Booking & Ticketing</h3>
        <p>Seamless booking experience for all your favorite music events</p>
      </div>
      <div class="feature-card blue">
        <div class="icon">🛍️</div>
        <h3>Merchandise Marketplace</h3>
        <p>Shop exclusive merchandise from your favorite artists</p>
      </div>
      <div class="feature-card red">
        <div class="icon">🚛</div>
        <h3>Supplier Rentals</h3>
        <p>Find and hire the best equipment suppliers for your event</p>
      </div>
      <div class="feature-card dark-purple">
        <div class="icon">⭐</div>
        <h3>Artist Promotion</h3>
        <p>Promote your talent and connect with fans directly</p>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="testimonials">
    <h2>Trusted by Industry Leaders</h2>
    <div class="testimonial-cards">
      <div class="testimonial-card">
        <div class="user">
          <img src="<?php echo URLROOT; ?>public/img/user1.png" alt="Mike Johnson"/>
          <div>
            <strong>Mike Johnson</strong><br />
            <span>Event Organizer</span>
          </div>
        </div>
        <p>"MelodyLink has revolutionized how we organize music events. The platform is intuitive and comprehensive."</p>
      </div>
      <div class="testimonial-card">
        <div class="user">
          <img src="<?php echo URLROOT; ?>public/img/user2.jpg"  alt="Sarah Chen"/>
          <div>
            <strong>Sarah Chen</strong><br />
            <span>Artist</span>
          </div>
        </div>
        <p>"As an artist, I've found the perfect platform to connect with my fans and manage my events."</p>
      </div>
      <div class="testimonial-card">
        <div class="user">
          <img src="<?php echo URLROOT; ?>public/img/user3.jpeg" alt="David Smith"/>
          <div>
            <strong>David Smith</strong><br />
            <span>Equipment Supplier</span>
          </div>
        </div>
        <p>"The rental management system is top-notch. It's helped us reach more clients efficiently."</p>
      </div>
    </div>
  </section>

    <!-- CTA & Footer Section -->
    <section class="cta-footer">
        <div class="cta-section">
          <h2>Ready to Join the Music Revolution?</h2>
          <p>Get started today and be part of the largest music event community</p>
          <a href="#" class="btn-primary">Sign Up Now</a>
        </div>
    
</body>
</html>
<?php require APPROOT . '/views/inc/footer.php'; ?>