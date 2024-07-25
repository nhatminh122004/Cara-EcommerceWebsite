-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 25, 2024 lúc 09:24 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ecommerceshop`
--
CREATE DATABASE IF NOT EXISTS `ecommerceshop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ecommerceshop`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `phone` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `type` enum('Admin','Staff') NOT NULL DEFAULT 'Staff',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `phone`, `address`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Nhat Minh', 'nhatminh122004@gmail.com', '2024-07-15 23:08:19', '12345', '1234512345', '0364244786', 'Phú Yên', 'Active', 'Admin', NULL, NULL),
(2, 'NV1', 'nv1@gmail.com', '2024-07-15 23:08:19', '12345', '1234512345', '0364244786', 'Phú Yên', 'Active', 'Staff', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Adidas', 'adidas', 'Active', NULL, NULL),
(3, 'Nike', 'nike', 'Active', NULL, NULL),
(4, 'Puma', 'puma', 'Active', NULL, NULL),
(5, 'SMAKER', 'smaker', 'Active', NULL, NULL),
(50, 'LONG BÀO', 'long-b-o', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mens shirt', 'mens-shirt', 'Active', NULL, NULL),
(2, 'Women Shirt', 'women-shirt', 'Active', NULL, NULL),
(3, 'Female trousser', 'female-trousser', 'Active', NULL, NULL),
(9, 'Male pants', 'male-pants', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_03_123426_create_admins_table', 1),
(6, '2023_10_03_130747_create_categories_table', 2),
(7, '2023_10_03_130946_create_brands_table', 2),
(8, '2023_10_03_132635_create_products_table', 3),
(9, '2023_10_03_135606_create_reviews_table', 4),
(10, '2023_10_04_080710_create_orders_table', 5),
(11, '2023_10_04_081411_create_order_details_table', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `newcategories`
--

CREATE TABLE `newcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `newscategory_id` int(12) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `newcategories`
--

