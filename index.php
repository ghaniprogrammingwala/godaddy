<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domain Finder</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Inter', Arial, sans-serif;
            line-height: 1.6;
            color: #1a1a1a;
            background-color: #f5f5f5;
        }
        header {
            background-color: #008a45;
            color: white;
            padding: 20px 15px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        header h1 {
            font-weight: 600;
            font-size: 24px;
            letter-spacing: -0.5px;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .container:hover {
            transform: scale(1.02);
            box-shadow: 0 15px 35px rgba(0,0,0,0.12);
        }
        .container h2 {
            color: #1a1a1a;
            margin-bottom: 20px;
            font-weight: 600;
        }
        input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        input[type="text"]:focus {
            outline: none;
            border-color: #008a45;
            box-shadow: 0 0 0 3px rgba(0,138,69,0.2);
        }
        button {
            width: 100%;
            padding: 12px 20px;
            background-color: #008a45;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            transform: perspective(500px);
        }
        button:hover {
            background-color: #00a45c;
            transform: scale(1.03) perspective(500px) rotateX(5deg);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        button:active {
            transform: scale(0.98);
            background-color: #007a3d;
        }
        @media (max-width: 480px) {
            .container {
                margin: 20px 15px;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Domain Finder</h1>
    </header>
    <div class="container">
        <h2>Find your perfect domain name</h2>
        <form action="results.php" method="GET">
            <input type="text" name="domain" placeholder="Enter domain name" required>
            <button type="submit">Search</button>
        </form>
    </div>
</body>
</html>
