<?php


$data = $_POST['data'];
$horario = $_POST['horario'];
$sistolico = $_POST['sistolico'];
$diastolico = $_POST['diastolico'];

$dateStr = $data . " " . $horario;

$timestamp = strtotime($dateStr);
$datetime = date('Y-m-d H:i:s', $timestamp);

echo $datetime;

session_start();

echo "<script>console.log('Debug Objects: " . $dateStr . "' );</script>";


new InserirPressao($datetime, $sistolico, $diastolico, $_SESSION['idUser']);



class InserirPressao
{
    public function __construct($data, $sis, $dias, $id)
    {
        $conn = mysqli_connect("localhost", "root", "", "web");

        if (mysqli_connect_errno()) {
            echo "Connect failed: %s\n" . mysqli_connect_error();
            exit();
        }


        if (!$conn->query("INSERT INTO pressao (idPaciente , valorSistolico , valorDiastolico , dataMedicao) VALUES ('$id' , '$sis' , '$dias' , '$data')")) {
            echo $conn->error;
        };



        $conn->close();
        header("location: /Web");
    }
}
