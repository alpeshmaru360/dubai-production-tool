@extends('layouts.main')
@section('content')
<link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
<link href="{{ asset('css/tabs/customer_service.css') }}" rel="stylesheet" />

<section class="req_customer_section phone_responsive">
    <div>
        <a href="{{ route('SaleManagerDashboard') }}" class="btn btn-primary custom-back c-back">
            <svg xmlns="http://www.w3.org/2000/svg" class="back-svg" viewBox="0 0 448 512">
                <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
            </svg>
            Back
        </a>
    </div>

    <div class="contact-us-section">
        @if(session('success'))
        <div id="successMessage" class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <h2>Contact Us</h2>
        <p>If you have any questions or need assistance, choose one of the options below:</p>

        <div class="contact-options">
            <!-- Email Option -->
            <div class="contact-option">
                <a href="mailto:{{$email}}" class="contact-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon">
                        <path d="M12 13.065L3.077 6h17.846L12 13.065zm0 1.5L3 7.34V18h18V7.34L12 14.565z" />
                    </svg>
                    <span class="contact-label">Email Us</span>
                </a>
                <span class="contact-info">{{$email}}</span>
            </div>

            <!-- Phone Option -->
            <div class="contact-option">
                <a href="tel:{{$phone}}" class="contact-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="phone-svg">
                        <path fill="#ffffff" d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                    </svg>
                    <span class="contact-label">Call Us</span>
                </a>
                <span class="contact-info">{{$phone}}</span>
            </div>
        </div>

        <!-- Suggestion Form -->
        <div class="suggestion-form-wrapper">
            <form method="POST" action="{{ route('SaleManagerStoreCustomerService') }}">
                @csrf
                <!-- Username -->
                <div class="form-group hidden">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->name }}">
                </div>

                <!-- Phone Number -->
                <div class="form-group hidden">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}">
                </div>

                <!-- Email -->
                <div class="form-group hidden">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                </div>

                <!-- Suggestion -->
                <div class="form-group">
                    <label for="suggestion" class="mandatory">Your Message:</label>
                    <textarea id="suggestion" name="message" class="form-control" rows="4" placeholder="Enter your message here..." required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Notify Us</button>
            </form>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hide the success message after 3 seconds (3000 milliseconds)
        const successMessage = document.getElementById('successMessage');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 5000);
        }
    });
</script>
@endsection