<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;

use App\Item as Item;
use App\ItemCategory as ItemCategory;
use Illuminate\Support\Facades\DB;


class test1 extends Controller
{
    public function __construct(Item $item )
    {
        $this->item = $item;
		
    }


    public function index($item_id)
    {
        
//        $item = $this->item->find($item_id);
//
//        if($item->variants==""){
//
//            $data_barcode = DB::table('items')
//            ->where('items.id','=',$item_id )
//            ->first();
//
//        }
    

        //dd($data_barcode->barcode);


        $barcode = new BarcodeGenerator();
        $barcode->setText($item_id);
        $barcode->setType(BarcodeGenerator::Code128);
        //$barcode->setLabel($data_barcode->item_name."\nKingdom SuperMarket");
        $barcode->setLabel("");
        $barcode->setScale(1);
        //$barcode->setSize(16);
        $barcode->setThickness(18);
        $barcode->setFontSize(10);
        $code = $barcode->generate();

        echo '<table>';

        echo '<tr>';

        echo '<td>';
        echo '<img src="data:image/png;base64,'.$code.'" />';
//        echo '<br/><div style="font-size:11px; text-align:center; width:100%; margin-left:auto; position:relative; margin-top:0px; margin-bottom:-20px; align:center;">'.$data_barcode->item_name.'</div><br/>'.'<span style="font-size:11px;">Kingdom SuperMarket</span>';
        echo '<br/><span style="font-size:11px;">Kingdom SuperMarket</span>';
        echo '<br/></td>';
        echo '<td></td>';
        echo '<td>';
        echo '<img src="data:image/png;base64,'.$code.'" />';
//        echo '<br/><div style="font-size:11px; text-align:center; width:100%; margin-left:auto; position:relative; margin-top:0px; margin-bottom:-20px; align:center;">'.$data_barcode->item_name.'</div><br/>'.'<span style="font-size:11px;">Kingdom SuperMarket</span>';
        echo '<br/><span style="font-size:11px;">Kingdom SuperMarket</span>';
        echo '</td>';

        echo '</tr>';

        // second row
        echo '<tr>';
        echo '<td>';
        echo '<img src="data:image/png;base64,'.$code.'" />';
//        echo '<br/><div style="font-size:11px; text-align:center; width:100%; margin-left:auto; position:relative; margin-top:0px; margin-bottom:-20px; align:center;">'.$data_barcode->item_name.'</div><br/>'.'<span style="font-size:11px;">Kingdom SuperMarket</span>';
        echo '<br/><span style="font-size:11px;">Kingdom SuperMarket</span>';
        echo '</td>';

        echo '<td></td>';

        echo '<td>';
        echo '<img src="data:image/png;base64,'.$code.'" />';
  //      echo '<br/><div style="font-size:11px; text-align:center; width:100%; margin-left:auto; position:relative; margin-top:0px; margin-bottom:-20px; align:center;">'.$data_barcode->item_name.'</div><br/>'.'<span style="font-size:11px;">Kingdom SuperMarket</span>';
        echo '<br/><span style="font-size:11px;">Kingdom SuperMarket</span>';
        echo '</td>';

        echo '</tr>';


}

