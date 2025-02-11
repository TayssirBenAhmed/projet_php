<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #8e44ad, #f39c12);
            margin: 0;
            padding: 0;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .contact-container {
            background: #ffffff;
            box-shadow: 0 6px 35px rgba(0, 0, 0, 0.2);
            border-radius: 25px;
            padding: 50px;
            width: 90%;
            max-width: 900px;
            text-align: center;
            animation: fadeIn 2s ease-in-out;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        h2 {
            font-size: 3.5rem;
            color: #6a1b9a;
            text-transform: uppercase;
            font-weight: bold;
            animation: slideIn 1.5s ease-in-out;
        }

        @keyframes slideIn {
            0% { transform: translateX(-30px); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }

        h2 span.emoji {
            font-size: 3rem;
            margin-left: 10px;
        }

        .contact-info {
            margin-top: 40px;
            text-align: left;
            color: #555;
        }

        .country-section {
            margin-bottom: 30px;
            padding: 30px;
            border-radius: 20px;
            background: #f1f1f1;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, background-color 0.3s ease;
            animation: bounceIn 1s ease-out;
        }

        @keyframes bounceIn {
            0% { transform: scale(0.5); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        .country-section:hover {
            background-color: #ffcc00;
            transform: scale(1.05);
        }

        .country-section h3 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        .country-section p {
            font-size: 1.2rem;
            color: #333;
            margin: 5px 0;
            font-weight: 600;
        }

        .flag {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            transition: transform 0.3s ease;
        }

        .flag:hover {
            transform: rotate(360deg);
        }

        .flag-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
            animation: fadeInUp 1.5s ease-out;
        }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .contact-info .emoji {
            font-size: 2rem;
            margin-left: 10px;
        }

        .contact-info p span {
            color: #f39c12;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="contact-container">
        <h2>Contact Us <span class="emoji">🌍</span></h2>
        <div class="contact-info">
            <div class="country-section">
                <div class="flag-container">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/Flag_of_Tunisia.svg/2560px-Flag_of_Tunisia.svg.png" alt="Tunisia" class="flag">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Flag_of_Morocco.svg/langfr-225px-Flag_of_Morocco.svg.png" alt="Morocco" class="flag">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Flag_of_Egypt.svg/640px-Flag_of_Egypt.svg.png" alt="Egypt" class="flag">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/05/Flag_of_Libya.svg" alt="Libya" class="flag">
                </div>
                <h3>Tunisia <span class="emoji">🇹🇳</span></h3>
                <p>Clinisys Tunisia - Sfax: <span>+216 24 231 400</span></p>
                <p>Clinisys Tunisia - Tunis: <span>+216 26 731 400</span></p>
                <p>Clinisys Tunisia - Sousse: <span>+216 26 838 074</span></p>
                <p>Clinisys Tunisia - Djerba: <span>+216 26 838 071</span></p>
            </div>

            <div class="country-section">
                <h3>Morocco <span class="emoji">🇲🇦</span></h3>
                <p>Clinisys Morocco - Sales Manager: <span>+212 779-990351</span></p>
                <p>Clinisys Morocco - Marketing Manager: <span>+212 782-857541</span></p>
            </div>

            <div class="country-section">
                <h3>Egypt <span class="emoji">🇪🇬</span></h3>
                <p>Clinisys Egypt - Cairo: <span>+216 25 731 730</span></p>
            </div>

            <div class="country-section">
                <h3>Libya <span class="emoji">🇱🇾</span></h3>
                <p>Clinisys Libya - Tripoli, Benghazi, Misurata: <span>+218 92-3617025</span></p>
            </div>
        </div>
    </div>
</body>
</html>
