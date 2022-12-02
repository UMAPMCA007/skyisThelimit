<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogicController extends Controller
{
    public function form1(Request $request)
    {
        $request->validate([
            'limit1' => 'required|numeric',
            'limit2' => 'required|numeric',
            
        ]);
        $range1=$request->limit1;
        $range2=$request->limit2;
        $arr = array();
        for($i=$range1;$i<=$range2;$i++)
        {
            $rev = strrev($i);
            if($i == $rev)
            {
                $arr[] = $i;
            }
        }
        return response()->json(['result'=>$arr]);
    }

    public function form2(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            
            
        ]);
        $text=$request->text;
        $revtext=strrev($text);
        
        return response()->json(['result'=>$revtext]);
    }

    function form3(Request $request)
    {
        $request->validate([
            'num1' => 'required|numeric',
            'num2' => 'required|numeric',
            'num3' => 'required|numeric',
    
        ]);

        $num1=$request->num1;
        $num2=$request->num2;
        $num3=$request->num3;
        $arr = array();
       
        $arr[]=$num1.$num2.$num3;
        $arr[]=$num1.$num3.$num2;
        $arr[]=$num2.$num1.$num3;
            
      
        return response()->json(['result'=>$arr]);
    }
}
