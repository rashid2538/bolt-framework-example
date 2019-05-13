-- database `bolt_demo`

CREATE TABLE `user` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `login` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
 `password` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `todo_list` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `name` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
 `userId` int(10) unsigned NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `name` (`name`,`userId`),
 KEY `userId` (`userId`),
 CONSTRAINT `todo_list_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `todo_list_item` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `todoListId` int(10) unsigned NOT NULL,
 `done` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
 PRIMARY KEY (`id`),
 KEY `todoListId` (`todoListId`),
 CONSTRAINT `todo_list_item_ibfk_1` FOREIGN KEY (`todoListId`) REFERENCES `todo_list` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;