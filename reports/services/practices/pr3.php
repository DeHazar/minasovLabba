<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> Персональная страничка студента </title>
  <meta charset="utf-8">
  <meta name="author" content="Иванова Виктория Сергеевна" />
  <meta name="keywords" content="Лабораторный практикум" />
  <meta name="description" content="Лабораторный практикум по дисциплине Сетевые сервисы обработки информации в ОТС" />
</head>
<style>
   .btn {
    display: inline-block;
    background: darkred;
    color: #fff;
    padding: 1rem 1.5rem;
    text-decoration: none;
    border-radius: 3px;
}
</style>
<?php
	echo('<body align=center>');
	echo('<h1><center>Практическая работа №3 </center></h1>');
	$LINK = mysqli_connect('csdeml.ugatu.su', 'sts07', 'sts407-077','sts07-13693');
	$QUERY = "SELECT * FROM transport ";
	$RESULT = mysqli_query($LINK,$QUERY);
    	if(mysqli_num_rows($RESULT) > 0)
        {
			$ROW = mysqli_fetch_array($RESULT);
			 echo('<center>Данные о транспортном средстве </center>');
           echo('<center><table border="1" align = center><tr>
			<td>№ </td>
			<td>Наименование категории билета</td>
                        <td>Количество мест</td>
                        <td>Продано</td>
                        <td>Свободно</td>
                        <td>Забронированно</td>
			<td>Стоимость от 0 до 10 км </td>
			<td>Стоимость от 11 до 17 км </td>
			<td>Стоимость от 18 км </td>
					 </tr></center>');
				do
				{
                echo('<tr>'.'<td>'.$ROW['id'].'</td>');
                echo('<td>'.$ROW['name'].'</td>');
		echo('<td>'.$ROW['total'].'</td>');
                echo('<td>'.$ROW['sold'].'</td>');
                echo('<td>'.$ROW['free'].'</td>');
                echo('<td>'.$ROW['booked'].'</td>');
                echo('<td>'.$ROW['cost'].'</td>');
		echo('<td>'.$ROW['cost1'].'</td>');
		echo('<td>'.$ROW['cost2'].'</td>');
		echo('</tr>');
				}
				while ($ROW = mysqli_fetch_array($RESULT));
				echo(' </table>	');
		}
    echo('<p></p>');
	$QUERY = "SELECT * FROM passenger ";
	$RESULT = mysqli_query($LINK,$QUERY);
   	if(mysqli_num_rows($RESULT) > 0)
        {
			$ROW = mysqli_fetch_array($RESULT);
			echo('<center>Данные о пассажирах </center>');
           echo('<center><table border="1" align = center><tr>
			<td>№ </td>
			<td>Фамилия</td>
			<td>Категория билета</td>
                        <td>Расстояние</td>
			<td>Льготы (в %)</td>
                        <td>Дата</td>
                        <td>Стоимость</td>
                     	</tr></center>');
				do
				{
                echo('<tr>'.'<td>'.$ROW['id'].'</td>');
		echo('<td>'.$ROW['lastname'].'</td>');
                echo('<td>'.$ROW['name'].'</td>');
		echo('<td>'.$ROW['distance'].'</td>');
		echo('<td>'.$ROW['lgota'].'</td>');
                echo('<td>'.$ROW['date'].'</td>');
                echo('<td>'.$ROW['cost'].'</td>');
                echo('</tr>');
				}
				while ($ROW = mysqli_fetch_array($RESULT));
				echo(' </table>	');
		}
    echo('<p>'.'</p>');
    echo('<a href="../../../index.php" class="btn"><font size="4"  face="Corbel">Главная</a>
          <a href="../../../pages/services.php"class="btn">Отчеты по ССОИ в ОТС</a>
          <a href="../../../pages/constructions.php" class="btn">Отчеты по ОКО ОТС</a></font>
    				<br><br>
        </center>
    	</td>
    </tr>');
?>
<center>
	&copy; Гараев Денис Нагимович, 2021.
</center>
</body>
</html>
