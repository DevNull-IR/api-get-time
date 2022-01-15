<?php
$link = file_get_contents("https://www.time.ir/");
function Get($city)
{   
    $ch = curl_init("https://api.keybit.ir/owghat/?city=$city");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($json, true);
    return $result;
}
$reb = Get("تهران");
preg_match_all("#(.*)#",$link,$result);
#var_dump($result[0][244],$result[0][238],$result[0][268],$result[0][274],$result[0][298],$result[0][304]);
header('Content-Type: application/json;');
$data = [
    'Tower'=>strip_tags(trim($result[0][330])),
    'Solar'=>[
        'text'=>html_entity_decode(strip_tags(trim($result[0][244]))),
        'Date'=>strip_tags(trim($result[0][238])),
        ],
    'lunar'=>[
        'text'=>html_entity_decode(strip_tags(trim($result[0][304]))),
        'Date'=>strip_tags(trim($result[0][298])),
        ],
    'miladi'=>[
        'text'=>strip_tags(trim($result[0][274])),
        'Date'=>strip_tags(trim($result[0][268])),
        ],
        'Religious_times'=>[
            'azan_sobh'=>[
                'persian_text'=>"اذان صبح",
                'time'=>$reb['result']['azan_sobh'],
                ],
            'azan_maghreb'=>[
                'persian_text'=>"اذان مغرب",
                'time'=>$reb['result']['azan_maghreb'],
                ],
            'azan_zohr'=>[
                'persian_text'=>"اذان ظهر",
                'time'=>$reb['result']['azan_zohr'],
                ],
            'ghorob_khorshid'=>[
                'persian_text'=>"غروب خورشید",
                'time'=>$reb['result']['ghorub_aftab'],
                ],
                'nime_shab_sharei'=>[
                'persian_text'=>"نیمه شب شرعی",
                'time'=>$reb['result']['nimeshab'],
                ],
                'toloee_khorshid'=>[
                'persian_text'=>"طلوع خورشید",
                'time'=>$reb['result']['tolu_aftab'],
                ],
            ]
    ];
echo json_encode($data,448);
