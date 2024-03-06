<?php

// APIs from AGORA Shops

$stockApi = "https://tapi.telstra.com/presentation/v1/ecommerce-products/con/stocks";
$agoraStockApi = "https://tapi.telstra.com/presentation/v1/ecommerce-products/con/stocks?sku=";

$conMobileCat = "https://tapi.telstra.com/presentation/v1/ecommerce-products/products/mobility/CON/POSTPAID_MOBILE/NEW";
$conTabletCat = 'https://tapi.telstra.com/presentation/v1/ecommerce-products/products/mobility/CON/POSTPAID_TABLET/NEW';
$conMbbCat = 'https://tapi.telstra.com/presentation/v1/ecommerce-products/products/mobility/CON/POSTPAID_MBB/NEW';
$gamXboxCat = 'https://tapi.telstra.com/presentation/v1/ecommerce-products/products/mobility/GAMING/POSTPAID_XBOX/NEW';
$stdMobileCat = 'https://tapi.telstra.com/presentation/v1/ecommerce-products/products/mobility/STUDENT/POSTPAID_MOBILE/NEW';
$smbMobileCat = 'https://tapi.telstra.com/presentation/v1/ecommerce-products/products/mobility/SMB/POSTPAID_MOBILE/NEW';
$smbTabletCat = 'https://tapi.telstra.com/presentation/v1/ecommerce-products/products/mobility/SMB/POSTPAID_TABLET/NEW';
$smbMbbCat = 'https://tapi.telstra.com/presentation/v1/ecommerce-products/products/mobility/SMB/POSTPAID_MBB/NEW';
$prepMobileCat = 'https://tapi.telstra.com/presentation/v1/ecommerce-products/products/mobility/PREPAID/PREPAID_MOBILE/NEW';
$prepMbbCat = 'https://tapi.telstra.com/presentation/v1/ecommerce-products/products/mobility/PREPAID/PREPAID_MBB/NEW';
$boostCat = 'https://tapi.telstra.com/presentation/v1/ecommerce-products/products/mobility/BOOST/BOOST/NEW';
$ly_conCat = 'https://tapi.telstra.com/presentation/v1/ecommerce-products/products/loyalty_con';
$ly_con_dvCat = 'https://tapi.telstra.com/presentation/v1/ecommerce-products/products/loyalty_con_dv';
$ly_smbCat = 'https://tapi.telstra.com/presentation/v1/ecommerce-products/products/loyalty_smb';
$acc_conCat = 'https://tapi.telstra.com/presentation/v1/ecommerce-products/products/accessories_con';
$acc_con_dvCat = 'https://tapi.telstra.com/presentation/v1/ecommerce-products/products/accessories_con_dv';
// All APIs packed
$catalogues = array($stockApi, $conMobileCat, $conTabletCat, 
                    $conMbbCat, $gamXboxCat, $stdMobileCat, 
                    $smbMobileCat, $smbTabletCat, $smbMbbCat,
                    $prepMobileCat, $prepMbbCat, $boostCat, 
                    $ly_conCat, $ly_con_dvCat, $ly_smbCat, 
                    $acc_conCat, $acc_con_dvCat);


// Links below are APIs to find a product's info addgin the RIMID at the end
$agoraConsumerMobile = "https://tapi.telstra.com/presentation/v1/ecommerce-products/product/mobility/CON/TELSTRA/2020-tso-mobile-s/";
$agoraConsumerTablet = "https://tapi.telstra.com/presentation/v1/ecommerce-products/product/mobility/CON/TELSTRA/tso-tablet-m/";
$agoraConsumerMbb = "https://tapi.telstra.com/presentation/v1/ecommerce-products/product/mobility/CON/TELSTRA/tso-mbb-s/";
$agoraGaming = "https://tapi.telstra.com/presentation/v1/ecommerce-products/product/mobility/GAMING/TELSTRA/2020-tso-xbox-x-all-24m/";
$agoraStudent = "https://tapi.telstra.com/presentation/v1/ecommerce-products/product/mobility/STUDENT/TELSTRA/2020-tso-mobile-s/";
$agoraSmallBusinessMobile = "https://tapi.telstra.com/presentation/v1/ecommerce-products/product/mobility/SMB/TELSTRA/2020-s-hs-plan/";
$agoraSmallBusinessTablet = "https://tapi.telstra.com/presentation/v1/ecommerce-products/product/mobility/SMB/TELSTRA/m-tab-plan/";
$agoraSmallBusinessMbb = "https://tapi.telstra.com/presentation/v1/ecommerce-products/product/mobility/SMB/TELSTRA/m-tab-plan/";
$agoraPrepaid = "https://tapi.telstra.com/presentation/v1/ecommerce-products/product/mobility/PREPAID/TELSTRA/ppd-s/";
$agoraBoost = "https://tapi.telstra.com/presentation/v1/ecommerce-products/product/mobility/BOOST/TELSTRA/boost-s/";
$agoraLoyaltyConsumer = "https://tapi.telstra.com/presentation/v1/ecommerce-products/products/loyalty_con/";
$agoraLoyaltyDavinci = "https://tapi.telstra.com/presentation/v1/ecommerce-products/products/loyalty_con_dv/";
$agoraLoyaltySmallBusiness = "https://tapi.telstra.com/presentation/v1/ecommerce-products/products/loyalty_smb/"; 
$agoraAccessoriesConsumer = "https://tapi.telstra.com/presentation/v1/ecommerce-products/products/accessories_con/";
$agoraAccessoriesDavinci = "https://tapi.telstra.com/presentation/v1/ecommerce-products/products/accessories_con_dv/";

// API for SalesForce only
$salesForceStockApi = "https://tapi.telstra.com/v1/logistics/ext/stock-check";

// It finds if the request returns Json with the Key "data" with content 
function findIfThereIsData($query){
    if (null !== ($json = getJsonData($query))){
        if (!empty($json['data'])){
            return array($json,'Green');
        }else {
            return array(null,'No Found');
        }
    }else{
        return array(null,'404 Error');
    }
}

// It makes a get request and decode de content into Json format
function getJsonData($link){
    $response = file_get_contents($link);
    if ($response === false){
        return null;
    }else{
        $jsonData = json_decode($response,true);
    }return $jsonData;
} 

// It look at 3 key values and decides availavility
function getStatus($pre,$back,$out){
    if ($pre === true){
        return 'Pre-Order';
    } elseif ($back === true){
        return 'Back-Order';
    }elseif ($out === true){
        return 'Out Stock';
    }else {
        return 'In Stock';
    }
}

