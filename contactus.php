<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - StarMess</title>
    <style>
        /* Reset and basic styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-image: url('images/cont.jpg'); /* Replace 'images/cont.jpg' with the path to your HD background image */
            background-size: contain; /* Ensures the image is displayed fully while maintaining aspect ratio */
            background-position: center; /* Centers the image */
            background-repeat: no-repeat; /* Prevents tiling of the image */
            background-attachment: fixed; /* Keeps the image fixed during scrolling */
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
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
            margin: 0;
            font-size: 1.8rem;
            animation: slideInLeft 1s ease-in-out;
            letter-spacing: 2px;
        }

        /* Main layout */
        .container {
            display: flex;
            width: 100%;
            height: 80vh;
            padding: 20px;
        }

        /* Right section (form) styling */
        .form-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
            animation: fadeInUp 1s ease-in-out;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input, 
        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group textarea {
            resize: vertical;
            height: 100px;
        }

        .submit-btn {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        /* Animations */
        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }

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
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Contact Us</h1>
    </header>

    <div class="container">
        <!-- Right Section (Form) -->
        <div class="form-container">
            <form id="contactForm" onsubmit="redirectToWhatsApp(event)">
                <h2>Contact Form</h2>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="contact">Contact Number:</label>
                    <input type="text" id="contact" name="contact" value="9591921668" readonly>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" placeholder="Type your message" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>

    <script>
        function redirectToWhatsApp(event) {
            event.preventDefault();

            const name = document.getElementById('name').value;
            const message = document.getElementById('message').value;
            const contact = document.getElementById('contact').value;

            // Format message for WhatsApp
            const whatsappMessage = `Hi, my name is ${name}. ${message}`;
            const whatsappURL = `https://wa.me/${contact}?text=${encodeURIComponent(whatsappMessage)}`;

            // Redirect to WhatsApp
            window.location.href = whatsappURL;
        }
    </script>
</body>
</html>
