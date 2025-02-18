<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">ИнфоТех</h1>

        <p class="lead">Тестовое задание</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6 mx-auto mb-3">
                <h2>
                    Описание
                </h2>
                <p>
                    Необходимо сделать на фреймворке Yii2 + MySQL каталог книг. Книга может иметь несколько авторов.
                    Тестовое задание можно делать без верстки.
                </p>

                <ol>
                    <li>
                        Книга - название, год выпуска, описание, isbn, фото главной страницы.
                    </li>
                    <li>
                        Авторы - ФИО.
                    </li>
                </ol>

                <p>
                    Права на доступ:
                </p>
                <ol>
                    <li>Гость - только просмотр + подписка на новые книги автора.</li>
                    <li>Юзер - просмотр, добавление, редактирование, удаление. (CRUD). Отчет без разницы.</li>
                </ol>

                <p>
                    Отчет - ТОП 10 авторов выпустивших больше книг за какой-то год.
                </p>
                <h5>
                    ПЛЮСОМ БУДЕТ
                </h5>
                <p>
                    Уведомление о поступлении книг из подписки должно отправляться на смс гостю.
                </p>

                <a href="https://smspilot.ru/" target="_blank">https://smspilot.ru/</a>
                <p>
                    Там "Для тестирования можно использовать ключ эмулятор (реальной отправки SMS не происходит)."
                </p>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mx-auto mb-3">
                <h5>
                    Ответы на часто задаваемые вопросы/пожелания к выполнению:
                </h5>
                <ol>
                    <li>
                        <strong>Нужно сделать web приложение? Не API?</strong>
                        <br/>
                        <em>web</em>
                    </li>
                    <li>
                        <strong>Нужна авторизация?</strong>
                        <br/>
                        <em>Да</em>
                    </li>
                    <li>
                        <strong>
                            Отчет нужен как PDF? Или как отдельная страница? Если отдельная страница или PDF, то кто
                            имеет право ее видеть?
                        </strong>
                        <br/>
                        <em>Отдельная страница, доступ для всех</em>
                    </li>
                    <li>
                        <strong>
                            Нужен функционал администратора, который может управлять подпиской/отпиской?
                        </strong>
                        <br/>
                        <em>Не нужен</em>
                    </li>
                    <li>
                        <strong>Как осуществляется отписка от новых поступлений?</strong>
                        <br/>
                        <em>Это не требуется</em>
                    </li>
                    <li>
                        <strong>Пример кода будут запускать локально или смотреть по коду?</strong>
                        <br/>
                        <em>Просто смотреть</em>
                    </li>
                    <li>
                        <strong>Какие версии PHP и СУБД использовать?</strong>
                        <br/>
                        <em>PHP 8+, MySQL/MariaDB</em>
                    </li>
                    <li>
                        <strong>Какой шаблон yii2 использовать advanced или basic?</strong>
                        <br/>
                        <em>Любой, который Вы сочтёте более подходящим под эту задачу</em>
                    </li>
                    <li>
                        <strong>Для rbac использовать phpManager или dbManager?</strong>
                        <br/>
                        <em>Не принципиально</em>
                    </li>
                </ol>
                <ul>
                    <li>
                        <em>
                            По тестовому заданию нужна БД MySQL. Можно прислать в виде файлов, но без директорий runtime
                            и vendor. Дамп БД не нужен, нужны миграции.
                        </em>
                    </li>
                    <li>
                        <em>
                            Выполненное тестовое прислать архивом или ссылкой (GitHub, Bitbucket и т.п.) – любым удобным
                            для Вас
                            способом.
                        </em>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
