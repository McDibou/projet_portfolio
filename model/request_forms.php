<?php

// CRUD_forms.php
function readForms($id, $db)
{
    return mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM forms JOIN users ON users_id = id_users AND id_forms = $id"));
}

// CRUD_reference.php
function visibleForms($id,$db)
{
    mysqli_query($db, "UPDATE forms SET active_forms = 1 WHERE id_forms = $id");
}

// CRUD_forms.php
function deleteForms($id, $db)
{
    return mysqli_query($db, " DELETE FROM forms WHERE id_forms = $id");
}