// It finds where a device is built (segments)
function findDeviceCategory($mobile,$tablet,$mbb){
    if($mobile === 'Green'){
        return 'Mobiles';
    }elseif($tablet === 'Green'){
        return 'Tablets';
    }elseif($mbb === 'Green'){
        return 'Mobile Broadband';
    }else{
        return 'Not Found';
    }
}

// It will obtain two arrays, Points and Pay of a product's tiers (Only for Loyalty segments)
function getPointsAndPay($numOfTiers,$jsonLySegment){
    $points = array();
    $pay = array();
    for($i=0; $i<=($numOfTiers-1); $i++){
        $points[] = $jsonLySegment['data']['currentPrice']['priceOptions'][$i]['upfrontPrice'];
        $pay[] = $jsonLySegment['data']['currentPrice']['priceOptions'][$i]['ongoingPrice'];
        //var_dump($points);
        //var_dump($pay);
    }
    return array($points,$pay);    
}

// This function will extract all data from the loyalty segments (con, smb, dv)
function getLoyaltyProductData($jsonLy){
    if (null !== $jsonLy){
        $name = $jsonLy['data']['name'];
        $status = getStatus($jsonLy['data']['preOrder'],$jsonLy['data']['backOrder'],$jsonLy['data']['outOfStock']);
        $numOfTiers = count($jsonLy['data']['currentPrice']['priceOptions']);
        $tiers = getPointsAndPay($numOfTiers,$jsonLy);

        // This condition finds if there are Repayment options available 
        if (null !== $jsonLy['data']['repaymentOptions']){
            if (in_array(12,$jsonLy['data']['repaymentOptions'])){
                $mro12 = true;
            }else {
                $mro12 = false;
            }
            if (in_array(24,$jsonLy['data']['repaymentOptions'])){
                $mro24 = true;
            }else{
                $mro24 = false;
            }  
        }
    }else{
        $name = '';
        $status = '';
        $numOfTiers = null;
        $tiers = null;
        $mro12 = null;
        $mro24 = null;

    }return array($name,$status,$numOfTiers,$tiers,$mro12,$mro24);
}

// It gets all price options only on Accessories segments (con, dv)
function getPriceOptionsAcc($numOfPrices,$jsonAccSegment){
    $payOptions = array();
    $prices = array();
    for($i=0; $i<=($numOfPrices-1); $i++){
        if ($jsonAccSegment['data']['currentPrice']['priceOptions'][$i]['upfrontPrice'] == null){
            $payOptions[] = $jsonAccSegment['data']['currentPrice']['priceOptions'][$i]['ongoingDuration'];
            $prices[] = $jsonAccSegment['data']['currentPrice']['priceOptions'][$i]['ongoingPrice'];
        }else{
            $payOptions[] = $jsonAccSegment['data']['currentPrice']['priceOptions'][$i]['ongoingDuration'];
            $prices[] = $jsonAccSegment['data']['currentPrice']['priceOptions'][$i]['upfrontPrice'];
        }
    }
    return array($payOptions,$prices);
}

// This function will extract all data from the Accessories segments (con, dv)
function getAccessoriesProductData($jsonAcc){
    if (null !== $jsonAcc){
        $name = $jsonAcc['data']['name'];
        $status = getStatus($jsonAcc['data']['preOrder'],$jsonAcc['data']['backOrder'],$jsonAcc['data']['outOfStock']);
        $numOfPriceOptions = count($jsonAcc['data']['currentPrice']['priceOptions']);
        $paymentAndPriceOpt = getPriceOptionsAcc($numOfPriceOptions,$jsonAcc);
    }else{
        $name = '';
        $status = '';
        $numOfPriceOptions = null;
        $paymentAndPriceOpt = null;
    }
    return array($name,$status,$numOfPriceOptions,$paymentAndPriceOpt);
}

// This function will extract all data from the Mobility segments (consumer, student, small-business)
function getMobilityPriductData($jsonMobility){
    if (null !== $jsonMobility){
        //var_dump($json['data']);
        $name = $jsonMobility['data']['offer']['optionalProductGroups'][0]['productSelections'][0]['product']['fulfilmentName'];
        //var_dump($name);
        $status = getStatus($jsonMobility['data']['offer']['optionalProductGroups'][0]['productSelections'][0]['product']['preorder'],
                            $jsonMobility['data']['offer']['optionalProductGroups'][0]['productSelections'][0]['product']['backorder'],
                            $jsonMobility['data']['offer']['optionalProductGroups'][0]['productSelections'][0]['product']['outOfStock']);
        $mro12 = $jsonMobility['data']['offer']['optionalProductGroups'][0]['productSelections'][0]['mro']['12'];
        $mro24 = $jsonMobility['data']['offer']['optionalProductGroups'][0]['productSelections'][0]['mro']['24'];
    }else {
        $name = '---';
        $status = '---';
        $mro12 = '---';
        $mro24 = '---';
    }
    return array($name,$status,$mro12,$mro24);
}

// This function will extract all data from the Prepaid and Boost segments
function getPreAndBoostProductData($jsonPreOrBoost){
    if (null !== $jsonPreOrBoost){
        //var_dump($json['data']);
        $name = $jsonPreOrBoost['data']['offer']['optionalProductGroups'][0]['productSelections'][0]['product']['fulfilmentName'];
        //var_dump($name);
        $status = getStatus($jsonPreOrBoost['data']['offer']['optionalProductGroups'][0]['productSelections'][0]['product']['preorder'],$jsonPreOrBoost['data']['offer']['optionalProductGroups'][0]['productSelections'][0]['product']['backorder'],$jsonPreOrBoost['data']['offer']['optionalProductGroups'][0]['productSelections'][0]['product']['outOfStock']);
        $mro0 = $jsonPreOrBoost['data']['offer']['optionalProductGroups'][0]['productSelections'][0]['mro']['0'];
    }else {
        $name = '---';
        $status = '---';
        $mro0 = '---';
    }
    return array($name,$status,$mro0);
}

