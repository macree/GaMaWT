<?php
session_start();
header('Access-Control-Allow-Origin: *');
$array = unserialize($_POST['Salut']);
$inc = 0;
$valoarePara = 0;
$valoareImpara = 0;
$nume1 = '';
$nume2 = '';
$contor = 0;
$contor2=0;
if ($_SESSION['contorGlobal']==0)
{
	foreach ($array as $k => $v1)
	{
		foreach ($v1 as $k1 => $v2)
		{
			if ($k % 2 == 0)
			{
				$valoarePara = $v2;
				$nume1 = $k1;
				$contor++;
			}
			if ($k % 2 == 1)
			{
				$valoareImpara = $v2;
				$nume2 = $k1;
				$contor++;
			}
			if ($contor%2==0 && $contor!=0)
			{
				if ($valoarePara >= $valoareImpara)
				{
					$_SESSION['tablou'][$inc++] = $valoarePara;//0
					$_SESSION['tablou'][$inc++] = $nume1;      //1
				} else if ($valoarePara < $valoareImpara)
				{
					$_SESSION['tablou'][$inc++] = $valoareImpara;//2
					$_SESSION['tablou'][$inc++] = $nume2;        //3
				}
			}
		}
	}
	echo "<ul class='round'>";
	echo "<li class='spacer'>&nbsp;</li>";
	for ($int = 0; $int < $inc - 3; $int += 4)
	{
		echo <<<TAG
            <li class="game game-top">{$_SESSION['tablou'][$int + 1]} <span>{$_SESSION['tablou'][$int]}</span></li>
            <li class="game game-spacer">&nbsp;</li>
            <li class="game game-bottom">{$_SESSION['tablou'][$int + 3]} <span>{$_SESSION['tablou'][$int + 2]}</span></li>
            <li class="spacer">&nbsp;</li>
TAG;
	}
echo "</ul>";
}
if ($_SESSION['contorGlobal'] == 1)
	{


	for ($int = 0; $int < (count($_SESSION['tablou'])-3); $int += 4)
	{

		if ($_SESSION['tablou'][$int] > $_SESSION['tablou'][$int+2])
		{
			$_SESSION['tablou'][$contor2++] = $_SESSION['tablou'][$int];
			$_SESSION['tablou'][$contor2++] = $_SESSION['tablou'][$int+1];
		} else if($_SESSION['tablou'][$int] <= $_SESSION['tablou'][$int+2]){
			$_SESSION['tablou'][$contor2++] = $_SESSION['tablou'][$int+2];
			$_SESSION['tablou'][$contor2++] = $_SESSION['tablou'][$int+3];
		}
	}
	echo "<ul class='round'>";
	echo "<li class='spacer'>&nbsp;</li>";
	for ($int = 0; $int < $contor2 - 3; $int += 4)
	{
		echo <<<TAG
            <li class="game game-top">{$_SESSION['tablou'][$int + 1]} <span>{$_SESSION['tablou'][$int]}</span></li>
            <li class="game game-spacer">&nbsp;</li>
            <li class="game game-bottom">{$_SESSION['tablou'][$int + 3]} <span>{$_SESSION['tablou'][$int + 2]}</span></li>
            <li class="spacer">&nbsp;</li>
TAG;
	}
echo "</ul>";
}
if ($_SESSION['contorGlobal'] == 2)
{
	for ($int = 0; $int < (count($_SESSION['tablou'])-3); $int += 4)
	{

		if ($_SESSION['tablou'][$int] > $_SESSION['tablou'][$int+2])
		{
			$_SESSION['tablou'][$contor2++] = $_SESSION['tablou'][$int];
			$_SESSION['tablou'][$contor2++] = $_SESSION['tablou'][$int+1];
		} else if($_SESSION['tablou'][$int] <= $_SESSION['tablou'][$int+2]){
			$_SESSION['tablou'][$contor2++] = $_SESSION['tablou'][$int+2];
			$_SESSION['tablou'][$contor2++] = $_SESSION['tablou'][$int+3];
		}
	}
	echo "<ul class='round'>";
	for ($int = 0; $int < $contor2 - 3; $int += 4)
	{
		echo <<<TAG
            <li class="game game-top winner">{$_SESSION['tablou'][$int + 1]} <span>{$_SESSION['tablou'][$int]}</span></li>
TAG;
		$_SESSION['castigator']=$_SESSION['tablou'][$int + 1];
	}
	
	echo "</ul>";
}

$_SESSION['contorGlobal']++;

