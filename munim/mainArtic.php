<!--  
  [==============================================]
  |  author : Nurullaev Ibrokhim  2027'          |
  |  github    : https://github.com/LokiChan69   |
  |  version   : 0.03                            |
  [==============================================]
-->



<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная - Школа имени Мирзо Улугбека</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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

        .container {
            width: 90%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Стили для шапки */
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
        }

        .logo {
            display: flex;
            align-items: center;
            color: #fff;
            text-decoration: none;
            font-size: 2em;
            font-weight: 700;
        }

        .logo-icon {
            margin-right: 10px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 20px;
        }

        .nav-link {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
        }

        .main-content {
            margin-top: 180px;
            padding: 40px 0;
        }

        .article-container {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .article-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .article-header h1 {
            font-size: 2.5em;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .article-subtitle {
            font-size: 1.2em;
            color: #666;
        }

        .article-section {
            margin-bottom: 30px;
        }

        .article-section h2 {
            color: var(--primary-color);
            font-size: 1.8em;
            margin-bottom: 20px;
        }

        .article-image {
            width: 100%;
            height: 400px;
            background: #f0f0f0;
            border-radius: 10px;
            margin: 20px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #777;
            font-size: 1.2em;
        }

        .highlight-box {
            background: var(--background-color);
            padding: 30px;
            border-radius: 15px;
            margin: 20px 0;
            border-left: 5px solid var(--secondary-color);
        }

        .achievements-section {
            background: var(--secondary-color);
            color: #fff;
            padding: 60px 0;
            text-align: center;
        }

        .achievement-item {
            margin: 20px 0;
        }

        .achievement-number {
            font-size: 3em;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .achievement-text {
            font-size: 1.2em;
        }

        .why-us-section {
            background: var(--primary-color);
            color: #fff;
            padding: 60px 0;
            text-align: center;
        }

        .why-us-item {
            margin: 20px 0;
        }

        .why-us-icon {
            font-size: 3em;
            margin-bottom: 20px;
        }

        .why-us-text {
            font-size: 1.2em;
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

            .main-content {
                margin-top: 220px;
            }

            .article-container {
                padding: 20px;
            }

            .article-header h1 {
                font-size: 2em;
            }
        }




        .article-image {
    position: relative;
    width: 100%;
    height: 300px;
    overflow: hidden;
    border-radius: 12px;
    background: #f0f0f0;
}

.image-container {
    display: flex;
    width: 100%;
    height: 100%;
}

.image-part {
    flex: 1;
    background-size: cover;
    background-position: center;
    transition: all 0.5s ease;
    position: relative;
    overflow: hidden;
}

.image-part::before {
    content: attr(data-year);
    position: absolute;
    bottom: 10px;
    left: 10px;
    color: white;
    font-size: 1.2rem;
    background: rgba(0, 0, 0, 0.6);
    padding: 5px 10px;
    border-radius: 5px;
    z-index: 2;
}

.image-part:hover {
    flex: 3; /* Увеличиваем часть при наведении */
}
        
    </style>
</head>
<body>

<header class="header">
    <div class="container">
        <div class="header-content">
            <h1 class="logo">
                <span class="logo-icon"><i class="fas fa-newspaper"></i></span>
                <span class="logo-text">Школьная Газета</span>
            </h1>
            <nav class="main-nav">
                <ul class="nav-menu">
                    <li class="nav-item"><a href="index.php" class="nav-link"><i class="fas fa-home"></i> Главная</a></li>
                    <li class="nav-item"><a href="news.php" class="nav-link"><i class="fas fa-newspaper"></i> Новости</a></li>
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
const scrollThreshold = 60;

window.addEventListener('scroll', () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    if (Math.abs(scrollTop - lastScrollTop) > scrollThreshold) {
        if (scrollTop > lastScrollTop) {
            header.classList.add('scrolled');
            header.classList.remove('show');
        } else {
            header.classList.remove('scrolled');
            header.classList.add('show');
        }
        lastScrollTop = scrollTop;
    }
});
</script>

<main class="main-content">
    <div class="container container-number">
        <div class="article-container">
            <!-- Заголовок статьи -->
            <header class="article-header">
                <h1>Специализированная школа имени Мирзо Улугбека</h1>
                <p class="article-subtitle">Новое слово в образовании Узбекистана</p>
            </header>

            <!-- История школы -->
            <section class="article-section">
                <h2>История создания</h2>
                <p>Школа была основана по инициативе президента Республики Узбекистан Шавката Мирзиёева. Открытие состоялось 31 августа 2019 года с личным участием президента, что подчеркнуло важность нового этапа в системе образования страны.</p>
                <div class="article-image">Фотография школы</div>
            </section>

            <!-- Общая информация -->
            <section class="highlight-box">
                <h2>Общие сведения</h2>
                <ul>
                    <li><strong>Количество учеников:</strong> 190 (включая 23 девочки)</li>
                    <li><strong>Учебные места:</strong> рассчитано на 200 учеников</li>
                    <li><strong>Общежитие:</strong> вмещает 150 учеников</li>
                    <li><strong>Столовая:</strong> рассчитана на 102 человека</li>
                </ul>
            </section>

            <!-- Языки обучения -->
            <section class="article-section">
                <h2>Языки обучения</h2>
                <p>В школе функционируют два класса с разными языками обучения:</p>
                <ul>
                    <li>Класс с русским языком обучения</li>
                    <li>Класс с узбекским языком обучения</li>
                </ul>
                <p>Каждый класс состоит из не более чем 20 человек, что позволяет индивидуально подходить к обучению каждого ученика.</p>
            </section>

            <!-- Образовательные достижения -->
            <section class="article-section">
                <h2>Образовательные достижения</h2>
                <p>Первый выпуск состоялся в 2021 году, и на данный момент у школы уже пятый выпуск. Обучение проводится с 7 по 11 классы, с углубленным изучением следующих предметов:</p>
                <ul>
                    <li>Математика</li>
                    <li>Физика</li>
                    <li>Информатика</li>
                    <li>Астрономия</li>
                </ul>
                <p>Дополнительно обязательными являются курсы русского и узбекского языков.</p>
                <div class="article-image">
                    <div class="image-container">
                        <div class="image-part" data-year="2021" style="background-image: url('https://i0.w.com/ttelka.com/uploads/posts/2022-11/1668858443_24-ttelka-com-p-porno-shikarnikh-devusek-25.jpg?ssl=1');"></div>
                        <div class="image-part" data-year="2022" style="background-image: url('https://img.ttpad.com/411e086e3801266796bc7f8a4730520ac240a76f/68747470733a2f2f73332e616d617a6f6e617732e636f6d2f776174747061642d6d656469612d736572766963652f53746f7279496d6167652f4d456d6f4c70335971595f4837513d3d2d3338363034323530382e313461646166623231336431336465383835363934313837343930342e676966?s=fit&w=720&h=720');"></div>
                        <div class="image-part" data-year="2023" style="background-image: url('https://ds.sisa.org/foto/foto/a1027076/5d870128347c03.441575191569128744_5d870128347cb3.6438292.gif');"></div>
                        <div class="image-part" data-year="2024" style="background-image: url('https://is-1.filesor.com/pimpandhost.com/1/4/6/0/146081/6/p/u/O/6puOz/Melanie%20Gold%20-%205.gif');"></div>
                    </div>
                </div>

            </section>

            <!-- Международные стандарты -->
            <section class="highlight-box">
                <h2>Международные стандарты</h2>
                <p>С 2024 года школа в процессе получения международного сертификата IB, что открывает двери для поступления в ведущие зарубежные университеты. Кроме того, школа прошла успешную аттестацию с результатом в 900 баллов, подтверждая высокий уровень образовательных стандартов.</p>
            </section>

            <!-- Общежитие и питание -->
            <section class="article-section">
                <h2>Общежитие и питание</h2>
                <p>Наше общежитие рассчитано на 150 учеников, в первую очередь для детей из отдаленных районов. Приоритетное право на размещение получают ученики из малообеспеченных семей, которые также обеспечиваются:</p>
                <ul>
                    <li>Бесплатным пятиразовым питанием</li>
                    <li>Необходимыми учебными материалами</li>
                </ul>
                <div class="article-image">Фотография общежития</div>
            </section>

            <!-- Возможности для выпускников -->
            <section class="highlight-box">
                <h2>Возможности для выпускников</h2>
                <p>Выпускники нашей школы имеют право поступать в технические и естественно-научные вузы на контрактной основе без экзаменов. Однако большинство из них предпочитает грантовые программы и успешно поступает в зарубежные университеты благодаря прочной подготовке и академическим достижениям.</p>
            </section>

            <!-- FAQ Section -->
            <section class="article-section">
    <h2>Часто задаваемые вопросы</h2>
    <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Как поступить в школу?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Для поступления необходимо пройти вступительные испытания по математике и физике, а также предоставить рекомендации от учителей.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Какие предметы изучаются углубленно?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Углубленно изучаются математика, физика, информатика и астрономия.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Есть ли общежитие для учеников?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Да, школа предоставляет общежитие на 150 мест, преимущественно для учеников из отдаленных районов.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Где находится школа имени Мирзо Улугбека в Ташкенте?
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Школа расположена в г. Ташкент, 1-й проезд Чингиза Айтматова, дом 9.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    Какова стоимость обучения в школе имени Улугбека?
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Обучение бесплатное и не требует затрат.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    На каком языке ведется обучение в  школе имени Улугбека?
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Классы делятся на русские (B) и узбекские (A) классы.
                </div>
            </div>
        </div>
    </div>
</section>

            <!-- Achievements Section -->
            <section class="achievements-section" style="width:106.5%; margin-left: -40px;">
        <div class="container">
            <h2>Наши достижения</h2>
            <div class="row">
                <div class="col-md-4 achievement-item">
                    <div class="achievement-number" data-target="900">0</div>
                    <div class="achievement-text">Баллов на аттестации IB</div>
                </div>
                <div class="col-md-4 achievement-item">
                    <div class="achievement-number" data-target="5">0</div>
                    <div class="achievement-text">Выпусков</div>
                </div>
                <div class="col-md-4 achievement-item">
                    <div class="achievement-number" data-target="150">0</div>
                    <div class="achievement-text">Мест в общежитии</div>
                </div>
            </div>
        </div>

    </section>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.achievement-number');
            let started = false;

            function easeOutQuad(t) {
                return 1 - (1 - t) * (1 - t); // формула замедления к концу (ease-out)
            }

            function animateCount(target, element, duration = 2000) {
                let start = 0;
                const startTime = performance.now();

                function updateCounter(currentTime) {
                    const elapsedTime = currentTime - startTime;
                    const progress = Math.min(elapsedTime / duration, 1);
                    const easedProgress = easeOutQuad(progress); // плавное замедление
                    element.textContent = Math.floor(easedProgress * target);

                    if (progress < 1) {
                        requestAnimationFrame(updateCounter);
                    } else {
                        element.textContent = target; // точная коррекция на последнем кадре
                    }
                }

                requestAnimationFrame(updateCounter);
            }

            function startCounting() {
                counters.forEach(counter => {
                    const target = +counter.getAttribute('data-target');
                    animateCount(target, counter);
                });
            }

            function checkScroll() {
                const section = document.querySelector('.achievements-section');
                const sectionTop = section.getBoundingClientRect().top;

                if (sectionTop < window.innerHeight && !started) {
                    startCounting();
                    started = true;
                }
            }

            window.addEventListener('scroll', checkScroll);
        });
    </script>
    <br>

            <!-- Why Us Section -->
            <section class="why-us-section">
                <div class="container">
                    <h2>Почему мы?</h2>
                    <div class="row">
                        <div class="col-md-4 why-us-item">
                            <div class="why-us-icon"><i class="fas fa-graduation-cap"></i></div>
                            <div class="why-us-text">Высококвалифицированные преподаватели</div>
                        </div>
                        <div class="col-md-4 why-us-item">
                            <div class="why-us-icon"><i class="fas fa-globe"></i></div>
                            <div class="why-us-text">Международные стандарты образования</div>
                        </div>
                        <div class="col-md-4 why-us-item">
                            <div class="why-us-icon"><i class="fas fa-users"></i></div>
                            <div class="why-us-text">Индивидуальный подход к каждому ученику</div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>