    public function index_x($item_id)
    {

        $item = $this->item->find($item_id);

        if($item->variants==""){

            $data_barcode = DB::table('items')
                ->where('items.id','=',$item_id )
                ->first();

        }


        //dd($data_barcode->barcode);


        $barcode = new BarcodeGenerator();
        $barcode->setText($data_barcode->barcode_main);
        $barcode->setType(BarcodeGenerator::Code128);
        //$barcode->setLabel($data_barcode->item_name."\nKingdom SuperMarket");
        $barcode->setLabel("");
        $barcode->setScale(1);
        //$barcode->setSize(16);
        $barcode->setThickness(18);
        $barcode->setFontSize(10);
        $code = $barcode->generate();

        echo '<table>';

        echo '<tr>';

        echo '<td>';
        echo '<img src="data:image/png;base64,'.$code.'" />';
        echo '<br/><div style="font-size:11px; text-align:center; width:100%; margin-left:auto; position:relative; margin-top:0px; margin-bottom:-20px; align:center;">'.$data_barcode->item_name.'</div><br/>'.'<span style="font-size:11px;">Kingdom SuperMarket</span>';
        echo '<br/></td>';
        echo '<td></td>';
        echo '<td>';
        echo '<img src="data:image/png;base64,'.$code.'" />';
        echo '<br/><div style="font-size:11px; text-align:center; width:100%; margin-left:auto; position:relative; margin-top:0px; margin-bottom:-20px; align:center;">'.$data_barcode->item_name.'</div><br/>'.'<span style="font-size:11px;">Kingdom SuperMarket</span>';
        echo '</td>';

        echo '</tr>';

        // second row
        echo '<tr>';
        echo '<td>';
        echo '<img src="data:image/png;base64,'.$code.'" />';
        echo '<br/><div style="font-size:11px; text-align:center; width:100%; margin-left:auto; position:relative; margin-top:0px; margin-bottom:-20px; align:center;">'.$data_barcode->item_name.'</div><br/>'.'<span style="font-size:11px;">Kingdom SuperMarket</span>';
        echo '</td>';

        echo '<td></td>';

        echo '<td>';
        echo '<img src="data:image/png;base64,'.$code.'" />';
        echo '<br/><div style="font-size:11px; text-align:center; width:100%; margin-left:auto; position:relative; margin-top:0px; margin-bottom:-20px; align:center;">'.$data_barcode->item_name.'</div><br/>'.'<span style="font-size:11px;">Kingdom SuperMarket</span>';
        echo '</td>';

        echo '</tr>';


    }

    public function index_variant($item_id)
{
    
        $data_barcode = DB::table('items')
        ->join('item_variants','items.id','=','item_variants.item')
        ->where('item_variants.id','=',$item_id )
        ->first();


    $barcode = new BarcodeGenerator();
    $barcode->setText($data_barcode->barcode);
    $barcode->setType(BarcodeGenerator::Code128);
    //$barcode->setLabel($data_barcode->item_name."\nKingdom SuperMarket");
    $barcode->setLabel("");
    $barcode->setScale(1);
    //$barcode->setSize(16);
    $barcode->setThickness(18);
    $barcode->setFontSize(10);
    $code = $barcode->generate();

    echo '<table>';

    echo '<tr>';

    echo '<td>';
    echo '<img src="data:image/png;base64,'.$code.'" />';
    echo '<br/><div style="font-size:11px; text-align:center; width:100%; margin-left:auto; position:relative; margin-top:0px; margin-bottom:-20px; align:center;">'.$data_barcode->item_name.'</div><br/>'.'<span style="font-size:11px;">Kingdom SuperMarket</span>';
    echo '<br/></td>';
    echo '<td></td>';
    echo '<td>';
    echo '<img src="data:image/png;base64,'.$code.'" />';
    echo '<br/><div style="font-size:11px; text-align:center; width:100%; margin-left:auto; position:relative; margin-top:0px; margin-bottom:-20px; align:center;">'.$data_barcode->item_name.'</div><br/>'.'<span style="font-size:11px;">Kingdom SuperMarket</span>';
    echo '</td>';

    echo '</tr>';

    // second row
    echo '<tr>';
    echo '<td>';
    echo '<img src="data:image/png;base64,'.$code.'" />';
    echo '<br/><div style="font-size:11px; text-align:center; width:100%; margin-left:auto; position:relative; margin-top:0px; margin-bottom:-20px; align:center;">'.$data_barcode->item_name.'</div><br/>'.'<span style="font-size:11px;">Kingdom SuperMarket</span>';
    echo '</td>';

    echo '<td></td>';

    echo '<td>';
    echo '<img src="data:image/png;base64,'.$code.'" />';
    echo '<br/><div style="font-size:11px; text-align:center; width:100%; margin-left:auto; position:relative; margin-top:0px; margin-bottom:-20px; align:center;">'.$data_barcode->item_name.'</div><br/>'.'<span style="font-size:11px;">Kingdom SuperMarket</span>';
    echo '</td>';

    echo '</tr>';

}

}
