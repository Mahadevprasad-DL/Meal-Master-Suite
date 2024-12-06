<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - StarMess</title>
    <style>
        /* Reset and basic styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f8fafc;
            color: #333;
        }

        /* Header styling */
        header {
            background-color: #007bff;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            width: 100%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }

        header h1 {
            font-size: 2.5rem;
            letter-spacing: 2px;
            animation: slideInLeft 1s ease-in-out;
            margin: 0;
        }

        /* Main content styling */
        .container {
            margin-top: 100px;
            padding: 20px;
        }

        /* About Section */
        .about-section {
            text-align: center;
            margin-bottom: 50px;
            animation: fadeIn 1.5s ease-in-out;
        }

        .about-section h2 {
            font-size: 3rem;
            color: #007bff;
            margin-bottom: 20px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 3px;
            animation: bounceIn 1s ease-in-out;
        }

        .about-section p {
            font-size: 1.4rem;
            line-height: 1.8;
            color: #555;
            max-width: 800px;
            margin: 0 auto;
            text-align: justify;
            letter-spacing: 1px;
            animation: fadeInUp 1.5s ease-in-out;
            background-color: rgba(0, 123, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Features Section */
        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            justify-items: center;
            margin-top: 50px;
            animation: fadeInUp 1.5s ease-in-out;
        }

        .feature {
            background-color: #fff;
            padding: 30px;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: bounceIn 1.2s ease-in-out;
            max-width: 300px;
        }

        .feature img {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .feature h3 {
            font-size: 1.8rem;
            color: #007bff;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .feature p {
            font-size: 1rem;
            color: #555;
            line-height: 1.5;
        }

        .feature:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .feature:hover img {
            transform: rotate(360deg);
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

        @keyframes fadeInUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }

        @keyframes bounceIn {
            from {
                transform: scale(0.5);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>About Us</h1>
    </header>

    <div class="container">
        <!-- About Section -->
        <div class="about-section">
            <h2>About StarMess</h2>
            <p>
                At StarMess, we are committed to providing our customers with high-quality food and exceptional service. 
                Our mess management system is designed to cater to the diverse dietary needs of students, professionals, 
                and families. With a focus on hygiene, timely service, and balanced meals, we ensure that your dining 
                experience is both delightful and nutritious. From sourcing the freshest ingredients to delivering meals 
                with love, StarMess aims to create a home-away-from-home experience for our customers. Your satisfaction 
                is our priority, and we continuously strive to innovate and improve to meet your expectations.
            </p>
        </div>

        <!-- Features Section -->
        <div class="features">
            <div class="feature">
                <img src="images/food-safety.png" alt="Quality Food">
                <h3>Good Quality Food</h3>
                <p>We use fresh ingredients to prepare delicious, nutritious meals.</p>
            </div>
            <div class="feature">
                <img src="images/clean-air.png" alt="Cleaning">
                <h3>Hygienic Environment</h3>
                <p>Our facilities are maintained to the highest hygiene standards.</p>
            </div>
            <div class="feature">
                <img src="images/24-7.png" alt="Timely Service">
                <h3>Timely Service</h3>
                <p>Enjoy meals served promptly to suit your busy schedule.</p>
            </div>
        </div>
    </div>

    
</body>
</html>
