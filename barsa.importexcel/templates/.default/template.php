<form id="xlsx_form" action="javascript:void(null);" onsubmit="importXLSX()" method="post" enctype="multipart/form-data">
    <p>
        <label for="file">Выберите файл: </label>
        <input type="file" name="userfile" id="file"> <br />
        <button>Закачать файл</button>
    <p>
</form>

<script>
/*
    function importXLSX() {
        var property = document.getElementById('file').files[0];
        var form_data = new FormData();
        form_data.append("file", property);


        BX.ajax({
            url: '/local/components/orm/orm.importexcel/ajax.php',
            method: 'POST',
            data: form_data,
            cache: false,
            processData: false,
            contentType: false,
            onsuccess: function(data){
                console.log("good");
            }
        });



    }
*/


    function importXLSX() {
        var property = document.getElementById('file').files[0];
        var form_data = new FormData();
        form_data.append("file", property);

        $.ajax({
            url: '/local/components/barsa/barsa.importexcel/ajax.php',
            method: 'POST',
            data: form_data,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function () {
                //$('#msg').html('Loading......');
            },
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);

            }
        });
    }


</script>

<?php
/*
if (CModule::IncludeModule("nkhost.phpexcel")) {
    global $PHPEXCELPATH;
    require_once($PHPEXCELPATH . '/PHPExcel.php');
    require_once($PHPEXCELPATH . '/PHPExcel/Writer/Excel5.php');

    /*

    $PHPExcel_file = PHPExcel_IOFactory::load($_SERVER['DOCUMENT_ROOT'] . "/upload/excel/name1.xlsx");

    if (CModule::IncludeModule("orm")) {
        if (\Bitrix\Main\Application::getConnection()->isTableExists(\ormnew\ORM\OrmnewTable::getTableName())) {
            \Bitrix\Main\Application::getConnection()->queryExecute('drop table if exists ' . \ormnew\ORM\OrmnewTable::getTableName());
            \Bitrix\Main\Entity\Base::getInstance('\ormnew\ORM\OrmnewTable')->createDbTable();
        } else {
            echo "bad";
        }
    }
    foreach ($PHPExcel_file->getWorksheetIterator() as $worksheet) {
        $highestRow = $worksheet->getHighestRow(); // получаем количество строк
        $highestColumn = $worksheet->getHighestColumn(); // а так можно получить количество колонок

        for ($row = 2; $row <= $highestRow; $row++) // обходим все строки
        {
            $cell1 = $worksheet->getCellByColumnAndRow(0, $row); //артикул
            $cell2 = $worksheet->getCellByColumnAndRow(1, $row); //наименование
            $cell3 = $worksheet->getCellByColumnAndRow(2, $row); //количество

            if (CModule::IncludeModule("orm")) {
                $result = \ormnew\ORM\OrmnewTable::add(array(
                    "NAME" => htmlspecialchars($cell2),
                ));
            }

        }
    }


}
*/


?>