<section class="apply-section">
    <h2>Подайте документы в школу Имени Мирзо Улугбека</h2>
    <p>Присоединяйтесь к лучшим ученикам страны и получите качественное образование, открывающее двери в будущее!</p>
    <a href="https://portal.piima.uz/ru/schools/presidental-schools/17" 
       class="apply-button" 
       target="_blank">
       Подать документы
    </a>
</section>

<style>
    .apply-section {
        text-align: center;
        background: linear-gradient(135deg, #1a5f7a, #2C3E50);
        color: #fff;
        padding: 50px 20px;
        border-radius: 12px;
        margin: 50px auto;
        max-width: 800px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .apply-section h2 {
        font-size: 2.5em;
        margin-bottom: 20px;
    }

    .apply-section p {
        font-size: 1.2em;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .apply-button {
        display: inline-block;
        background-color:rgb(149, 212, 255);
        color: #333;
        font-size: 1.2em;
        padding: 15px 40px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .apply-button:hover {
        background-color: rgb(71, 181, 255);
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }
</style>
<script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const imageParts = document.querySelectorAll('.image-part');

    imageParts.forEach(part => {
        part.addEventListener('mouseenter', () => {
            // Увеличиваем выбранную часть
            part.style.flex = '3';
        });

        part.addEventListener('mouseleave', () => {
            // Возвращаем исходный размер
            part.style.flex = '1';
        });
    });
});
</script>
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>