<?php
//
////TRAITEMENT INFO ENTRER FORMS
//function analyse($name)
//{
//    return htmlspecialchars(strip_tags(trim($name)), ENT_QUOTES, 'UTF-8');
//}
//
//
////============================================================================================//
////REQUETE AFFICHAGE INFO PAGE
////============================================================================================//
//
////REQUETE INFORMATION PAGES
//function affichePage($page_name, $lang, $db)
//{
//    return mysqli_fetch_assoc(mysqli_query($db, 'SELECT * FROM pages WHERE link_pages = "' . $page_name . '" AND langages_id = "' . $lang . '" AND active_pages = 1'));
//}
//
////REQUETE CONTENTS PAGES
//function afficheContent($page_name, $lang, $db)
//{
//    return mysqli_query($db, "SELECT * FROM pages AS i JOIN contents AS c ON i.id_pages = c.pages_id JOIN langages AS l ON c.langages_id = l.id_langages WHERE i.link_pages = '$page_name' AND c.langages_id = '$lang' AND c.active_contents = 1 ORDER BY id_contents");
//}
//
////TABLEAU CONTENTS TAB PAGES
//function afficheContentTab($page_name, $lang, $db)
//{
//    $value = mysqli_fetch_assoc(mysqli_query($db, 'SELECT text_contents FROM contents WHERE pages_id = (SELECT id_pages FROM pages WHERE link_pages = "' . $page_name . '" AND langages_id = "' . $lang . '" ) AND active_contents = 1'));
//    return explode('|_|', $value['text_contents']);
//}
//
////REQUETE CONTENTS PAGES AVEC IMAGES
//function afficheContentImg($page_name, $lang, $db)
//{
//    return mysqli_query($db, "SELECT * FROM pages AS i JOIN contents AS c ON i.id_pages = c.pages_id JOIN langages AS l ON c.langages_id = l.id_langages JOIN pics_has_contents AS pc ON c.id_contents = pc.contents_id JOIN pics AS p ON pc.pics_id = p.id_pics WHERE i.link_pages = '$page_name' AND c.langages_id = '$lang' AND c.active_contents = 1 ORDER BY id_contents");
//}
//
////REQUETE GALLERY IMAGES
//function afficheImg($page_name, $lang, $db)
//{
//    return mysqli_query($db, "SELECT * FROM pages AS i JOIN contents AS c ON i.id_pages = c.pages_id JOIN langages AS l ON c.langages_id = l.id_langages JOIN pics_has_contents AS pc ON c.id_contents = pc.contents_id JOIN pics AS p ON pc.pics_id = p.id_pics WHERE c.link_contents = '$page_name' AND c.langages_id = '$lang' AND c.active_contents = 1 ORDER BY id_contents");
//}
//
////REQUETE CONTENU PAGES REFERENCE ADMIN
//function afficheContentRef($db)
//{
//    return mysqli_query($db, "SELECT l.name_langages, c.id_contents, c.date_contents, c.title_contents, c.text_contents, c.link_contents, p.name_pics, p.id_pics, c.active_contents FROM pages AS i JOIN contents AS c ON i.id_pages = c.pages_id JOIN langages AS l ON c.langages_id = l.id_langages JOIN pics_has_contents AS pc ON c.id_contents = pc.contents_id JOIN pics AS p ON pc.pics_id = p.id_pics WHERE i.link_pages = 'reference' ORDER BY id_contents");
//}
//
////REQUETE MENU
//function afficheMenu($lang, $db)
//{
//    return mysqli_fetch_all(mysqli_query($db, 'SELECT title_pages, link_pages FROM pages WHERE langages_id = "' . $lang . '" '));
//}
//
////============================================================================================//
////CRUD REFERENCE ADMIN
////============================================================================================//
//
////REQUETE READ /CRUD
//function crudRead($id, $page_name, $db)
//{
//    return mysqli_fetch_assoc(mysqli_query($db, "SELECT c.id_contents, c.title_contents, c.text_contents, c.link_contents, p.name_pics FROM pages AS i JOIN contents AS c ON i.id_pages = c.pages_id JOIN pics_has_contents AS pc ON c.id_contents = pc.contents_id JOIN pics AS p ON pc.pics_id = p.id_pics WHERE i.link_pages = '$page_name' AND c.id_contents = $id"));
//}
//
////REQUETE VIEW UPDATE PICS /CRUD
//function crudViewPics($id, $db)
//{
//    return mysqli_fetch_assoc(mysqli_query($db, "SELECT id_pics, name_pics FROM pics WHERE id_pics = $id"));
//}
//
////REQUETE IMAGE VERIFY /CRUD
//function crudImgName($id, $db)
//{
//    $value = mysqli_fetch_assoc(mysqli_query($db, "SELECT name_pics FROM pics WHERE id_pics = $id"));
//    return $value = (isset($value)) ? implode($value) : null;
//}
//
//// REQUETE CREATE /CRUD
//function crudCreate($title_fr, $text_fr, $title_en, $text_en, $link, $img, $db)
//{
//    mysqli_begin_transaction($db, MYSQLI_TRANS_START_READ_WRITE);
//
//    mysqli_query($db, "INSERT INTO contents(title_contents, text_contents, link_contents, name_contents, active_contents, pages_id, langages_id) VALUES('$title_fr','$text_fr','$link','card_horizontal',1,13,1),('$title_en','$text_en','$link','card_horizontal',1,14,2);");
//    mysqli_query($db, "INSERT INTO pics(name_pics,active_pics) VALUES ('$img',1);");
//    mysqli_query($db, "INSERT INTO pics_has_contents(pics_id, contents_id) VALUES((SELECT id_pics FROM pics WHERE name_pics = '$img'),(SELECT id_contents FROM contents WHERE title_contents ='$title_fr' AND langages_id = 1)),((SELECT id_pics FROM pics WHERE name_pics = '$img'), (SELECT id_contents FROM contents WHERE title_contents ='$title_en' AND langages_id = 2));");
//
//    mysqli_commit($db);
//    mysqli_close($db);
//
//}
//
////REQUETE UPDATE /CRUD
//function crudUpdate($id, $title, $text, $link, $db)
//{
//    mysqli_query($db, "UPDATE contents SET title_contents='$title', text_contents=' $text', link_contents='$link' WHERE id_contents = $id");
//    header('Location: ?p=admin_reference');
//}
//
////REQUETE UPDATE PICS /CRUD
//function crudUpdatePics($id, $img_up, $img, $db)
//{
//    mysqli_query($db, "UPDATE pics SET name_pics = '$img_up' WHERE id_pics = $id");
//}
//
////REQUETE DELETE /CRUD
//function crudDelete($delete, $db)
//{
//    mysqli_begin_transaction($db, MYSQLI_TRANS_START_READ_WRITE);
//
//    $value = mysqli_fetch_assoc(mysqli_query($db, "SELECT pics_id FROM pics_has_contents WHERE contents_id = $delete"));
//    $id_pics = (isset($value)) ? (int)implode($value) : null;
//
//    mysqli_query($db, "DELETE FROM pics_has_contents WHERE contents_id = $delete");
//    mysqli_query($db, "DELETE FROM pics WHERE id_pics = $id_pics");
//    mysqli_query($db, "DELETE FROM contents WHERE id_contents = $delete");
//
//    mysqli_commit($db);
//    mysqli_close($db);
//
//    header('Location: ?p=admin_reference');
//}
//
////REQUETE DELETE IMG /CRUD
//function selectDeleteImg($id, $db)
//{
//    return mysqli_fetch_assoc(mysqli_query($db, "SELECT name_pics FROM pics JOIN pics_has_contents ON id_pics = pics_id JOIN contents ON contents_id = id_contents AND id_contents = $id"));
//}
//
////REQUETE VISIBILITY /CRUD
//function crudVisisbility($id, $active, $db)
//{
//    mysqli_query($db, "UPDATE contents SET active_contents = $active WHERE id_contents = $id");
//    header('Location: ?p=admin_reference');
//}
//
////============================================================================================//
////REQUETE NEW USER & CONNEXION
////============================================================================================//
//
//function compare($sql, $name, $db)
//{
//    $value = mysqli_fetch_assoc(mysqli_query($db, "SELECT $sql FROM users WHERE $sql = '$name'"));
//    return $value = (isset($value)) ? implode($value) : null;
//}
//
//function userCreate($name_users, $username_users, $mail_users, $pseudo_users, $password_users, $db)
//{
//    mysqli_query($db, "INSERT INTO users ( name_users, username_users, mail_users, pseudo_users, password_users, roles_id ) VALUES ( '$name_users', '$username_users', '$mail_users', '$pseudo_users', '$password_users', 1 );");
//}
//
//function compareId($name, $db)
//{
//    $value = mysqli_fetch_assoc(mysqli_query($db, "SELECT id_roles FROM roles WHERE name_roles = '$name'"));
//    return $value = (isset($value)) ? implode($value) : null;
//}
//
//function connectCompare($name1, $name2, $enter, $id, $db)
//{
//    $value = mysqli_fetch_assoc(mysqli_query($db, "SELECT $name1 FROM users WHERE $name2 = '$enter' AND roles_id = $id"));
//    return $value = (isset($value)) ? implode($value) : null;
//}
//
//function roleId($pseudo_enter, $db)
//{
//    $value = mysqli_fetch_assoc(mysqli_query($db, 'SELECT roles_id FROM users WHERE pseudo_users = "' . $pseudo_enter . '"'));
//    return $value = (isset($value)) ? implode($value) : null;
//}
//
////============================================================================================//
////REQUETE CONTACT
////============================================================================================//
//
//function selectUser($name, $db)
//{
//    return mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE pseudo_users = '$name'"));
//}
//
//function insertMail($title, $text, $id, $db)
//{
//    mysqli_query($db, "INSERT INTO forms ( title_forms, text_forms, users_id) VALUES ( '$title', '$text', $id);");
//}
//
//
////============================================================================================//
////REQUETE FORMS ADMIN
////============================================================================================//
//
//function selectMail($db)
//{
//    return mysqli_query($db, 'SELECT * FROM forms LEFT JOIN users ON users_id = id_users ORDER BY date_forms DESC');
//}
//
//function selectForms($id, $db)
//{
//    return mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM forms JOIN users ON users_id = id_users AND id_forms = $id"));
//}
//
//function deleteForms($id, $db)
//{
//    return mysqli_query($db, " DELETE FROM forms WHERE id_forms = $id");
//}
//
//
////============================================================================================//
////REQUETE GALLERY ADMIN
////============================================================================================//
//
//function selectOption($lang, $db)
//{
//    return mysqli_query($db, "SELECT * FROM contents WHERE pages_id IN (5,6) AND langages_id = $lang");
//}
//
//function crudCreateImg($img, $title, $db)
//{
//    mysqli_begin_transaction($db, MYSQLI_TRANS_START_READ_WRITE);
//
//    mysqli_query($db, "INSERT INTO pics(name_pics,active_pics) VALUES ('$img',1);");
//    mysqli_query($db, "INSERT INTO pics_has_contents(pics_id, contents_id) VALUES((SELECT id_pics FROM pics WHERE name_pics = '$img'),(SELECT id_contents FROM contents WHERE link_contents ='$title' AND langages_id = 1)),((SELECT id_pics FROM pics WHERE name_pics = '$img'), (SELECT id_contents FROM contents WHERE link_contents ='$title' AND langages_id = 2));");
//
//    mysqli_commit($db);
//    mysqli_close($db);
//}
//
//function selectImg($name, $lang, $db)
//{
//    return mysqli_query($db, "SELECT * FROM pics JOIN pics_has_contents ON id_pics = pics_id JOIN contents ON contents_id = id_contents AND link_contents = '$name' AND langages_id = $lang");
//}
//
//function selectImgDelete($id, $db)
//{
//    return mysqli_fetch_assoc(mysqli_query($db, "SELECT name_pics FROM pics WHERE id_pics = $id"));
//}
//
//function selectContentImg($id, $db)
//{
//    return mysqli_fetch_assoc(mysqli_query($db, "SELECT link_contents FROM pics JOIN pics_has_contents ON id_pics = pics_id JOIN contents ON contents_id = id_contents AND id_pics = $id GROUP BY link_contents"));
//}
//
//function imgVisisbility($id, $active, $db)
//{
//    mysqli_query($db, "UPDATE pics SET active_pics = $active WHERE id_pics = $id");
//    header('Location: ?p=admin_gallery');
//}
//
//function crudDeleteImg($id, $db)
//{
//    mysqli_begin_transaction($db, MYSQLI_TRANS_START_READ_WRITE);
//
//    mysqli_query($db, "DELETE FROM pics_has_contents WHERE pics_id = $id");
//    mysqli_query($db, "DELETE FROM pics WHERE id_pics = $id");
//
//    mysqli_commit($db);
//    mysqli_close($db);
//}