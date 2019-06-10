<?php
/*
 * Visar alla böcker
*/
function getAllBocker($conn){
    $query = "SELECT * FROM kategori INNER JOIN bok ON kategori.kategoriId = bok.bokKategoriId ORDER BY bokTitel ASC";

    $result = mysqli_query($conn,$query) or die("Query failed: $query");

    $row = mysqli_fetch_all($result);

    return $row;
}

/*
 * Hämtar en bok
 */
function getBokData($conn,$bokId){
    $query = "SELECT * FROM bok
			WHERE bokId=".$bokId;

    $result = mysqli_query($conn,$query) or die("Query failed: $query");

    $row = mysqli_fetch_all($result);

    return $row;
}

/*
 * Sparar en bok
*/
function saveBok($conn){
    $titel = escapeInsert($conn,$_POST['bokTitel']);
    $forfattare = escapeInsert($conn,$_POST['bokForfattare']);
    $beskrivn = escapeInsert($conn,$_POST['bokBeskrivn']);
    $isbn = escapeInsert($conn,$_POST['bokIsbn']);
    $pris = escapeInsert($conn,$_POST['bokPris']);
    $bokkategori = escapeInsert($conn,$_POST['bokKategoriId']);
    // Sparar lösenordet med password_hash
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO bok
			(bokTitel,bokForfattare,bokBeskrivn,bokIsbn,bokPris,bokKategoriId)
			VALUES('$titel','$forfattare','$beskrivn','$isbn','$pris','$bokkategori')";

    $result = mysqli_query($conn,$query) or die("Query failed: $query");

    $insId = mysqli_insert_id($conn);

    return $insId;
}

/*
 * Uppdaterar en bok
*/
function updateBok($conn){
    $titel = escapeInsert($conn,$_POST['bokTitel']);
    $forfattare = escapeInsert($conn,$_POST['bokForfattare']);
    $beskrivn = escapeInsert($conn,$_POST['bokBeskrivn']);
    $isbn = escapeInsert($conn,$_POST['bokIsbn']);
    $pris = escapeInsert($conn,$_POST['bokPris']);
    $bokkategori = escapeInsert($conn,$_POST['bokKategoriId']);
    $editid = $_POST['bokId'];

    $query = "UPDATE bok
			SET bokTitel='$titel', bokForfattare='$forfattare', bokBeskrivn='$beskrivn', bokIsbn='$isbn' , bokPris='$pris', bokKategoriId='$bokkategori'
			WHERE bokId=". $editid;

    $result = mysqli_query($conn,$query) or die("Query failed: $query");
}

/*
 * Raderar kund
*/
function deleteBok($conn,$bokId){
    $query = "DELETE FROM bok WHERE bokId=". $bokId;

    $result = mysqli_query($conn,$query) or die("Query failed: $query");
}

/*
 * Tar bort oönskade html-tecken
 *
 * mysqli_real_escape_string motverkar SQLInjection
 */
function escapeInsert($conn,$insert) {
    $insert = htmlspecialchars($insert);

    $insert = mysqli_real_escape_string($conn,$insert);

    return $insert;
}
