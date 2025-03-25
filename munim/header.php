<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<style>
    ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg,rgb(44, 44, 44),rgb(44, 44, 44));
            border-radius: 30px;
            margin-right: 10px;
        }
        ::selection {
            background-color: #3498DB;
            color: #000;
            text-shadow: 1px 1px 2px #000;
        }

        input {
            caret-color: lightblue;
        }
    :root {
        --primary-color: #2C3E50;
        --secondary-color: #3498DB;
        --accent-color: #E74C3C;
        --background-color: #F5F6FA;
        --text-color: #2C3E50;
        --header-gradient: linear-gradient(135deg, #1a5f7a, #2C3E50);
    }
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: 'Montserrat', sans-serif;
        background: var(--background-color);
        color: var(--text-color);
        line-height: 1.8;
    }
    /* Шапка */
    .header {
        background: linear-gradient(135deg, #2C3E50 0%, #3498DB 100%);
        padding: 25px 0;
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
    }
    .header.scrolled {
        padding: 8px 0;
        background: linear-gradient(135deg, #1a2733 0%, #2980b9 100%);
        transform: translateY(-100%);
    }
    .header.show {
        transform: translateY(0);
    }
    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
        transition: all 0.3s ease;
    }
    .logo {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .logo-icon {
        font-size: 2rem;
        color: #fff;
        transition: transform 0.3s ease;
    }
    .logo:hover .logo-icon {
        transform: scale(1.1);
    }
    .logo-text {
        font-size: 1.8rem;
        color: #fff;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .header.scrolled .logo-text {
        font-size: 1.5rem;
    }
    .header.scrolled .logo-icon {
        font-size: 1.7rem;
    }
    .main-nav {
        margin-left: 40px;
        transition: all 0.3s ease;
    }
    .nav-menu {
        display: flex;
        gap: 15px;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .nav-item {
        position: relative;
    }
    .nav-link {
        color: #fff;
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 6px;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.95rem;
    }
    .nav-link i {
        font-size: 1rem;
    }
    .nav-link:hover {
        background: rgba(255,255,255,0.15);
    }
    .nav-link.active {
        background: rgba(255,255,255,0.2);
        font-weight: 500;
    }
    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            text-align: center;
        }
        .nav-menu {
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
    }
</style>

<header class="header">
    <div>
        <div class="header-content">
            <h1 class="logo" style="margin-left:96px;">
                <span class="logo-icon"><i class="fas fa-newspaper"></i></span>
                <span class="logo-text">MUNIM Union</span>
            </h1>
            <nav class="main-nav">
                <ul class="nav-menu" style="margin-right: 112px;">
                    <li class="nav-item"><a href="index.php" class="nav-link"><i class="fas fa-home"></i> Главная</a></li>
                    <li class="nav-item"><a href="news.php" class="nav-link active"><i class="fas fa-newspaper"></i> Новости</a></li>
                    <li class="nav-item"><a href="clubes.php" class="nav-link"><i class="fas fa-users"></i> Клубы</a></li>
                    <li class="nav-item"><a href="galary.php" class="nav-link"><i class="fas fa-images"></i> Галерея</a></li>
                    <li class="nav-item"><a href="contacts.php" class="nav-link"><i class="fas fa-envelope"></i> Контакты</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<script>
    let lastScrollTop = 0;
    const header = document.querySelector('.header');

    window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > 80) {
            header.classList.add('scrolled');
            header.classList.remove('show');
        } else {
            header.classList.remove('scrolled');
            header.classList.add('show');
        }

        lastScrollTop = scrollTop;
    });
</script>