<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h3 class="center-align">Речевой экран</h3>
<form class="right" action="/speech_screen/search">
    <div class="input-field">
        <input type="search" name="q" id="screen-search" autocomplete="off" autofocus>
        <label for="search">Search</label>
        <i class="material-icons right close-icon">close</i>
    </div>
    <div id="search-result"></div>
</form>
<a class="btn-add btn-floating waves-effect waves-light" href="/speech_screen/create/"><i class="material-icons">add</i></a><table>
    <tr class="border-row">
        <td></td>
        <td>Ф.И.О.</td>
        <td>ФФ. восприятие</td>
        <td>Год обучения</td>
        <td>Диагноз</td>
        <?php foreach ($sounds as $sound): ?>
            <td><?= $sound->name; ?></td>
        <?php endforeach; ?>
        <td colspan="2"></td>
    </tr>
    <?php foreach($screens as $screen): ?>
        <tr>
            <td class="photo-cell"><img src="<?php if ($screen['children_photo']) echo '/uploads/40x40/' . $screen['children_photo']; else echo '/img/profile.png'; ?>" alt="" class="circle"></td>
            <td><?= $screen['full_name']; ?></td>
            <td><?= $screen['ff_perception']; ?></td>
            <td><?= $screen['study_year']; ?></td>
            <td><?= $screen['diagnosis']; ?></td>
            <?php foreach($screen['sounds'] as $sound): ?>
                <td><?= $sound['progress_symbol']; ?></td>
            <?php endforeach; ?>
            <td><a href="/speech_screen/edit/<?= $screen['id']; ?>"><i class="material-icons tools">edit</i></a></td>
            <td><a href="/speech_screen/delete/<?= $screen['id']; ?>"><i class="material-icons tools">clear</i></a></td>
        </tr>
    <?php endforeach; ?>
</table>
<?= $pagination; ?>
<a href="/speech_screen/report" class="btn btn-report btn-floating"><i class="material-icons">assignment</i></a>
<a href="#modal-speech" class="btn btn-help btn-floating modal-trigger"><i class="material-icons">info_outline</i></a>

<div id="modal-speech" class="modal">
    <div class="modal-content">
        <h4>Обозначение символов</h4>
        <p><span class="mark-desc">(_)</span> - Звук выговаривается</p>
        <p><span class="mark-desc">:_:</span> - Звук выговаривается не полностью</p>
        <p><span class="mark-desc">_:_</span> - Звук не выговаривается</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect btn-flat">OK</a>
    </div>
</div>