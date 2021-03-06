<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <h3 class="center-align">Индивидуальные планы</h3>
<form class="right form-right" action="/individual_plan/search">
    <div class="input-field">
        <input type="search" name="q" id="plan-search" autocomplete="off" autofocus>
        <label for="search">Search</label>
        <i class="material-icons right close-icon">close</i>
    </div>
    <div id="search-result"></div>
</form>
<a class="btn-add btn-floating waves-effect waves-light" href="/individual_plan/create/"><i class="material-icons">add</i></a>
<div class="col s12">
    <ul class="collection">
    <?php foreach($plans as $plan): ?>
    	<li class="collection-item">
        <a class="photo-thumb" href="/individual_plan/edit/<?= $plan->id; ?>">
            <img src="<?php if ($plan->children_photo) echo '/uploads/40x40/' . $plan->children_photo; else echo '/img/profile.png'; ?>" alt="" class="circle">
            <span><?= $plan->full_name; ?></span>
        </a>
        <a href="/individual_plan/delete/<?= $plan->id; ?>" class="delete-link right"><i class="material-icons tools">close</i></a>
        </li>
    <?php endforeach; ?>
    </ul>
    <?= $pagination; ?>
</div>