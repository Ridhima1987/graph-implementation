<?php
if(isset($_POST['btn_submit']))
{
$goal=$_POST['sel1'];
$horizon=$_POST['amt'];
$invest=$_POST['amt1'];
$topup=$_POST['amt2'];
$tolerance=$_POST['sel2'];
switch($goal)
{
case "Save for retirement":
                               $cash=15;
                               $patrimonial=30;
                               $alternative=0;
//echo $cash,$patrimonial,$alternative;
                               break;
case "Increase your capital":
                               $cash=0;
                               $patrimonial=15;
                               $alternative=30;
//echo $cash,$patrimonial,$alternative;
                               break;
case "Finance an important purchase":
                               $cash=0;
                               $patrimonial=22.5;
                               $alternative=22.5;
//echo $cash,$patrimonial,$alternative;
                               break;
case "Create a safety net":
                               $cash=0;
                               $patrimonial=45;
                               $alternative=0;
//echo $cash,$patrimonial,$alternative;
                               break;
default:
break;
}
switch($tolerance)
{
case "Conservative":
                               $cash=$cash+20;
                               $patrimonial=$patrimonial+10;
                               $alternative=$alternative+0;
//echo $cash,$patrimonial,$alternative;
                               break;
case "Moderately conservative":
                               $cash=$cash+10;
                               $patrimonial=$patrimonial+20;
                               $alternative=$alternative+0;
//echo $cash,$patrimonial,$alternative;
                               break;
case "Moderate":
                               $cash=$cash+5;
                               $patrimonial=$patrimonial+20;
                               $alternative=$alternative+5;
//echo $cash,$patrimonial,$alternative;
                               break;
case "Moderately aggressive":
                               $cash=$cash+20;
                               $patrimonial=$patrimonial+10;
                               $alternative=$alternative+0;
//echo $cash,$patrimonial,$alternative;
                               break;
case "Aggressive":
                               $cash=$cash+0;
                               $patrimonial=$patrimonial+15;
                               $alternative=$alternative+15;
//echo $cash,$patrimonial,$alternative;
                               break;
default:
break;
}
if($horizon==1)
{
$cash=$cash+15;
$patrimonial=$patrimonial+30;
$alternative=$alternative+0;
//echo $cash,$patrimonial,$alternative;
}
else if($horizon==2)
{
$cash=$cash+10;
$patrimonial=$patrimonial+10;
$alternative=$alternative+5;
//echo $cash,$patrimonial,$alternative;
}
else if($horizon==3)
{
$cash=$cash+5;
$patrimonial=$patrimonial+10;
$alternative=$alternative+10;
//echo $cash,$patrimonial,$alternative;
}
else if($horizon==4 || $horizon==5)
{
$cash=$cash+0;
$patrimonial=$patrimonial+12.5;
$alternative=$alternative+12.5;
//echo $cash,$patrimonial,$alternative;
}
else if($horizon>=6 && $horizon<=10)
{
$cash=$cash+0;
$patrimonial=$patrimonial+10;
$alternative=$alternative+15;
//echo $cash,$patrimonial,$alternative;
}
else if($horizon>=11 && $horizon<=40)
{
$cash=$cash+0;
$patrimonial=$patrimonial+10;
$alternative=$alternative+15;
//echo $cash,$patrimonial,$alternative;
}
else{}
$alter=$alternative*55/100;
$pat=$patrimonial*45/100;
mysql_connect("localhost","ridhima123","ridhimajacob@123");
mysql_select_db("betalphing_db");
$result=mysql_query("insert into tbl_save_record values('',$cash,$patrimonial,$alternative)");
if($result)
{
//echo "Inserted.";
}
else
{
echo mysql_error();
}

}



// function NORMSINV

function NormSInv($p){
   $a1 = -39.696830286653757; $a2 = 220.9460984245205; $a3 = -275.92851044696869;
   $a4 = 138.357751867269; $a5 = -30.66479806614716; $a6 = 2.5066282774592392;

   $b1 = -54.476098798224058; $b2 = 161.58583685804089; $b3 = -155.69897985988661;
   $b4 = 66.80131188771972; $b5 = -13.280681552885721; 
  
   $c1 = -0.0077848940024302926;$c2 =-0.32239645804113648; $c3 = -2.4007582771618381;
   $c4 = -2.5497325393437338;$c5 =  4.3746641414649678; $c6 =2.9381639826987831; 

   $d1 = 0.0077846957090414622;$d2 =0.32246712907003983; $d3 =2.445134137142996; $d4 =3.7544086619074162;

   $p_low =0.02425; $p_high = 1 - $p_low;
   $q = 0.0; $r = 0.0;
   if($p < 0 || $p > 1){
      echo "NormSInv: Argument out of range.";
   } else if($p < $p_low){
      $q = pow(-2 * log($p), 2);
      $NormS = ((((($c1 * $q + $c2) * $q + $c3) * $q + $c4) * $q + $c5) * $q + $c6) /
         (((($d1 * $q + $d2) * $q + $d3) * $q + $d4) * $q + 1);
    } else if($p <= $p_high){
      $q = $p - 0.5; $r = $q * $q;
      $NormS = ((((($a1 * $r + $a2) * $r + $a3) * $r + $a4) * $r + $a5) * $r + $a6) * $q / 
         ((((($b1 * $r + $b2) * $r + $b3) * $r + $b4) * $r + $b5) * $r + 1);
    } else {
      $q = pow(-2 * log(1 - $p), 2);
      $NormS = -((((($c1 * $q + $c2) * $q + $c3) * $q + $c4) * $q + $c5) * $q + $c6) / 
         (((($d1 * $q + $d2) * $q + $d3) * $q + $d4) * $q + 1);
    }
    return $NormS;
}
// random numbers

$rand1=floatVal('0.'.rand(1, 9));
$rand2=floatVal('0.'.rand(1, 9));
$rand3=floatVal('0.'.rand(1, 9));

//calculating NORMSINV for 3 random numbers

$Nrand1=NormSInv($rand1);
$Nrand2=NormSInv($rand2);
$Nrand3=NormSInv($rand3);


//correlation

$corr=-0.4;

//withdraw

$withdraw=-$top/$year;

//previous year 

$year=$invest;

//arrays for containing 100 records

$stack=array();
$stack1=array();
$stack2=array();
$stack3=array();
$stack4=array();
$stack5=array();
$stack6=array();
$stack7=array();
$stack8=array();
$stack9=array();
$stack10=array();

//loop for records

for($i=1;$i<=100;$i++)
{
array_push($stack, $invest);


//Annual top-up

$top=1000;

//values for exponent

$ex1=EXP(0.02+$Nrand1*0.01);
$ex2=EXP(0.02+$Nrand2*0.08);
$ex3=EXP(0.09+($Nrand2*SQRT(1-$corr*$corr)+$Nrand3*$corr)*0.14);

//calculating value for YEAR 1

$year1=$year * (1+(0.10*($ex1-1))+(0.45*($ex2-1))+(0.45*($ex3-1)-(-0.01)));

array_push($stack1, $year1);

$rand1=floatVal('0.'.rand(1, 9));
$rand2=floatVal('0.'.rand(1, 9));
$rand3=floatVal('0.'.rand(1, 9));

//calculating NORMSINV for 3 random numbers

$Nrand1=NormSInv($rand1);
$Nrand2=NormSInv($rand2);
$Nrand3=NormSInv($rand3);

//values for exponent

$ex1=EXP(0.02+$Nrand1*0.01);
$ex2=EXP(0.02+$Nrand2*0.08);
$ex3=EXP(0.09+($Nrand2*SQRT(1-$corr*$corr)+$Nrand3*$corr)*0.14);

$year2=$year1 * (1+(0.10*($ex1-1))+(0.45*($ex2-1))+(0.45*($ex3-1)-(-0.01)));

array_push($stack2, $year2);

$rand1=floatVal('0.'.rand(1, 9));
$rand2=floatVal('0.'.rand(1, 9));
$rand3=floatVal('0.'.rand(1, 9));

//calculating NORMSINV for 3 random numbers

$Nrand1=NormSInv($rand1);
$Nrand2=NormSInv($rand2);
$Nrand3=NormSInv($rand3);

//values for exponent

$ex1=EXP(0.02+$Nrand1*0.01);
$ex2=EXP(0.02+$Nrand2*0.08);
$ex3=EXP(0.09+($Nrand2*SQRT(1-$corr*$corr)+$Nrand3*$corr)*0.14);

$year3=$year2 * (1+(0.10*($ex1-1))+(0.45*($ex2-1))+(0.45*($ex3-1)-(-0.01)));

array_push($stack3, $year3);

$rand1=floatVal('0.'.rand(1, 9));
$rand2=floatVal('0.'.rand(1, 9));
$rand3=floatVal('0.'.rand(1, 9));

//calculating NORMSINV for 3 random numbers

$Nrand1=NormSInv($rand1);
$Nrand2=NormSInv($rand2);
$Nrand3=NormSInv($rand3);

//values for exponent

$ex1=EXP(0.02+$Nrand1*0.01);
$ex2=EXP(0.02+$Nrand2*0.08);
$ex3=EXP(0.09+($Nrand2*SQRT(1-$corr*$corr)+$Nrand3*$corr)*0.14);

$year4=$year3 * (1+(0.10*($ex1-1))+(0.45*($ex2-1))+(0.45*($ex3-1)-(-0.01)));

array_push($stack4, $year4);

$rand1=floatVal('0.'.rand(1, 9));
$rand2=floatVal('0.'.rand(1, 9));
$rand3=floatVal('0.'.rand(1, 9));

//calculating NORMSINV for 3 random numbers

$Nrand1=NormSInv($rand1);
$Nrand2=NormSInv($rand2);
$Nrand3=NormSInv($rand3);

//values for exponent

$ex1=EXP(0.02+$Nrand1*0.01);
$ex2=EXP(0.02+$Nrand2*0.08);
$ex3=EXP(0.09+($Nrand2*SQRT(1-$corr*$corr)+$Nrand3*$corr)*0.14);


$year5=$year4 * (1+(0.10*($ex1-1))+(0.45*($ex2-1))+(0.45*($ex3-1)-(-0.01)));

array_push($stack5, $year5);

$rand1=floatVal('0.'.rand(1, 9));
$rand2=floatVal('0.'.rand(1, 9));
$rand3=floatVal('0.'.rand(1, 9));

//calculating NORMSINV for 3 random numbers

$Nrand1=NormSInv($rand1);
$Nrand2=NormSInv($rand2);
$Nrand3=NormSInv($rand3);

//values for exponent

$ex1=EXP(0.02+$Nrand1*0.01);
$ex2=EXP(0.02+$Nrand2*0.08);
$ex3=EXP(0.09+($Nrand2*SQRT(1-$corr*$corr)+$Nrand3*$corr)*0.14);

$year6=$year5 * (1+(0.10*($ex1-1))+(0.45*($ex2-1))+(0.45*($ex3-1)-(-0.01)));

array_push($stack6, $year6);

$rand1=floatVal('0.'.rand(1, 9));
$rand2=floatVal('0.'.rand(1, 9));
$rand3=floatVal('0.'.rand(1, 9));

//calculating NORMSINV for 3 random numbers

$Nrand1=NormSInv($rand1);
$Nrand2=NormSInv($rand2);
$Nrand3=NormSInv($rand3);

//values for exponent

$ex1=EXP(0.02+$Nrand1*0.01);
$ex2=EXP(0.02+$Nrand2*0.08);
$ex3=EXP(0.09+($Nrand2*SQRT(1-$corr*$corr)+$Nrand3*$corr)*0.14);


$year7=$year6 * (1+(0.10*($ex1-1))+(0.45*($ex2-1))+(0.45*($ex3-1)-(-0.01)));

array_push($stack7, $year7);

$rand1=floatVal('0.'.rand(1, 9));
$rand2=floatVal('0.'.rand(1, 9));
$rand3=floatVal('0.'.rand(1, 9));

//calculating NORMSINV for 3 random numbers

$Nrand1=NormSInv($rand1);
$Nrand2=NormSInv($rand2);
$Nrand3=NormSInv($rand3);

//values for exponent

$ex1=EXP(0.02+$Nrand1*0.01);
$ex2=EXP(0.02+$Nrand2*0.08);
$ex3=EXP(0.09+($Nrand2*SQRT(1-$corr*$corr)+$Nrand3*$corr)*0.14);


$year8=$year7 * (1+(0.10*($ex1-1))+(0.45*($ex2-1))+(0.45*($ex3-1)-(-0.01)));

array_push($stack8, $year8);

$rand1=floatVal('0.'.rand(1, 9));
$rand2=floatVal('0.'.rand(1, 9));
$rand3=floatVal('0.'.rand(1, 9));

//calculating NORMSINV for 3 random numbers

$Nrand1=NormSInv($rand1);
$Nrand2=NormSInv($rand2);
$Nrand3=NormSInv($rand3);

//values for exponent

$ex1=EXP(0.02+$Nrand1*0.01);
$ex2=EXP(0.02+$Nrand2*0.08);
$ex3=EXP(0.09+($Nrand2*SQRT(1-$corr*$corr)+$Nrand3*$corr)*0.14);


$year9=$year8 * (1+(0.10*($ex1-1))+(0.45*($ex2-1))+(0.45*($ex3-1)-(-0.01)));

array_push($stack9, $year9);

$rand1=floatVal('0.'.rand(1, 9));
$rand2=floatVal('0.'.rand(1, 9));
$rand3=floatVal('0.'.rand(1, 9));

//calculating NORMSINV for 3 random numbers

$Nrand1=NormSInv($rand1);
$Nrand2=NormSInv($rand2);
$Nrand3=NormSInv($rand3);

//values for exponent

$ex1=EXP(0.02+$Nrand1*0.01);
$ex2=EXP(0.02+$Nrand2*0.08);
$ex3=EXP(0.09+($Nrand2*SQRT(1-$corr*$corr)+$Nrand3*$corr)*0.14);


$year10=$year9 * (1+(0.10*($ex1-1))+(0.45*($ex2-1))+(0.45*($ex3-1)-(-0.01)));

array_push($stack10, $year10);
}
$s=json_encode($stack);
$s1=json_encode($stack1);
$s2=json_encode($stack2);
$s3=json_encode($stack3);
$s4=json_encode($stack4);
$s5=json_encode($stack5);
$s6=json_encode($stack6);
$s7=json_encode($stack7);
$s8=json_encode($stack8);
$s9=json_encode($stack9);
$s10=json_encode($stack10);