INSERT INTO `newcategories` (`id`, `name`, `slug`, `status`, `newscategory_id`, `created_at`, `updated_at`) VALUES
(8, 'New Collection', 'new-collection', 'Active', 0, NULL, NULL),
(11, 'Brand News', 'brand-news', 'Active', 0, NULL, NULL),
(12, 'Technology and Creativity', 'technology-and-creativity', 'Active', 0, NULL, NULL),
(13, 'Discounts and Promotions', 'discounts-and-promotions', 'Active', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` bigint(20) NOT NULL,
  `tittle` varchar(150) NOT NULL,
  `avatar` varchar(250) NOT NULL,
  `slug` varchar(1) NOT NULL,
  `sumary` text NOT NULL,
  `description` text NOT NULL,
  `newcategories_id` int(11) NOT NULL,
  `brand_id` bigint(12) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `tittle`, `avatar`, `slug`, `sumary`, `description`, `newcategories_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(1, 'Luxury Fashion For Special Events', 'uploads/news/66a0b51840885b1.jpg', 'l', 'The luxurious evening gown exudes elegance and sophistication, making it the perfect choice for formal events and special occasions. ', 'This chic evening gown exudes elegance and sophistication, making it the perfect choice for formal events and special occasions. Made from premium satin, the dress\'s flowing silhouette creates a graceful silhouette as it wraps the body, while hand-embroidered details and detailed sequins add a touch of glamour. The dress has a sweetheart neckline and a sweeping skirt that creates an impressive and unforgettable entrance.\r\nDon\'t miss the opportunity to own this evening dress to look stunning at any event you attend. Explore more of our evening gown collection and find the perfect style for you.', 10, 3, '2024-01-13 15:54:13', '2024-01-13 15:54:13'),
(2, 'Cozy Cashmere Sweater', 'uploads/news/66a0b6aab7322b2.jpg', 'c', 'Discover ultimate comfort and timeless style with this collection of premium cashmere sweaters, ideal for both casual and formal occasions.', '12/21/2023 - Experience ultimate luxury and warmth with this collection of premium cashmere sweaters. Made from the finest cashmere fibers, this premium cashmere sweater is not only soft but also provides all-day comfort. With a classic round neck design and ribbed cuff details, it combines traditional and modern beauty. This sweater is perfect for both relaxing outings and formal events, ensuring you stay cool and warm during the cold months.', 8, 2, '2023-12-21 15:52:36', '2023-12-21 15:52:36'),
(3, 'Versatile Tailored Blazer Sale', 'uploads/news/66a0b8dcc1971b3.jpg', 'v', 'Don\'t miss the chance to own a versatile blazer from SMAKER at an attractive discount during this special sale.\r\n                        ', '10/06 - Elevate your professional style with the versatile tailored blazer from SMAKER, now available at a special discount. Meticulously designed, this blazer features a sleek lapel collar, structured shoulders, and a single-button closure that accentuates your modern silhouette. Constructed from high-quality wool blend fabric, it offers both style and functionality, effortlessly transitioning from the office to after-work gatherings and formal events. Act fast to take advantage of this exclusive offer!\r\n                        ', 13, 5, '2024-06-10 15:18:36', '2024-06-10 15:18:36'),
(7, 'Versatile Tailored Blazer Sale', 'uploads/news/66a0baa178cd6b4.jpg', 'v', 'Don\'t miss the chance to own a versatile blazer from SMAKER at an attractive discount during this special sale.      ', 'Elevate your professional style with the versatile tailored blazer from SMAKER, now available at a special discount. Meticulously designed, this blazer features a sleek lapel collar, structured shoulders, and a single-button closure that accentuates your modern silhouette. Constructed from high-quality wool blend fabric, it offers both style and functionality, effortlessly transitioning from the office to after-work gatherings and formal events. Act fast to take advantage of this exclusive offer!', 11, 4, '2024-07-24 15:26:09', '2024-07-24 15:26:09'),
(8, 'Relaxed Boho Maxi Dress', 'uploads/news/66a0bc5200b81b5.jpg', 'r', 'Grab the chance to enhance your wardrobe with the relaxed boho maxi dress from Puma, now available at a special discount during this limited-time sale.\r\n                        ', 'Refresh your summer style with the relaxed boho maxi dress from Puma, now offered at an attractive discount. This dress features a flowing silhouette, with a soft, lightweight fabric that drapes beautifully. Its intricate patterns and adjustable waist ensure a flattering fit while embracing the free-spirited boho aesthetic. Perfect for casual outings, beach days, or laid-back gatherings, this maxi dress combines comfort and style effortlessly. Don’t miss out on this exclusive offer to elevate your wardrobe with a touch of bohemian charm!\r\n                        ', 13, 3, '2023-11-21 15:33:22', '2023-11-21 15:33:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `newscategories`
--

CREATE TABLE `newscategories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `status` enum('Active','Innactive') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `newscategories`
--

INSERT INTO `newscategories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Danh mục A', 'danh-m-c-a', 'Active', NULL, NULL),
(3, 'Danh mục B', 'danh-m-c-b', 'Active', NULL, NULL),
(4, 'Danh mục C', 'danh-m-c-c', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` enum('Processing','Confirmed','Shipping','Delivered','Cancelled') NOT NULL DEFAULT 'Processing',
  `product_id` bigint(20) NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `firstname`, `lastname`, `address`, `phone`, `email`, `status`, `product_id`, `price`, `created_at`, `updated_at`) VALUES
(19, NULL, 'Văn', 'Xẻn', 'sssssss', '0364244781', 'nihkog@email10p.cyou', 'Shipping', 35, 135, '2024-07-24 22:59:37', '2024-07-24 22:59:37'),
(20, NULL, 'Văn', 'Xẻn', 'sssssss', '0364244781', 'nihkog@email10p.cyou', 'Shipping', 19, 150, '2024-07-25 02:30:35', '2024-07-25 02:30:35'),
(21, NULL, 'Văn', 'Xẻn', 'sssssss', '0364244781', 'nihkog@email10p.cyou', 'Cancelled', 18, 150, '2024-07-25 02:30:35', '2024-07-25 02:30:35'),
(22, NULL, 'Văn', 'Xẻn', 'sssssss', '0364244781', 'nihkog@email10p.cyou', 'Processing', 34, 135, '2024-07-25 03:33:06', '2024-07-25 03:33:06'),
(23, NULL, 'Văn', 'Xẻn', 'sssssss', '0364244781', 'nihkog@email10p.cyou', 'Confirmed', 19, 150, '2024-07-25 03:33:06', '2024-07-25 03:33:06'),
(24, NULL, 'Văn', 'Xẻn', 'sssssss', '0364244781', 'nihkog@email10p.cyou', 'Processing', 22, 150, '2024-07-25 07:12:17', '2024-07-25 07:12:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price` double NOT NULL,
  `qty` tinyint(4) NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `summary` text NOT NULL,
  `stock` tinyint(3) UNSIGNED NOT NULL,
  `price` double NOT NULL,
  `disscounted_price` double NOT NULL,
  `images` text NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `summary`, `stock`, `price`, `disscounted_price`, `images`, `category_id`, `brand_id`, `status`, `created_at`, `updated_at`) VALUES
(18, 'Red Blossom Shirt Women', 'red-blossom-shirt-women', '', 'f4', 123, 150, 139, 'uploads/669d4cd048c28f4.jpg', 2, 5, 'Active', NULL, NULL),
(19, 'Floral Summer Shirt', 'floral-summer-shirt', '', 'floral-shirt', 123, 150, 139, 'uploads/669d563742ebcf5.jpg', 2, 3, 'Active', NULL, NULL),
(20, 'Casual Colorblock Shirt', 'casual-colorblock-shirt', '', 'casual-shirt', 123, 150, 139, 'uploads/669d575977ecaf6.jpg', 2, 4, 'Active', NULL, NULL),
(22, 'Abstract Pattern Blouse', 'abstract-pattern-blouse', '', 'pattern-blouse', 123, 150, 139, 'uploads/66a1c81e47a3eẢnh chụp màn hình 2024-07-03 124456.png', 2, 5, 'Active', NULL, NULL),
(33, 'Floral Pattern Shirt', 'floral-pattern-shirt', '', 'f1', 123, 135, 89, 'uploads/669fccf541aaa_f1.jpg', 1, 2, 'Active', NULL, NULL),
(34, 'Tropical Leaf Shirt', 'tropical-leaf-shirt', '', 'f2', 123, 135, 89, 'uploads/669fce8018e93_f2.jpg', 1, 2, 'Active', NULL, NULL),
(35, 'Red Blossom Shirt Men', 'red-blossom-shirt-men', '', 'f3', 123, 135, 89, 'uploads/669fd768b2f0b_f3.jpg', 1, 3, 'Active', NULL, NULL),
(36, 'Linen Floral Pants', 'linen-floral-pants', '', 'f7', 123, 135, 89, 'uploads/669fd7ed5b66f_f7.jpg', 3, 4, 'Active', NULL, NULL),
(37, 'Classic Light Blue Shirt', 'classic-light-blue-shirt', '', 'n1', 123, 135, 89, 'uploads/669fd8b953ed4_669e8446d5aeb_n1.jpg', 1, 3, 'Active', NULL, NULL),
(38, 'Modern Striped Shirt', 'modern-striped-shirt', '', 'n2', 123, 135, 89, 'uploads/669fd9032dcc9_669e846e5b44b_n2.jpg', 1, 2, 'Active', NULL, NULL),
(39, 'Elegant White Shirt', 'elegant-white-shirt', '', 'n3', 123, 135, 89, 'uploads/669fd92932654_669e9332443ee_n3.jpg', 1, 4, 'Active', NULL, NULL),
(40, 'Casual Printed Shirt', 'casual-printed-shirt', '', 'n4', 123, 135, 89, 'uploads/669fd9455a48f_669e9381da029_n4.jpg', 1, 5, 'Active', NULL, NULL),
(41, 'Denim Classic Shirt', 'denim-classic-shirt', '', 'n2', 123, 135, 89, 'uploads/669fdb16d80a5669e953e1286d_n5.jpg', 1, 3, 'Active', NULL, NULL),
(42, 'Striped Summer Shorts', 'striped-summer-shorts', '', 'n6', 123, 135, 89, 'uploads/669fdbb5bcd4d_669e956362691_n6.jpg', 1, 2, 'Active', NULL, NULL),
(43, 'Khaki Utility Shirt', 'khaki-utility-shirt', '', 'n7', 123, 135, 89, 'uploads/669fdbece58fa_669e96c15385b_n7.jpg', 1, 4, 'Active', NULL, NULL),
(44, 'Short Sleeve Collar Shirt', 'short-sleeve-collar-shirt', '', 'n8', 123, 135, 89, 'uploads/669fdc57da1b0_669e96ec4c205_n8.jpg', 1, 5, 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `phone` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `user_id`, `email`, `email_verified_at`, `password`, `remember_token`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bùi Công Thành', NULL, 'admin@gmail.com', '2023-10-17 01:30:09', '123456', NULL, '', '', 'Active', NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `newcategories`
--
ALTER TABLE `newcategories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `newscategories`
--
ALTER TABLE `newscategories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `newcategories`
--
ALTER TABLE `newcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `newscategories`
--
ALTER TABLE `newscategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
