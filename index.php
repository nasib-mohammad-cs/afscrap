<?php
include_once 'simple_html_dom.php';
$context = stream_context_create(array(
        'http' => array(
            'header' => array('User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201'),
        ),
    ));
$url = "https://www.daraz.com.bd/products/hbq-i7s-tws-double-dual-mini-wireless-41-bluetooth-earphone-with-power-case-i164618426-s1097418780.html?&search=pdp_same_topselling?spm=a2a0e.pdp.recommend_2.1.39acef56kbQiWo&mp=1&scm=1007.16389.198132.0&clickTrackInfo=091414de-36ea-482f-b914-37e967b7c810__164618426__9708__trigger2i__170092__0.372__0.372__0.0__0.0__0.0__0.372__0__null__null__null__null__null__null____450.0__0.3355555555555556__4.90909__11__299.0__120237__null__null__null__3650.16544_3650.16536_955.3632__null__13426__null__0.0__0.0______";
$html = file_get_html($url,false,$context);
$html->save();

$scripts = $html->find('script');
function multiexplode ($delimiters,$string) {
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}
$data='';
foreach($scripts as $s) {
    if (strpos($s->innertext, 'var pdpTrackingData') !== false) 
    {
        $script_array = multiexplode(array('= "', '";'), $s->innertext);
        $data = $script_array[1];
        break;
    }
}

//$data = preg_replace('/"/', '', $data);

echo $data;

?>
<script>
var darazdata = '<?php echo $data ?>';
//var abc='{\"pdt_category\":[\"TV, Audio \/ Video, Gaming \u0026 Wearables\",\"Audio\",\"Headphones \u0026 Headsets\",\"Wireless Earbuds\"],\"pagetype\":\"pdp\",\"pdt_discount\":\"-35%\",\"pdt_photo\":\"https:\/\/static-01.daraz.com.bd\/p\/699260dd426edbe1266120daa7f8669f.jpg\",\"v_voya\":1,\"brand_name\":\"No Brand\",\"brand_id\":\"39704\",\"pdt_sku\":156768738,\"core\":{\"country\":\"BD\",\"layoutType\":\"desktop\",\"language\":\"en\",\"currencyCode\":\"BDT\"},\"seller_name\":\"Abrar World\",\"pdt_simplesku\":1086564852,\"pdt_name\":\"HBQ I7S Double Dual Mini Earphone With Power Case\",\"page\":{\"regCategoryId\":\"030101070000\",\"xParams\":\"_p_typ=pdp\u0026_p_ispdp=1\u0026_p_item=156768738_BD-1086564852\u0026_p_prod=156768738\u0026_p_sku=1086564852\u0026_p_slr=700507722043\"},\"supplier_id\":700507722043,\"pdt_price\":\"\u09F3 450\"}';
 
console.log(darazdata);
var pdpTrackingData = JSON.parse(darazdata);

console.log(pdpTrackingData);
</script>
