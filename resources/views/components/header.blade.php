<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - @yield('title')</title>
<link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
<link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">

<!-- Ensure proper theme and text visibility -->
<style>
/* Force light theme for better visibility */
body {
    background-color: #f8f9fa !important;
    color: #212529 !important;
}

.page-heading {
    background-color: transparent !important;
}

.section {
    background-color: transparent !important;
}

/* Ensure cards have proper background */
.card {
    background-color: #ffffff !important;
    border: 1px solid #dee2e6 !important;
    color: #212529 !important;
}

.card-header {
    background-color: #ffffff !important;
    border-bottom: 1px solid #dee2e6 !important;
    color: #212529 !important;
}

.card-body {
    background-color: #ffffff !important;
    color: #212529 !important;
}

/* Table styling */
.table {
    background-color: #ffffff !important;
    color: #212529 !important;
}

.table th, .table td {
    color: #212529 !important;
}

.table-responsive {
    background-color: #ffffff !important;
}

/* Ensure text visibility */
.text-dark, h1, h2, h3, h4, h5, h6, p, span, div {
    color: #212529 !important;
}

.text-muted {
    color: #6c757d !important;
}

/* Navigation styling */
#sidebar {
    background-color: #343a40 !important;
}

#sidebar .sidebar-wrapper {
    background-color: #343a40 !important;
}

#sidebar .sidebar-header {
    background-color: #343a40 !important;
}

#sidebar .sidebar-header h5 {
    color: #ffffff !important;
}

#sidebar .sidebar-menu {
    background-color: #343a40 !important;
}

#sidebar .menu {
    background-color: #343a40 !important;
}

#sidebar .sidebar-title {
    color: #adb5bd !important;
    background-color: transparent !important;
}

#sidebar .sidebar-item {
    background-color: transparent !important;
}

#sidebar .sidebar-link {
    color: #ffffff !important;
    background-color: transparent !important;
}

#sidebar .sidebar-link:hover {
    background-color: rgba(255, 255, 255, 0.1) !important;
    color: #ffffff !important;
}

#sidebar .sidebar-link i {
    color: #ffffff !important;
}

#sidebar .sidebar-link span {
    color: #ffffff !important;
}

#sidebar .sidebar-item.active .sidebar-link {
    background-color: #007bff !important;
    color: #ffffff !important;
}

/* Logout button styling */
#sidebar .btn.sidebar-link {
    color: #dc3545 !important;
    background-color: transparent !important;
    border: none !important;
}

#sidebar .btn.sidebar-link:hover {
    background-color: rgba(220, 53, 69, 0.1) !important;
    color: #dc3545 !important;
}

#sidebar .btn.sidebar-link i {
    color: #dc3545 !important;
}

#sidebar .btn.sidebar-link span {
    color: #dc3545 !important;
}

/* Fix any dark theme overrides */
[data-bs-theme="dark"] .card,
[data-bs-theme="dark"] .table,
[data-bs-theme="dark"] .card-header,
[data-bs-theme="dark"] .card-body {
    background-color: #ffffff !important;
    color: #212529 !important;
}
</style>
