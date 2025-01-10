<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Student Mentoring Portal | Brainware University</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJX3QJtIHq6w8p4+ISXYxX3I6w8vR+fu5NkdTk59y+XbiI4D02jbl5WqM6rJ" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            color: #333;
        }

        .container {
            max-width: 100%;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #3498db, #2ecc71);
            color: white;
            text-align: center;
            padding: 40px 20px;
            margin-bottom: 30px;
            border-bottom: 4px solid #fff;
            position: relative;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .hero-section h1 {
            font-size: 1.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
            animation: fadeIn 2s ease-out;
        }

        .hero-section p {
            font-size: 1rem;
            font-weight: 400;
            opacity: 0.8;
            line-height: 1.6;
            animation: fadeIn 2s ease-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* About Us Section */
        .section-title {
            font-size: 2rem;
            font-weight: 600;
            color: #34495e;
            text-align: center;
            margin-bottom: 30px;
            letter-spacing: 1px;
            text-transform: uppercase;
            animation: fadeIn 2s ease-out;
        }

        .about-us-content {
            display: flex;
            justify-content: space-between;
            gap: 40px;
            margin-top: 30px;
            animation: fadeIn 2s ease-out;
        }
        .about-us-left{
            margin-left: 3%;
        }
        .about-us-right {
            margin-right: 3%;
        }


        .about-us-left,
        .about-us-right {
            flex: 1;
            text-align: left;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .about-us-left:hover,
        .about-us-right:hover {
            transform: translateY(-5px);
        }

        .about-us-left h3,
        .about-us-right h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2ecc71;
            margin-bottom: 15px;
        }

        .values-list ul {
            padding-left: 20px;
        }

        .values-list ul li {
            margin-bottom: 12px;
            position: relative;
            font-size: 1.1rem;
        }

        .values-list ul li::before {
            content: "•";
            position: absolute;
            left: -20px;
            font-size: 1.2rem;
            color: #3498db;
        }

        /* Location Section */
        .location-section {
            background-color: #34495e;
            color: white;
            padding: 60px 20px;
            position: relative;
            margin-top: 50px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1.5s ease-out;
        }

        .location-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .location-info {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #fff;
            margin-bottom: 30px;
            text-align: center;
        }

        .location-info p {
            margin-bottom: 15px;
        }

        .location-info i {
            font-size: 1.6rem;
            margin-right: 10px;
            color: #2ecc71;
        }

        #location .btn {
            background-color: #2ecc71;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 30px;
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        #location .btn:hover {
            background-color: #27ae60;
            transform: translateY(-5px);
        }

        .google-map {
            position: relative;
            overflow: hidden;
            padding-bottom: 56.25%;
            height: 0;
            max-width: 100%;
            width: 100%;
            border-radius: 10px;
        }

        .google-map iframe {
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
            border-radius: 10px;
        }

        /* Hover Effects */
        .location-info:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        /* Footer Section */
        footer {
            background-color: #34495e;
            color: white;
            padding: 30px 20px;
            text-align: center;
            margin-top: 60px;
        }

        footer a {
            color: #1abc9c;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        footer i {
            font-size: 1.5rem;
            margin-right: 15px;
            transition: transform 0.3s ease;
        }

        footer i:hover {
            transform: scale(1.1);
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 1.4rem;
            }

            .hero-section p {
                font-size: 0.9rem;
            }

            .about-us-content {
                flex-direction: column;
                align-items: center;
            }

            .about-us-left,
            .about-us-right {
                width: 100%;
                text-align: center;
                margin-bottom: 20px;
            }

            .location-title {
                font-size: 2rem;
            }

            .location-info {
                font-size: 1rem;
            }

            .google-map iframe {
                border-radius: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Welcome to the Student Mentoring Portal</h1>
            <p>Empowering students with guidance, support, and mentorship to succeed academically and personally. Let's achieve success together!</p>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="about-us py-5">
        <div class="container">
            <h2 class="section-title">About Us</h2>
            <div class="about-us-content">
                <div class="about-us-left ">
                    <h3>Our Vision</h3>
                    <p>The Student Mentoring Portal at Brainware University is committed to providing personalized mentorship to every student. Our vision is to empower students with the skills, guidance, and support needed to achieve academic success and grow personally.</p>
                </div>
                <div class="about-us-right">
                    <h3>Our Values</h3>
                    <ul class="values-list">
                        <li><strong>Guidance:</strong> Offering expert guidance and advice to help students thrive.</li>
                        <li><strong>Support:</strong> Providing emotional and academic support to foster success.</li>
                        <li><strong>Development:</strong> Focusing on holistic development through mentoring programs.</li>
                        <li><strong>Empowerment:</strong> Encouraging students to take charge of their learning journey.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Location Section -->
    <section class="location-section" id="location">
        <div class="container">
            <h2 class="location-title">Visit Us</h2>
            <div class="row">
                <!-- Location Text and Button -->
                <div class="col-md-6">
                    <div class="location-info">
                        <p class="location-address">
                            <i class="bi bi-geo-alt-fill"></i>
                            Brainware University<br>
                            Plot 2, Sector V, Salt Lake City, Kolkata, West Bengal 700091, India
                        </p>
                        <a href="https://goo.gl/maps/2UdgXMz7RcpRNeHg8" target="_blank" class="btn btn-light btn-lg" id="get-directions">Get Directions</a>
                    </div>
                </div>
                <!-- Google Map -->
                <div class="col-md-6">
                    <div class="google-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3540.15678122957!2d88.42567221512207!3d22.576497648536085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0274f1d1b3300f%3A0xa0b16b7348ef748a!2sBrainware%20University!5e0!3m2!1sen!2sin!4v1696574026640!5m2!1sen!2sin" frameborder="0" style="border:0; width: 100%; height: 100%;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <p><a href="mailto:info@brainwareuniversity.edu.in">Contact Us</a></p>
        <p>Phone: +91 123 456 7890 | Email: info@brainwareuniversity.edu.in</p>
        <p>Follow us on:</p>
        <p>
            <a href="https://facebook.com/brainwareuniversity" target="_blank">
                <i class="bi bi-facebook" style="font-size: 1.5rem; color: #1877f2; margin-right: 15px;"></i>
            </a>
            <a href="https://twitter.com/brainwareuniv" target="_blank">
                <i class="bi bi-twitter" style="font-size: 1.5rem; color: #1da1f2; margin-right: 15px;"></i>
            </a>
            <a href="https://instagram.com/brainwareuniversity" target="_blank">
                <i class="bi bi-instagram" style="font-size: 1.5rem; color: #e4405f;"></i>
            </a>
        </p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0o6lD4YyaXciD8iK5DX6SHVjl/8cUGiXltI5R2j5rdGHqqM3" crossorigin="anonymous"></script>

</body>
</html>
