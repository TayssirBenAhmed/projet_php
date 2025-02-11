<body>
<div class="about-container">
    <!-- Header Section -->
    <header class="about-header">
        <h1 class="animated-title">🚀 Elevate Your Healthcare Experience with CliniSys 🚀</h1>
        <p class="animated-text">CliniSys is your ultimate platform to simplify healthcare interactions. Designed for patients, it allows you to easily book appointments, provide feedback, and streamline your healthcare journey !</p>
        <div class="header-image">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ41jyvWBPajau4yWd5wD5sMotO2ylV1bStvg&s" alt="Healthcare Solutions">
        </div>
    </header>

    <main class="about-main">
        <!-- Section 1: Mission -->
        <section class="about-section">
            <div class="content">
                <h2 class="section-title">✨ Our Mission</h2>
                <p class="section-text">At CliniSys, we aim to make healthcare easier, faster, and more transparent for everyone. Our platform bridges the gap between patients and healthcare providers with cutting-edge technology.</p>
                <ul>
                    <li>⏰ Fast appointment scheduling</li>
                    <li>💬 Seamless feedback collection</li>
                    <li>📊 Actionable insights for healthcare providers</li>
                </ul>
            </div>
            <div class="image-container">
                <img src="https://images.unsplash.com/photo-1511174511562-5f7f18b874f8?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=800" alt="Mission Image">
            </div>
        </section>

        <!-- Section 2: Features -->
        <section class="about-section reverse">
            <div class="image-container">
                <img src="https://images.unsplash.com/photo-1526256262350-7da7584cf5eb?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=800" alt="Features Image">
            </div>
            <div class="content">
                <h2 class="section-title">🌟 Key Features</h2>
                <p class="section-text">CliniSys is designed with your convenience in mind. Here are the standout features:</p>
                <ul>
                    <li>📅 Instant appointment bookings at your fingertips</li>
                    <li>🔔 Real-time notifications and reminders</li>
                    <li>🛡️ Secure data management for peace of mind</li>
                    <li>📈 Analytics to optimize healthcare operations</li>
                </ul>
            </div>
        </section>

        <!-- Section 3: Why Us -->
        <section class="about-section">
            <div class="content">
                <h2 class="section-title">🌍 Why Choose CliniSys?</h2>
                <p class="section-text">Trusted by over 110 hospitals in North Africa, CliniSys is the most efficient platform for simplifying the healthcare experience. Here’s why:</p>
                <ul>
                    <li>⏱️ Fast and simple appointment scheduling</li>
                    <li>📝 Feedback forms to improve care</li>
                    <li>📞 Always available, 24/7, for your convenience</li>
                </ul>
            </div>
            <div class="image-container">
                <img src="https://media.istockphoto.com/id/1441979374/photo/medical-team-meeting.jpg?s=612x612&w=0&k=20&c=2DM74ZVh8bv4hS5lbTKTnbozb9pR6-QeIk5zf2SFdoo=" alt="Why Choose Us">
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <footer class="about-footer">
        <p>🌟 Join the revolution in healthcare with CliniSys. Book, review, and simplify your healthcare journey. 🚀</p>
    </footer>
</div>
</body>

<!-- CSS for Ultra Attractive, Modern Design -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #8e44ad, #f39c12);
        color: #fff;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    .about-container {
        max-width: 1200px;
        margin: 50px auto;
        padding: 20px;
        background: #fff;
        border-radius: 25px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    .about-header {
        text-align: center;
        padding: 60px 20px;
        background: linear-gradient(135deg, #6a0dad, #f39c12);
        color: white;
        border-radius: 25px 25px 0 0;
        animation: headerAnimation 1.5s ease-out;
    }

    .about-header h1 {
        font-size: 3.8rem;
        margin: 20px 0;
        animation: slideInUp 1s ease-out;
    }

    .about-header p {
        font-size: 1.5rem;
        line-height: 1.7;
        animation: fadeIn 2s ease-in-out;
    }

    .about-header .header-image img {
        margin-top: 25px;
        max-width: 100%;
        border-radius: 20px;
        animation: zoomIn 1.5s ease-out;
    }
.section-text{
    color:black;
}
    .about-main {
        padding: 50px 20px;
    }

    .about-section {
        display: flex;
        align-items: center;
        margin-bottom: 60px;
        gap: 30px;
        transition: transform 0.4s ease;
    }

    .about-section.reverse {
        flex-direction: row-reverse;
    }

    .about-section:hover {
        transform: translateY(-10px);
    }

    .about-section .content {
        flex: 1;
        animation: fadeInLeft 1.5s ease-out;
    }

    .about-section .image-container {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }
li{
    color:#6a0dad;
}
    .about-section .image-container img {
        max-width: 90%;
        border-radius: 20px;
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
        animation: zoomIn 1s ease-out;
    }

    .about-section h2 {
        font-size: 2.5rem;
        margin-bottom: 25px;
        color: #6a0dad;
        animation: slideInDown 1s ease-out;
    }

    .about-section p, ul {
        font-size: 1.3rem;
        line-height: 1.8;
    }

    .about-section ul {
        padding-left: 25px;
        list-style-type: none;
    }

    .about-section ul li {
        margin-bottom: 15px;
        position: relative;
        padding-left: 35px;
    }

    .about-section ul li::before {
        content: "⚡";
        position: absolute;
        left: 0;
        color: #f39c12;
        font-size: 1.6rem;
    }

    .about-footer {
        text-align: center;
        padding: 30px;
        background: linear-gradient(135deg, #6a0dad, #f39c12);
        color: white;
        font-size: 1.4rem;
        border-radius: 0 0 25px 25px;
    }

    @media (max-width: 768px) {
        .about-section {
            flex-direction: column;
        }

        .about-section.reverse {
            flex-direction: column;
        }
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideInUp {
        from {
            transform: translateY(50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes slideInDown {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes fadeInLeft {
        from {
            transform: translateX(-50px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes zoomIn {
        from {
            transform: scale(0.8);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes headerAnimation {
        0% {
            transform: scale(0.8);
            opacity: 0;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>
