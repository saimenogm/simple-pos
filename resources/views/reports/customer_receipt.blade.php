
<head><title>CSS Syntax</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-16" />

    <style>
        body{
            font-size:12px;
        }
        .header{
            font-weight:bolder;
            font-weight:900;
            color:black;
            font-size: 18px;
            width:260px; left:0; margin-left:10%; right:0; margin-right:auto;
        }

        #ts {
            margin:0px;
            padding:0px;
            margin-right:-10px;
        }
        #ts td { background:white; font-size:12px; text-align:center; } /* Background of all cells */
        #ts th { background:white; font-size:12px; } /* Background of all cells */
        #t1 .odd td { background:#ddd; } /* Alternating Row Background */
        #t1 td.c3 { background:darkgreen; color:white; } /* Column Background */
        #t1 .odd { background:#eee; }
        #t1 {cell-padding:0px; cellspacing:0px;}

        .collapsed { border-collapse:collapse; }

        .auto-layout { table-layout:auto; }
        .stretched { width:100%; }

        .main-container{
            width:550px;
        }
    </style>

    <div class="main-container">
        <div class="header"><u>ፋርማሲ ሓማሴን</u></div>
        <div style="float:right;">ዕለት: 01-02-2018 <br/></div><br/>
        <table id="ts">
            <tr>
                <th><u>መድሃኒት</u></th>
                <th><u>ብዝሒ</u></th>
                <th><u>ሰዓታት ኣወሳስዳ</u></th>
                <th><u>ዓቀን ኣወሳስዳ</u></th>
                <th><u>ኣገባብ ኣወሳስዳ</u></th>
                <th><u>እዋን</u></th>
            </tr>


            <tr>
                <td>Amoxapine</td>
                <td>2 bottle</td>
                <td>1 ንግሆ፡ 1 ቀትሪ፡ 1 ምሸት</td>
                <td>1 ከኒና  500mg</td>
                <td>ድሕሪ መግቢ</td>
                <td>1 ወርሒ</td>
            </tr>

            <tr>
                <td>Amoxapine</td>
                <td>2 strip</td>
                <td>ሰዓት 6 ቅ/ቐ፡ 2 ድ/ቐ: 8 ድ/ቐ</td>
                <td>1 ከኒና 500mg</td>
                <td>ድሕሪ ምሕጻብ</td>
                <td>1 ወርሒ</td>
            </tr>


            <tr>
                <td><u><b>ጠቅላላ</b></u></td>
                <td></td>
                <td></td>
                <td><u><b>40 ናቕፋ</b></u></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

        </table>


        <br/>

        <div>
            <div style="width:50%; float:left">
                <B><u>መጠንቀቕታ/ምክሪ</u></B> <br/>
                * ጸባ ከተውሕድ ኣሎካ <br/>
                * ኣልኮላዊ መስተ ክትሰቲ የብልካን<br/>
                * መድሃኒት ኣብ ዝሑል ቦታ ይተዓቀብ
            </div>

            <div style="width:40%; float: left;">
                <B><u>ሳዕቤናት</u></B> <br/>
                * ድካም <br/>
                * ሸውሃት ምዕጻው<br/><br/>

                * ካብዞም ኣብ ላዕሊ ዘለዉ ሳዕቤናት ምስ ትዕዘብ ምስ ሓኪም ተማከር ።
            </div>

        </div>
    </div>
    <div style="width:300px; margin-top:30px; padding-top:30px; display:block;">
        <br/><br/>
        <b>ብዘይ ምክሪ ናይ ሓኪም መድሃኒት ኣይንጠቀም !!! </b>&nbsp;&nbsp;&nbsp;&nbsp;
    </div>