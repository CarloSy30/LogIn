<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<nav class="navbar navbar-expand-sm" id="navigation">
    <div class="container-fluid">
        <button class="btn" data-bs-target="#show" data-bs-toggle="offcanvas"><i class="fa-solid fa-bars fa-xl navText"></i></button>
        <p style="font-size:30px; margin:0;">Apartment Management System</p>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="../destroy.php" class="nav-link navText"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="offcanvas offcanvas-start" id="show"  style="width:250px;">
    <div class="offcanvas-header">
            <p class="h3" style="margin-top: 20px;"><i class="fa-solid fa-user"></i> Admin</p>
            <div class="btn-close btn-close-black text-white" data-bs-dismiss="offcanvas"></div>
    </div>
    <div class="offcanvas-body">
        <nav class="nav flex-column">
            <ul style="list-style: none;">
                <li class="navHover"><a href="dashboard.php" class="nav-link text-decoration-none navText "><i class="fa-solid fa-chart-simple navLink"></i> Dashboard</a></li>
                <li class="navHover"><a href="tenant.php" class="nav-link text-decoration-none navText "><i class="fa-solid fa-people-roof navLink"></i> Tenants</a></li>
                <li class="navHover"><a href="#" class="nav-link text-decoration-none navText "><i class="fa-solid fa-door-closed navLink"></i> Units</a></li>
                <li class="navHover"><a href="#" class="nav-link text-decoration-none navText "><i class="fa-solid fa-screwdriver-wrench navLink"></i> Maintenance</a></li>
                <li class="navHover"><a href="#" class="nav-link text-decoration-none navText "><i class="fa-solid fa-circle-exclamation navLink"></i> Complaint</a></li>
                <li class="navHover"><a href="#" class="nav-link text-decoration-none navText "><i class="fa-solid fa-list-check navLink"></i> Reports</a></li>
                <li class="navHover"><a href="#" class="nav-link text-decoration-none navText "><i class="fa-regular fa-id-badge navLink"></i> Contact Us</a></li>
                <li class="navHover"><a href="#" class="nav-link text-decoration-none navText "><i class="fa-solid fa-gear navLink"></i> Setting</a></li>
            </ul>
        </nav>
    </div>
</div>