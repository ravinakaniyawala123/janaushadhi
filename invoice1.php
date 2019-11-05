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
  /*  body{
        height: 3508px;
    }*/
     @font-face {font-family:"1979 Dot Matrix Regular";src:url("font/1979_dot_matrix.eot?") format("eot"),url("font/1979_dot_matrix.woff") format("woff"),url("font/1979_dot_matrix.ttf") format("truetype"),url("font/1979_dot_matrix.svg#1979-Dot-Matrix") format("svg");font-weight:normal;font-style:normal;}
    html {font-family:"1979 Dot Matrix Regular"}

    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:15px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;
        /*font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;*/
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td,.invoice-box table th{
        padding:5px;
        vertical-align:top;
    }
    
    table.center tr td,table.center tr th{
        text-align:center;
    }

    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }
    
    .invoice-box table tr.heading td, .invoice-box table tr.heading th{
        background:#2e3e4e;
        color: #eef7f1;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="5">
                    <table>
                        <tr width="100%">
                            <img style="width:100%;">
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table style="padding-bottom: 80px;">
                        <tr>
                            <td>
                                Name : <b><?php echo $Row_customer['customerName']; ?></b><br>
                                Address: <b><?php echo $Row_customer['customerAddress']; ?></b><br>
                                Contact Number: <b><?php echo $Row_customer['mobile_number']; ?></b><br>
                                Doctor Name: <b><?php echo $Row_customer['doctor_name']; ?></b><br>
                            </td>
                            <td style="padding-right: 0;float: right;">
                                Invoice No:<b> <?php echo $Row_customer['invoice_no']; ?>   </b><br>
                                Date:<b> <?php echo $Row_customer['date']; ?>   </b><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <table class="center">
                    <tr class="heading">
                        <th width="10%">Sr No.</th>
                        <th width="20%">Product</th>
                        <th width="40%">Description</th>
                        <th width="10%">Price</th>
                        <th width="6%">Discount(%)</th>
                        <th width="4%">Quantity</th>
                        <th width="10%">Total</th>
                    </tr>
                    
                        <?php 
                        $i=1;
                        while ($Row = mysqli_fetch_array($query_item)) {
                            echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$Row['name'].'</td>';
                            echo '<td>'.$Row['discription'].'</td>';
                            echo '<td>'.$Row['amount'].'</td>';
                            echo '<td>'.$Row['discount'].'</td>';
                            echo '<td>'.$Row['quantity'].'</td>';
                            echo '<td>'.$Row['total'].'</td>';
                            echo '</tr>';
                            $i++;
                        }
                        ?>
                   
                    <tr class="heading">
                        <td colspan="6">Total</td>
                        <!-- <td colspan="4"></td> -->
                        <td><?php echo $Row_total['total']; ?></td>
                    </tr>
                     <tr class="heading">
                        <td colspan="2">Amount in Words</td>
                        <td colspan="5"><?php echo ucfirst(convert_number_to_words((int)$Row_total['total'])); ?></td>
                    </tr>
                </table>
            </tr>

            <tr class="footer">
                <td colspan="5">
                    <table>
                        <tr width="100%">
                            <img src="" style="width:100%;padding-top: 140px;">
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>