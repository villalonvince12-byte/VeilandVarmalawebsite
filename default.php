<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veil and Varmala | Coming Soon</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Raleway:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Raleway', sans-serif;
            color: #333;
            line-height: 1.6;
            background-color: #fafafa;
            overflow-x: hidden;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(248,248,248,0.9) 100%);
            position: relative;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect fill="none" stroke="rgba(200,200,200,0.2)" stroke-width="0.5" x="0" y="0" width="100" height="100"/></svg>');
            z-index: -1;
        }
        
        .logo {
            margin-bottom: 30px;
        }
        
        .logo h1 {
            font-family: 'Playfair Display', serif;
            font-size: 4.5rem;
            font-weight: 600;
            letter-spacing: 2px;
            color: #d4af37;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        }
        
        .logo span {
            display: block;
            font-size: 1.8rem;
            font-weight: 300;
            color: #888;
            letter-spacing: 8px;
            margin-top: 5px;
        }
        
        .tagline {
            font-size: 1.5rem;
            font-weight: 300;
            margin-bottom: 40px;
            color: #555;
            max-width: 600px;
        }
        
        .coming-soon {
            background: rgba(255,255,255,0.8);
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            margin: 30px 0;
            max-width: 600px;
            backdrop-filter: blur(5px);
        }
        
        .coming-soon h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            margin-bottom: 20px;
            color: #333;
        }
        
        .countdown {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
        }
        
        .countdown-item {
            background: white;
            padding: 15px;
            border-radius: 8px;
            min-width: 80px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .countdown-number {
            font-size: 2.5rem;
            font-weight: 300;
            color: #d4af37;
        }
        
        .countdown-label {
            font-size: 0.9rem;
            text-transform: uppercase;
            color: #888;
            letter-spacing: 1px;
        }
        
        /* Notify Section */
        .notify {
            padding: 60px 20px;
            text-align: center;
            background: white;
        }
        
        .notify h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }
        
        .notify p {
            max-width: 600px;
            margin: 0 auto 30px;
            color: #666;
        }
        
        .subscribe-form {
            display: flex;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .subscribe-input {
            flex: 1;
            padding: 15px 20px;
            border: 1px solid #ddd;
            border-radius: 5px 0 0 5px;
            font-family: 'Raleway', sans-serif;
            font-size: 1rem;
        }
        
        .subscribe-button {
            background: #d4af37;
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            font-family: 'Raleway', sans-serif;
            font-weight: 500;
            transition: background 0.3s;
        }
        
        .subscribe-button:hover {
            background: #c19b2a;
        }
        
        /* Footer */
        footer {
            background: #333;
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .social-links a {
            color: white;
            font-size: 1.5rem;
            transition: color 0.3s;
        }
        
        .social-links a:hover {
            color: #d4af37;
        }
        
        .copyright {
            color: #aaa;
            font-size: 0.9rem;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .logo h1 {
                font-size: 3.5rem;
            }
            
            .logo span {
                font-size: 1.4rem;
            }
            
            .countdown {
                flex-wrap: wrap;
            }
            
            .subscribe-form {
                flex-direction: column;
            }
            
            .subscribe-input {
                border-radius: 5px;
                margin-bottom: 10px;
            }
            
            .subscribe-button {
                border-radius: 5px;
            }
        }
    </style>
</head>
<body>
    <section class="hero">
        <div class="container">
            <div class="logo">
                <h1>VEIL & VARMALA<span>PHOTOGRAPHY</span></h1>
            </div>
            
            <p class="tagline">Capturing the essence of your special moments with elegance and artistry</p>
            
            <div class="coming-soon">
                <h2>Our Website Is Coming Soon</h2>
                <p>We're crafting an exceptional online experience to showcase our photography portfolio. Stay tuned for our launch!</p>
                
                <div class="countdown">
                    <div class="countdown-item">
                        <div class="countdown-number" id="days">00</div>
                        <div class="countdown-label">Days</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number" id="hours">00</div>
                        <div class="countdown-label">Hours</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number" id="minutes">00</div>
                        <div class="countdown-label">Minutes</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number" id="seconds">00</div>
                        <div class="countdown-label">Seconds</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="notify">
        <div class="container">
            <h2>Get Notified When We Launch</h2>
            <p>Be the first to know when we go live and receive exclusive early-bird offers for our photography services.</p>
            
            <form class="subscribe-form">
                <input type="email" class="subscribe-input" placeholder="Enter your email address" required>
                <button type="submit" class="subscribe-button">Notify Me</button>
            </form>
        </div>
    </section>
    
    <footer>
        <div class="container">
            <div class="social-links">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
            <p class="copyright">©Veil & Varmala Photography. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Set the launch date (2 months from now)
        const launchDate = new Date();
        launchDate.setMonth(launchDate.getMonth() + 1);
        
        function updateCountdown() {
            const currentTime = new Date();
            const difference = launchDate - currentTime;
            
            const days = Math.floor(difference / (1000 * 60 * 60 * 24));
            const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((difference % (1000 * 60)) / 1000);
            
            document.getElementById('days').innerText = days.toString().padStart(1, '0');
            document.getElementById('hours').innerText = hours.toString().padStart(1, '0');
            document.getElementById('minutes').innerText = minutes.toString().padStart(1, '0');
            document.getElementById('seconds').innerText = seconds.toString().padStart(1, '0');
        }
        
        // Initial update
        updateCountdown();
        
        // Update every second
        setInterval(updateCountdown, 1000);
        
        // Form submission
        document.querySelector('.subscribe-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input').value;
            if (email) {
                alert('Thank you! We\'ll notify you at ' + email + ' when we launch.');
                this.querySelector('input').value = '';
            }
        });
    </script>
</body>
</html>