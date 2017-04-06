
Wordpress Magic Boilerplate [![AUR](https://img.shields.io/aur/license/yaourt.svg)](https://www.gnu.org/licenses/gpl-3.0.en.html) [![WordPress](https://img.shields.io/badge/wordpress-4.7.3%20tested-brightgreen.svg)](https://ru.wordpress.org/releases/)
=======================

**#RU**

**WordPress Плагин**

Скелет плагина призванный привнести в ваш код WordPress код много срытой магии.
Позволяет повысить порог вхождения джуниоров в проект, ломает сложившие паттерны разработки WordPress.

Привносит в код нашего будущего плагина все то что все мы так любим.
 - Мое субъективное видение проблем проблем WordPress;
 - ООП;
 - Многословность;
 - Быть может позднее статическое связывание;
 - Возможно кодогенирацию;
 - Навязывает зависимость от сторонних утилит.

Я ещё не определился с полным списком фитч и точно не уверен.
Документации на английском скорее всего не будет никогда.

**Фитчи:**
 - [PSR-4 автозагрузка](http://www.php-fig.org/psr/psr-4/) классов;
 - Универсальная структура проекта;
 - Авторегистрация WordPress виджетов при создании класса;
 - Автоподключение асертов изходя из названия файлов (css/javascript файлов);
 - Регистрация и подключение асертов разом;
 - Удобные алиасы хуков;
 - Возможность облегчить перенос асертов в нижнюю часть страницы сайта;
 - Сборщик фронтенда;
 - Возможно что то еще.

**Внимание** семантическое версионирование, между мажорными версиями совместимость точно будет ломаться.

После установки нужно сделать `npm install` для установки gulp и плагинов к нему. 
