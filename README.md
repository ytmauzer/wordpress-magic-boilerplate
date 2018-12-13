


ⓦ WordPress Magic Boilerplate[![Codacy Badge](https://api.codacy.com/project/badge/Grade/d55f36e9bd444c54821dfb76f6eab833)](https://www.codacy.com/app/petrozavodsky/wordpress-magic-boilerplate?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=petrozavodsky/wordpress-magic-boilerplate&amp;utm_campaign=Badge_Grade) [![AUR](https://img.shields.io/aur/license/yaourt.svg)](https://www.gnu.org/licenses/gpl-3.0.en.html) [![WordPress](https://img.shields.io/badge/wordpress-5.0.1tested-brightgreen.svg)](https://ru.wordpress.org/releases/) [![built with gulp](https://img.shields.io/badge/build%20with-gulp-FA234B.svg)](http://gulpjs.com)
=======================


## WordPress Плагин
<img width='100' height='100' src="public/images/wordpress.png" title='WordPress Magic Boilerplate' alt='Wordpress Magic Boilerplate' align='right'>

Скелет плагина призванный привнести в ваш код WordPress код много срытой магии.
Позволяет повысить порог вхождения джуниоров в проект, ломает сложившие паттерны разработки WordPress.

## Полезность

Исходя из требований современных тенденций веб разработки плагин дает возможность ранее реализованные вещи более сложным образом.

Привносит в свой код все то что все мы так любим.
 - Многословность;
 - Быть может позднее статическое связывание;
 - Возможно кодогенирацию;
 - Мое субъективное видение проблем проблем WordPress;
 - ООП;
 - Навязывает зависимость от сторонних утилит.

Я ещё не определился с полным списком фитч и точно не уверен.
Документации на английском скорее всего не будет никогда.

## Установка
Понадобится перейти в каталог плагинов вашего сайта обычно это
`wp-content/plugins/` 

Далее клонируем  этот репозиторий:
`git@github.com:petrozavodsky/wordpress-magic-boilerplate.git` 

И переходим в каталог:
`wordpress-magic-boilerplate` 

Выдаем права на выполнение конфигуратора:
`chmod +x scaffold.sh`  

Придумываем имя будущего плагина (например MyPlugin) и  исполняем скрипт: 
`./scaffold.sh MyPlugin` 

Бинго ! Скелет будущего плагина создан, можно начинать разработку. 

[Подробнее об установке](https://github.com/petrozavodsky/wordpress-magic-boilerplate/wiki/%D0%A3%D1%81%D1%82%D0%B0%D0%BD%D0%BE%D0%B2%D0%BA%D0%B0)

## Фитчи

 - [PSR-4 автозагрузка](http://www.php-fig.org/psr/psr-4/) классов;
 - [PSR-2 Кодстайл ](https://www.php-fig.org/psr/psr-2/);
 - Универсальная структура проекта;
 - Каркас для базового класса плагина;
 - Авторегистрация [WordPress виджетов](https://codex.wordpress.org/Widgets_API) при создании их класса;
 - Правильная [регистрация и подключение ассетов](https://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts) разом;
 - Автоподключение ассетов изходя из названия файлов (css/javascript файлов);
 - Возможность облегчить перенос ассетов в нижнюю часть страницы сайта;
 - Удобные алиасы хуков;
 - [Сборщик фронтенда](http://gulpjs.com/);
 - Базовый класс для облегчающий [AJAX запросы в WordPress](https://codex.wordpress.org/AJAX);
 - Обертка для легкого создания [шорткодов](https://codex.wordpress.org/Function_Reference/add_shortcode);
 - Возможно что то еще.

## Стиль кода

В ядре WordPress не принято использовать PSR-2 но для плагина он вполне подойдет. В остальном рекомендации [wordpress.org](https://codex.wordpress.org/%D0%A1%D1%82%D0%B0%D0%BD%D0%B4%D0%B0%D1%80%D1%82%D1%8B_%D0%BA%D0%BE%D0%B4%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D1%8F_PHP) хорошие и их можно соблюдать.

## Сборка фронтенда

Для сборки используется таск менеджер [Gulp](http://gulpjs.com/) .

Все ресурсы имеющие отношение к фронтенду находятся в каталоге `public/`.

После установки нужно в каталоге плагина нужно выполнить  `npm install` для установки gulp и плагинов к нему. После установки можно приступить к сборке фронтенда  такс `gulp js` - минифицирует Javascript файлы в каталоге `public/js`  и кладет их рядом с оригинальными добавляя *.min.js перед расширением . Javascript файлы в каталоге `public/js/vendor` никак не обрабатываются, в него следует помещать сторонние библиотеки.

В качестве препроцессора [Less](http://lesscss.org/), возможно это не лучший выбор зато не избыточный и компилируется быстро. 

Все файлы с расширением *.less в каталоге `public/css` компилируются в css файлы с аналогичными именами и расширением `*.css`.  Запустить процесс можно командой `gulp css`.
Команда `gulp watch` включает автоматическое слежение за изменением js/css файлов, и при их изменении запускает их компиляцию.

Конкатенация нескольких файлов в один не происходит так как файлы скриптом и стилей обычно выводятся только на страницах сайта требующих их применения. Для объединения файлов в WordPress есть другие инструменты которые могут решить эту проблему и будут работать с такой структурой проекта.

Если в WordPress константа `CONCATENATE_SCRIPTS` равна true то будут использованы не минифицированные версии скриптов.

Графические файлы любых типов в каталоге `public/images` могут быть минифицированный автоматически, об этом не нужно заботиться в момент их создания. В gulpfile.js есть соответствующий таск.

----------

**Внимание** семантическое версионирование, между мажорными версиями (когда они появятся) совместимость точно будет ломаться. 

