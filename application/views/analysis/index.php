<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h3 class="center-align">Анализ результативности</h3>
<form class="right form-right" action="/analysis/search">
    <div class="input-field">
        <input type="search" name="q" id="analysis-search" autocomplete="off" autofocus>
        <label for="search">Search</label>
        <i class="material-icons right close-icon">close</i>
    </div>
    <div id="search-result"></div>
</form>
<a class="btn-add btn-floating waves-effect waves-light" href="/analysis/create/"><i class="material-icons">add</i></a>
<div class="col s12">
    <ul class="collection">
    <?php foreach($children as $child): ?>
    	<li class="collection-item">
            <a class="photo-thumb" href="/analysis/view/<?= $child->id; ?>">
                <img src="<?php if ($child->children_photo) echo '/uploads/40x40/' . $child->children_photo; else echo '/img/profile.png'; ?>" alt="" class="circle">
                <span><?= $child->full_name; ?></span>
            </a>
            <a href="/analysis/delete_all/<?= $child->id; ?>" class="delete-link right"><i class="material-icons tools">close</i></a>
        </li>
    <?php endforeach; ?>
    </ul>
    <?= $pagination; ?>
</div>