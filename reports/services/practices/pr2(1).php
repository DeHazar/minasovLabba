<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="Author" content="Иванова Виктория Сергеевна"><meta name="Keywords" content="Программирование, PHP, ООП">
<meta name="Description" content="">
<title>Задание 1</title>
</head>
<body>
<?php
class Портативная_электроника {
 private $Тип_устройства, $Напряжение_элементов_питания, $Тип_элементов_питания,$Количество_элементов_питания, $Ресурс, $Наработка;
    public function __construct($_Тип,$_Напряжение_элементов_питания,$_Тип_элементов_питания, $_Количество_элементов_питания,$_Ресурс, $_Наработка)
    {
      $this->Тип=$_Тип;
      $this->Напряжение_элементов_питания=$_Напряжение_элементов_питания;
      $this->Тип_элементов_питания=$_Тип_элементов_питания;
      $this->Количество_элементов_питания=$_Количество_элементов_питания;
      $this->Ресурс=$_Ресурс;
      $this->Наработка=$_Наработка;
    }
        public function printInfo() {
    echo "<strong>".$this->Тип.":</strong>"
    ."<hr>"
    ." Напряжение элементов питания, В: ".$this->Напряжение_элементов_питания
    ."<br>"
    ." Тип элементов питания: ".$this->Тип_элементов_питания
    ."<br>"
    ." Количество элементов питания, шт: ".$this->Количество_элементов_питания
    ."<br>"
    ." Ресурс работы от одного комплекта элементов питания (Ватт*час): ".$this->Ресурс
    ."<br>"
    ." Остаток ресурса текущего комплекта элементов питания, (Ватт*час): ".$this->Ресурс*(1-$this->Наработка/100)
    ."<br>"
    ."<br>";
    }
      function getLogin()
      {
        return $this->Тип;
      }
      public function Добавление_наработки($arg){
        $this->Наработка=$this->Наработка+$arg;
      }
      public function Обнуление_наработки(){
        $this->Наработка=0;
      }
}
$Устройство = new Портативная_электроника ('Портативная радиостанция', 12, 'Ni-MH', 2, 5.5,40);
$Устройство->printInfo();
	echo "<hr>";
$Устройство->Добавление_наработки(10);
$Устройство->printInfo();
$Устройство->Обнуление_наработки();
$Устройство->printInfo();
?>
</body>
</html>
