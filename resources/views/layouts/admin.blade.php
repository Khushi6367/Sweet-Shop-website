<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganpati Industries | @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
            padding: 1rem;
        }

        .topbar .navbar-brand {
            font-weight: 600;
            margin-right: 2rem;
        }

        .topbar .navbar-nav {
            flex-wrap: nowrap;
            gap: 1rem;
        }
    </style>
</head>

<body>
    <nav class="navbar topbar shadow-sm">
        <div class="container-fluid flex-nowrap">
            <a class="navbar-brand" href="/">Ganpati Industries</a>
            <ul class="navbar-nav flex-row flex-nowrap me-auto">
                <li class="nav-item"><a class="nav-link px-2" href="/admin/dashboard">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link px-2" href="/product/create">Add New Product</a></li>
                <li class="nav-item"><a class="nav-link px-2" href="/product/adminlisting">Product Listing</a></li>
                <li class="nav-item"><a class="nav-link px-2" href="/admin/orders">My Orders</a></li>
                <li class="nav-item"><a class="nav-link px-2" href="/product/all">All Products</a></li>
            </ul>
            <a class="nav-link px-2" href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

</body>

</html>
