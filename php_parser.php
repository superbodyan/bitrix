
$url = "https://www.neboleem.net/medicinskie-specialnosti.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$answer = curl_exec($ch);

$dom = new simple_html_dom();
$html = str_get_html($answer);
$list = $html->find(".levstolb>ul>li>a");

$links = array();

foreach ($list as $key => $val){

    preg_match_all("/<[Aa][\s]{1}[^>]*[Hh][Rr][Ee][Ff][^=]*=[ '\"\s]*([^ \"'>\s#]+)[^>]*>/", $val, $matches);
    $urls = $matches[1];

    foreach ($urls as $url)
    {
        array_push($links, $url);
    }

/*    $elem = strip_tags($val, "a");

    if (CModule::IncludeModule("iblock")) {
        $el = new CIBlockElement;
        $arLoadProductArray = Array(
            "MODIFIED_BY" => 1, // элемент изменен текущим пользователем
            "IBLOCK_ID" => 8,

            "NAME" => $elem,
            "ACTIVE" => "Y",            // активен
        );

        if ($PRODUCT_ID = $el->Add($arLoadProductArray))
            echo "New ID: " . $PRODUCT_ID;
        else
            echo "Error: " . $el->LAST_ERROR;
    }

*/

}
curl_close($ch);
$id_e = 134;
foreach ($links as $link) {



   // $url = "https://www.neboleem.net/akusher.php";
    $url = "https://www.neboleem.net/" . $link;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $answer = curl_exec($ch);

    $dom = new simple_html_dom();
    $html = str_get_html($answer);
    $list = $html->find(".st>h1");

    foreach ($list as $key => $val) {

        ;
        $p = $val->next_sibling();
      //  echo $p . "<hr>";
    /*    $p2 = $p->next_sibling();
        $p2 = $p2->next_sibling();*/
       // echo $p2;

        $text = $p;
        echo $text;
        if (CModule::IncludeModule("iblock")) {
            $el = new CIBlockElement;


            $arLoadProductArray = Array(
                "PREVIEW_TEXT" => $text,
            );

            $PRODUCT_ID = $id_e;
            $res = $el->Update($PRODUCT_ID, $arLoadProductArray);
        }
        $id_e++;

    }

    curl_close($ch);
    }