function get_salesForce_status(){

    $curl = curl_init();
    $data = '{"correlationId":"7517899e-5419-4807-aed1-683ade485556","data":{"isExplore":true,"isPreorder":false,"warehouseCode":"MSC","lineOfBusiness":"035","products":[{"productType":"RIMS","productId":"100245413"}]}}';
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://tapi.telstra.com/v1/logistics/ext/stock-check',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '{"correlationId":"7517899e-5419-4807-aed1-683ade485556","data":{"isExplore":true,"isPreorder":false,"warehouseCode":"MSC","lineOfBusiness":"035","products":[{"productType":"RIMS","productId":"100246882"}]}}',
      CURLOPT_HTTPHEADER => array(
        'ConsumerId: 0KhnFrg3bhvNW38ofwPGVMHoR2luZUlG',
        'Content-Type: text/plain'
      ),
    ));
    
    $response = curl_exec($curl);
    var_dump($response);
    //var_dump($rim_Id);
    //var_dump('{"correlationId":"7517899e-5419-4807-aed1-683ade485556","data":{"isExplore":true,"isPreorder":false,"warehouseCode":"MSC","lineOfBusiness":"035","products":[{"productType":"RIMS","productId":"'.$rim_Id.'"}]}}');
    var_dump($data);
    curl_close($curl);
    
}

function get_salesForce_status1(){

    $url = 'https://tapi.telstra.com/v1/logistics/ext/stock-check';
    // Collection object
    $data = [
      'correlationId' => '7517899e-5419-4807-aed1-683ade485556',
      'data' => ['isExplore' => TRUE,
                 'isPreorder' => FALSE,
                 'warehouseCode' => 'MSC',
                 'lineOfBusiness' => '035',
                 'products' => [['productType' => 'RIMS',
                 'productId' => '100247440'
                 ]]
      ]
    ];
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_ENCODING, '');
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
      'ConsumerId: 0KhnFrg3bhvNW38ofwPGVMHoR2luZUlG',
      'Content-Type: text/plain'
    ]);
    $response = curl_exec($curl);
    var_dump(json_encode($data));
    var_dump($response);
    curl_close($curl);    
}

