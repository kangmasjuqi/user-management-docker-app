@extends('emails.layouts.app')

@section('title', 'Notification - ' . ($appName ?? 'Your App'))

@section('header-subtitle', 'Important Notification')

@section('content')
    <div class="greeting">
        Hello {{ $user->name ?? 'Valued User' }}! 👋
    </div>
    
    <div class="message-content">
        {{ $message_content }}
    </div>
    
    @if($template === 'urgent')
        <div style="background-color: #fff5f5; border-left: 4px solid #fc8181; padding: 15px; margin: 20px 0; border-radius: 4px;">
            <strong style="color: #c53030;">⚠️ This is an urgent notification that requires your immediate attention.</strong>
        </div>
    @elseif($template === 'success')
        <div style="background-color: #f0fff4; border-left: 4px solid #68d391; padding: 15px; margin: 20px 0; border-radius: 4px;">
            <strong style="color: #2f855a;">✅ Great news! This notification contains positive updates.</strong>
        </div>
    @elseif($template === 'info')
        <div style="background-color: #ebf8ff; border-left: 4px solid #63b3ed; padding: 15px; margin: 20px 0; border-radius: 4px;">
            <strong style="color: #2b6cb0;">ℹ️ This is an informational update for you.</strong>
        </div>
    @endif
    
    @if($appUrl)
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $appUrl }}" class="cta-button">
                Visit Our Platform
            </a>
        </div>
    @endif
    
    <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e2e8f0; font-size: 14px; color: #718096;">
        <p><strong>Account Details:</strong></p>
        <p>Email: {{ $user->email }}</p>
        @if($user->phone)
            <p>Phone: {{ $user->phone }}</p>
        @endif
        <p>Notification sent on: {{ now()->format('F j, Y \a\t g:i A') }}</p>
    </div>
    
    <div style="margin-top: 20px; padding: 15px; background-color: #f7fafc; border-radius: 6px; font-size: 13px; color: #4a5568;">
        <p><strong>Need Help?</strong> If you have any questions or need assistance, please don't hesitate to contact our support team.</p>
        <p style="margin-top: 8px;">
            📧 Email: support@{{ parse_url($appUrl ?? 'yourapp.com', PHP_URL_HOST) ?? 'yourapp.com' }}<br>
            📞 Phone: +1 (555) 123-4567
        </p>
    </div>
@endsection