?>
<!<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic,800,800italic,600,600italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="font-awesome/font-awesome/css/font-awesome.min.css">
        <!-- CSS styles for KoolChart -->
        <!-- <link rel="stylesheet" type="text/css" href="Assets/Css/KoolChart.css"/> -->


       <!--  <script language="javascript" type="text/javascript" src="LicenseKey/KoolChartLicense.js"></script> -->

        <!-- KoolChart JavaScript library -->
        <script language="javascript" type="text/javascript" src="JS/amcharts.js"></script>
        <script language="javascript" type="text/javascript" src="JS/serial.js"></script>

        <!-- Theme.js -->
       <!--  <script type="text/javascript" src="Assets/Theme/theme.js"></script> -->
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <!-- chart coding start here -->
        <script>
                    var chart;
                    var graph;
var i;

var y=<? echo $s; ?>;
var y1=<? echo $s1; ?>;
var y2=<? echo $s2; ?>;
var y3=<? echo $s3; ?>;
var y4=<? echo $s4; ?>;
var y5=<? echo $s5; ?>;
var y6=<? echo $s6; ?>;
var y7=<? echo $s7; ?>;
var y8=<? echo $s8; ?>;
var y9=<? echo $s9; ?>;
var y10=<? echo $s10; ?>;



    
             chartData=[
                        
                       
                        {
                            "year": "2016",
                            "value0": y[0],
                            "value1":y[1],
                            "value2":y[2],
                            "value3":y[3],
                            "value4":y[4],
                            "value5":y[5],
                            "value6":y[6],
                            "value7":y[7],
                            "value8":y[8],
                            "value9":y[9],
                            "value10":y[10],
                            "value11":y[11],
                            "value12":y[12],
                            "value13":y[13],
                            "value14":y[14],
                            "value15":y[15],
                            "value16":y[16],
                            "value17":y[17],
                            "value18":y[18],
                            "value19":y[19],
                            "value20":y[20],
                            "value21":y[21],
                            "value22":y[22],
                            "value23":y[23],
                            "value24":y[24],
                            "value25":y[25],
                            "value26":y[26],
                            "value27":y[27],
                            "value28":y[28],
                            "value29":y[29],
                            "value30":y[30],
                            "value31":y[31],
                            "value32":y[32],
                            "value33":y[33],
                            "value34":y[34],
                            "value35":y[35],
                            "value36":y[36],
                            "value37":y[37],
                            "value38":y[38],
                            "value39":y[39],
                            "value40":y[40],
                            "value41":y[41],
                            "value42":y[42],
                            "value43":y[43],
                            "value44":y[44],
                            "value45":y[45],
                            "value46":y[46],
                            "value47":y[47],
                            "value48":y[48],
                            "value49":y[49],
                            "value50":y[50],
                            "value51":y[51],
                            "value52":y[52],
                            "value53":y[53],
                            "value54":y[54],
                            "value55":y[55],
                            "value56":y[56],
                            "value57":y[57],
                            "value58":y[58],
                            "value59":y[59],
                            "value60":y[60],
                            "value61":y[61],
                            "value62":y[62],
                            "value63":y[63],
                            "value64":y[64],
                            "value65":y[65],
                            "value66":y[66],
                            "value67":y[67],
                            "value68":y[68],
                            "value69":y[69],
                            "value70":y[70],
                            "value71":y[71],
                            "value72":y[72],
                            "value73":y[73],
                            "value74":y[74],
                            "value75":y[75],
                            "value76":y[76],
                            "value77":y[77],
                            "value78":y[78],
                            "value79":y[79],
                            "value80":y[80],
                            "value81":y[81],
                            "value82":y[82],
                            "value83":y[83],
                            "value84":y[84],
                            "value85":y[85],
                            "value86":y[86],
                            "value87":y[87],
                            "value88":y[88],
                            "value89":y[89],
                            "value90":y[90],
                            "value91":y[91],
                            "value92":y[92],
                            "value93":y[93],
                            "value94":y[94],
                            "value95":y[95],
                            "value96":y[96],
                            "value97":y[97],
                            "value98":y[98],
                            "value99":y[99]

                       },
                        {
                            "year": "2017",
                            "value0": y1[0],
                            "value1":y1[1],
                            "value2":y1[2],
                            "value3":y1[3],
                            "value4":y1[4],
                            "value5":y1[5],
                            "value6":y1[6],
                            "value7":y1[7],
                            "value8":y1[8],
                            "value9":y1[9],
                            "value10":y1[10],
                            "value11":y1[11],
                            "value12":y1[12],
                            "value13":y1[13],
                            "value14":y1[14],
                            "value15":y1[15],
                            "value16":y1[16],
                            "value17":y1[17],
                            "value18":y1[18],
                            "value19":y1[19],
                            "value20":y1[20],
                            "value21":y1[21],
                            "value22":y1[22],
                            "value23":y1[23],
                            "value24":y1[24],
                            "value25":y1[25],
                            "value26":y1[26],
                            "value27":y1[27],
                            "value28":y1[28],
                            "value29":y1[29],
                            "value30":y1[30],
                            "value31":y1[31],
                            "value32":y1[32],
                            "value33":y1[33],
                            "value34":y1[34],
                            "value35":y1[35],
                            "value36":y1[36],
                            "value37":y1[37],
                            "value38":y1[38],
                            "value39":y1[39],
                            "value40":y1[40],
                            "value41":y1[41],
                            "value42":y1[42],
                            "value43":y1[43],
                            "value44":y1[44],
                            "value45":y1[45],
                            "value46":y1[46],
                            "value47":y1[47],
                            "value48":y1[48],
                            "value49":y1[49],
                            "value50":y1[50],
                            "value51":y1[51],
                            "value52":y1[52],
                            "value53":y1[53],
                            "value54":y1[54],
                            "value55":y1[55],
                            "value56":y1[56],
                            "value57":y1[57],
                            "value58":y1[58],
                            "value59":y1[59],
                            "value60":y1[60],
                            "value61":y1[61],
                            "value62":y1[62],
                            "value63":y1[63],
                            "value64":y1[64],
                            "value65":y1[65],
                            "value66":y1[66],
                            "value67":y1[67],
                            "value68":y1[68],
                            "value69":y1[69],
                            "value70":y1[70],
                            "value71":y1[71],
                            "value72":y1[72],
                            "value73":y1[73],
                            "value74":y1[74],
                            "value75":y1[75],
                            "value76":y1[76],
                            "value77":y1[77],
                            "value78":y1[78],
                            "value79":y1[79],
                            "value80":y1[80],
                            "value81":y1[81],
                            "value82":y1[82],
                            "value83":y1[83],
                            "value84":y1[84],
                            "value85":y1[85],
                            "value86":y1[86],
                            "value87":y1[87],
                            "value88":y1[88],
                            "value89":y1[89],
                            "value90":y1[90],
                            "value91":y1[91],
                            "value92":y1[92],
                            "value93":y1[93],
                            "value94":y1[94],
                            "value95":y1[95],
                            "value96":y1[96],
                            "value97":y1[97],
                            "value98":y1[98],
                            "value99":y1[99]
                        },
                        {
                            "year": "2018",
                            "value0": y2[0],
                            "value1":y2[1],
                            "value2":y2[2],
                            "value3":y2[3],
                            "value4":y2[4],
                            "value5":y2[5],
                            "value6":y2[6],
                            "value7":y2[7],
                            "value8":y2[8],
                            "value9":y2[9],
                            "value10":y2[10],
                            "value11":y2[11],
                            "value12":y2[12],
                            "value13":y2[13],
                            "value14":y2[14],
                            "value15":y2[15],
                            "value16":y2[16],
                            "value17":y2[17],
                            "value18":y2[18],
                            "value19":y2[19],
                            "value20":y2[20],
                            "value21":y2[21],
                            "value22":y2[22],
                            "value23":y2[23],
                            "value24":y2[24],
                            "value25":y2[25],
                            "value26":y2[26],
                            "value27":y2[27],
                            "value28":y2[28],
                            "value29":y2[29],
                            "value30":y2[30],
                            "value31":y2[31],
                            "value32":y2[32],
                            "value33":y2[33],
                            "value34":y2[34],
                            "value35":y2[35],
                            "value36":y2[36],
                            "value37":y2[37],
                            "value38":y2[38],
                            "value39":y2[39],
                            "value40":y2[40],
                            "value41":y2[41],
                            "value42":y2[42],
                            "value43":y2[43],
                            "value44":y2[44],
                            "value45":y2[45],
                            "value46":y2[46],
                            "value47":y2[47],
                            "value48":y2[48],
                            "value49":y2[49],
                            "value50":y2[50],
                            "value51":y2[51],
                            "value52":y2[52],
                            "value53":y2[53],
                            "value54":y2[54],
                            "value55":y2[55],
                            "value56":y2[56],
                            "value57":y2[57],
                            "value58":y2[58],
                            "value59":y2[59],
                            "value60":y2[60],
                            "value61":y2[61],
                            "value62":y2[62],
                            "value63":y2[63],
                            "value64":y2[64],
                            "value65":y2[65],
                            "value66":y2[66],
                            "value67":y2[67],
                            "value68":y2[68],
                            "value69":y2[69],
                            "value70":y2[70],
                            "value71":y2[71],
                            "value72":y2[72],
                            "value73":y2[73],
                            "value74":y2[74],
                            "value75":y2[75],
                            "value76":y2[76],
                            "value77":y2[77],
                            "value78":y2[78],
                            "value79":y2[79],
                            "value80":y2[80],
                            "value81":y2[81],
                            "value82":y2[82],
                            "value83":y2[83],
                            "value84":y2[84],
                            "value85":y2[85],
                            "value86":y2[86],
                            "value87":y2[87],
                            "value88":y2[88],
                            "value89":y2[89],
                            "value90":y2[90],
                            "value91":y2[91],
                            "value92":y2[92],
                            "value93":y2[93],
                            "value94":y2[94],
                            "value95":y2[95],
                            "value96":y2[96],
                            "value97":y2[97],
                            "value98":y2[98],
                            "value99":y2[99]
                        },
                        {
                            "year": "2019",
                            "value0": y3[0],
                            "value1":y3[1],
                            "value2":y3[2],
                            "value3":y3[3],
                            "value4":y3[4],
                            "value5":y3[5],
                            "value6":y3[6],
                            "value7":y3[7],
                            "value8":y3[8],
                            "value9":y3[9],
                            "value10":y3[10],
                            "value11":y3[11],
                            "value12":y3[12],
                            "value13":y3[13],
                            "value14":y3[14],
                            "value15":y3[15],
                            "value16":y3[16],
                            "value17":y3[17],
                            "value18":y3[18],
                            "value19":y3[19],
                            "value20":y3[20],
                            "value21":y3[21],
                            "value22":y3[22],
                            "value23":y3[23],
                            "value24":y3[24],
                            "value25":y3[25],
                            "value26":y3[26],
                            "value27":y3[27],
                            "value28":y3[28],
                            "value29":y3[29],
                            "value30":y3[30],
                            "value31":y3[31],
                            "value32":y3[32],
                            "value33":y3[33],
                            "value34":y3[34],
                            "value35":y3[35],
                            "value36":y3[36],
                            "value37":y3[37],
                            "value38":y3[38],
                            "value39":y3[39],
                            "value40":y3[40],
                            "value41":y3[41],
                            "value42":y3[42],
                            "value43":y3[43],
                            "value44":y3[44],
                            "value45":y3[45],
                            "value46":y3[46],
                            "value47":y3[47],
                            "value48":y3[48],
                            "value49":y3[49],
                            "value50":y3[50],
                            "value51":y3[51],
                            "value52":y3[52],
                            "value53":y3[53],
                            "value54":y3[54],
                            "value55":y3[55],
                            "value56":y3[56],
                            "value57":y3[57],
                            "value58":y3[58],
                            "value59":y3[59],
                            "value60":y3[60],
                            "value61":y3[61],
                            "value62":y3[62],
                            "value63":y3[63],
                            "value64":y3[64],
                            "value65":y3[65],
                            "value66":y3[66],
                            "value67":y3[67],
                            "value68":y3[68],
                            "value69":y3[69],
                            "value70":y3[70],
                            "value71":y3[71],
                            "value72":y3[72],
                            "value73":y3[73],
                            "value74":y3[74],
                            "value75":y3[75],
                            "value76":y3[76],
                            "value77":y3[77],
                            "value78":y3[78],
                            "value79":y3[79],
                            "value80":y3[80],
                            "value81":y3[81],
                            "value82":y3[82],
                            "value83":y3[83],
                            "value84":y3[84],
                            "value85":y3[85],
                            "value86":y3[86],
                            "value87":y3[87],
                            "value88":y3[88],
                            "value89":y3[89],
                            "value90":y3[90],
                            "value91":y3[91],
                            "value92":y3[92],
                            "value93":y3[93],
                            "value94":y3[94],
                            "value95":y3[95],
                            "value96":y3[96],
                            "value97":y3[97],
                            "value98":y3[98],
                            "value99":y3[99]
                        },
                        {
                            "year": "2020",
                            "value0": y4[0],
                            "value1":y4[1],
                            "value2":y4[2],
                            "value3":y4[3],
                            "value4":y4[4],
                            "value5":y4[5],
                            "value6":y4[6],
                            "value7":y4[7],
                            "value8":y4[8],
                            "value9":y4[9],
                            "value10":y4[10],
                            "value11":y4[11],
                            "value12":y4[12],
                            "value13":y4[13],
                            "value14":y4[14],
                            "value15":y4[15],
                            "value16":y4[16],
                            "value17":y4[17],
                            "value18":y4[18],
                            "value19":y4[19],
                            "value20":y4[20],
                            "value21":y4[21],
                            "value22":y4[22],
                            "value23":y4[23],
                            "value24":y4[24],
                            "value25":y4[25],
                            "value26":y4[26],
                            "value27":y4[27],
                            "value28":y4[28],
                            "value29":y4[29],
                            "value30":y4[30],
                            "value31":y4[31],
                            "value32":y4[32],
                            "value33":y4[33],
                            "value34":y4[34],
                            "value35":y4[35],
                            "value36":y4[36],
                            "value37":y4[37],
                            "value38":y4[38],
                            "value39":y4[39],
                            "value40":y4[40],
                            "value41":y4[41],
                            "value42":y4[42],
                            "value43":y4[43],
                            "value44":y4[44],
                            "value45":y4[45],
                            "value46":y4[46],
                            "value47":y4[47],
                            "value48":y4[48],
                            "value49":y4[49],
                            "value50":y4[50],
                            "value51":y4[51],
                            "value52":y4[52],
                            "value53":y4[53],
                            "value54":y4[54],
                            "value55":y4[55],
                            "value56":y4[56],
                            "value57":y4[57],
                            "value58":y4[58],
                            "value59":y4[59],
                            "value60":y4[60],
                            "value61":y4[61],
                            "value62":y4[62],
                            "value63":y4[63],
                            "value64":y4[64],
                            "value65":y4[65],
                            "value66":y4[66],
                            "value67":y4[67],
                            "value68":y4[68],
                            "value69":y4[69],
                            "value70":y4[70],
                            "value71":y4[71],
                            "value72":y4[72],
                            "value73":y4[73],
                            "value74":y4[74],
                            "value75":y4[75],
                            "value76":y4[76],
                            "value77":y4[77],
                            "value78":y4[78],
                            "value79":y4[79],
                            "value80":y4[80],
                            "value81":y4[81],
                            "value82":y4[82],
                            "value83":y4[83],
                            "value84":y4[84],
                            "value85":y4[85],
                            "value86":y4[86],
                            "value87":y4[87],
                            "value88":y4[88],
                            "value89":y4[89],
                            "value90":y4[90],
                            "value91":y4[91],
                            "value92":y4[92],
                            "value93":y4[93],
                            "value94":y4[94],
                            "value95":y4[95],
                            "value96":y4[96],
                            "value97":y4[97],
                            "value98":y4[98],
                            "value99":y4[99]
                        },
                        {
                            "year": "2021",
                            "value0": y5[0],
                            "value1":y5[1],
                            "value2":y5[2],
                            "value3":y5[3],
                            "value4":y5[4],
                            "value5":y5[5],
                            "value6":y5[6],
                            "value7":y5[7],
                            "value8":y5[8],
                            "value9":y5[9],
                            "value10":y5[10],
                            "value11":y5[11],
                            "value12":y5[12],
                            "value13":y5[13],
                            "value14":y5[14],
                            "value15":y5[15],
                            "value16":y5[16],
                            "value17":y5[17],
                            "value18":y5[18],
                            "value19":y5[19],
                            "value20":y5[20],
                            "value21":y5[21],
                            "value22":y5[22],
                            "value23":y5[23],
                            "value24":y5[24],
                            "value25":y5[25],
                            "value26":y5[26],
                            "value27":y5[27],
                            "value28":y5[28],
                            "value29":y5[29],
                            "value30":y5[30],
                            "value31":y5[31],
                            "value32":y5[32],
                            "value33":y5[33],
                            "value34":y5[34],
                            "value35":y5[35],
                            "value36":y5[36],
                            "value37":y5[37],
                            "value38":y5[38],
                            "value39":y5[39],
                            "value40":y5[40],
                            "value41":y5[41],
                            "value42":y5[42],
                            "value43":y5[43],
                            "value44":y5[44],
                            "value45":y5[45],
                            "value46":y5[46],
                            "value47":y5[47],
                            "value48":y5[48],
                            "value49":y5[49],
                            "value50":y5[50],
                            "value51":y5[51],
                            "value52":y5[52],
                            "value53":y5[53],
                            "value54":y5[54],
                            "value55":y5[55],
                            "value56":y5[56],
                            "value57":y5[57],
                            "value58":y5[58],
                            "value59":y5[59],
                            "value60":y5[60],
                            "value61":y5[61],
                            "value62":y5[62],
                            "value63":y5[63],
                            "value64":y5[64],
                            "value65":y5[65],
                            "value66":y5[66],
                            "value67":y5[67],
                            "value68":y5[68],
                            "value69":y5[69],
                            "value70":y5[70],
                            "value71":y5[71],
                            "value72":y5[72],
                            "value73":y5[73],
                            "value74":y5[74],
                            "value75":y5[75],
                            "value76":y5[76],
                            "value77":y5[77],
                            "value78":y5[78],
                            "value79":y5[79],
                            "value80":y5[80],
                            "value81":y5[81],
                            "value82":y5[82],
                            "value83":y5[83],
                            "value84":y5[84],
                            "value85":y5[85],
                            "value86":y5[86],
                            "value87":y5[87],
                            "value88":y5[88],
                            "value89":y5[89],
                            "value90":y5[90],
                            "value91":y5[91],
                            "value92":y5[92],
                            "value93":y5[93],
                            "value94":y5[94],
                            "value95":y5[95],
                            "value96":y5[96],
                            "value97":y5[97],
                            "value98":y5[98],
                            "value99":y5[99]
                        },
                        {
                            "year": "2022",
                            "value0": y6[0],
                            "value1":y6[1],
                            "value2":y6[2],
                            "value3":y6[3],
                            "value4":y6[4],
                            "value5":y6[5],
                            "value6":y6[6],
                            "value7":y6[7],
                            "value8":y6[8],
                            "value9":y6[9],
                            "value10":y6[10],
                            "value11":y6[11],
                            "value12":y6[12],
                            "value13":y6[13],
                            "value14":y6[14],
                            "value15":y6[15],
                            "value16":y6[16],
                            "value17":y6[17],
                            "value18":y6[18],
                            "value19":y6[19],
                            "value20":y6[20],
                            "value21":y6[21],
                            "value22":y6[22],
                            "value23":y6[23],
                            "value24":y6[24],
                            "value25":y6[25],
                            "value26":y6[26],
                            "value27":y6[27],
                            "value28":y6[28],
                            "value29":y6[29],
                            "value30":y6[30],
                            "value31":y6[31],
                            "value32":y6[32],
                            "value33":y6[33],
                            "value34":y6[34],
                            "value35":y6[35],
                            "value36":y6[36],
                            "value37":y6[37],
                            "value38":y6[38],
                            "value39":y6[39],
                            "value40":y6[40],
                            "value41":y6[41],
                            "value42":y6[42],
                            "value43":y6[43],
                            "value44":y6[44],
                            "value45":y6[45],
                            "value46":y6[46],
                            "value47":y6[47],
                            "value48":y6[48],
                            "value49":y6[49],
                            "value50":y6[50],
                            "value51":y6[51],
                            "value52":y6[52],
                            "value53":y6[53],
                            "value54":y6[54],
                            "value55":y6[55],
                            "value56":y6[56],
                            "value57":y6[57],
                            "value58":y6[58],
                            "value59":y6[59],
                            "value60":y6[60],
                            "value61":y6[61],
                            "value62":y6[62],
                            "value63":y6[63],
                            "value64":y6[64],
                            "value65":y6[65],
                            "value66":y6[66],
                            "value67":y6[67],
                            "value68":y6[68],
                            "value69":y6[69],
                            "value70":y6[70],
                            "value71":y6[71],
                            "value72":y6[72],
                            "value73":y6[73],
                            "value74":y6[74],
                            "value75":y6[75],
                            "value76":y6[76],
                            "value77":y6[77],
                            "value78":y6[78],
                            "value79":y6[79],
                            "value80":y6[80],
                            "value81":y6[81],
                            "value82":y6[82],
                            "value83":y6[83],
                            "value84":y6[84],
                            "value85":y6[85],
                            "value86":y6[86],
                            "value87":y6[87],
                            "value88":y6[88],
                            "value89":y6[89],
                            "value90":y6[90],
                            "value91":y6[91],
                            "value92":y6[92],
                            "value93":y6[93],
                            "value94":y6[94],
                            "value95":y6[95],
                            "value96":y6[96],
                            "value97":y6[97],
                            "value98":y6[98],
                            "value99":y6[99]
                        },
                        {
                            "year": "2023",
                            "value0": y7[0],
                            "value1":y7[1],
                            "value2":y7[2],
                            "value3":y7[3],
                            "value4":y7[4],
                            "value5":y7[5],
                            "value6":y7[6],
                            "value7":y7[7],
                            "value8":y7[8],
                            "value9":y7[9],
                            "value10":y7[10],
                            "value11":y7[11],
                            "value12":y7[12],
                            "value13":y7[13],
                            "value14":y7[14],
                            "value15":y7[15],
                            "value16":y7[16],
                            "value17":y7[17],
                            "value18":y7[18],
                            "value19":y7[19],
                            "value20":y7[20],
                            "value21":y7[21],
                            "value22":y7[22],
                            "value23":y7[23],
                            "value24":y7[24],
                            "value25":y7[25],
                            "value26":y7[26],
                            "value27":y7[27],
                            "value28":y7[28],
                            "value29":y7[29],
                            "value30":y7[30],
                            "value31":y7[31],
                            "value32":y7[32],
                            "value33":y7[33],
                            "value34":y7[34],
                            "value35":y7[35],
                            "value36":y7[36],
                            "value37":y7[37],
                            "value38":y7[38],
                            "value39":y7[39],
                            "value40":y7[40],
                            "value41":y7[41],
                            "value42":y7[42],
                            "value43":y7[43],
                            "value44":y7[44],
                            "value45":y7[45],
                            "value46":y7[46],
                            "value47":y7[47],
                            "value48":y7[48],
                            "value49":y7[49],
                            "value50":y7[50],
                            "value51":y7[51],
                            "value52":y7[52],
                            "value53":y7[53],
                            "value54":y7[54],
                            "value55":y7[55],
                            "value56":y7[56],
                            "value57":y7[57],
                            "value58":y7[58],
                            "value59":y7[59],
                            "value60":y7[60],
                            "value61":y7[61],
                            "value62":y7[62],
                            "value63":y7[63],
                            "value64":y7[64],
                            "value65":y7[65],
                            "value66":y7[66],
                            "value67":y7[67],
                            "value68":y7[68],
                            "value69":y7[69],
                            "value70":y7[70],
                            "value71":y7[71],
                            "value72":y7[72],
                            "value73":y7[73],
                            "value74":y7[74],
                            "value75":y7[75],
                            "value76":y7[76],
                            "value77":y7[77],
                            "value78":y7[78],
                            "value79":y7[79],
                            "value80":y7[80],
                            "value81":y7[81],
                            "value82":y7[82],
                            "value83":y7[83],
                            "value84":y7[84],
                            "value85":y7[85],
                            "value86":y7[86],
                            "value87":y7[87],
                            "value88":y7[88],
                            "value89":y7[89],
                            "value90":y7[90],
                            "value91":y7[91],
                            "value92":y7[92],
                            "value93":y7[93],
                            "value94":y7[94],
                            "value95":y7[95],
                            "value96":y7[96],
                            "value97":y7[97],
                            "value98":y7[98],
                            "value99":y7[99]
                        },
                        {
                            "year": "2024",
                            "value0": y8[0],
                            "value1":y8[1],
                            "value2":y8[2],
                            "value3":y8[3],
                            "value4":y8[4],
                            "value5":y8[5],
                            "value6":y8[6],
                            "value7":y8[7],
                            "value8":y8[8],
                            "value9":y8[9],
                            "value10":y8[10],
                            "value11":y8[11],
                            "value12":y8[12],
                            "value13":y8[13],
                            "value14":y8[14],
                            "value15":y8[15],
                            "value16":y8[16],
                            "value17":y8[17],
                            "value18":y8[18],
                            "value19":y8[19],
                            "value20":y8[20],
                            "value21":y8[21],
                            "value22":y8[22],
                            "value23":y8[23],
                            "value24":y8[24],
                            "value25":y8[25],
                            "value26":y8[26],
                            "value27":y8[27],
                            "value28":y8[28],
                            "value29":y8[29],
                            "value30":y8[30],
                            "value31":y8[31],
                            "value32":y8[32],
                            "value33":y8[33],
                            "value34":y8[34],
                            "value35":y8[35],
                            "value36":y8[36],
                            "value37":y8[37],
                            "value38":y8[38],
                            "value39":y8[39],
                            "value40":y8[40],
                            "value41":y8[41],
                            "value42":y8[42],
                            "value43":y8[43],
                            "value44":y8[44],
                            "value45":y8[45],
                            "value46":y8[46],
                            "value47":y8[47],
                            "value48":y8[48],
                            "value49":y8[49],
                            "value50":y8[50],
                            "value51":y8[51],
                            "value52":y8[52],
                            "value53":y8[53],
                            "value54":y8[54],
                            "value55":y8[55],
                            "value56":y8[56],
                            "value57":y8[57],
                            "value58":y8[58],
                            "value59":y8[59],
                            "value60":y8[60],
                            "value61":y8[61],
                            "value62":y8[62],
                            "value63":y8[63],
                            "value64":y8[64],
                            "value65":y8[65],
                            "value66":y8[66],
                            "value67":y8[67],
                            "value68":y8[68],
                            "value69":y8[69],
                            "value70":y8[70],
                            "value71":y8[71],
                            "value72":y8[72],
                            "value73":y8[73],
                            "value74":y8[74],
                            "value75":y8[75],
                            "value76":y8[76],
                            "value77":y8[77],
                            "value78":y8[78],
                            "value79":y8[79],
                            "value80":y8[80],
                            "value81":y8[81],
                            "value82":y8[82],
                            "value83":y8[83],
                            "value84":y8[84],
                            "value85":y8[85],
                            "value86":y8[86],
                            "value87":y8[87],
                            "value88":y8[88],
                            "value89":y8[89],
                            "value90":y8[90],
                            "value91":y8[91],
                            "value92":y8[92],
                            "value93":y8[93],
                            "value94":y8[94],
                            "value95":y8[95],
                            "value96":y8[96],
                            "value97":y8[97],
                            "value98":y8[98],
                            "value99":y8[99]
                        },
                        {
                            "year": "2025",
                            "value0": y9[0],
                            "value1":y9[1],
                            "value2":y9[2],
                            "value3":y9[3],
                            "value4":y9[4],
                            "value5":y9[5],
                            "value6":y9[6],
                            "value7":y9[7],
                            "value8":y9[8],
                            "value9":y9[9],
                            "value10":y9[10],
                            "value11":y9[11],
                            "value12":y9[12],
                            "value13":y9[13],
                            "value14":y9[14],
                            "value15":y9[15],
                            "value16":y9[16],
                            "value17":y9[17],
                            "value18":y9[18],
                            "value19":y9[19],
                            "value20":y9[20],
                            "value21":y9[21],
                            "value22":y9[22],
                            "value23":y9[23],
                            "value24":y9[24],
                            "value25":y9[25],
                            "value26":y9[26],
                            "value27":y9[27],
                            "value28":y9[28],
                            "value29":y9[29],
                            "value30":y9[30],
                            "value31":y9[31],
                            "value32":y9[32],
                            "value33":y9[33],
                            "value34":y9[34],
                            "value35":y9[35],
                            "value36":y9[36],
                            "value37":y9[37],
                            "value38":y9[38],
                            "value39":y9[39],
                            "value40":y9[40],
                            "value41":y9[41],
                            "value42":y9[42],
                            "value43":y9[43],
                            "value44":y9[44],
                            "value45":y9[45],
                            "value46":y9[46],
                            "value47":y9[47],
                            "value48":y9[48],
                            "value49":y9[49],
                            "value50":y9[50],
                            "value51":y9[51],
                            "value52":y9[52],
                            "value53":y9[53],
                            "value54":y9[54],
                            "value55":y9[55],
                            "value56":y9[56],
                            "value57":y9[57],
                            "value58":y9[58],
                            "value59":y9[59],
                            "value60":y9[60],
                            "value61":y9[61],
                            "value62":y9[62],
                            "value63":y9[63],
                            "value64":y9[64],
                            "value65":y9[65],
                            "value66":y9[66],
                            "value67":y9[67],
                            "value68":y9[68],
                            "value69":y9[69],
                            "value70":y9[70],
                            "value71":y9[71],
                            "value72":y9[72],
                            "value73":y9[73],
                            "value74":y9[74],
                            "value75":y9[75],
                            "value76":y9[76],
                            "value77":y9[77],
                            "value78":y9[78],
                            "value79":y9[79],
                            "value80":y9[80],
                            "value81":y9[81],
                            "value82":y9[82],
                            "value83":y9[83],
                            "value84":y9[84],
                            "value85":y9[85],
                            "value86":y9[86],
                            "value87":y9[87],
                            "value88":y9[88],
                            "value89":y9[89],
                            "value90":y9[90],
                            "value91":y9[91],
                            "value92":y9[92],
                            "value93":y9[93],
                            "value94":y9[94],
                            "value95":y9[95],
                            "value96":y9[96],
                            "value97":y9[97],
                            "value98":y9[98],
                            "value99":y9[99]
                        },
                        {
                            "year": "2026",
                            "value0": y10[0],
                            "value1":y10[1],
                            "value2":y10[2],
                            "value3":y10[3],
                            "value4":y10[4],
                            "value5":y10[5],
                            "value6":y10[6],
                            "value7":y10[7],
                            "value8":y10[8],
                            "value9":y10[9],
                            "value10":y10[10],
                            "value11":y10[11],
                            "value12":y10[12],
                            "value13":y10[13],
                            "value14":y10[14],
                            "value15":y10[15],
                            "value16":y10[16],
                            "value17":y10[17],
                            "value18":y10[18],
                            "value19":y10[19],
                            "value20":y10[20],
                            "value21":y10[21],
                            "value22":y10[22],
                            "value23":y10[23],
                            "value24":y10[24],
                            "value25":y10[25],
                            "value26":y10[26],
                            "value27":y10[27],
                            "value28":y10[28],
                            "value29":y10[29],
                            "value30":y10[30],
                            "value31":y10[31],
                            "value32":y10[32],
                            "value33":y10[33],
                            "value34":y10[34],
                            "value35":y10[35],
                            "value36":y10[36],
                            "value37":y10[37],
                            "value38":y10[38],
                            "value39":y10[39],
                            "value40":y10[40],
                            "value41":y10[41],
                            "value42":y10[42],
                            "value43":y10[43],
                            "value44":y10[44],
                            "value45":y10[45],
                            "value46":y10[46],
                            "value47":y10[47],
                            "value48":y10[48],
                            "value49":y10[49],
                            "value50":y10[50],
                            "value51":y10[51],
                            "value52":y10[52],
                            "value53":y10[53],
                            "value54":y10[54],
                            "value55":y10[55],
                            "value56":y10[56],
                            "value57":y10[57],
                            "value58":y10[58],
                            "value59":y10[59],
                            "value60":y10[60],
                            "value61":y10[61],
                            "value62":y10[62],
                            "value63":y10[63],
                            "value64":y10[64],
                            "value65":y10[65],
                            "value66":y10[66],
                            "value67":y10[67],
                            "value68":y10[68],
                            "value69":y10[69],
                            "value70":y10[70],
                            "value71":y10[71],
                            "value72":y10[72],
                            "value73":y10[73],
                            "value74":y10[74],
                            "value75":y10[75],
                            "value76":y10[76],
                            "value77":y10[77],
                            "value78":y10[78],
                            "value79":y10[79],
                            "value80":y10[80],
                            "value81":y10[81],
                            "value82":y10[82],
                            "value83":y10[83],
                            "value84":y10[84],
                            "value85":y10[85],
                            "value86":y10[86],
                            "value87":y10[87],
                            "value88":y10[88],
                            "value89":y10[89],
                            "value90":y10[90],
                            "value91":y10[91],
                            "value92":y10[92],
                            "value93":y10[93],
                            "value94":y10[94],
                            "value95":y10[95],
                            "value96":y10[96],
                            "value97":y10[97],
                            "value98":y10[98],
                            "value99":y10[99]
                        }       
                     
                    ];
             

  AmCharts.ready(function () {
                        // SERIAL CHART
                        
                        chart= new AmCharts.AmSerialChart();

                        chart.dataProvider = chartData;
                        chart.marginLeft = 10;
                        chart.categoryField = "year";
                        chart.dataDateFormat = "YYYY";

                        // listen for "dataUpdated" event (fired when chart is inited) and call zoomChart method when it happens
                        chart.addListener("dataUpdated", zoomChart);

                        // AXES
                        // category
                        var categoryAxis = chart.categoryAxis;
                        categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
                        categoryAxis.minPeriod = "YYYY"; // our data is yearly, so we set minPeriod to YYYY
                       

                        // value
                        var valueAxis = new AmCharts.ValueAxis();
                        valueAxis.axisAlpha = 0;
                        valueAxis.inside = true;
                       
                        chart.addValueAxis(valueAxis);

                        // GRAPH
                        graph = new AmCharts.AmGraph();
                        graph.id=("g1");
                        graph.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph.lineColor = "#e91a33";
                        graph.negativeLineColor = "#e91a33"; // this line makes the graph to change color when it drops below 0
                        graph.lineThickness = 3;
                        graph.valueField = "value0";
                        //graph.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value0]]</span></b>";
                        chart.addGraph(graph);

                        graph1 = new AmCharts.AmGraph();
                        graph1.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph1.lineColor = "green";
                        graph1.negativeLineColor = "green"; // this line makes the graph to change color when it drops below 0
                        graph1.lineThickness = 3;
                        graph1.valueField = "value1";
                        //graph1.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value1]]</span></b>";
                        chart.addGraph(graph1);

                        graph2 = new AmCharts.AmGraph();
                        graph2.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph2.lineColor = "yellow";
                        graph2.negativeLineColor = "yellow"; // this line makes the graph to change color when it drops below 0
                        graph2.lineThickness = 3;
                        graph2.valueField = "value2";
                        //graph2.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value2]]</span></b>";
                        chart.addGraph(graph2);

                        graph3 = new AmCharts.AmGraph();
                        graph3.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph3.lineColor = "blue";
                        graph3.negativeLineColor = "blue"; // this line makes the graph to change color when it drops below 0
                        graph3.lineThickness = 3;
                        graph3.valueField = "value3";
                        //graph3.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value3]]</span></b>";
                        chart.addGraph(graph3);

                        graph4 = new AmCharts.AmGraph();
                        graph4.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph4.lineColor = "pink";
                        graph4.negativeLineColor = "pink"; // this line makes the graph to change color when it drops below 0
                        graph4.lineThickness = 3;
                        graph4.valueField = "value4";
                       // graph4.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value4]]</span></b>";
                        chart.addGraph(graph4);

                        graph5 = new AmCharts.AmGraph();
                        graph5.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph5.lineColor = "#e91a00";
                        graph5.negativeLineColor = "#e91a00"; // this line makes the graph to change color when it drops below 0
                        graph5.lineThickness = 3;
                        graph5.valueField = "value5";
                        //graph5.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value5]]</span></b>";
                        chart.addGraph(graph5);

                        graph6 = new AmCharts.AmGraph();
                        graph6.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph6.lineColor = "#e91a55";
                        graph6.negativeLineColor = "#e91a55"; // this line makes the graph to change color when it drops below 0
                        graph6.lineThickness = 3;
                        graph6.valueField = "value6";
                        //graph6.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value6]]</span></b>";
                        chart.addGraph(graph6);

                        graph7 = new AmCharts.AmGraph();
                        graph7.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph7.lineColor = "#e91a11";
                        graph7.negativeLineColor = "#e91a11"; // this line makes the graph to change color when it drops below 0
                        graph7.lineThickness = 3;
                        graph7.valueField = "value7";
                        //graph7.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value7]]</span></b>";
                        chart.addGraph(graph7);

                        graph8 = new AmCharts.AmGraph();
                        graph8.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph8.lineColor = "#e81a33";
                        graph8.negativeLineColor = "#e81a33"; // this line makes the graph to change color when it drops below 0
                        graph8.lineThickness = 3;
                        graph8.valueField = "value8";
                        //graph8.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value8]]</span></b>";
                        chart.addGraph(graph8);

                        graph9 = new AmCharts.AmGraph();
                        graph9.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph9.lineColor = "#e61a33";
                        graph9.negativeLineColor = "#e61a33"; // this line makes the graph to change color when it drops below 0
                        graph9.lineThickness = 3;
                        graph9.valueField = "value9";
                        //graph9.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value9]]</span></b>";
                        chart.addGraph(graph9);

                        graph10 = new AmCharts.AmGraph();
                        graph10.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph10.lineColor = "#e91a53";
                        graph10.negativeLineColor = "#e91a53"; // this line makes the graph to change color when it drops below 0
                        graph10.lineThickness = 3;
                        graph10.valueField = "value10";
                        //graph10.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value10]]</span></b>";
                        chart.addGraph(graph10);

                        graph11 = new AmCharts.AmGraph();
                        graph11.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph11.lineColor = "purple";
                        graph11.negativeLineColor = "purple"; // this line makes the graph to change color when it drops below 0
                        graph11.lineThickness = 3;
                        graph11.valueField = "value11";
                        //graph10.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value11]]</span></b>";
                        chart.addGraph(graph11);

                        graph12 = new AmCharts.AmGraph();
                        graph12.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph12.lineColor = "black";
                        graph12.negativeLineColor = "black"; // this line makes the graph to change color when it drops below 0
                        graph12.lineThickness = 3;
                        graph12.valueField = "value12";
                        //graph2.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value12]]</span></b>";
                        chart.addGraph(graph12);

                        graph13 = new AmCharts.AmGraph();
                        graph13.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph13.lineColor = "#e81b53";
                        graph13.negativeLineColor = "#e81b53"; // this line makes the graph to change color when it drops below 0
                        graph13.lineThickness = 3;
                        graph13.valueField = "value13";
                        //graph3.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value13]]</span></b>";
                        chart.addGraph(graph13);

                        graph14 = new AmCharts.AmGraph();
                        graph14.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph14.lineColor = "#c91a53";
                        graph14.negativeLineColor = "#c91a53"; // this line makes the graph to change color when it drops below 0
                        graph14.lineThickness = 3;
                        graph14.valueField = "value14";
                       // graph4.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value14]]</span></b>";
                        chart.addGraph(graph14);

                        graph15 = new AmCharts.AmGraph();
                        graph15.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph15.lineColor = "#c81b53";
                        graph15.negativeLineColor = "#c81b53"; // this line makes the graph to change color when it drops below 0
                        graph15.lineThickness = 3;
                        graph15.valueField = "value15";
                        //graph5.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value15]]</span></b>";
                        chart.addGraph(graph15);

                        graph16 = new AmCharts.AmGraph();
                        graph16.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph16.lineColor = "#f91b55";
                        graph16.negativeLineColor = "#f91b55"; // this line makes the graph to change color when it drops below 0
                        graph16.lineThickness = 3;
                        graph16.valueField = "value16";
                        //graph6.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value16]]</span></b>";
                        chart.addGraph(graph16);

                        graph17 = new AmCharts.AmGraph();
                        graph17.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph17.lineColor = "#e93b11";
                        graph17.negativeLineColor = "#e93b11"; // this line makes the graph to change color when it drops below 0
                        graph17.lineThickness = 3;
                        graph17.valueField = "value17";
                        //graph7.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value17]]</span></b>";
                        chart.addGraph(graph17);

                        graph18 = new AmCharts.AmGraph();
                        graph18.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph18.lineColor = "#d81a33";
                        graph18.negativeLineColor = "#d81a33"; // this line makes the graph to change color when it drops below 0
                        graph18.lineThickness = 3;
                        graph18.valueField = "value18";
                        //graph8.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value18]]</span></b>";
                        chart.addGraph(graph18);

                        graph19 = new AmCharts.AmGraph();
                        graph19.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph19.lineColor = "#e60b33";
                        graph19.negativeLineColor = "#e60b33"; // this line makes the graph to change color when it drops below 0
                        graph19.lineThickness = 3;
                        graph19.valueField = "value19";
                        //graph9.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value19]]</span></b>";
                        chart.addGraph(graph19);

                        graph20 = new AmCharts.AmGraph();
                        graph20.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph20.lineColor = "gray";
                        graph20.negativeLineColor = "gray"; // this line makes the graph to change color when it drops below 0
                        graph20.lineThickness = 3;
                        graph20.valueField = "value20";
                        //graph10.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value20]]</span></b>";
                        chart.addGraph(graph20);

                        graph21 = new AmCharts.AmGraph();
                        graph21.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph21.lineColor = "#89da59";
                        graph21.negativeLineColor = "#89da59"; // this line makes the graph to change color when it drops below 0
                        graph21.lineThickness = 3;
                        graph21.valueField = "value21";
                        //graph1.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value21]]</span></b>";
                        chart.addGraph(graph12);

                        graph22 = new AmCharts.AmGraph();
                        graph22.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph22.lineColor = "#80bd9e";
                        graph22.negativeLineColor = "#80bd9e"; // this line makes the graph to change color when it drops below 0
                        graph22.lineThickness = 3;
                        graph22.valueField = "value22";
                        //graph2.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value22]]</span></b>";
                        chart.addGraph(graph22);

                        graph23 = new AmCharts.AmGraph();
                        graph23.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph23.lineColor = "#90afc5";
                        graph23.negativeLineColor = "#90afc5"; // this line makes the graph to change color when it drops below 0
                        graph23.lineThickness = 3;
                        graph23.valueField = "value23";
                        //graph3.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value23]]</span></b>";
                        chart.addGraph(graph23);

                        graph24 = new AmCharts.AmGraph();
                        graph24.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph24.lineColor = "#336b87";
                        graph24.negativeLineColor = "#336b87"; // this line makes the graph to change color when it drops below 0
                        graph24.lineThickness = 3;
                        graph24.valueField = "value24";
                       // graph4.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value24]]</span></b>";
                        chart.addGraph(graph24);

                        graph25 = new AmCharts.AmGraph();
                        graph25.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph25.lineColor = "#2a3132";
                        graph25.negativeLineColor = "#2a3132"; // this line makes the graph to change color when it drops below 0
                        graph25.lineThickness = 3;
                        graph25.valueField = "value25";
                        //graph5.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value25]]</span></b>";
                        chart.addGraph(graph25);

                        graph26 = new AmCharts.AmGraph();
                        graph26.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph26.lineColor = "#46211a";
                        graph26.negativeLineColor = "#46211a"; // this line makes the graph to change color when it drops below 0
                        graph26.lineThickness = 3;
                        graph26.valueField = "value26";
                        //graph6.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value26]]</span></b>";
                        chart.addGraph(graph26);

                        graph27 = new AmCharts.AmGraph();
                        graph27.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph27.lineColor = "#763626";
                        graph27.negativeLineColor = "#763626"; // this line makes the graph to change color when it drops below 0
                        graph27.lineThickness = 3;
                        graph27.valueField = "value27";
                        //graph7.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value27]]</span></b>";
                        chart.addGraph(graph27);

                        graph28 = new AmCharts.AmGraph();
                        graph28.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph28.lineColor = "#693d3d";
                        graph28.negativeLineColor = "#693d3d"; // this line makes the graph to change color when it drops below 0
                        graph28.lineThickness = 3;
                        graph28.valueField = "value28";
                        //graph8.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value28]]</span></b>";
                        chart.addGraph(graph28);

                        graph29 = new AmCharts.AmGraph();
                        graph29.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph29.lineColor = "#505160";
                        graph29.negativeLineColor = "#505160"; // this line makes the graph to change color when it drops below 0
                        graph29.lineThickness = 3;
                        graph29.valueField = "value29";
                        //graph9.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value29]]</span></b>";
                        chart.addGraph(graph29);

                        graph30 = new AmCharts.AmGraph();
                        graph30.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph30.lineColor = "#68829e";
                        graph30.negativeLineColor = "#68829e"; // this line makes the graph to change color when it drops below 0
                        graph30.lineThickness = 3;
                        graph30.valueField = "value30";
                        //graph10.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value30]]</span></b>";
                        chart.addGraph(graph30);

                        graph31 = new AmCharts.AmGraph();
                        graph31.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph31.lineColor = "#021c1e";
                        graph31.negativeLineColor = "#021c1e"; // this line makes the graph to change color when it drops below 0
                        graph31.lineThickness = 3;
                        graph31.valueField = "value31";
                        //graph1.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value31]]</span></b>";
                        chart.addGraph(graph31);

                        graph32 = new AmCharts.AmGraph();
                        graph32.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph32.lineColor = "#c4dfe6";
                        graph32.negativeLineColor = "#c4dfe6"; // this line makes the graph to change color when it drops below 0
                        graph32.lineThickness = 3;
                        graph32.valueField = "value32";
                        //graph2.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value32]]</span></b>";
                        chart.addGraph(graph32);

                        graph33 = new AmCharts.AmGraph();
                        graph33.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph33.lineColor = "#2e4600";
                        graph33.negativeLineColor = "#2e4600"; // this line makes the graph to change color when it drops below 0
                        graph33.lineThickness = 3;
                        graph33.valueField = "value33";
                        //graph3.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value33]]</span></b>";
                        chart.addGraph(graph33);

                        graph34 = new AmCharts.AmGraph();
                        graph34.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph34.lineColor = "#486b00";
                        graph34.negativeLineColor = "#486b00"; // this line makes the graph to change color when it drops below 0
                        graph34.lineThickness = 3;
                        graph34.valueField = "value34";
                       // graph4.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value34]]</span></b>";
                        chart.addGraph(graph34);

                        graph35 = new AmCharts.AmGraph();
                        graph35.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph35.lineColor = "#66a5ad";
                        graph35.negativeLineColor = "#66a5ad"; // this line makes the graph to change color when it drops below 0
                        graph35.lineThickness = 3;
                        graph35.valueField = "value35";
                        //graph5.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value35]]</span></b>";
                        chart.addGraph(graph35);

                        graph36 = new AmCharts.AmGraph();
                        graph36.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph36.lineColor = "#07575";
                        graph36.negativeLineColor = "#07575"; // this line makes the graph to change color when it drops below 0
                        graph36.lineThickness = 3;
                        graph36.valueField = "value36";
                        //graph6.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value36]]</span></b>";
                        chart.addGraph(graph36);

                        graph37 = new AmCharts.AmGraph();
                        graph37.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph37.lineColor = "#003b46";
                        graph37.negativeLineColor = "#003b46"; // this line makes the graph to change color when it drops below 0
                        graph37.lineThickness = 3;
                        graph37.valueField = "value37";
                        //graph7.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value37]]</span></b>";
                        chart.addGraph(graph37);

                        graph38 = new AmCharts.AmGraph();
                        graph38.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph38.lineColor = "#598234";
                        graph38.negativeLineColor = "#598234"; // this line makes the graph to change color when it drops below 0
                        graph38.lineThickness = 3;
                        graph38.valueField = "value38";
                        //graph8.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value38]]</span></b>";
                        chart.addGraph(graph38);

                        graph39 = new AmCharts.AmGraph();
                        graph39.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph39.lineColor = "#aebd38";
                        graph39.negativeLineColor = "#aebd38"; // this line makes the graph to change color when it drops below 0
                        graph39.lineThickness = 3;
                        graph39.valueField = "value49";
                        //graph9.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value39]]</span></b>";
                        chart.addGraph(graph39);

                        graph40 = new AmCharts.AmGraph();
                        graph40.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph40.lineColor = "#004445";
                        graph40.negativeLineColor = "#004445"; // this line makes the graph to change color when it drops below 0
                        graph40.lineThickness = 3;
                        graph40.valueField = "value40";
                       // graph4.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value40]]</span></b>";
                        chart.addGraph(graph40);

                        graph41 = new AmCharts.AmGraph();
                        graph41.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph41.lineColor = "#2c7873";
                        graph41.negativeLineColor = "green"; // this line makes the graph to change color when it drops below 0
                        graph41.lineThickness = 3;
                        graph41.valueField = "value41";
                        //graph1.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value41]]</span></b>";
                        chart.addGraph(graph41);

                        graph42 = new AmCharts.AmGraph();
                        graph42.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph42.lineColor = "#6fb98f";
                        graph42.negativeLineColor = "#6fb98f"; // this line makes the graph to change color when it drops below 0
                        graph42.lineThickness = 3;
                        graph42.valueField = "value42";
                        //graph2.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value42]]</span></b>";
                        chart.addGraph(graph42);

                        graph43 = new AmCharts.AmGraph();
                        graph43.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph43.lineColor = "#375e97";
                        graph43.negativeLineColor = "#375e97"; // this line makes the graph to change color when it drops below 0
                        graph43.lineThickness = 3;
                        graph43.valueField = "value43";
                        //graph3.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value43]]</span></b>";
                        chart.addGraph(graph43);

                        graph44 = new AmCharts.AmGraph();
                        graph44.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph44.lineColor = "#fb6542";
                        graph44.negativeLineColor = "#fb6542"; // this line makes the graph to change color when it drops below 0
                        graph44.lineThickness = 3;
                        graph44.valueField = "value44";
                       // graph4.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value44]]</span></b>";
                        chart.addGraph(graph44);

                        graph45 = new AmCharts.AmGraph();
                        graph45.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph45.lineColor = "#ffbb00";
                        graph45.negativeLineColor = "#ffbb00"; // this line makes the graph to change color when it drops below 0
                        graph45.lineThickness = 3;
                        graph45.valueField = "value45";
                        //graph5.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value45]]</span></b>";
                        chart.addGraph(graph45);

                        graph46 = new AmCharts.AmGraph();
                        graph46.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph46.lineColor = "#98dbc6";
                        graph46.negativeLineColor = "#98dbc6"; // this line makes the graph to change color when it drops below 0
                        graph46.lineThickness = 3;
                        graph46.valueField = "value46";
                        //graph6.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value46]]</span></b>";
                        chart.addGraph(graph46);

                        graph47 = new AmCharts.AmGraph();
                        graph47.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph47.lineColor = "#5bc8ac";
                        graph47.negativeLineColor = "#5bc8ac"; // this line makes the graph to change color when it drops below 0
                        graph47.lineThickness = 3;
                        graph47.valueField = "value47";
                        //graph7.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value47]]</span></b>";
                        chart.addGraph(graph47);

                        graph48 = new AmCharts.AmGraph();
                        graph48.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph48.lineColor = "#e6d72a";
                        graph48.negativeLineColor = "#e6d72a"; // this line makes the graph to change color when it drops below 0
                        graph48.lineThickness = 3;
                        graph48.valueField = "value48";
                        //graph48.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value48]]</span></b>";
                        chart.addGraph(graph48);

                        graph49 = new AmCharts.AmGraph();
                        graph49.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph49.lineColor = "#f18d9e";
                        graph49.negativeLineColor = "#f18d9e"; // this line makes the graph to change color when it drops below 0
                        graph49.lineThickness = 3;
                        graph49.valueField = "value49";
                        //graph9.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value49]]</span></b>";
                        chart.addGraph(graph49);

                        graph50 = new AmCharts.AmGraph();
                        graph50.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph50.lineColor = "#324851";
                        graph50.negativeLineColor = "#324851"; // this line makes the graph to change color when it drops below 0
                        graph50.lineThickness = 3;
                        graph50.valueField = "value50";
                        //graph5.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value50]]</span></b>";
                        chart.addGraph(graph50);

                        graph51 = new AmCharts.AmGraph();
                        graph51.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph51.lineColor = "#86ac41";
                        graph51.negativeLineColor = "#86ac41"; // this line makes the graph to change color when it drops below 0
                        graph51.lineThickness = 3;
                        graph51.valueField = "value51";
                        //graph1.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value51]]</span></b>";
                        chart.addGraph(graph51);

                        graph52 = new AmCharts.AmGraph();
                        graph52.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph52.lineColor = "#34675c";
                        graph52.negativeLineColor = "#34675c"; // this line makes the graph to change color when it drops below 0
                        graph52.lineThickness = 3;
                        graph52.valueField = "value52";
                        //graph2.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value52]]</span></b>";
                        chart.addGraph(graph52);

                        graph53 = new AmCharts.AmGraph();
                        graph53.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph53.lineColor = "#7da3a1";
                        graph53.negativeLineColor = "#7da3a1"; // this line makes the graph to change color when it drops below 0
                        graph53.lineThickness = 3;
                        graph53.valueField = "value53";
                        //graph3.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value53]]</span></b>";
                        chart.addGraph(graph53);

                        graph54 = new AmCharts.AmGraph();
                        graph54.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph54.lineColor = "#4cb5f5";
                        graph54.negativeLineColor = "#4cb5f5"; // this line makes the graph to change color when it drops below 0
                        graph54.lineThickness = 3;
                        graph54.valueField = "value54";
                       // graph4.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value54]]</span></b>";
                        chart.addGraph(graph54);

                        graph55 = new AmCharts.AmGraph();
                        graph55.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph55.lineColor = "#b7b8b6";
                        graph55.negativeLineColor = "#b7b8b6"; // this line makes the graph to change color when it drops below 0
                        graph55.lineThickness = 3;
                        graph55.valueField = "value55";
                        //graph5.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value55]]</span></b>";
                        chart.addGraph(graph55);

                        graph56 = new AmCharts.AmGraph();
                        graph56.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph56.lineColor = "#34675c";
                        graph56.negativeLineColor = "#34675c"; // this line makes the graph to change color when it drops below 0
                        graph56.lineThickness = 3;
                        graph56.valueField = "value56";
                        //graph6.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value56]]</span></b>";
                        chart.addGraph(graph56);

                        graph57 = new AmCharts.AmGraph();
                        graph57.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph57.lineColor = "#b3c100";
                        graph57.negativeLineColor = "#b3c100"; // this line makes the graph to change color when it drops below 0
                        graph57.lineThickness = 3;
                        graph57.valueField = "value57";
                        //graph7.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value57]]</span></b>";
                        chart.addGraph(graph57);

                        graph58 = new AmCharts.AmGraph();
                        graph58.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph58.lineColor = "#f4cc70";
                        graph58.negativeLineColor = "#f4cc70"; // this line makes the graph to change color when it drops below 0
                        graph58.lineThickness = 3;
                        graph58.valueField = "value58";
                        //graph8.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value58]]</span></b>";
                        chart.addGraph(graph58);

                        graph59 = new AmCharts.AmGraph();
                        graph59.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph59.lineColor = "#de7a22";
                        graph59.negativeLineColor = "#de7a22"; // this line makes the graph to change color when it drops below 0
                        graph59.lineThickness = 3;
                        graph59.valueField = "value59";
                        //graph9.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value59]]</span></b>";
                        chart.addGraph(graph59);

                        graph60 = new AmCharts.AmGraph();
                        graph60.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph60.lineColor = "#20948b";
                        graph60.negativeLineColor = "#20948b"; // this line makes the graph to change color when it drops below 0
                        graph60.lineThickness = 3;
                        graph60.valueField = "value60";
                        //graph6.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value60]]</span></b>";
                        chart.addGraph(graph60);

                        graph61 = new AmCharts.AmGraph();
                        graph61.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph61.lineColor = "#6ab187";
                        graph61.negativeLineColor = "#6ab187"; // this line makes the graph to change color when it drops below 0
                        graph61.lineThickness = 3;
                        graph61.valueField = "value61";
                        //graph1.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value61]]</span></b>";
                        chart.addGraph(graph61);

                        graph62 = new AmCharts.AmGraph();
                        graph62.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph62.lineColor = "#8d230f";
                        graph62.negativeLineColor = "#8d230f"; // this line makes the graph to change color when it drops below 0
                        graph62.lineThickness = 3;
                        graph62.valueField = "value62";
                        //graph2.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value62]]</span></b>";
                        chart.addGraph(graph62);

                        graph63 = new AmCharts.AmGraph();
                        graph63.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph63.lineColor = "#1e434c";
                        graph63.negativeLineColor = "#1e434c"; // this line makes the graph to change color when it drops below 0
                        graph63.lineThickness = 3;
                        graph63.valueField = "value63";
                        //graph3.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value63]]</span></b>";
                        chart.addGraph(graph63);

                        graph64 = new AmCharts.AmGraph();
                        graph64.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph64.lineColor = "#c99e10";
                        graph64.negativeLineColor = "#c99e10"; // this line makes the graph to change color when it drops below 0
                        graph64.lineThickness = 3;
                        graph64.valueField = "value64";
                       // graph4.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value64]]</span></b>";
                        chart.addGraph(graph64);

                        graph65 = new AmCharts.AmGraph();
                        graph65.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph65.lineColor = "#9b4f0f";
                        graph65.negativeLineColor = "#9b4f0f"; // this line makes the graph to change color when it drops below 0
                        graph65.lineThickness = 3;
                        graph65.valueField = "value65";
                        //graph5.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value65]]</span></b>";
                        chart.addGraph(graph65);

                        graph66 = new AmCharts.AmGraph();
                        graph66.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph66.lineColor = "#f1f1f2";
                        graph66.negativeLineColor = "#f1f1f2"; // this line makes the graph to change color when it drops below 0
                        graph66.lineThickness = 3;
                        graph66.valueField = "value66";
                        //graph6.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value66]]</span></b>";
                        chart.addGraph(graph66);

                        graph67 = new AmCharts.AmGraph();
                        graph67.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph67.lineColor = "#bcbabe";
                        graph67.negativeLineColor = "#bcbabe"; // this line makes the graph to change color when it drops below 0
                        graph67.lineThickness = 3;
                        graph67.valueField = "value67";
                        //graph7.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value67]]</span></b>";
                        chart.addGraph(graph67);

                        graph68 = new AmCharts.AmGraph();
                        graph68.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph68.lineColor = "#a1d6e2";
                        graph68.negativeLineColor = "#a1d6e2"; // this line makes the graph to change color when it drops below 0
                        graph68.lineThickness = 3;
                        graph68.valueField = "value68";
                        //graph8.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value68]]</span></b>";
                        chart.addGraph(graph68);

                        graph69 = new AmCharts.AmGraph();
                        graph69.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph69.lineColor = "#1995ad";
                        graph69.negativeLineColor = "#1995ad"; // this line makes the graph to change color when it drops below 0
                        graph69.lineThickness = 3;
                        graph69.valueField = "value69";
                        //graph9.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value69]]</span></b>";
                        chart.addGraph(graph69);

                        graph70 = new AmCharts.AmGraph();
                        graph70.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph70.lineColor = "#9a9eab";
                        graph70.negativeLineColor = "#9a9eab"; // this line makes the graph to change color when it drops below 0
                        graph70.lineThickness = 3;
                        graph70.valueField = "value70";
                        //graph7.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value70]]</span></b>";
                        chart.addGraph(graph70);

                        graph71 = new AmCharts.AmGraph();
                        graph71.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph71.lineColor = "#e6df44";
                        graph71.negativeLineColor = "#e6df44"; // this line makes the graph to change color when it drops below 0
                        graph71.lineThickness = 3;
                        graph71.valueField = "value71";
                        //graph1.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value71]]</span></b>";
                        chart.addGraph(graph71);

                        graph72 = new AmCharts.AmGraph();
                        graph72.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph72.lineColor = "#75b1a9";
                        graph72.negativeLineColor = "#75b1a9"; // this line makes the graph to change color when it drops below 0
                        graph72.lineThickness = 3;
                        graph72.valueField = "value72";
                        //graph2.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value72]]</span></b>";
                        chart.addGraph(graph72);

                        graph73 = new AmCharts.AmGraph();
                        graph73.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph73.lineColor = "#d9b44a";
                        graph73.negativeLineColor = "#d9b44a"; // this line makes the graph to change color when it drops below 0
                        graph73.lineThickness = 3;
                        graph73.valueField = "value73";
                        //graph3.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value73]]</span></b>";
                        chart.addGraph(graph73);

                        graph74 = new AmCharts.AmGraph();
                        graph74.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph74.lineColor = "#f0810f";
                        graph74.negativeLineColor = "#f0810f"; // this line makes the graph to change color when it drops below 0
                        graph74.lineThickness = 3;
                        graph74.valueField = "value74";
                       // graph4.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value74]]</span></b>";
                        chart.addGraph(graph74);

                        graph75 = new AmCharts.AmGraph();
                        graph75.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph75.lineColor = "#063852";
                        graph75.negativeLineColor = "#063852"; // this line makes the graph to change color when it drops below 0
                        graph75.lineThickness = 3;
                        graph75.valueField = "value75";
                        //graph5.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value75]]</span></b>";
                        chart.addGraph(graph75);

                        graph76 = new AmCharts.AmGraph();
                        graph76.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph76.lineColor = "#011a27";
                        graph76.negativeLineColor = "#011a27"; // this line makes the graph to change color when it drops below 0
                        graph76.lineThickness = 3;
                        graph76.valueField = "value76";
                        //graph6.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value76]]</span></b>";
                        chart.addGraph(graph76);

                        graph77 = new AmCharts.AmGraph();
                        graph77.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph77.lineColor = "#dfe166";
                        graph77.negativeLineColor = "#dfe166"; // this line makes the graph to change color when it drops below 0
                        graph77.lineThickness = 3;
                        graph77.valueField = "value77";
                        //graph7.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value77]]</span></b>";
                        chart.addGraph(graph77);

                        graph78 = new AmCharts.AmGraph();
                        graph78.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph78.lineColor = "#ec96a4";
                        graph78.negativeLineColor = "#ec96a4"; // this line makes the graph to change color when it drops below 0
                        graph78.lineThickness = 3;
                        graph78.valueField = "value78";
                        //graph8.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value78]]</span></b>";
                        chart.addGraph(graph78);

                        graph79 = new AmCharts.AmGraph();
                        graph79.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph79.lineColor = "#5d535e";
                        graph79.negativeLineColor = "#5d535e"; // this line makes the graph to change color when it drops below 0
                        graph79.lineThickness = 3;
                        graph79.valueField = "value79";
                        //graph9.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value79]]</span></b>";
                        chart.addGraph(graph79);

                        graph80 = new AmCharts.AmGraph();
                        graph80.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph80.lineColor = "#4f6457";
                        graph80.negativeLineColor = "#4f6457"; // this line makes the graph to change color when it drops below 0
                        graph80.lineThickness = 3;
                        graph80.valueField = "value80";
                        //graph8.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value80]]</span></b>";
                        chart.addGraph(graph80);

                        graph81 = new AmCharts.AmGraph();
                        graph81.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph81.lineColor = "#acd0c0";
                        graph81.negativeLineColor = "#acd0c0"; // this line makes the graph to change color when it drops below 0
                        graph81.lineThickness = 3;
                        graph81.valueField = "value81";
                        //graph1.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value81]]</span></b>";
                        chart.addGraph(graph81);

                        graph82 = new AmCharts.AmGraph();
                        graph82.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph82.lineColor = "#f9dc24";
                        graph82.negativeLineColor = "#f9dc24"; // this line makes the graph to change color when it drops below 0
                        graph82.lineThickness = 3;
                        graph82.valueField = "value82";
                        //graph2.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value82]]</span></b>";
                        chart.addGraph(graph82);

                        graph83 = new AmCharts.AmGraph();
                        graph83.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph83.lineColor = "#4b7447";
                        graph83.negativeLineColor = "#4b7447"; // this line makes the graph to change color when it drops below 0
                        graph83.lineThickness = 3;
                        graph83.valueField = "value83";
                        //graph3.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value83]]</span></b>";
                        chart.addGraph(graph83);

                        graph84 = new AmCharts.AmGraph();
                        graph84.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph84.lineColor = "#8eba43";
                        graph84.negativeLineColor = "#8eba43"; // this line makes the graph to change color when it drops below 0
                        graph84.lineThickness = 3;
                        graph84.valueField = "value84";
                       // graph4.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value84]]</span></b>";
                        chart.addGraph(graph84);

                        graph85 = new AmCharts.AmGraph();
                        graph85.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph85.lineColor = "#363237";
                        graph85.negativeLineColor = "#363237"; // this line makes the graph to change color when it drops below 0
                        graph85.lineThickness = 3;
                        graph85.valueField = "value85";
                        //graph5.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value85]]</span></b>";
                        chart.addGraph(graph85);

                        graph86 = new AmCharts.AmGraph();
                        graph86.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph86.lineColor = "#2d4262";
                        graph86.negativeLineColor = "#2d4262"; // this line makes the graph to change color when it drops below 0
                        graph86.lineThickness = 3;
                        graph86.valueField = "value86";
                        //graph6.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value86]]</span></b>";
                        chart.addGraph(graph86);

                        graph87 = new AmCharts.AmGraph();
                        graph87.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph87.lineColor = "#73605b";
                        graph87.negativeLineColor = "#73605b"; // this line makes the graph to change color when it drops below 0
                        graph87.lineThickness = 3;
                        graph87.valueField = "value87";
                        //graph7.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value87]]</span></b>";
                        chart.addGraph(graph87);

                        graph88 = new AmCharts.AmGraph();
                        graph88.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph88.lineColor = "#d09683";
                        graph88.negativeLineColor = "#d09683"; // this line makes the graph to change color when it drops below 0
                        graph88.lineThickness = 3;
                        graph88.valueField = "value88";
                        //graph8.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value88]]</span></b>";
                        chart.addGraph(graph88);

                        graph89 = new AmCharts.AmGraph();
                        graph89.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph89.lineColor = "#f52549";
                        graph89.negativeLineColor = "#f52549"; // this line makes the graph to change color when it drops below 0
                        graph89.lineThickness = 3;
                        graph89.valueField = "value89";
                        //graph9.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value89]]</span></b>";
                        chart.addGraph(graph89);

                        graph90 = new AmCharts.AmGraph();
                        graph90.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph90.lineColor = "#fa6775";
                        graph90.negativeLineColor = "#fa6775"; // this line makes the graph to change color when it drops below 0
                        graph90.lineThickness = 3;
                        graph90.valueField = "value90";
                        //graph9.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value90]]</span></b>";
                        chart.addGraph(graph90);

                        graph91 = new AmCharts.AmGraph();
                        graph91.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph91.lineColor = "#ffd64d";
                        graph91.negativeLineColor = "#ffd64d"; // this line makes the graph to change color when it drops below 0
                        graph91.lineThickness = 3;
                        graph91.valueField = "value91";
                        //graph1.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value91]]</span></b>";
                        chart.addGraph(graph91);

                        graph92 = new AmCharts.AmGraph();
                        graph92.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph92.lineColor = "#9bc01c";
                        graph92.negativeLineColor = "#9bc01c"; // this line makes the graph to change color when it drops below 0
                        graph92.lineThickness = 3;
                        graph92.valueField = "value92";
                        //graph2.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value92]]</span></b>";
                        chart.addGraph(graph92);

                        graph93 = new AmCharts.AmGraph();
                        graph93.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph93.lineColor = "#2e2300";
                        graph93.negativeLineColor = "#2e2300"; // this line makes the graph to change color when it drops below 0
                        graph93.lineThickness = 3;
                        graph93.valueField = "value93";
                        //graph3.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value93]]</span></b>";
                        chart.addGraph(graph93);

                        graph94 = new AmCharts.AmGraph();
                        graph94.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph94.lineColor = "#6e6702";
                        graph94.negativeLineColor = "#6e6702"; // this line makes the graph to change color when it drops below 0
                        graph94.lineThickness = 3;
                        graph94.valueField = "value94";
                       // graph4.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value94]]</span></b>";
                        chart.addGraph(graph94);

                        graph95 = new AmCharts.AmGraph();
                        graph95.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph95.lineColor = "#c05805";
                        graph95.negativeLineColor = "#c05805"; // this line makes the graph to change color when it drops below 0
                        graph95.lineThickness = 3;
                        graph95.valueField = "value95";
                        //graph5.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value95]]</span></b>";
                        chart.addGraph(graph95);

                        graph96 = new AmCharts.AmGraph();
                        graph96.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph96.lineColor = "#db9501";
                        graph96.negativeLineColor = "#db9501"; // this line makes the graph to change color when it drops below 0
                        graph96.lineThickness = 3;
                        graph96.valueField = "value96";
                        //graph6.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value96]]</span></b>";
                        chart.addGraph(graph96);

                        graph97 = new AmCharts.AmGraph();
                        graph97.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph97.lineColor = "#50312f";
                        graph97.negativeLineColor = "#50312f"; // this line makes the graph to change color when it drops below 0
                        graph97.lineThickness = 3;
                        graph97.valueField = "value97";
                        //graph7.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value97]]</span></b>";
                        chart.addGraph(graph97);

                        graph98 = new AmCharts.AmGraph();
                        graph98.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph98.lineColor = "#cb0000";
                        graph98.negativeLineColor = "#cb0000"; // this line makes the graph to change color when it drops below 0
                        graph98.lineThickness = 3;
                        graph98.valueField = "value98";
                        //graph8.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value98]]</span></b>";
                        chart.addGraph(graph98);

                        graph99 = new AmCharts.AmGraph();
                        graph99.type = "smoothedLine"; // this line makes the graph smoothed line.
                        graph99.lineColor = "#e4ea8c";
                        graph99.negativeLineColor = "#e4ea8c"; // this line makes the graph to change color when it drops below 0
                        graph99.lineThickness = 3;
                        graph99.valueField = "value99";
                        //graph9.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value99]]</span></b>";
                        chart.addGraph(graph99);

                        
                        // CURSOR
                        var chartCursor = new AmCharts.ChartCursor();
                        chartCursor.cursorAlpha = 0;
                        chartCursor.cursorPosition = "mouse";
                        chartCursor.categoryBalloonDateFormat = "YYYY";
                        chart.addChartCursor(chartCursor);

                       

                        chart.creditsPosition = "bottom-right";
                        chart.write("chartdiv");

                       


                    });

                    // this method is called when chart is first inited as we listen for "dataUpdated" event
                    function zoomChart() {
                        // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
                        chart.zoomToDates(new Date(2016, 0), new Date(2026, 0));
                    }

                </script>

                <style>
                    .amcharts-chart-div a{
                        display: none!important;
                    }
                   
                </style>
        
        <!-- chart coding end here -->



    </head>
    <body>
        <header>
            <div class="top_header">
                <div class="container">
                    <div class="top_header_links">
                        <ul>
                            <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href=""><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a href=""><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="top_header_nav">
                        <ul>
                            <li><a href="#">HELP</a></li>
                            <li><a href="#">SIGN IN</a></li>
                            <li><select class="language">
                            <option value="English">English</option>
                            <option value="French">French</option>
                        </select></li>
                        </ul>
                        
                    </div>
                </div>
            </div>
            <div class="bottom_header">
                <div class="container">
                    <h1><a href=""><img src="images/Homepage-Design_23.png" alt=""></a></h1>
                    <ul>
                        <li>Parometer<span>></span></li>
                        <li>Results<span>></span></li>
                        <li>Details<span>></span></li>
                        <li>Subscribe</li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="section">
            <div class="container">
                <div class="tab_section_cover">
                    <div class="tab_section_left">
                        <label>1.)   Choose your goal</label>
                        <p><?php echo $goal; ?></p>
                        <label>2.)   What is your investment horizon?</label>
                        <p><?php echo $horizon; ?> Yrs</p>
                        <label>3.)   How much do you want to invest?</label>
                        <p><?php echo $invest; ?> EUR</p>
                        <label>4.)   What will be your annual top-ups?</label>
                        <p><?php echo $topup; ?> EUR</p>
                        <label>5.)   Choose your risk tolerance</label>
                        <p><?php echo $tolerance; ?></p>
                    </div>
                    <div class="tabs_section_right">
                        <input type="radio" name="nav" id="one" checked="checked"/>
                        <label for="one">Tab-1</label>

                        <input type="radio" name="nav" id="two"/>
                        <label for="two">Tab-2</label>

                        <input type="radio" name="nav" id="three"/>
                        <label for="three">Tab-3</label>

                        <input type="radio" name="nav" id="four"/>
                        <label for="four">Tab-4</label>

                        <article class="content one">
                            <h2>Proposed Allocation</h2>
                            <table>
                                  <tr>
                                    <th>Strategies</th>
                                    <th>%</th>
                                   
                                  </tr>
                                  <tr>
                                    <td>Cash</td>
                                    <td><?php echo $cash;?>%</td>
                                   
                                  </tr>
                                  <tr>
                                    <td>Patrimonial</td>
                                    <td><?php echo $patrimonial;?>%</td>
                                
                                  </tr>
                                 
                                  <tr>
                                    <td>Alternative</td>
                                    <td><?php echo $alternative;?>%</td>
                                  
                                  </tr>
                                  
                                
                                </table>
                        </article>

                        <article class="content two">
                           
                           <div id="chartdiv" style="width:100%; height:550px;"></div>
                           
                        </article>

                        <article class="content three">
                           <div id="chart1div" style="width:100%; height:400px;"></div>
                            
                        </article>

                        <article class="content four">
                          <div id="chart2div" style="width:100%; height:400px;"></div>
                     
                        </article>
                    </div>
                </div>
            </div>
        </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </body>   
</html>