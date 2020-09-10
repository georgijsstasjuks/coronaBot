<?php


function getStatistic($country){

 //getting all countries   
$getCountries = json_decode(file_get_contents('https://api.thevirustracker.com/free-api?countryTotals=ALL'),JSON_OBJECT_AS_ARRAY);


//getting an array like country => code

$countries=[];
foreach($getCountries['countryitems']['0'] as $item){
    $countries[$item['title']] =  $item['code'];
};

//getting info for requested country
$getInfo = json_decode(file_get_contents('https://api.thevirustracker.com/free-api?countryTotal=' . $countries[$country]),JSON_OBJECT_AS_ARRAY);

if($getInfo==NULL)  return false;

//total info for country
$stats['total_cases'] = $getInfo['countrydata'][0]['total_cases'] != NULL? $getInfo['countrydata'][0]['total_cases'] : 0 ;
$stats['total_deaths'] = $getInfo['countrydata'][0]['total_deaths'] != NULL? $getInfo['countrydata'][0]['total_deaths'] : 0 ;
$stats['total_recovered'] = $getInfo['countrydata'][0]['total_recovered'] != NULL? $getInfo['countrydata'][0]['total_recovered'] : 0 ;

$stats['total_active'] = $stats['total_cases'] - $stats['total_deaths'] - $stats['total_recovered'];

//today info for country
$stats['cases_today'] = $getInfo['countrydata'][0]['total_new_cases_today'] != NULL? $getInfo['countrydata'][0]['total_new_cases_today'] : 0 ;
$stats['deaths_today'] = $getInfo['countrydata'][0]['total_new_cases_today'] != NULL? $getInfo['countrydata'][0]['total_new_deaths_today'] : 0 ;
$stats['serious'] = $getInfo['countrydata'][0]['total_new_cases_today'] != NULL? $getInfo['countrydata'][0]['total_active_cases'] : 0 ;

return $stats;
}



?>