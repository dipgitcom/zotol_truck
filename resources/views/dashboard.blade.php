@extends('backend.master')

@section('title', 'Zotol Truck - Dashboard')

@section('content')
<div class="page-wrapper">
    <div class="greeting-card shadow-lg rounded-4 p-5">
        <h2 class="fw-bold mb-3 text-gradient">
            👋 Welcome Back, {{ Auth::user()->name ?? 'Guest' }}!
        </h2>
        <p class="lead mb-4" id="greetingText">🌞 Have a wonderful day ahead!</p>

        <div class="time-box d-inline-flex align-items-center px-4 py-2 rounded-pill shadow-sm">
            <i class="bi bi-clock-history me-2"></i> 
            <span id="currentTime"></span>
        </div>

        <div class="mt-5 d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary shadow-glow rounded-pill px-4 py-2">
                <i class="bi bi-person-circle me-2"></i> Profile
            </a>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-glass rounded-pill px-4 py-2">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </div>
    </div>
</div>

<script>
function updateGreeting() {
    const hour = new Date().getHours();
    let greeting = "🌞 Have a wonderful day ahead!";
    if(hour >= 5 && hour < 12) greeting = "☀️ Good Morning!";
    else if(hour >= 12 && hour < 15) greeting = "🌤 Good Noon!";
    else if(hour >= 15 && hour < 18) greeting = "🌤 Good Afternoon!";
    else if(hour >= 18 && hour < 21) greeting = "🌙 Good Evening!";
    else greeting = "🌙 Good Night!";
    document.getElementById("greetingText").innerText = greeting;
}

function updateTime() {
    document.getElementById("currentTime").innerText =
        new Date().toLocaleTimeString([], { hour:'2-digit', minute:'2-digit', second:'2-digit' });
}

updateGreeting();
updateTime();
setInterval(updateTime, 1000);
</script>

<style>
/* Page Background */
.page-wrapper {
    margin-left: 100px;
    transition: margin-left 0.3s ease;
    min-height: 100vh;
    padding: 40px 50px;

    background: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1600&q=80') 
                no-repeat center center fixed;
    background-size: cover;

    display: flex;
    align-items: center;
    justify-content: center;
}


/* Glassmorphism Card */
.greeting-card {
    position: relative;
    z-index: 2; /* keeps card above overlay */
}
.greeting-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 36px rgba(98, 75, 255, 0.25);
}

/* Gradient Title Text */
.text-gradient {
    background: linear-gradient(45deg, #d6d3da, #2575fc);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Greeting Text */
#greetingText {
    font-size: 1.25rem;
    font-weight: 500;
    color: #eeafaf;
}

/* Time Display Box */
.time-box {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2575fc;
    background: rgba(98, 75, 255, 0.08);
    border: 1px solid rgba(98, 75, 255, 0.2);
    backdrop-filter: blur(10px);
}

/* Buttons */
.btn {
    min-width: 180px;
    font-weight: 600;
    border-radius: 50px;
    transition: all 0.3s ease-in-out;
}
.btn i {
    vertical-align: middle;
    font-size: 1.2rem;
}
.btn-primary {
    background: linear-gradient(45deg, #6a11cb, #2575fc);
    border: none;
    color: white;
}
.shadow-glow {
    box-shadow: 0 0 15px rgba(37, 117, 252, 0.6);
}
.btn-primary:hover {
    background: linear-gradient(45deg, #2575fc, #6a11cb);
    box-shadow: 0 0 25px rgba(37, 117, 252, 0.85);
}

/* Outline Glass Button */
.btn-outline-glass {
    background: rgba(255,255,255,0.6);
    border: 1px solid rgba(98, 75, 255, 0.25);
    color: #2575fc;
}
.btn-outline-glass:hover {
    background: rgba(255,255,255,0.9);
    box-shadow: 0 0 15px rgba(98, 75, 255, 0.3);
    color: #6a11cb;
}
</style>
@endsection