// Find RimID across many APIs
function findRimIdLocation($rimId,$catalogues){
    $segment = array();
    for($i=0; $i<=(count($catalogues)-1); $i++){
        $catlogText = file_get_contents($catalogues[$i]);
        if (strpos($catlogText,$rimId) !== false){
            array_push($segment,true);
        }else{
            array_push($segment,false);
        }
        //echo $i;    
    }return $segment;    
}

 
// The App starts HERE when the user enter a RIMID and click on "Search"
if (isset($_POST['rimId'])){

    $rimId = $_POST['rimId'];
    //Identify where the RimId is located
    $rimIdLocation =  findRimIdLocation($rimId,$catalogues);
    //var_dump($rimIdLocation);
    
    // Find if there is data available
    if (in_array(true,$rimIdLocation)){
        $CloneRimId = $rimId;
    }else{
        $CloneRimId = 'No data found';
    }

    // Access info from Stock API if RIMID present
    if ($rimIdLocation[0] ==  true){
        $jsonStockApi = getJsonData($agoraStockApi.$rimId);
        $availability = $jsonStockApi['data']['stocks'][0]['available'];
        if ($availability === false){
            $ava = 'No';
            $sku = '';
            $stat = '';
            $notice = '';
        }else{
            $ava = 'Yes';
            $sku = $jsonStockApi['data']['stocks'][0]['sku'];
            $stat = getStatus($jsonStockApi['data']['stocks'][0]['preOrder'],
                              $jsonStockApi['data']['stocks'][0]['backOrder'],
                              $jsonStockApi['data']['stocks'][0]['outOfStock']);
            $notice = $jsonStockApi['data']['stocks'][0]['stockNotice'];    
        }
    }

    // Access info from consumer if RIMID present (Mobile, Tablet, Mbb)
    if ($rimIdLocation[1] == true){
        $jsonConsumer = getJsonData($agoraConsumerMobile.$rimId);
        $consumerProductData = getMobilityPriductData($jsonConsumer);
        $conName = $consumerProductData[0];
        $conStatus = $consumerProductData[1];
        $conMro12 = $consumerProductData[2];
        $conMro24 = $consumerProductData[3];    
    }elseif ($rimIdLocation[2] == true){
        $jsonConsumer = getJsonData($agoraConsumerTablet.$rimId);
        $consumerProductData = getMobilityPriductData($jsonConsumer);
        $conName = $consumerProductData[0];
        $conStatus = $consumerProductData[1];
        $conMro12 = $consumerProductData[2];
        $conMro24 = $consumerProductData[3];    
    }elseif ($rimIdLocation[3] == true){
        $jsonConsumer = getJsonData($agoraConsumerMbb.$rimId);
        $consumerProductData = getMobilityPriductData($jsonConsumer);
        $conName = $consumerProductData[0];
        $conStatus = $consumerProductData[1];
        $conMro12 = $consumerProductData[2];
        $conMro24 = $consumerProductData[3];    
    }else {
        $jsonConsumer = null;
    }

    // Access info from gaming if RIMID present
    if ($rimIdLocation[4] == true){
        $jsonGaming = getJsonData($agoraGaming.$rimId);
        $gameName = $jsonGaming['data']['offer']['optionalProductGroups'][0]['productSelections'][0]['product']['fulfilmentName'];
        $gameStatus = getStatus($jsonGaming['data']['offer']['optionalProductGroups'][0]['productSelections'][0]['product']['preorder'],
                                $jsonGaming['data']['offer']['optionalProductGroups'][0]['productSelections'][0]['product']['backorder'],
                                $jsonGaming['data']['offer']['optionalProductGroups'][0]['productSelections'][0]['product']['outOfStock']);
    }else {
        $jsonGaming = null;
    }

    // Access info from student if RIMID present
    if ($rimIdLocation[5] == true){
        $jsonStudent = getJsonData($agoraStudent.$rimId);
        $studMobileProductData = getMobilityPriductData($jsonStudent);
        $studName = $studMobileProductData[0];
        $studStatus = $studMobileProductData[1];
        $studMro12 = $studMobileProductData[2];
        $studMro24 = $studMobileProductData[3];
    }else {
        $jsonStudent = null;
    }

    // Access info from smallbusiness if RIMID present (Mobile, Tablet, Mbb)
    if ($rimIdLocation[6] == true){
        $jsonSmallbusiness = getJsonData($agoraSmallBusinessMobile.$rimId);
        $smallProductData = getMobilityPriductData($jsonSmallbusiness);
        $smallName = $smallProductData[0];
        $smallStatus = $smallProductData[1];
        $smallMro12 = $smallProductData[2];
        $smallMro24 = $smallProductData[3];
    }elseif ($rimIdLocation[7] == true){
        $jsonSmallbusiness = getJsonData($agoraSmallBusinessTablet.$rimId);
        $smallProductData = getMobilityPriductData($jsonSmallbusiness);
        $smallName = $smallProductData[0];
        $smallStatus = $smallProductData[1];
        $smallMro12 = $smallProductData[2];
        $smallMro24 = $smallProductData[3];
    }elseif ($rimIdLocation[8] == true){
        $jsonSmallbusiness = getJsonData($agoraSmallBusinessMbb.$rimId);
        $smallProductData = getMobilityPriductData($jsonSmallbusiness);
        $smallName = $smallProductData[0];
        $smallStatus = $smallProductData[1];
        $smallMro12 = $smallProductData[2];
        $smallMro24 = $smallProductData[3];
    }else {
        $jsonSmallbusiness = null;
    }

    // Acess info from prepaid if RIMID present (Mobile, Mbb)
    if (($rimIdLocation[9] == true) || ($rimIdLocation[10] == true)){
        $jsonPrepaid = getJsonData($agoraPrepaid.$rimId);
        $prepaidProductData = getPreAndBoostProductData($jsonPrepaid);
        $prepName = $prepaidProductData[0];
        $prepStatus = $prepaidProductData[1];
        $prepMro0 = $prepaidProductData[2];
    }else{
        $jsonPrepaid = null;
    }

    // Acess info from boost if RIMID present
    if ($rimIdLocation[11]){
        $jsonBoost = getJsonData($agoraBoost.$rimId);
        $boostProductData = getPreAndBoostProductData($jsonBoost);
        $boostName = $boostProductData[0];
        $boostStatus = $boostProductData[1];
        $boostMro0 = $boostProductData[2];
    }else{
        $jsonBoost = null;
    }

    // Acess info from Loyalty 
    if ($rimIdLocation[12]){
        $jsonLyCon = getJsonData($agoraLoyaltyConsumer.$rimId);
        $lyConProductData = getLoyaltyProductData($jsonLyCon);
        $lyConName = $lyConProductData[0];
        $lyConStatus = $lyConProductData[1];
        $lyConNumOfTiers = $lyConProductData[2];
        $lyConTiers = $lyConProductData[3];
        $lyConMro12 = $lyConProductData[4];
        $lyConMro24 = $lyConProductData[5];
    }else{
        $jsonLyCon = null;
    }
    if ($rimIdLocation[13]){
        $jsonLyDv = getJsonData($agoraLoyaltyDavinci.$rimId);
        $lyDvProductData = getLoyaltyProductData($jsonLyDv);
        $lyDvName = $lyDvProductData[0];
        $lyDvStatus = $lyDvProductData[1];
        $lyDvNumOfTiers = $lyDvProductData[2];
        $lyDvTiers = $lyDvProductData[3];
        $lyDvMro12 = $lyDvProductData[4];
        $lyDvMro24 = $lyDvProductData[5];
    }else{
        $jsonLyDv = null;
    }
    if ($rimIdLocation[14]){
        $jsonLySmb = getJsonData($agoraLoyaltySmallBusiness.$rimId);
        $lySmbProductData = getLoyaltyProductData($jsonLySmb);
        $lySmbName = $lySmbProductData[0];
        $lySmbStatus = $lySmbProductData[1];
        $lySmbNumOfTiers = $lySmbProductData[2];
        $lySmbTiers = $lySmbProductData[3];
        $lySmbMro12 = $lySmbProductData[4];
        $lySmbMro24 = $lySmbProductData[5];    
    }else{
        $jsonLySmb = null;
    }

    // Acess info from Accessories
    if ($rimIdLocation[15]){
        $jsonAccCon = getJsonData($agoraAccessoriesConsumer.$rimId);
        $accConProductData = getAccessoriesProductData($jsonAccCon);
        $accConName = $accConProductData[0];
        $accConStatus = $accConProductData[1];
        $accConNumOfPriceOpts = $accConProductData[2];
        $accConPaymentAndPricesOpts = $accConProductData[3];
    }else{
        $jsonAccCon = null;
    }
    if ($rimIdLocation[16]){
        $jsonAccDv = getJsonData($agoraAccessoriesDavinci.$rimId);
        $accDvProductData = getAccessoriesProductData($jsonAccDv);
        $accDvName = $accDvProductData[0];
        $accDvStatus = $accDvProductData[1];
        $accDvNumOfPriceOpts = $accDvProductData[2];
        $accDvPaymentAndPricesOpts = $accDvProductData[3];    
    }else{
        $jsonAccDv = null;
    }

}else{
    $rimId = '';
    $CloneRimId = '';
    // Stock API table
    $ava = '';
    $sku = '';
    $stat = '';
    $notice = '';
    // Consumer Table
    $conName = '';
    $conStatus = '';
    $conMro12 = '';
    $conMro24 = '';
    // Gaming Table
    $gameName = '';
    $gameStatus = '';
    // Student Table
    $studName = '';
    $studStatus = '';
    $studMro12 = '';
    $studMro24 = '';
    // Smallbusiness Table
    $smallName = '';
    $smallStatus = '';
    $smallMro12 = '';
    $smallMro24 = '';
    // Prepaid Table
    $prepName = '---';
    $prepStatus = '---';
    $prepMro0 = '---';
    // Boost Table
    $boostName = '---';
    $boostStatus = '---';
    $boostMro0 = '---';
    // Loyalty Tables
    $lyConName = '---';
    $lyConStatus = '---';
    $lyConNumOfTiers = null;
    $lyConMro12 = false;
    $lyConMro24 = false;
    $lyDvName = '---';
    $lyDvStatus = '---';
    $lyDvNumOfTiers = null;
    $lyDvMro12 = false;
    $lyDvMro24 = false;
    $lySmbName = '---';
    $lySmbStatus = '---';
    $lySmbNumOfTiers = null;
    $lySmbMro12 = false;
    $lySmbMro24 = false;
    // Acessories Table
    $accConName = '---';
    $accConStatus = '---';
    $accConNumOfPriceOpts = null;
    $accConPaymentAndPricesOpts = null;
    $accDvName = '---';
    $accDvStatus = '---';
    $accDvNumOfPriceOpts = null;
    $accDvPaymentAndPricesOpts = null;

}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="UTF-8">
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Chakra+Petch">
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <!-- Font Awesome 5 -->
        <script src="https://kit.fontawesome.com/19bb01d8b0.js" crossorigin="anonymous"></script>
        <!-- My Script -->
        <script src="js/main.js"></script>
        <!-- My Style -->
        <link rel="stylesheet" href="css/style.css">
        <title>Cheetah</title>
    </head>
    <body>
        
        <!-- Search module--> 
        <div class="container">
            <img class="img_cheetah" src="images/cheetah.png" alt="the_cheetah">
            
            <h1>Cheetah</h1>
            <form name ="rimidInput" onsubmit="return validateForm()"  method="post">
                <label for="rimId"><p>Rimid</p></label>
                <input type="search" name="rimId" required>
                <input type="submit" value="Search">           
            </form>
            <img id="img_loading" src="images/loading.gif" alt="loading">
            <h2><?=$CloneRimId?></h2>
        </div>
        <hr>
        <!-- MAUI Segments--> 
        <div class="container" id="maui_segments">
            <div class="row">
                <div class="col">
                    <p>Stock API</p>
                    <a href="https://tapi.telstra.com/presentation/v1/ecommerce-products/con/stocks" target="_blank">
                    <i class="fas fa-cogs"  id="stockAPI"></i>
                    </a>
                    <?php
                        // Set Stock API Icon "Green" if RimId is found on segment
                        if (isset($rimIdLocation)){
                            if ($rimIdLocation[0] == true){
                            echo '<script> greenActive("stockAPI");</script>';
                            }
                        }
                    ?>
                </div>
                <div class="col">
                    <p>Consumer</p>
                    <?php
                        // Selecting the link according to the segment considence
                        if (isset($rimIdLocation)){
                            if (true == $rimIdLocation[1]){
                                echo '<a href="https://checkout.telstra.com.au/consumer/mobile/autht/upgrade?device='.$rimId.'&repay=24&plan=2020-tso-mobile-xl" target="_blank">';
                            }elseif (true == $rimIdLocation[2]){
                                echo '<a href="https://checkout.telstra.com.au/consumer/tablet/autht/upgrade?device='.$rimId.'&repay=24&plan=tso-tablet-s" target="_blank">';
                            }elseif(true == $rimIdLocation[3]){
                                echo '<a href="https://checkout.telstra.com.au/consumer/mbb/autht/upgrade?device='.$rimId.'&repay=24&plan=tso-mbb-s" target="_blank">';
                            }else{
                                echo '<a href="https://telstra.com.au" target="_blank">';
                            }  
                        }else{
                            echo '<a href="https://telstra.com.au" target="_blank">';
                        }
                    ?>
                    <i class="fas fa-users" id="consumer"></i>
                    </a>
                    <?php
                        // Set consumer Icon "Green" if RimId is found on segment
                        if (isset($rimIdLocation)){
                            if (($rimIdLocation[1] == true)||($rimIdLocation[2] == true)||($rimIdLocation[3] == true)){
                                echo '<script> greenActive("consumer");</script>';
                            }                    
                        }
                    ?>
                </div>
                <div class="col">
                    <p>Gaming</p>
                    <?php
                        if (isset($rimIdLocation)){
                            if (true == $rimIdLocation[4]){
                                if ($rimId == '100245656'){
                                    echo '<a href="https://checkout.telstra.com.au/gaming/xbox?plan=2020-tso-xbox-x-all-24m&device='.$rimId.'" target="_blank">';
                                }else{
                                    echo '<a href="https://checkout.telstra.com.au/gaming/xbox?plan=2020-tso-xbox-s-all-24m&device='.$rimId.'" target="_blank">';
                                }
                                
                            }else{
                                echo '<a href="https://telstra.com.au" target="_blank">';
                            }
                        }else{
                            echo '<a href="https://telstra.com.au" target="_blank">';
                        }
                    ?>
                    <i class="fab fa-xbox" id="gaming"></i>
                    </a>
                    
                    <?php
                        // Set gaming Icon "Green" if RimId is found on segment
                        if (isset($rimIdLocation)){
                            if ($rimIdLocation[4] == true){
                                echo '<script> greenActive("gaming");</script>';
                            }
                        }
                    ?>

                </div>
                <div class="col">
                    <p>Students</p>
                    <?php
                        if (isset($rimIdLocation)){
                            if (true == $rimIdLocation[5]){
                                echo '<a href="https://checkout.telstra.com.au/consumer/mobile/autht/upgrade?device='.$rimId.'&repay=24&plan=2020-tso-mobile-xl" target="_blank">';
                            }else{
                                echo '<a href="https://telstra.com.au" target="_blank">';
                            }
                        }else{
                            echo '<a href="https://telstra.com.au" target="_blank">';
                        }
                    ?>
                    <i class="fas fa-graduation-cap" id="students"></i>
                    </a>
                    <?php 
                        // Set student Icon "Green" if RimId if found on segment
                        if (isset($rimIdLocation)){
                            if ($rimIdLocation[5] ==  true){
                                echo '<script> greenActive("students");</script>';
                            }
                        }
                    ?>

                </div>
                <div class="col">
                    <p>Small Business</p>
                    <?php
                        // Selecting the link according to the segment considence
                        if (isset($rimIdLocation)){
                            if (true == $rimIdLocation[6]){
                                echo '<a href="https://checkout.telstra.com.au/small-business/mobile?device='.$rimId.'&repay=24&plan=2020-xl-hs-plan" target="_blank">';
                            }elseif (true == $rimIdLocation[7]){
                                echo '<a href="https://checkout.telstra.com.au/small-business/tablet?device='.$rimId.'&repay=24&plan=s-tab-plan" target="_blank">';
                            }elseif(true == $rimIdLocation[8]){
                                echo '<a href="https://checkout.telstra.com.au/small-business/mbb?device='.$rimId.'&repay=24%20mths&plan=s-tab-plan" target="_blank">';
                            }else{
                                echo '<a href="https://telstra.com.au" target="_blank">';
                            }  
                        }else{
                            echo '<a href="https://telstra.com.au" target="_blank">';
                        }
                    ?>
                    <i class="fas fa-store" id="smallBusiness"></i>
                    </a>
                    <?php
                        // Set business Icon "Green" if RimId is found on segment
                        if (isset($rimIdLocation)){
                            if (($rimIdLocation[6] == true)||($rimIdLocation[7] == true)||($rimIdLocation[8] == true)){
                                echo '<script> greenActive("smallBusiness");</script>';
                            }                    
                        }
                    ?>
                </div>
                <div class="col">
                    <p>Prepaid</p>
                    <?php
                        if (isset($rimIdLocation)){
                            if (true == $rimIdLocation[9]){
                                echo '<a href="https://checkout.telstra.com.au/consumer/prepaid?sku='.$rimId.'" target="_blank">';
                            }elseif (true == $rimIdLocation[10]){
                                echo '<a href="https://checkout.telstra.com.au/consumer/prepaid?sku='.$rimId.'&deviceType=mbb" target="_blank">';
                            }else{
                                echo '<a href="https://telstra.com.au" target="_blank">';
                            }
                        }else{
                            echo '<a href="https://telstra.com.au" target="_blank">';
                        }
                    ?>
                    <i class="fas fa-credit-card" id="prepaid"></i>
                    </a>
                    <?php
                        // Set prepaid Icon "Green" if RimId is found on segment
                        if (isset($rimIdLocation)){
                            if (($rimIdLocation[9] == true) || ($rimIdLocation[10] == true)){
                                echo '<script> greenActive("prepaid");</script>';
                            }
                        }
                    ?>

                </div>
                <div class="col">
                    <p>Boost</p>
                    <?php
                        if (isset($rimIdLocation)){
                            if (true == $rimIdLocation[11]){
                                echo '<a href="https://checkout.boost.com.au/consumer/boost?sku='.$rimId.'" target="_blank">';
                            }else{
                                echo '<a href="https://telstra.com.au" target="_blank">';
                            }
                        }else{
                            echo '<a href="https://telstra.com.au" target="_blank">';
                        }
                    ?>
                    <i class="fas fa-sim-card" id="boost"></i>
                    </a>
                    <?php
                        // Set boost Icon "Green" if RimId is found on segment
                        if (isset($rimIdLocation)){
                            if ($rimIdLocation[11] == true){
                                echo '<script> greenActive("boost");</script>';
                            }
                        }                    
                    ?>
                </div>
            </div>
            <p id="p2">MAUI</p>
        </div>
        <hr>
        <!-- MAUI3 Segments--> 
        <div class="container" id="maui3_segments">
            <div class="row">
                <div class="col">
                    <p>Loyalty</p>
                    <?php
                        if (isset($rimIdLocation)){
                            if (($rimIdLocation[12] == true) || ($rimIdLocation[13] == true) || ($rimIdLocation[14] == true)){
                                echo '<a href="https://checkout.telstra.com.au/consumer/rewards" target="_blank">';
                            }else{
                                echo '<a href="https://telstra.com.au" target="_blank">';
                            }
                        }else{
                            echo '<a href="https://telstra.com.au" target="_blank">';
                        }
                    ?>
                    <i class="fas fa-user-plus" id="loyalty"></i>
                    </a>
                    <?php
                        // Set Loyalty Icon "Green" if RimId is found on segment
                        if (isset($rimIdLocation)){
                            if (($rimIdLocation[12] == true) || ($rimIdLocation[13] == true) || ($rimIdLocation[14] == true)){
                                echo '<script> greenActive("loyalty");</script>';
                            }
                        }                     
                    ?>
                    <div class="row">
                        <div class="col">
                            <p id="textConsumerLy">Consumer</p>
                            <?php
                                // Set consumer text "Green" if RimId is found on segment
                                if (isset($rimIdLocation)){
                                    if ($rimIdLocation[12] == true){
                                        echo '<script> greenActive("textConsumerLy");</script>';
                                    }
                                }                     
                            ?>
                        </div>
                        <div class="col">
                            <p id="textDavinciLy">Davinci</p>
                            <?php 
                                // Set davinci text "Green" if RimId is found on segment
                                if (isset($rimIdLocation)){
                                    if ($rimIdLocation[13] == true){
                                        echo '<script> greenActive("textDavinciLy");</script>';
                                    }
                                }                     
                            ?>
                        </div>
                        <div class="col">
                            <p id="textSmallBusinessLy">Small Business</p>
                            <?php 
                                // Set smallbusiness text "Green" if RimId is found on segment
                                if (isset($rimIdLocation)){
                                    if ($rimIdLocation[14] == true){
                                        echo '<script> greenActive("textSmallBusinessLy");</script>';
                                    }
                                }                     
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <p>Accessories</p>
                    <?php
                        if (isset($rimIdLocation)){
                            if (($rimIdLocation[15] == true) || ($rimIdLocation[16] == true)){
                                echo '<a href="https://checkout.telstra.com.au/consumer/accessories/category/id/'.$rimId.'" target="_blank">';
                            }else{
                                echo '<a href="https://telstra.com.au" target="_blank">';
                            }
                        }else{
                            echo '<a href="https://telstra.com.au" target="_blank">';
                        }
                    ?>
                    <i class="fas fa-headphones" id="accessories"></i>
                    </a>
                    <?php 
                        // Set Acessories Icon "Green" if RimId is found on segment
                        if (isset($rimIdLocation)){
                            if (($rimIdLocation[15] == true) || ($rimIdLocation[16] == true)){
                                echo '<script> greenActive("accessories");</script>';
                            }
                        }                     
                    ?>
                    <div class="row">
                        <div class="col">
                            <p id="textConsumerAcc">Consumer</p>
                            <?php
                                // Set consumer text "Green" if RimId is found on segment
                                if (isset($rimIdLocation)){
                                    if ($rimIdLocation[15] == true){
                                        echo '<script> greenActive("textConsumerAcc");</script>';
                                    }
                                }                      
                            ?>
                        </div>
                        <div class="col">
                            <p id="textDavinciAcc">Davinci</p>
                            <?php 
                                // Set davinci text "Green" if RimId is found on segment
                                if (isset($rimIdLocation)){
                                    if ($rimIdLocation[16] == true){
                                        echo '<script> greenActive("textDavinciAcc");</script>';
                                    }
                                }                      
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <p id="p3">MAUI3</p>
        </div>
        <hr>
        <!-- SalesForce info--> 
        <div class="container" id="sales_force_segment">
            <p>SalesForce</p>
            <i class="fab fa-salesforce" id="salesforce"></i>
            <p id="p4">Others</p>
        </div>
        <hr>

        <div id="all_tables">
            <div class="container">
                <div class="row">
                    <!-- MAUI Segments tables--> 
                    <div class="col">
                        <div id="stock_api_table">
                        <?php 
                            if ($rimIdLocation[0] == true){
                                echo '<script> display_on("stock_api_table");</script>';
                            }
                        ?>
                            <p>Stock API</p>
                            <table class="table table-striped table-dark">
                                <thead>
                                  <tr>
                                    <th scope="col">Available</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Stock Notice</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><?=$ava?></td>
                                    <td><?=$stat?></td>
                                    <td><?=$notice?></td>
                                  </tr>
                                </tbody>
                            </table>
                        </div>                  
                        <div  id="consumer_table">
                        <?php
                            if (($rimIdLocation[1] == true)||($rimIdLocation[2] == true)||($rimIdLocation[3] == true)){
                                echo '<script> display_on("consumer_table");</script>';
                            }                                             
                        ?>
                            <p>Consumer</p>
                            <table class="table table-striped table-dark">
                                <thead>
                                  <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Price</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><?=$conName?></td>
                                    <td><?=$conStatus?></td>
                                    <td>
                                        <table class="table table-striped table-dark">
                                            <tr>
                                                <td>12mth</td>
                                                <td>24mth</td>
                                            </tr>
                                            <tr>
                                                <td>$<?=$conMro12?></td>
                                                <td>$<?=$conMro24?></td>
                                            </tr>
                                        </table>
                                    </td>
                                  </tr>
                                </tbody>
                            </table>                    
                        </div>   
                        <div id="gaming_table">
                        <?php 
                            if ($rimIdLocation[4] == true){
                                echo '<script> display_on("gaming_table");</script>';
                            }
                        ?>
                            <p>Gaming</p>
                            <table class="table table-striped table-dark">
                                <thead>
                                  <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><?=$gameName?></td>
                                    <td><?=$gameStatus?></td>
                                  </tr>
                                </tbody>
                            </table>                    
                        </div>
                        <div id="student_table">
                        <?php 
                            if ($rimIdLocation[5] == true){
                                echo '<script> display_on("student_table");</script>';
                            }else{
                            }
                        ?>
                            <p>Student</p>
                            <table class="table table-striped table-dark">
                                <thead>
                                  <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Price</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><?=$studName?></td>
                                    <td><?=$studStatus?></td>
                                    <td>
                                        <table class="table table-striped table-dark">
                                            <tr>
                                                <td>12mth</td>
                                                <td>24mth</td>
                                            </tr>
                                            <tr>
                                                <td>$<?=$studMro12?></td>
                                                <td>$<?=$studMro24?></td>
                                            </tr>
                                        </table>
                                    </td>
                                  </tr>
                                </tbody>
                            </table>                    
                        </div>
                        <div id="small_business_table">
                        <?php 
                            if (($rimIdLocation[6] == true)||($rimIdLocation[7] == true)||($rimIdLocation[8] == true)){
                                echo '<script> display_on("small_business_table");</script>';
                            }
                        ?>
                            <p>SmallBusiness</p>
                            <table class="table table-striped table-dark">
                                <thead>
                                  <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Price</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><?=$smallName?></td>
                                    <td><?=$smallStatus?></td>
                                    <td>
                                        <table class="table table-striped table-dark">
                                            <tr>
                                                <td>12mth</td>
                                                <td>24mth</td>
                                            </tr>
                                            <tr>
                                                <td>$<?=$smallMro12?></td>
                                                <td>$<?=$smallMro24?></td>
                                            </tr>
                                        </table>
                                    </td>
                                  </tr>
                                </tbody>
                            </table>                    
                        </div>
                        <div id="prepaid_table">
                        <?php
                            if (($rimIdLocation[9] == true)||($rimIdLocation[10] == true)){
                                echo '<script> display_on("prepaid_table");</script>';
                            }                         
                        ?>
                            <p>Prepaid</p>
                            <table class="table table-striped table-dark">
                                <thead>
                                  <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Price</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><?=$prepName?></td>
                                    <td><?=$prepStatus?></td>
                                    <td>$<?=$prepMro0?></td>
                                  </tr>
                                </tbody>
                            </table>                    
                        </div>
                        <div id="boost_table">
                        <?php 
                            if ($rimIdLocation[11] == true){
                                echo '<script> display_on("boost_table");</script>';
                            }
                        ?>
                            <p>Boost</p>
                            <table class="table table-striped table-dark">
                                <thead>
                                  <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Price</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><?=$boostName?></td>
                                    <td><?=$boostStatus?></td>
                                    <td>$<?=$boostMro0?></td>
                                  </tr>
                                </tbody>
                            </table>  
                        </div>                  
                    </div>
                    <!-- MAUI3 Segments tables-->
                    <div class="col">
                        <!-- Loyalty Consumer Table-->
                        <div id="ly_con_table">
                        <?php
                            if ($rimIdLocation[12] == true){
                                echo '<script> display_on("ly_con_table");</script>';
                            } 
                        ?>
                            <p>Loyalty_con</p>
                            <table class="table table-striped table-dark">
                                <thead>
                                  <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Payment Opt</th>
                                    <th scope="col">Price</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><?=$lyConName?></td>
                                    <td><?=$lyConStatus?></td>
                                    <td>
                                        <table class="table table-striped table-dark">
                                            <?php
                                                if ((true !== $lyConMro12)&&(true !== $lyConMro24)){
                                                    echo('<tr>');
                                                    echo('<td>NA</td>');
                                                    echo('</tr>');
                                                }else{
                                                    if (true == $lyConMro12){
                                                        echo('<tr>');
                                                        echo('<td>12mths &check;</td>');
                                                        echo('</tr>');
                                                    }
                                                    if (true == $lyConMro24){
                                                        echo('<tr>');
                                                        echo('<td>24mths &check;</td>');
                                                        echo('</tr>');
                                                    }
                                                }
                                            ?>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table table-striped table-dark">
                                            <tr>
                                                <td>Points</td>
                                                <td>Pay</td>
                                            </tr>
                                            <?php
                                                if (null !== $lyConNumOfTiers){
                                                    for($i=0; $i<=($lyConNumOfTiers-1); $i++){
                                                        echo('<tr>');
                                                        echo('<td>'.$lyConTiers[0][$i].'</td>');
                                                        echo('<td>'.'$'.$lyConTiers[1][$i].'</td>');
                                                        echo('</tr>');
                                                    }
                                                }
                                            ?>
                                        </table>
                                    </td>
                                  </tr>
                                </tbody>
                            </table>  
                        </div>                  
                        
                        <div id="ly_dv_table">
                        <?php 
                            if ($rimIdLocation[13] == true){
                                echo '<script> display_on("ly_dv_table");</script>';
                            } 
                        ?>

                            <p>Loyalty_dv</p>
                            <table class="table table-striped table-dark">
                                <thead>
                                  <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Payment Opt</th>
                                    <th scope="col">Price</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><?=$lyDvName?></td>
                                    <td><?=$lyDvStatus?></td>
                                    <td>
                                        <table class="table table-striped table-dark">
                                            <?php
                                                if ((true !== $lyDvMro12)&&(true !== $lyDvMro24)){
                                                    echo('<tr>');
                                                    echo('<td>NA</td>');
                                                    echo('</tr>');
                                                }else{
                                                    if (true == $lyDvMro12){
                                                        echo('<tr>');
                                                        echo('<td>12mths &check;</td>');
                                                        echo('</tr>');
                                                    }
                                                    if (true == $lyDvMro24){
                                                        echo('<tr>');
                                                        echo('<td>24mths &check;</td>');
                                                        echo('</tr>');
                                                    }
                                                }
                                            ?>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table table-striped table-dark">
                                            <tr>
                                                <td>Points</td>
                                                <td>Pay</td>
                                            </tr>
                                            <?php
                                                if (null !== $lyDvNumOfTiers){
                                                    for($i=0; $i<=($lyDvNumOfTiers-1); $i++){
                                                        echo('<tr>');
                                                        echo('<td>'.$lyDvTiers[0][$i].'</td>');
                                                        echo('<td>'.'$'.$lyDvTiers[1][$i].'</td>');
                                                        echo('</tr>');
                                                    }
                                                }
                                            ?>
                                        </table>
                                    </td>
                                  </tr>
                                </tbody>
                            </table>  
                        </div>

                        <div id="ly_smb_table">
                        <?php 
                            if ($rimIdLocation[14] == true){
                                echo '<script> display_on("ly_smb_table");</script>';
                            } 
                        ?>
                            <p>Loyalty_smb</p>
                            <table class="table table-striped table-dark">
                                <thead>
                                  <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Payment Opt</th>
                                    <th scope="col">Price</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><?=$lySmbName?></td>
                                    <td><?=$lySmbStatus?></td>
                                    <td>
                                        <table class="table table-striped table-dark">
                                            <?php
                                                if ((true !== $lySmbMro12)&&(true !== $lySmbMro24)){
                                                    echo('<tr>');
                                                    echo('<td>NA</td>');
                                                    echo('</tr>');
                                                }else{
                                                    if (true == $lySmbMro12){
                                                        echo('<tr>');
                                                        echo('<td>12mths &check;</td>');
                                                        echo('</tr>');
                                                    }
                                                    if (true == $lySmbMro24){
                                                        echo('<tr>');
                                                        echo('<td>24mths &check;</td>');
                                                        echo('</tr>');
                                                    }
                                                }
                                            ?>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table table-striped table-dark">
                                            <tr>
                                                <td>Points</td>
                                                <td>Pay</td>
                                            </tr>
                                            <?php
                                                if (null !== $lySmbNumOfTiers){
                                                    for($i=0; $i<=($lySmbNumOfTiers-1); $i++){
                                                        echo('<tr>');
                                                        echo('<td>'.$lySmbTiers[0][$i].'</td>');
                                                        echo('<td>'.'$'.$lySmbTiers[1][$i].'</td>');
                                                        echo('</tr>');
                                                    }
                                                }
                                            ?>
                                        </table>
                                    </td>
                                  </tr>
                                </tbody>
                            </table> 
                        </div>                  
                        
                        <div id="acc_con_table">
                        <?php
                            if ($rimIdLocation[15] == true){
                                echo '<script> display_on("acc_con_table");</script>';
                            }  
                        ?>
                            <p>Acc_con</p>
                            <table class="table table-striped table-dark">
                                <thead>
                                  <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Payment Opt</th>
                                    <th scope="col">Price</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><?=$accConName?></td>
                                    <td><?=$accConStatus?></td>
                                    <td>
                                        <table class="table table-striped table-dark">
                                            <?php
                                                if (null != $accConNumOfPriceOpts){
                                                    for($i=0; $i<=($accConNumOfPriceOpts-1); $i++){
                                                        echo('<tr>');
                                                        echo('<td>'.$accConPaymentAndPricesOpts[0][$i].'</td>');
                                                        echo('</tr>');
                                                    }
                                                }else{
                                                    echo('<tr>');
                                                    echo('<td>NA</td>');
                                                    echo('</tr>');

                                                }
                                            ?>    
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table table-striped table-dark">
                                            <?php
                                                if (null != $accConNumOfPriceOpts){
                                                    for($i=0; $i<=($accConNumOfPriceOpts-1); $i++){
                                                        echo('<tr>');
                                                        echo('<td>'.'$'.$accConPaymentAndPricesOpts[1][$i].'</td>');
                                                        echo('</tr>');
                                                    }
                                                }else{
                                                    echo('<tr>');
                                                    echo('<td>NA</td>');
                                                    echo('</tr>');
                                                }
                                            ?>    
                                        </table>
                                    </td>
                                  </tr>
                                </tbody>
                            </table> 
                        </div>                   
                        
                        <div id="acc_dv_table">
                        <?php
                            if ($rimIdLocation[16] == true){
                                echo '<script> display_on("acc_dv_table");</script>';
                            }   
                        ?>

                            <p>Acc_dv</p>
                            <table class="table table-striped table-dark">
                                <thead>
                                  <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Payment Opt</th>
                                    <th scope="col">Price</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><?=$accDvName?></td>
                                    <td><?=$accDvStatus?></td>
                                    <td>
                                        <table class="table table-striped table-dark">
                                        <?php
                                            if (null != $accDvNumOfPriceOpts){
                                                for($i=0; $i<=($accDvNumOfPriceOpts-1); $i++){
                                                    echo('<tr>');
                                                    echo('<td>'.$accDvPaymentAndPricesOpts[0][$i].'</td>');
                                                    echo('</tr>');
                                                }
                                            }else{
                                                echo('<tr>');
                                                echo('<td>NA</td>');
                                                echo('</tr>');
                                            }
                                        ?>    
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table table-striped table-dark">
                                        <?php
                                            if (null != $accConNumOfPriceOpts){
                                                for($i=0; $i<=($accConNumOfPriceOpts-1); $i++){
                                                    echo('<tr>');
                                                    echo('<td>'.'$'.$accConPaymentAndPricesOpts[1][$i].'</td>');
                                                    echo('</tr>');
                                                }
                                            }else{
                                                echo('<tr>');
                                                echo('<td>NA</td>');
                                                echo('</tr>');
                                            }
                                        ?>    
                                        </table>
                                    </td>
                                  </tr>
                                </tbody>
                            </table>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    <footer>
        <div class="container">
            <p id="p5">Designed, built and maintained by Daniel Rodriguez 
            <br>daniel.rodriguez@team.telstra.com
            <br>danielrodriguezmarin@me.com</p>            
        </div>    
    </footer>
        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    </body>
</html>