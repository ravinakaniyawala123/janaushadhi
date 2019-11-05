<?php
include 'config.php';
if(isset($_REQUEST['id'])){
    $id=$_REQUEST['id'];
    $sql_customer = "select * from customer where id=".$id;
    $sql = "select m.name,m.discription,m.amount,i.quantity,m.discount,i.total from item i INNER JOIN medicine m  on(i.`medcine_id` = m.id) where i.customer_id=".$id;
    $query_customer = mysqli_query($conn, $sql_customer);
    $Row_customer = mysqli_fetch_array($query_customer);
    $query_item =  mysqli_query($conn, $sql);
    $query_total = mysqli_query($conn, "select SUM(total) as total from item where customer_id=".$id);
    $Row_total = mysqli_fetch_array($query_total);
    //print_r($Row_total);
}else{
    header("Location:add_medicine.php");
}
function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ' ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string." rupees only";
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bill</title>
    <style>
    html,body,{
        width: 5.5in; /* was 8.5in */
        height: 8.5in; /* was 5.5in */
        display: block;
    }
   html,body,table{
        font-family: "Courier New";
        font-size: 11px;
        font-style: normal;
        font-variant: normal;
        font-weight:900;
        letter-spacing: 1.5px;
        line-height: 14.4px;   
    }
@media print {
    html,body{
        font-family: "Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace;
        font-size: 10px;
        font-style: normal;
        font-variant: normal;
        font-weight:900;
        letter-spacing: 1.5px;
        line-height: 14.4px;  
    }
}
    .text_center{
        text-align: center;
    }
    .text_left{
        text-align: left;
    }
    .text_right{
        text-align: right;
    }
    .border_down{
        border-bottom: 1px dashed
    }
     .border_up{
        border-top: 1px dashed;
    }
    </style>
</head>

<body>
    <table>
        <tr width="100%">
            <td class="border_up border_down text_center" colspan="7">
                <table>
                    <tr>Janaushadhi</tr>
                </table>
            </td>
        </tr>
        <tr width="100%">
            <td class="" colspan="4">
                            Jan Aushadhi medical Store,<br/>
                            Surat-Navsari Road,
                            Bhestan Char Rasta, <br/>
                            Opp. Sardar Statue, Bhestan,Surat. <br/>
                            TIN NO: 
            </td>
            <td class="text_left "  colspan="3">
                Phone: <br/>
                LandLine No: <br/>
                Email ID: <br/>
                DL No: <br/>
            </td>
        </tr>
        <tr width="100%">
            <td class="border_down text_center border_up" colspan="7" >
                     Retail Invoice/Cash Memo
            </td>
        </tr>
        <tr width="100%">
            <td class="text_left border_down" colspan="4"><b>Bill No:<?php echo $Row_customer['invoice_no'];?> </b></td>
            <td class="text_right border_down" colspan="3"><b>Date:<?php echo $Row_customer['date'];?> </b></td>
        </tr>
        <tr width="100%">
            <td class="text_left border_down" colspan="4"><b>Patient Name : <?php echo $Row_customer['customerName']; ?></b></td>
            <td class="text_left border_down" colspan="3"><b>Doctor Name: <?php echo $Row_customer['doctor_name']; ?></td>
        </tr>
        <tr width="100%">
            <td class="text_left border_down" colspan="4"><b>Patient Address: <?php echo $Row_customer['customerAddress']; ?></b></td>
            <td class="text_left border_down" colspan="3"><b>Patient Mobile :<?php echo $Row_customer['mobile_number']; ?></b></td>
        </tr>
        <tr width="100%">
            <th width="5%" class="text_left border_down">S.No.</th>
            <th width="12%" class="text_left border_down">Product</th>
            <!-- <th width="40%" class="text_left border_down">Description</th> -->
            <th width="12%" class="text_right border_down">MRP</th>
            <th width="8%" class="text_right border_down">Discount(%)</th>

            <th width="12%" class="text_right border_down">Rate</th>
            <th width="5%" class="text_right border_down">Qty</th>
            <th width="10%" class="text_right border_down">Amount</th>
        </tr>
        <tr width="100%"> 
                    <?php 
                    $i=1;
                    while ($Row = mysqli_fetch_array($query_item)) {
                        echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$Row['name'].'</td>';
                        // echo '<td>'.$Row['discription'].'</td>';
                        echo '<td align="right">'.$Row['amount'].'</td>';
                        echo '<td align="right">'.$Row['discount'].'</td>';
                        echo '<td align="right">'.($Row['amount'] - ($Row['amount']*($Row['discount']/100))).'</td>';
                        echo '<td align="right">'.$Row['quantity'].'</td>';
                        echo '<td align="right">'.$Row['total'].'</td>';
                        echo '</tr>';
                        $i++;
                    }
                    ?>
        </tr>
        <tr class="heading">
            <td colspan="6" class="text_left border_up">Net Amount: </td>
            <!-- <td colspan="4"></td> -->
            <td  class="text_right border_up"><?php echo $Row_customer['total_amount']; ?></td>
        </tr>
        <tr class="heading">
            <td colspan="6" class="text_left border_up">Total: </td>
            <!-- <td colspan="4"></td> -->
            <td  class="text_right border_up"><?php echo round($Row_customer['total_amount']); ?></td>
        </tr>
        <tr class="heading">
            <td colspan="2" class="text_left border_up border_down">Amount in Words</td>
            <td colspan="5" class="text_left border_up border_down"><?php echo ucfirst(convert_number_to_words((int)$Row_customer['total_amount'])); ?></td>
        </tr>
    </table>
</body>
</html>