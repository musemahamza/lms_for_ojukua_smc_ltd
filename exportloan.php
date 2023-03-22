<?php include 'db_connect.php' ?>
<?php
$qry = $conn->query("SELECT  * from loan_list order by id asc");
$header = 'id'."\t".'ref_no'."\t"."loan_type_id"."\t"."borrower_id"."\t"."purpose"."\t"."amount"."\t"."plan_id"."\t"."status"."\t". "date_released"."\t"."date_created"."\t";
$result ='';
 
$fields = mysqli_num_fields ( $qry );
 
for ( $i = 0; $i < $fields; $i++ )
{
//    $header .= mysqli_field_name( $exportData , $i ) . "\t";
}
while($row = $qry->fetch_assoc())
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $result .= trim( $line ) . "\n";
}
$result = str_replace( "\r" , "" , $result );
 
if ( $result == "" )
{
    $result = "\nNo Record(s) Found!\n";                        
}
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$result";
 
?>