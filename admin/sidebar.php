<?php

?>

<style>
.sidebar {
    width: 220px;
    min-height: 100vh;
    background-color: #630000;
    transition: 0.3s;
}

/* COLLAPSED */
.sidebar.collapsed {
    width: 70px;
}

/* MENU LINKS */
.sidebar .nav-link {
    color: #fff;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 12px;
    margin-bottom: 4px;
    border-radius: 8px;
    transition: background-color 0.2s, box-shadow 0.2s;
}

.sidebar i {
    font-size: 1.2rem;
}

.sidebar.collapsed span {
    display: none;
}

.sidebar .nav-link.active {
    background-color: rgba(255, 255, 255, 0.18); 
    backdrop-filter: blur(4px);              
    box-shadow: inset 0 0 0 1px rgba(255,255,255,0.25);
}

/* HOVER EFFECT */
.sidebar .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.12);
}

/* MOBILE */
@media (max-width: 768px) {
    .sidebar {
        position: fixed;
        left: -220px;
        z-index: 1000;
    }

    .sidebar.show {
        left: 0;
    }
}

</style>

<div id="sidebar" class="sidebar p-3">
    <div class="d-flex justify-content-end">
        <button class="btn btn-sm p-1 border-0 bg-transparent text-white" onclick="toggleSidebar()">
            <i class="bi bi-caret-left-fill fs-5"></i>
        </button>
    </div>

    <ul class="nav flex-column mt-2">
        <li class="nav-item">
            <a class="nav-link <?= $active=='dashboard'?'active':'' ?>" href="dashboard.php">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $active=='users'?'active':'' ?>" href="userAccounts.php">
                <i class="bi bi-people"></i>
                <span>User Accounts</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $active=='departments'?'active':'' ?>" href="departments.php">
                <i class="bi bi-building"></i>
                <span>Departments</span>
            </a>
        </li>
    </ul>
</div>
