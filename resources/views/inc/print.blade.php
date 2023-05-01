<div id="printRegistry" style="width: 800px;display: none;">
    <style>
        .table1, .table1 tr, .table1 td,.table1 th{
            border: 1px solid black;
            border-collapse: collapse;
        }
        .block1{
            width: 100%;
            display:flex;
        }
        .table1{
            width: 60%;
        }
        .table2{
            width: 100%;
        }
        .top_text{
            margin-left: -160px;
        }
        .from_city, .to_city, .take_date, .transporter_info{
            margin-left: 10px;
        }
        #barcode{
            margin-top: -10px;
            margin-left: 30px;
        }
        .signature{
            width: 100%;
            display:flex;
            margin-top: 20px;

        }
        .fromer, .toer{
            border-bottom: 1px solid black;
            width: 350px;
        }
        .counter{
            width: 40px;
            border: 1px solid black;
            padding: 5px;
            display:flex;
            text-align: center;
            align-items: center;
            margin-left: 40px;
            margin-right: 40px;
        }
    </style>
    <div class="top_info">
        <div class="block1">
            <table class="table1 table-bordered1">
                <thead>
                <tr class="table-dark1">
                    <th colspan="2" style="background: #e7e7e7;"><span class="top_text">ВНУТРЕННИЙ РЕЕСТР ОТ: <span class="top_date">13.11.2021</span></span></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="width: 50%;"><span class="from_city">Алматы</span></td>
                    <td style="width: 50%;">
                        <div class="transporter_info">
                            <div class="transporter_company">
                                <span class="transporter_company_key">Перевозчик:</span>
                                <span class="transporter_company_value">Тоо Моо</span>
                            </div>
                            <div class="transporter_type">
                                <span class="transporter_type_key">Тип транспорта:</span>
                                <span class="transporter_type_value">ЖД</span>
                            </div>
                            <div class="transporter_phone">
                                <span class="transporter_phone_key">Телефон:</span>
                                <span class="transporter_phone_value">87073729565</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="to_city">Оскемен</span>
                    </td>
                    <td>
                        <span class="take_date">Дата приема:</span>
                    </td>
                </tr>
                </tbody>
            </table>
            <svg id="barcode"></svg>
        </div>
        <table class="table1 table2 table-bordered1" style="margin-top: 30px;">
            <thead>
            <tr>
                <th>№</th>
                <th>Отправитель</th>
                <th>Адрес получатель</th>
                <th>Детали</th>
                <th>Вес</th>
                <th>Кол-во</th>
                <th>Номер накладной</th>
                <th>Примечание</th>
                <th>Получатель</th>
                <th style="width:100px;">Подпись</th>
            </tr>
            </thead>
            <tbody id="table_body">

            </tbody>
        </table>
        <div class="signature">
            <div class="fromer">
                Отправитель:
            </div>
            <div class="counter"></div>
            <div class="toer">Получатель:</div>
        </div>
    </div>
</div>
