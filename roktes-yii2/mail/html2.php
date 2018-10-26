<?php

?>
<div class="body-q" style="text-align: center">
    <table align="center" border="1" cellpadding="2" cellspacing="5" style="width:100%">
        <caption>
            <h1>Запрос с сайта</h1>
        </caption>
        <thead>
        <tr>
            <th scope="col" style="background-color:#333333"><span style="color:#FFFFFF">От</span></th>
            <th scope="col" style="background-color:#333333"><span style="color:#FFFFFF">Телефон</span></th>
            <th scope="col" style="background-color:#333333"><span style="color:#FFFFFF">E-mail</span></th>
            <? if (isset($city)) : ?>
                <th scope="col" style="background-color:#333333"><span style="color:#FFFFFF">Город</span></th>
            <? endif; ?>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?= $name ?></td>
            <td><?= $phone ?></td>
            <td><?= $email ?></td>
            <? if (isset($city)) : ?>
                <td><?= $city ?></td>
            <? endif; ?>
        </tr>
        </tbody>
    </table>
    <p style="text-align: left;">
        <h2>Запрос</h2>
        <?= $text ?>
    </p>
</div>


