<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <style>
            body {
                background-color: #f1f3f5;
            }
    
            .card {
                border-radius: 12px;
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease;
            }
    
            .card:hover {
                transform: translateY(-5px);
            }
    
            .card-header {
                background-color: #18152f;
                color: white;
                border-radius: 12px 12px 0 0;
            }
    
            .card-body {
                padding: 35px;
                background-color: white;
                border-radius: 0 0 12px 12px;
            }
    
            .btn-primary {
                background-color: #d9d4ff;
                border: none;
                padding: 14px 28px;
                font-size: 16px;
                border-radius: 8px;
                transition: all 0.3s ease;
            }
    
            .btn-primary:hover {
                background-color: #5a4cc7;
                transform: translateY(-3px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            }
    
            .btn-secondary {
                background-color: #b2bec3;
                border: none;
                padding: 12px 24px;
                font-size: 16px;
                border-radius: 8px;
                transition: all 0.3s ease;
            }
    
            .btn-secondary:hover {
                background-color: #95a5a6;
                transform: translateY(-3px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            }
    
            h5, h6 {
                color: #333;
            }
    
            .text-muted {
                color: #6c757d;
            }
    
            .fw-bold {
                font-weight: 600;
            }
    
            .row .col-md-6 {
                margin-bottom: 1rem;
            }
        </style>
    
        <div class="card shadow-lg border-0">
            <div class="card-header text-center">
                <h4 class="mb-0">Selamat datang, {{ Auth::user()->name }}!</h4>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h5 class="fw-bold">Informasi Anda:</h5>
                    <p class="text-muted">Berikut adalah detail informasi anda.</p>
                </div>
    
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="fw-bold">Email:</h6>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold">Phone:</h6>
                        <p>{{ Auth::user()->no_telp ?? 'Not Provided' }}</p>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="fw-bold">Address:</h6>
                        <p>{{ Auth::user()->alamat ?? 'Not Provided' }}</p>
                    </div>
                </div>
    
                <div class="d-flex justify-content-center mt-4">
                    <a href="{{ url('user/profile') }}" class="btn btn-primary mx-3">Update Profile</a>
                    <a href="{{ url('/user_order') }}" class="btn btn-primary mx-3">My Orders</a>
                    <a href="{{ url('/') }}" class="btn btn-secondary mx-3">Back to Home</a>
                </div>
                
            </div>
        </div>
    </div>
    
</x-app-layout>



