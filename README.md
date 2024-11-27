
composer require slim/slim:"4.*" slim/psr7 php-di/php-di vlucas/valitron vlucas/phpdotenv monolog/monolog slim/twig-view
composer require phpunit/phpunit:"10.*" --dev


php -S localhost:8080
php -S localhost:8080 -t public/

composer dump-autoload

```json
//composer.json
"config": {
        "process-timeout": 0,
        "sort-packages": true
    },
```

```sql
CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text DEFAULT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

INSERT INTO `product` (`name`, `description`, `size`) VALUES
('Product One', NULL, 10),
('Product Two', 'example', 20);
```

```bash
git init
git add .
git commit -m "first commit"
git branch -M main

git push -u origin main
```