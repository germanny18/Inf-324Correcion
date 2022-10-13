<?php
    require_once("conexion.php");

    //session_start();
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['rol'])){
        header('location: login.php');
    }else{
        if($_SESSION['rol'] != 2){
            header('location: login.php');
        }
    }
    
    $sql = "SELECT per.departamento num_dept, avg(ins.notaFinal) promedio,
    case when per.departamento ='01' then avg(ins.notaFinal) end CH,
    case when per.departamento ='02' then avg(ins.notaFinal) end LP,
    case when per.departamento ='03' then avg(ins.notaFinal) end CB,
    case when per.departamento ='04' then avg(ins.notaFinal) end ORU,
    case when per.departamento ='05' then avg(ins.notaFinal) end PT,
    case when per.departamento ='06' then avg(ins.notaFinal) end TJ,
    case when per.departamento ='07' then avg(ins.notaFinal) end SC
    from persona per join inscripcion ins
    on per.ci = ins.ciEst
    group by per.departamento;";

    $resultado = mysqli_query($conexion, $sql);
?>
<table border="1px">
    <tr>
        <td>Num Departamento</td>
        <td>Promedio</td>
        <td>CH</td>
        <td>LP</td>
        <td>CB</td>
        <td>OR</td>
        <td>PT</td>
        <td>TJ</td>
        <td>SC</td>
    </tr>
<?php
    while($fila = mysqli_fetch_array($resultado)){
        echo "<tr>";
        echo "<td>".$fila[0]."</td>";
        echo "<td>".$fila[1]."</td>";
        echo "<td>".$fila[2]."</td>";
        echo "<td>".$fila[3]."</td>";
        echo "<td>".$fila[4]."</td>";
        echo "<td>".$fila[5]."</td>";
        echo "<td>".$fila[6]."</td>";
        echo "<td>".$fila[7]."</td>";
        echo "<td>".$fila[8]."</td>";
        echo "</tr>";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Director</title>
</head>
<body>
    <h1>Director </h1>
    <h2>Promedio de notas por departamento</h2>
    
</body>
</html>