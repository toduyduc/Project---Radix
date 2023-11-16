<?php
$route['/'] = 'index.php?module=home';
$route['blog/.+-(.+).html'] = 'index.php?module=blogs&action=detail&id=$1';
$route['dich-vu/.+-(.+).html'] = 'index.php?module=services&action=detail&id=$1';
$route['thong-tin/.+-(.+).html'] = 'index.php?module=page&action=detail&id=$1';
$route['du-an/.+-(.+).html'] = 'index.php?module=portfolios&action=detail&id=$1';
$route['danh-muc-blog/.+-(.+).html'] = 'index.php?module=blogs&action=category&id=$1';
$route['danh-muc-blog/.+-(.+)-page-(.+)'] = 'index.php?module=blogs&action=category&id=$1&page=$2';
$route['gioi-thieu.html'] = 'index.php?module=page-template&action=about';
$route['doi-ngu.html'] = 'index.php?module=page-template&action=team';
$route['lien-he.html'] = 'index.php?module=page-template&action=contact';
$route['du-an.html'] = 'index.php?module=portfolios&action=lists';
$route['dich-vu.html'] = 'index.php?module=services&action=lists';
$route['blog.html'] = 'index.php?module=blogs&action=lists';
$route['blog-page-(.+).html'] = 'index.php?module=blogs&action=lists&page=$1';
$route['tim-kiem.html'] = 'index.php?module=search';
$route['submit-subcribe.html'] = 'index.php?module=subscribe&action=submit';