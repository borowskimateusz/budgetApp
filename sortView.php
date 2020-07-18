<?php
if($_GET['sort']) {
    $catStyle = $dateStyle = $typeStyle = $typeStyle = '';

    if ($_GET['sort'] == 'category_desc') $catStyle = "<i class='fas fa-arrow-up'></i>";
    if ($_GET['sort'] == 'category_asc') $catStyle = "<i class='fas fa-down-up'></i>";

    if ($_GET['sort'] == 'money_desc') $moneyStyle = "<i class='fas fa-arrow-up'></i>";
    if ($_GET['sort'] == 'money_asc') $moneyStyle = "<i class='fas fa-down-up'></i>";

    if ($_GET['sort'] == 'date_desc') $dateStyle = "<i class='fas fa-arrow-up'></i>";
    if ($_GET['sort'] == 'date_asc') $dateStyle = "<i class='fas fa-down-up'></i>";

    if ($_GET['sort'] == 'type_desc') $typeStyle = "<i class='fas fa-arrow-up'></i>";
    if ($_GET['sort'] == 'type_asc') $typeStyle = "<i class='fas fa-down-up'></i>";
}
?>