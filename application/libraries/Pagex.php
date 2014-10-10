<?php


class Pagex{


	public function paging($X,$B,$A,$link)
	{
            $C=ceil($A/$B);
            $abc='<div align="center" class="paginations">';

            if($C > 1)
            {
		$F=1;
		$D=$X/$B + 1;
		//$abc.="<li><span>$D/$C</span></li>";
		//if($D != 1)
		//{
			$abc.="<span><a href='$link?start=0'>Đầu trang</a></span>";
			//$Y=$X - $B;
			//$abc.= "<li><a href='$link?start=$Y'><<</a></li>";
			if($D > 3)
                        {
                            $F=$D-2;
                            //$abc.= "<li><span>...</span></li>";
			}
		//}
		$G=$D;
		if($G < ($C-2))
		{
                    if($G==1)
                        $G=$D+4;
                    else if($G==2)
                        $G=$D+3;
                    else
                        $G=$D+2;
                }else{
                    if($G>5){
                        if($G==($C-1))
                            $F=$D-3;
                        else if($G==$C)
                            $F=$D-4;
                    }
                    $G=$C;
		}
		for($I=$F;$I<=$G;$I++)
		{
                    if($I==$D)
                    {
                        $abc.= "<span><a class='active'>$I</a></span>";
                    }else{
			$Y=($I - 1)*$B;
			$abc.= "<span><a href='$link?start=$Y'>$I</a></span>";
                    }
		}
		//if($D != $C)
		//{
                    //if($D < ($C-2))
                    //{
                        //$abc.= "<li><span>...</span></li>";;
                    //}
                    //$Y=$X + $B;
                    //$abc.= "<li><a href='$link?start=$Y'>>></a></li>";			
                    $L=($C - 1)*$B;	
                    $abc.= "<span><a href='$link?start=$L'>Trang cuối</a></span>";
		//}
            }
            $abc.='</div>';
            return $abc;
	}	
}