<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', $appName ?? 'Notification')</title>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
        }
        
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .header p {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .content {
            padding: 30px 20px;
        }
        
        .greeting {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        
        .message-content {
            font-size: 16px;
            line-height: 1.8;
            color: #34495e;
            margin-bottom: 25px;
            white-space: pre-line;
        }
        
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            margin: 20px 0;
            transition: transform 0.2s ease;
        }
        
        .cta-button:hover {
            transform: translateY(-2px);
        }
        
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        
        .footer p {
            font-size: 12px;
            color: #6c757d;
            margin: 5px 0;
        }
        
        .footer a {
            color: #667eea;
            text-decoration: none;
        }
        
        .social-links {
            margin-top: 15px;
        }
        
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #6c757d;
            text-decoration: none;
            font-size: 12px;
        }
        
        /* Template variations */
        .template-urgent .header {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        }
        
        .template-urgent .cta-button {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        }
        
        .template-success .header {
            background: linear-gradient(135deg, #51cf66 0%, #40c057 100%);
        }
        
        .template-success .cta-button {
            background: linear-gradient(135deg, #51cf66 0%, #40c057 100%);
        }
        
        .template-info .header {
            background: linear-gradient(135deg, #339af0 0%, #228be6 100%);
        }
        
        .template-info .cta-button {
            background: linear-gradient(135deg, #339af0 0%, #228be6 100%);
        }
        
        /* Mobile responsive */
        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
            }
            
            .header, .content {
                padding: 20px 15px;
            }
            
            .header h1 {
                font-size: 20px;
            }
            
            .greeting {
                font-size: 16px;
            }
            
            .message-content {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container template-{{ $template ?? 'default' }}">
        <div class="header">
            <h1>{{ $appName ?? 'Your App' }}</h1>
            <p>@yield('header-subtitle', 'Notification')</p>
        </div>
        
        <div class="content">
            @yield('content')
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ $appName ?? 'Your App' }}. All rights reserved.</p>
            <p>
                <a href="{{ $appUrl ?? '#' }}/unsubscribe">Unsubscribe</a> | 
                <a href="{{ $appUrl ?? '#' }}/privacy">Privacy Policy</a> | 
                <a href="{{ $appUrl ?? '#' }}/contact">Contact Us</a>
            </p>
            <div class="social-links">
                <a href="#">Twitter</a>
                <a href="#">Facebook</a>
                <a href="#">LinkedIn</a>
            </div>
        </div>
    </div>
</body>
</html>