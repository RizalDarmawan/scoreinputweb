<?php 
$conn = mysqli_connect("localhost", "root", "", "smk");

function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$wadah = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$wadah[] = $row;
	}
	return $wadah;
}

function tambahkelas($data){
	global $conn;
	$nama = htmlspecialchars($data["nama"]);
	$query = "INSERT INTO kelas VALUES('', '$nama')";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function tambahmapel($data){
	global $conn;
	$nama = htmlspecialchars($data["nama"]);
	$guru = htmlspecialchars($data["guru"]);
	$query = "INSERT INTO mapel VALUES('', '$nama', '$guru')";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function tambahsiswa($data){
	global $conn;
	$nama = htmlspecialchars($data["nama"]);
	$username = htmlspecialchars($data["username"]);
	$password = htmlspecialchars($data["password"]);
	$email = htmlspecialchars($data["email"]);
	$gender = htmlspecialchars($data["gender"]);
	$kelas_id = htmlspecialchars($data["kelas_id"]);
	$query = "INSERT INTO siswa VALUES('', '$nama', '$username', '$password', '$email', '$gender', '$kelas_id')";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

// fungsi hapus dan edit
if (isset($_GET["id"])&&
	isset($_GET["tabel"])) {
	//fungsi hapus
	if (hapus($_GET["id"], $_GET["tabel"]) > 0) {
		header("Location: tables.php");
	}
}
function hapus($id, $tabel){
	global $conn;
	mysqli_query($conn, "DELETE FROM $tabel WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function editkelas($data){
	global $conn;
	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$query = "UPDATE kelas SET
				nama = '$nama'
				WHERE id = $id";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function editmapel($data){
	global $conn;
	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$guru = htmlspecialchars($data["guru"]);
	$query = "UPDATE mapel SET
				nama = '$nama',
				guru = '$guru'
				WHERE id = $id";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function editsiswa($data){
	global $conn;
	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$kelas_id = htmlspecialchars($data["kelas_id"]);
	$username = htmlspecialchars($data["username"]);
	$password = htmlspecialchars($data["password"]);
	$email = htmlspecialchars($data["email"]);
	$gender = htmlspecialchars($data["gender"]);
	$query = "UPDATE siswa SET
				nama = '$nama',
				kelas_id = '$kelas_id',
				username = '$username',
				password = '$password',
				email = '$email',
				gender = '$gender'
				WHERE id = $id";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function editnilai($data){
	global $conn;
	$id = $data["id"];
	$nilaiasj = $data["nilaiasj"];
	$nilaiaij = $data["nilaiaij"];
	$nilaitlj = $data["nilaitlj"];
	$nilaipkk = $data["nilaipkk"];
	// var_dump($data);die;

	$queryasj = "UPDATE nilai SET
				nilai = $nilaiasj
				WHERE siswa_id = $id 
                AND mapel_id = 'asj'
				";
	mysqli_query($conn, $queryasj);

	$queryaij = "UPDATE nilai SET
				nilai = $nilaiaij
				WHERE siswa_id = $id 
                AND mapel_id = 'aij'
				";
	mysqli_query($conn, $queryaij);

	$querytlj = "UPDATE nilai SET
				nilai = $nilaitlj
				WHERE siswa_id = $id 
                AND mapel_id = 'tlj'
				";
	mysqli_query($conn, $querytlj);

	$querypkk = "UPDATE nilai SET
				nilai = $nilaipkk
				WHERE siswa_id = $id 
                AND mapel_id = 'pkk'
				";
	mysqli_query($conn, $querypkk);

	return 1;
}
function tambahnilai($data){
	global $conn;
	$id = $data["id"];
	$nilaiasj = $data["nilaiasj"];
	$nilaiaij = $data["nilaiaij"];
	$nilaitlj = $data["nilaitlj"];
	$nilaipkk = $data["nilaipkk"];
	// var_dump($data);die;

	$queryasj = "INSERT INTO nilai VALUES('', $id, 'asj', '$nilaiasj')";
	mysqli_query($conn, $queryasj);

	$queryaij = "INSERT INTO nilai VALUES('', $id, 'aij', '$nilaiaij')";
	mysqli_query($conn, $queryaij);

	$querytlj = "INSERT INTO nilai VALUES('', $id, 'tlj', '$nilaitlj')";
	mysqli_query($conn, $querytlj);

	$querypkk = "INSERT INTO nilai VALUES('', $id, 'pkk', '$nilaipkk')";
	mysqli_query($conn, $querypkk);

	return 1;
}

function cari($keyword){

	$query = "SELECT * FROM siswa WHERE
			nama LIKE '%$keyword%' OR
			username LIKE '%$keyword%' OR
			password LIKE '%$keyword%' OR
			email LIKE '%$keyword%' OR
			gender LIKE '%$keyword%'
			";

	return query($query);
}


 ?>