<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// home
Breadcrumbs::for('backend.home', function ($trail) {
    $trail->push(__('messages.page_title.backend.home'), route('backend.home'));
});

// users
Breadcrumbs::for('backend.users.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(__('messages.page_title.backend.users'), route('backend.users.index'));
    $trail->push(__('messages.page_action.index'));
});
Breadcrumbs::for('backend.users.create', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(__('messages.page_title.backend.users'), route('backend.users.index'));
    $trail->push(__('messages.page_action.create'));
});
Breadcrumbs::for('backend.users.edit', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(__('messages.page_title.backend.users'), route('backend.users.index'));
    $trail->push(__('messages.page_action.edit'));
});
Breadcrumbs::for('backend.users.show', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(__('messages.page_title.backend.users'), route('backend.users.index'));
    $trail->push(__('messages.page_action.show'));
});
Breadcrumbs::for('backend.users.confirm', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(__('messages.page_title.backend.users'), route('backend.users.index'));
    $trail->push(__('messages.page_action.confirm'));
});
