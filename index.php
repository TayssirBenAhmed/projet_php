<?php include('header.php')?>

<div class="home-container">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-text">
            <h1>Manage Your Healthcare, Effortlessly 💜</h1>
            <p><em>Book appointments with ease and provide feedback to improve healthcare for everyone. 🌟</em></p>
            <a href="appointments.php" class="button-primary">Book an Appointment 🚀</a>
        </div>
        <div class="hero-image">
            <img src="https://static1.squarespace.com/static/56f2ebaea3360cd86ed27dc7/t/5ecfd9315167fa039bd063f1/1590679860774/healthcareportal.jpg?format=1500w" alt="Healthcare Management">
        </div>
    </div>

    <!-- Features Section -->
    <section class="features-section">
        <h2>Why Choose Us? 🌟</h2>
        <div class="features-grid">
            <div class="feature-item" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Appointments">
                </div>
                <h3>Easy Appointments</h3>
                <p>Quickly book, reschedule, or cancel your appointments with just a few clicks.</p>
            </div>
            <div class="feature-item" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135718.png" alt="Feedback">
                </div>
                <h3>Feedback for Better Care</h3>
                <p>Your voice matters. Share your experiences to help improve healthcare services.</p>
            </div>
            <div class="feature-item" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135770.png" alt="Secure System">
                </div>
                <h3>Secure and Confidential</h3>
                <p>Your data is protected with advanced encryption and privacy standards.</p>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works-section">
        <h2>How It Works 🧐</h2>
        <div class="steps-grid">
            <div class="step-item" data-aos="fade-right" data-aos-delay="100">
                <h3>1. Book an Appointment</h3>
                <p>Choose your preferred doctor, date, and time for your visit.</p>
            </div>
            <div class="step-item" data-aos="fade-right" data-aos-delay="200">
                <h3>2. Attend Your Appointment</h3>
                <p>Get reminders and manage your schedule seamlessly.</p>
            </div>
            <div class="step-item" data-aos="fade-right" data-aos-delay="300">
                <h3>3. Provide Feedback</h3>
                <p>Share your experience to help us improve our services.</p>
            </div>
        </div>
    </section>

    <!-- Appointment Call to Action -->
    <section class="cta-section">
        <h2>Book Your Appointment Today ✨</h2>
        <p>Take the first step toward better healthcare. Book now and let us handle the rest.</p>
        <a href="appointments.php" class="button-secondary">Book Now 📅</a>
        <a href="addreview.php" class="button-secondary-alt">Share Feedback 💬</a>
    </section>
</div>

<?php include('footer.php'); ?>

<!-- Modern CSS Styling -->
<style>
    /* General Styling */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Roboto', sans-serif;
        background: linear-gradient(135deg, #f8f9ff, #f7f1ff);
        color: #333;
        overflow-x: hidden;
    }

    .home-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Hero Section */
    .hero-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(135deg, #6a0dad, #f39c12);
        padding: 50px;
        border-radius: 15px;
        margin-bottom: 50px;
        color: white;
    }

    .hero-text {
        max-width: 50%;
    }

    .hero-text h1 {
        font-size: 3em;
        margin-bottom: 20px;
    }

    .hero-text p {
        font-size: 1.2em;
        margin-bottom: 30px;
    }

    .button-primary {
        display: inline-block;
        padding: 15px 30px;
        background: #ff8c00;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: background 0.3s, transform 0.3s;
    }

    .button-primary:hover {
        background: #e65100;
        transform: scale(1.05);
    }

    .hero-image img {
        max-width: 100%;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    /* Features Section */
    .features-section {
        text-align: center;
        padding: 50px 20px;
        background: white;
        border-radius: 15px;
        margin-bottom: 50px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .features-grid {
        display: flex;
        gap: 30px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .feature-item {
        background: #f8f9ff;
        padding: 20px;
        border-radius: 12px;
        max-width: 300px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
        text-align: center;
    }

    .feature-item:hover {
        transform: translateY(-10px) scale(1.05);
    }

    .feature-icon img {
        width: 100px;
        height: auto;
        margin-bottom: 15px;
    }

    .feature-item h3 {
        font-size: 1.5em;
        color: #f39c12;
        margin-bottom: 10px;
    }

    /* Steps Section */
    .how-it-works-section {
        padding: 50px 20px;
        background: #f4f4f9;
        border-radius: 15px;
        margin-bottom: 50px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .steps-grid {
        display: flex;
        justify-content: space-between;
        gap: 30px;
        flex-wrap: wrap;
    }

    .step-item {
        background: white;
        padding: 20px;
        border-radius: 12px;
        max-width: 300px;
        text-align: center;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    .step-item:hover {
        transform: translateY(-10px) scale(1.05);
    }

    .step-item h3 {
        font-size: 1.5em;
        color: #f39c12;
        margin-bottom: 10px;
    }

    /* Call to Action Section */
    .cta-section {
        text-align: center;
        padding: 50px 20px;
        background: linear-gradient(135deg, #f39c12, #ff8c00);
        color: white;
        border-radius: 15px;
    }

    .button-secondary {
        display: inline-block;
        padding: 15px 30px;
        background: #6a0dad;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: background 0.3s, transform 0.3s;
    }

    .button-secondary:hover {
        background: #4a008e;
        transform: scale(1.05);
    }

    .button-secondary-alt {
        margin-left: 15px;
        padding: 15px 30px;
        background: #ff8c00;
        color: #fff;
        border-radius: 8px;
        text-decoration: none;
    }

    .button-secondary-alt:hover {
        background: #e65100;
        transform: scale(1.05);
    }
    h1{
        color: white;
    }
</style>

<!-- Include AOS Library -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
