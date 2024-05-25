<nav class="navbar bg-body-tertiary fixed-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Переключить навигацию">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex gap-5 ">
            <form class="d-flex d-none d-sm-block" role="search">
                <input class="form-control" type="search" placeholder="Поиск" aria-label="Поиск">
            </form>
            <div class="flex-shrink-0 dropdown">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="assets/image/admin/avatar-mt.png" alt="user" width="32" height="32"
                        class="rounded-circle">
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUser2">
                    <li><a class="dropdown-item" href="#">Выйти</a></li>
                </ul>
            </div>
        </div>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">SKYBRIDGE ADMIN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item d-flex align-items-center gap-2">
                        <i class="bi bi-house fs-5"></i>
                        <a class="nav-link active" aria-current="page" href="admin.html">Главная</a>
                    </li>
                    <li class="nav-item d-flex align-items-center gap-2">
                        <i class="bi bi-card-text fs-5"></i>
                        <a class="nav-link" href="ticket.html">Билеты</a>
                    </li>
                    <li class="nav-item d-flex align-items-center gap-2">
                        <i class="bi bi-people fs-5"></i>
                        <a class="nav-link" href="user.html">Пользователи</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex justify-content-center mb-5 site">
                <li class="nav-item d-flex">
                    <a class="nav-link" href="index.html">SkyBridge</a>
                </li>
            </div>
        </div>
    </div>
</nav>