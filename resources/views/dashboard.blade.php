<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="container mt-5 px-4">
        <style>
            body {
                background-color: #f1f3f5;
            }
    
            .card {
                border-radius: 12px;
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease;
                margin: 0 auto;
                max-width: 100%;
            }
    
            .card:hover {
                transform: translateY(-5px);
            }
    
            .card-header {
                background-color: #18152f;
                color: white;
                border-radius: 12px 12px 0 0;
                padding: 1.5rem 1rem;
            }
    
            .card-body {
                padding: 1.5rem;
                background-color: white;
                border-radius: 0 0 12px 12px;
            }
    
            .btn-wrapper {
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
                justify-content: center;
            }
    
            .custom-btn {
                display: inline-block;
                padding: 0.75rem 1.5rem;
                border-radius: 8px;
                font-size: 0.875rem;
                font-weight: 500;
                text-align: center;
                transition: all 0.3s ease;
                white-space: nowrap;
                margin: 0.5rem;
                min-width: 120px;
            }
    
            .btn-primary {
                background-color: #d9d4ff;
                color: #18152f;
            }
    
            .btn-primary:hover {
                background-color: #5a4cc7;
                color: white;
                transform: translateY(-3px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            }
    
            .btn-secondary {
                background-color: #b2bec3;
                color: #2d3436;
            }
    
            .btn-secondary:hover {
                background-color: #95a5a6;
                color: white;
                transform: translateY(-3px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            }
    
            .info-section {
                margin-bottom: 2rem;
            }
    
            .info-item {
                margin-bottom: 1.5rem;
            }
    
            .info-label {
                font-weight: 600;
                color: #333;
                margin-bottom: 0.5rem;
            }
    
            .info-value {
                color: #6c757d;
                word-break: break-word;
            }
    
            @media (max-width: 768px) {
                .container {
                    padding: 1rem;
                }
    
                .card-body {
                    padding: 1rem;
                }
    
                .btn-wrapper {
                    flex-direction: column;
                }
    
                .custom-btn {
                    width: 100%;
                    margin: 0.25rem 0;
                }
    
                h4 {
                    font-size: 1.25rem;
                }
            }
        </style>
    
        <div class="card">
            <div class="card-header text-center">
                <h4 class="mb-0">Selamat datang, {{ Auth::user()->name }}!</h4>
            </div>
            <div class="card-body">
                <div class="info-section">
                    <h5 class="fw-bold mb-3">Informasi Anda:</h5>
                    <p class="text-muted mb-4">Berikut adalah detail informasi anda.</p>
                
                    <div class="info-item">
                        <div class="info-label">Email:</div>
                        <div class="info-value">{{ Auth::user()->email }}</div>
                    </div>
                
                    <div class="info-item">
                        <div class="info-label">No Telp:</div>
                        <div class="info-value">{{ Auth::user()->no_telp ?? 'Not Provided' }}</div>
                    </div>
                
                    <div class="info-item">
                        <div class="info-label">Alamat:</div>
                        <div class="info-value">{{ Auth::user()->alamat ?? 'Not Provided' }}</div>
                    </div>
                </div>
    
                <div class="btn-wrapper">
                    <a href="{{ url('user/profile') }}" class="custom-btn btn-primary">
                        Update Profile
                    </a>
                    <a href="{{ url('/user_order') }}" class="custom-btn btn-primary">
                        Order Saya
                    </a>
                    <a href="{{ url('/') }}" class="custom-btn btn-secondary">
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>