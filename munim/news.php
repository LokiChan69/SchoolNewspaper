<?php
require "header.php";
// Database configuration
$host = 'localhost'; 
$db   = 'school_news'; 
$user = 'root'; 
$pass = ''; 

/* ==============================================
 * DATABASE CONNECTION
 * ============================================== */
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
    exit;
}

/* ==============================================
 * SEARCH FUNCTIONALITY
 * ============================================== */
$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';
$searchParam = "%$searchQuery%";

// Get articles with search filter
$query = "SELECT id, title, content, published_date, image_url 
          FROM articles 
          WHERE title LIKE :query OR content LIKE :query 
          ORDER BY published_date DESC";

$stmt = $pdo->prepare($query);
$stmt->execute(['query' => $searchParam]);
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новости - Школьная Газета</title>
    
    <!-- External Resources -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Styles -->
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
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--background-color);
            color: var(--text-color);
            line-height: 1.8;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .main-content {
            margin-top: 50px;
            padding-top: 40px;
        }

        .search-container {
            margin-bottom: 40px;
            display: flex;
            justify-content: center;
        }

        #search-form {
            display: flex;
            width: 100%;
            max-width: 600px;
            background: #fff;
            border-radius: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1),
                        0 6px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            border-radius: 5px;
        }

        #search-form:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2),
                        0 10px 10px rgba(0, 0, 0, 0.1);
        }

        #search-input {
            flex: 1;
            padding: 15px 20px;
            border: none;
            font-size: 1rem;
            outline: none;
            background: transparent;
            z-index: 2;
        }

        #search-form button {
            padding: 15px 20px;
            background: var(--secondary-color);
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
            z-index: 2;
            border-bottom-left-radius: 27px;
        }

        #search-form button:hover {
            background: #2980b9;
            transform: scale(1.1);
        }

        #search-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 30px;
            z-index: 1;
            transition: opacity 0.3s ease;
        }

        #search-form:hover::before {
            opacity: 0;
        }

        .article {
            display: flex;
            align-items: center;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .article:hover {
            transform: translateY(-10px);
        }

        .article-content {
            flex: 1;
            margin-right: 20px;
        }

        .article h2 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 10px;
        }

        .article .date {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 15px;
        }

        .article p {
            font-size: 1rem;
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .article .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #5c6bc0;
            color: #fff;
            font-size: 0.9rem;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .article .btn:hover {
            background-color: #3949ab;
        }

        .article-image {
            width: 150px;
            height: 150px;
            border-radius: 12px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .article-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-results {
            text-align: center;
            font-size: 1.2rem;
            color: #777;
            margin-top: 20px;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <!-- MAIN CONTENT STRUCTURE -->
    <main class="main-content">
        <div class="container">
            <h2>Новости</h2>

            <!-- SEARCH FORM -->
            <div class="search-container">
                <form id="search-form" method="GET" action="news.php">
                    <input type="text" 
                           name="query" 
                           id="search-input" 
                           placeholder="Поиск статей..." 
                           value="<?= isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '' ?>">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>

            <!-- ARTICLES LIST -->
            <?php if (empty($articles)): ?>
                <div class="no-results">
                    <p>По вашему запросу ничего не найдено.</p>
                </div>
            <?php else: ?>
                <?php foreach ($articles as $article): ?>
                <div class="article fade-in">
                    <div class="article-content">
                        <h2><?= htmlspecialchars($article['title']) ?></h2>
                        <p class="date"><?= date('d.m.Y H:i', strtotime($article['published_date'])) ?></p>
                        <p><?= htmlspecialchars(substr($article['content'], 0, 150)) ?>...</p>
                        <a href="article.php?id=<?= $article['id'] ?>" class="btn">Читать далее</a>
                    </div>
                    
                    <?php if (!empty($article['image_url'])): ?>
                        <div class="article-image">
                            <img src="<?= htmlspecialchars($article['image_url']) ?>" 
                                 alt="<?= htmlspecialchars($article['title']) ?>">
                        </div>
                    <?php else: ?>
                        <div class="article-image">
                            <img src="https://via.placeholder.com/150" alt="Заглушка">
                        </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <script>
    window.addEventListener('load', () => {
        document.querySelectorAll('.fade-in').forEach(el => el.classList.add('visible'));
    });
    </script>
</body>
</html>