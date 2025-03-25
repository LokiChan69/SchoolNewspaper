-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 22 2025 г., 20:46
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `school_news`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password_hash`) VALUES
(3, 'admin', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4'),
(4, 'qwertyiop123456789', 'fb07446f95e3f0e2df9e3598f36855d597de6207455c4f3a3a28709b467dca26');

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `content` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `published_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `title`, `short_description`, `content`, `image_url`, `published_date`, `author`) VALUES
(1, 'Важное школьное событие', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'шфыаофшывфвфышвофышвофывофшыовшфыовшфыовфыоволфытволфытволфытволфытвл', 'images/event1.jpg', '2024-11-09 14:56:02', 'Иван Иванов'),
(2, 'Новая выставка в школе', '1Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'Текст статьи о выставке...', 'images/exhibit.jpg', '2024-11-09 14:56:02', 'Мария Смирнова'),
(3, 'Интервью с учителем', '2Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'Текст интервью с учителем...', 'images/interview.jpg', '2024-11-09 14:56:02', 'Анна Кузнецова'),
(4, 'Maktabimizda katta Non festivali! ', 'Azizlar, 12-noyabr kuni maktabimizda \"Chinor Academy\" taklifi bilan \"Chinor Volunteering\" va Maktab ...', 'Azizlar, 12-noyabr kuni maktabimizda \"Chinor Academy\" taklifi bilan \"Chinor Volunteering\" va Maktab ma\'muriyati hamkorligida \"Non festivali\" bo‘lib o‘tadi. Bu tadbirda sizni yuzlab turdagi nonlarning xilma-xilligini kashf qilish va har biridan tatib ko‘rish imkoniyati kutmoqda! Ushbu festivalda istalgan odam ishtirok etishi mumkin va barchasi bepul\r\n\r\nFestival davomida quyidagilar bo‘ladi: \r\n\r\nTurli millat va hududlarga xos yuzlab nonlar: hududiy nonlardan tortib to an’anaviy nonlargacha, bug\'doyli nonlardan tortib to kepakli nonlargacha! \r\n\r\nMehmonlar uchun tatib ko‘rish imkoniyati: har bir ishtirokchi o‘ziga yoqadigan nonni tanlab, tatib ko‘rishi mumkin.\r\n\r\nMusiqa va ko‘ngilochar dasturlar: bayram ruhini yanada ko‘tarish uchun maxsus musiqalar, milliy o\'yinlar  va har bir sinf tomonidan tayyorlangan o\'yinlar\r\n\r\nMahorat darslari - non hamirini tayyorlashdan tortib to pishirishgacha \r\n\r\nHayriya auksioni. Eng yaxshi baholangan va o\'quvchilar o\'zlari tayyorlagan nonlari ota-onalar o\'rtasida auksionga qo\'yiladi. Barcha to\'plangan pullar \"Chinor g\'azna\" hayriya tashkiloti bilan hamkorlikda bolalar uyi uchun sarflanadi\r\n\r\nFestivalimizning eng asosiy qismi – Non ulashish paradi bo‘lib, unda asosiy ishtirokchilar maktabdan to katta yo\'l bo\'ylab parad shaklida milliy kiyimlar va maktab bayroqlari bilan nonlarni istalgan insonlarga ulashishadi. Bu esa bayramning eng hayajonli va quvonchli lahzalari bo‘ladi\r\n\r\nFestival sanasi: 12-noyabr\r\nVaqti: 14:15 dan 17:00 gacha\r\nManzil: Maktab hovlisi\r\n\r\nBarcha non sevuvchilarni bu ajoyib tadbirga taklif etamiz. Keling, birgalikda mazali nonga to‘la kunni nishonlaymiz! Bu kutilmagan zavqlarga boy bo‘lgan tadbirni o‘tkazib yubormang‼️', 'imgs/1731255528_234.jpg', '2024-11-10 16:18:48', 'Javlon'),
(5, 'Maktabimizda katta Non festivali! ', 'Azizlar, 12-noyabr kuni maktabimizda \"Chinor Academy\" taklifi bilan \"Chinor Volunteering\" va Maktab ...', 'Azizlar, 12-noyabr kuni maktabimizda \"Chinor Academy\" taklifi bilan \"Chinor Volunteering\" va Maktab ma\'muriyati hamkorligida \"Non festivali\" bo‘lib o‘tadi. Bu tadbirda sizni yuzlab turdagi nonlarning xilma-xilligini kashf qilish va har biridan tatib ko‘rish imkoniyati kutmoqda! Ushbu festivalda istalgan odam ishtirok etishi mumkin va barchasi bepul\r\n\r\nFestival davomida quyidagilar bo‘ladi: \r\n\r\nTurli millat va hududlarga xos yuzlab nonlar: hududiy nonlardan tortib to an’anaviy nonlargacha, bug\'doyli nonlardan tortib to kepakli nonlargacha! \r\n\r\nMehmonlar uchun tatib ko‘rish imkoniyati: har bir ishtirokchi o‘ziga yoqadigan nonni tanlab, tatib ko‘rishi mumkin.\r\n\r\nMusiqa va ko‘ngilochar dasturlar: bayram ruhini yanada ko‘tarish uchun maxsus musiqalar, milliy o\'yinlar  va har bir sinf tomonidan tayyorlangan o\'yinlar\r\n\r\nMahorat darslari - non hamirini tayyorlashdan tortib to pishirishgacha \r\n\r\nHayriya auksioni. Eng yaxshi baholangan va o\'quvchilar o\'zlari tayyorlagan nonlari ota-onalar o\'rtasida auksionga qo\'yiladi. Barcha to\'plangan pullar \"Chinor g\'azna\" hayriya tashkiloti bilan hamkorlikda bolalar uyi uchun sarflanadi\r\n\r\nFestivalimizning eng asosiy qismi – Non ulashish paradi bo‘lib, unda asosiy ishtirokchilar maktabdan to katta yo\'l bo\'ylab parad shaklida milliy kiyimlar va maktab bayroqlari bilan nonlarni istalgan insonlarga ulashishadi. Bu esa bayramning eng hayajonli va quvonchli lahzalari bo‘ladi\r\n\r\nFestival sanasi: 12-noyabr\r\nVaqti: 14:15 dan 17:00 gacha\r\nManzil: Maktab hovlisi\r\n\r\nBarcha non sevuvchilarni bu ajoyib tadbirga taklif etamiz. Keling, birgalikda mazali nonga to‘la kunni nishonlaymiz! Bu kutilmagan zavqlarga boy bo‘lgan tadbirni o‘tkazib yubormang‼️', 'imgs/1731255542_234.jpg', '2024-11-10 16:19:02', 'Javlon'),
(6, 'tadbir zor otdi', 'Assalomu alaykum hurmatli o\'quvchilar!\r\n\r\n\r\nBugungi tadbir uchun barcha sinf o\'quvchilariga o\'z minn...', 'Assalomu alaykum hurmatli o\'quvchilar!\r\n\r\n\r\nBugungi tadbir uchun barcha sinf o\'quvchilariga o\'z minnatdorchiligimizni bildiramiz! Boisi bugungi tadbirda:\r\n\r\n100 dan ortiq mehmonlarni qamrab oldik. Bular orasida Kanadalik Professor Lui Train, mahalla raislari, Turizm vazirligi katta turdagi tadbirlarni tashkillashtirish rahbari o\'rinbosari Yuliena xonim ham bo\'ldi.\r\n\r\nMaktabimizdagi tadbir haqida 3 ta telegram kanallarida e\'lon qilindi\r\n\r\n Afisha.uz (https://t.me/afishauzb/8788) - 8 168 ta obunachi\r\n Мероприятия Ташкент (https://t.me/tashkent_gogo/3063) - 12 669 ta obunachi\r\n Tashkent go - 12 085 ta obunachi \r\n\r\nHamda 2 ta telekanal:\r\n       \r\n     Aqlvoy - 15-20 daqiqalik efir uchun reportaj\r\n     Mening Yurtim 5 -   To\'liq katta efir uchun reportaj\r\n       Qolaversa, Juma kuni bo\'lib o\'tadigan efir uchun alohida bugungi Non festivali haqida ma\'lumot berish uchun kelishuv tuzildi.\r\n\r\nTadbir davomida barcha sinf o\'quvchilari tomonidan 170 dan ziyod 190 ga yaqin non turlari taqdim etildi.\r\n\r\nTadbirda 130 dan ziyod o\'quvchilar qamrab olindi. Mahorat darslarimizda esa maktabimiz qizlari bilan ikki turdagi xamirdan bir qancha nonlar tayyorlanib mehmonlarga tortiq qilindi.\r\n\r\nTadbirdan \"Chinor G\'azna\" xayriya tashkiloti uchun 2 007 400 so\'m miqdorda mablag\' to\'planildi.\r\n\r\nShu bois Chinor hamjamiyati va Maktab ma\'muriyati barcha o\'quvchilarga, qolaversa barcha tarbiyachalarga hamda ustozlarimizga  o\'z minnatdorchiligini bildiradi.', 'imgs/1731438932_aa.jpg', '2024-11-12 19:15:32', 'Javlon'),
(7, 'Announcement: Best School Website Competition', 'Dear Students, \r\n\r\nWe are excited to announce the Best School Website Competition! This is your chan...', 'Dear Students, \r\n\r\nWe are excited to announce the Best School Website Competition! This is your chance to showcase your creativity, technical skills, and vision for a modern, engaging school website.\r\n\r\nKey Details:\r\nDate of  Application Submission: 15 March\r\nCriteria:\r\n\r\nDesign & Aesthetics\r\nUser-Friendliness\r\nContent Quality\r\nInnovative Features\r\nWho Can Participate?\r\nAll students and teachers are welcome to join individually or in teams of up to 5 members.\r\n\r\nWinners will receive exciting prizes and have their designs featured as our official school website!\r\n\r\nLet’s show everyone how talented and creative our school community is. We look forward to seeing your amazing ideas!\r\n\r\nGrand prize: 3,000,000 sums\r\n\r\nRegulations  (https://telegra.ph/Musobaqa-Otkazish-Nizomi-03-01-2)\r\nGroup for more info (https://t.me/+irPn_HYAgdAyZWIy)\r\n\r\nFor more information and registration, contact @Ibrohimbukh', 'imgs/1741673623_1222313.jpg', '2025-03-11 06:13:43', 'Ibrohim'),
(8, 'asd', 'qerqwj...', 'qerqwj', 'imgs/1741681714_3414.jpg', '2025-03-11 08:28:34', 'Javlontoy'),
(9, 'Test', 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lor...', 'What is Lorem Ipsum?\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\n\nWhy do we use it?\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\n\n\nWhere does it come from?\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'imgs/1741690529_photo_2024-10-12_23-12-20.jpg', '2025-03-11 10:55:29', 'Nurik'),
(10, 'a', 'b', 'b', 'imgs/1731255528_234.jpg', '2025-03-14 13:29:30', 'Javlon'),
(11, 'NON', 'clb', 'mikumikubeeem', 'imgs/1741959198_robo.jfif', '2025-03-14 13:33:18', 'Ibrohim'),
(12, 'AYOLGA EHTIROM\" HAFTALIGI ', 'Bu juda ajoyib tashabbus! \r\n\r\nAyollarga bo‘lgan ehtiromni sport orqali ifodalash nafaqat ularning ji...', 'Bu juda ajoyib tashabbus! \r\n\r\nAyollarga bo‘lgan ehtiromni sport orqali ifodalash nafaqat ularning jismoniy faolligini oshiradi, balki intellektual salohiyatini ham rivojlantiradi. \r\n\r\nBunday tadbirlar ayollar va qizlarni sportga jalb qilish, ularning sog‘lom turmush tarzini qo‘llab-quvvatlash hamda jamoaviy ruhni mustahkamlashda muhim ahamiyatga ega. \r\n﻿\r\nMirzo Ulug‘bek nomidagi ixtisoslashtirilgan maktabida \"Ayolga ehtirom\" haftaligi doirasida \"SPORT SALOMATLIK MANBAI\" shiori ostida o‘tkazilgan ushbu \r\nVoleybol \r\nBasketbol \r\nShaxmat va shashka \r\nArqonda sakrash va darts\r\nmusobaqalari barcha ishtirokchilarga ruhiy ko‘tarinkilik va motivatsiya ulashganiga shubha yo‘q. \r\nAyniqsa, shaxmat va shashka musobaqalari mantiqiy tafakkurni rivojlantirsa, volleyball va basketbol jamoaviy ishlash qobiliyatini oshiradi. Arqonda sakrash va darts esa e’tibor va chaqqonlikni mustahkamlashga yordam beradi. \r\n\r\nMusobaqada ishtirok etgan o‘qituvchi va o‘quvchi qizlarimizga muvaffaqiyat va yanada yuksak g‘alabalar tilaymiz!', 'imgs/1741959601_chaynik i pechka.jpg', '2025-03-14 13:40:01', 'Shohruz'),
(13, 'Diqqat, iqtidorlilar saralanadi!', 'Maktabgacha va maktab ta’limi vazirligi tomonidan mamlakatimizda ILK MAROTOBA “Iqtidor” maktab ansam...', 'Maktabgacha va maktab ta’limi vazirligi tomonidan mamlakatimizda ILK MAROTOBA “Iqtidor” maktab ansambli Respublika tanlovi o’tkaziladi.\r\n\r\nMaqsadimiz — umumiy o‘rta ta’lim maktablaridagi ansambllar faoliyatini qo‘llab-quvvatlash orqali hududlarda milliy cholg‘uchilik san’atini rivojlantirishdan iborat.\r\n\r\nTanlov 6-10-sinf o‘quvchilari o‘rtasida milliy cholg‘ular yo‘nalishida aprel oyida o‘tkaziladi. \r\n\r\nRespublika bosqichida g‘oliblikni qo‘lga kiritgan maktab ansambli xorijiy mamlakatga ta’lim sayohatini qo‘lga kiritadi.\r\n\r\nTanlovda ishtirok etish uchun quyidagi telegram bot orqali ro‘yxatdan o‘ting: @iqtidoransambli_bot\r\n\r\nTANLOV NIZOMI (https://drive.google.com/file/d/1nWpD1NzGrvRe7CVjtTDvsxJnfz2Tayyx/view)\r\n\r\nBatafsil ma’lumotlarni vazirlikning rasmiy kanali (https://t.me/uzedu) va @maktabtanlovlari manzili orqali kuzatib boring.\r\n\r\n@hilola_umarova', 'imgs/1741959829_iqiiq.jpg', '2025-03-14 13:43:49', 'Javlon'),
(14, 'eko-zakovat', 'eko_zakovat\r\n\r\nIxtisoslashtirilgan ta’lim muassasalari agentligi tizimidagi Mirzo Ulug‘bek nomidagi ...', 'eko_zakovat\r\n\r\nIxtisoslashtirilgan ta’lim muassasalari agentligi tizimidagi Mirzo Ulug‘bek nomidagi ixtisoslashtirilgan maktabida \"Eko-Schools Uzbekistan\" loyihasiga a’zo maktablar oʻrtasida \"EKO ZAKOVAT\" intellektual o‘yini bo‘lib o‘tdi. Musobaqa qizg\'in va qiziqarli kechdi. \r\n\r\nTadbirda o’quvchilar ekologik muammolar, tabiatni muhofaza qilish hamda boshqa muhim mavzular haqida o’z bilimlarini oshirdilar. Musobaqa natijalariga ko’ra:\r\n\r\n1-о‘rinni – Mirzo Ulug‘bek nomidagi ixtisoslashtirilgan maktabi;\r\n2-o‘rinni – Abdulla Qodiriy nomidagi ijod maktabi;\r\n3-o‘rinni – Olmazor tuman ixtisoslashtirilgan maktabi jamoalari qo’lga kiritdi.\r\n  \r\nG‘oliblar bilan bir qatorda qolgan barcha jamoalar faxriy yorliq va esdalik sovg‘alar bilan taqdirlandilar.\r\n\r\nShuningdek \"EKO ZAKOVAT\" intellektual o\'yini doirasida jamoalar ishtirokida maktab issiqxonasiga turli xildagi poliz ekinlarining urugʻlari ham ekildi.\r\n\r\n\"EKO ZAKOVAT\" o‘yini orqali o‘quvchilar nafaqat ekologik mavzular bo‘yicha bilimlarini sinovdan o‘tkazdilar, balki jamoaviy ishlash va tahliliy fikrlash ko‘nikmalarini ham rivojlantirdilar.\r\n', 'imgs/1741959946_eko.jpg', '2025-03-14 13:45:46', 'Javlon');

-- --------------------------------------------------------

--
-- Структура таблицы `clubes`
--

CREATE TABLE `clubes` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `content` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `published_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `clubes`
--

INSERT INTO `clubes` (`id`, `title`, `short_description`, `content`, `image_url`, `published_date`, `author`) VALUES
(1, 'Шахматный клуб ', 'Крупнейшая школа шахмат в России\r\n13 лет обучаем детей шахматам\r\nСобственная программа обучения, док...', 'Крупнейшая школа шахмат в России\r\n13 лет обучаем детей шахматам\r\nСобственная программа обучения, доказавшая эффективность\r\nОбучение в удобное время (работаем 24/7)\r\nУчастие и победы учеников в крупных шахматных турнирах', 'imgs/1741890276_1689193739_new_preview_maxresdefault.jpg', '2025-03-13 18:24:36', 'Бехруз Ниязов'),
(2, 'Таеквандо Клуб', 'Тренера ТГОАТУ тренируют во всех районах г. Ташкента. Представляют г. Ташкент во всех соревнованиях ...', 'Тренера ТГОАТУ тренируют во всех районах г. Ташкента. Представляют г. Ташкент во всех соревнованиях Таэквондо WT проводимых на территории республики Узбекистан. Также принимают участие в соревнованиях и сборах, проводимых в различных странах.', 'imgs/1741890771_ava.jpg', '2025-03-13 18:32:51', 'Хуршид'),
(3, 'Eco Nest club', 'Eco Nest — Клуб экологов\r\nПрирода зовёт — ответь ей вместе с нами!\r\n\r\nEco Nest — это не просто клуб,...', 'Eco Nest — Клуб экологов\r\nПрирода зовёт — ответь ей вместе с нами!\r\n\r\nEco Nest — это не просто клуб, это сообщество единомышленников, которые верят, что маленькие шаги могут привести к большим переменам. Если тебе небезразлична судьба нашей планеты, если ты задумываешься о чистоте окружающей среды, о сохранении лесов, рек и животных, то здесь ты найдёшь свою команду!\r\n\r\nЧем мы занимаемся:\r\nОрганизуем акции по озеленению территории и высадке деревьев.\r\nПроводим мастер-классы по переработке отходов и созданию экотоваров.\r\nУчаствуем в экологических проектах, направленных на сокращение углеродного следа.\r\nРаспространяем знания об экологии через социальные кампании и школьные мероприятия.\r\n\r\nПочему стоит присоединиться:\r\n\r\nТы станешь частью команды, которая реально влияет на окружающий мир.\r\nНаучишься создавать экологичные решения для повседневной жизни.\r\nПолучишь возможность участвовать в конкурсах, проектах и даже волонтёрских программах.\r\nЕсли ты чувствуешь в себе желание действовать и менять будущее — мы ждём тебя!', 'imgs/1741959014_ecopicu.jpg', '2025-03-14 13:30:14', 'Javlon'),
(4, 'Robotics Club', 'Создавай будущее своими руками!\r\n\r\nRobotics Club — это место, где технологии и креативность объединя...', 'Создавай будущее своими руками!\r\n\r\nRobotics Club — это место, где технологии и креативность объединяются, чтобы создавать удивительные вещи. Если ты мечтаешь оживить свои инженерные идеи, разобраться в принципах программирования, создавать механизмы и соревноваться с другими изобретателями — этот клуб для тебя!\r\n\r\nЧем мы занимаемся:\r\nКонструируем роботов — от простых механизмов до сложных автономных устройств.\r\nИзучаем программирование, микроконтроллеры и искусственный интеллект.\r\nУчаствуем в соревнованиях по робототехнике, включая школьные и региональные чемпионаты.\r\nПроводим воркшопы по 3D-моделированию и дизайну роботизированных систем.\r\n\r\nПочему стоит присоединиться:\r\n\r\nТы получишь практические навыки работы с электроникой и программированием.\r\nНаучишься мыслить, как инженер, решая реальные технические задачи.\r\nВстретишь людей, которые также горят идеями и хотят создавать технологии завтрашнего дня.\r\nЕсли ты готов воплощать идеи в реальность и строить мир будущего — добро пожаловать в Robotics Club!\r\n\r\n', 'imgs/1741959311_robo.jfif', '2025-03-14 13:35:11', 'Ibrohim'),
(5, 'Research Club', 'Исследуй. Открывай. Создавай.\r\n\r\nResearch Club — это пространство для тех, кто не перестаёт задавать...', 'Исследуй. Открывай. Создавай.\r\n\r\nResearch Club — это пространство для тех, кто не перестаёт задавать вопросы и искать ответы. Если тебе интересно, как устроен мир, почему происходят те или иные явления, если ты мечтаешь разрабатывать новые проекты и проводить собственные эксперименты — этот клуб ждёт тебя!\r\n\r\nЧем мы занимаемся:\r\nПроводим научные эксперименты в области физики, химии, биологии и IT.\r\nСоздаём исследовательские проекты и защищаем их на конкурсах и конференциях.\r\nОбсуждаем научные открытия, изучаем статьи и тренды в разных областях науки.\r\nСотрудничаем с экспертами и учёными, участвуем в мастер-классах и лекциях.\r\n\r\nПочему стоит присоединиться:\r\n\r\nТы научишься ставить гипотезы, собирать данные и анализировать результаты.\r\nПолучишь опыт публичных выступлений, защищая свои проекты на научных мероприятиях.\r\nОткроешь для себя новые горизонты, готовясь к будущей карьере в науке и исследованиях.\r\nЕсли ты готов экспериментировать, изучать и двигать науку вперёд — Research Club ждёт тебя!', 'imgs/1741959421_res.jpg', '2025-03-14 13:37:01', 'Behruz Niyazov');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clubes`
--
ALTER TABLE `clubes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `clubes`
--
ALTER TABLE `clubes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
