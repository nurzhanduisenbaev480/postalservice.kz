<div id="printRegistry" style="display: none;">
    <div class="top_info">
        <style>
            .table1, .table1 tr, .table1 td,.table1 th{
                border: 1px solid black;
                border-collapse: collapse;
                width: 100%;
            }
            .top_info{
                width: 100%;
            }
            .table1{
                width: 100%;
            }
            .table1 tbody td, .table1 tbody th{
                text-align: center;
                padding-left: 5px;
                padding-right: 5px;
            }
            .top-city{
                width: 100%;
                display: flex;
                text-align: center;align-items: center;
            }
            .top-city #barcode{
                width: 30%;
            }
            .top-city h3{
                width: 70%;
            }
        </style>
        <table class="table1 table-bordered1" id="registry_archive">
            <thead>
            <tr>
                <td colspan="5">
                    <div class="top-city">
                        <svg id="barcode"></svg>
                        <h3 id="top_city_1"
                            style="font-size: 40px;
                            font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;">Актобе</h3>
                    </div>
                </td>
                <td></td>
                <td style="text-align: center;">
                    <span class="top_date" style="width: 100%;">13.11.2021</span>
                </td>
                <td colspan="2">
                    <p style="width: 90%;
                            margin: 0 auto;
                            text-align: center;">
                        *Хранить реестр и накладные. <br>
                        *высылать накладные с
                        подписями получателя
                        каждое 1 число месяца.<br>
                        *фотографии с
                        доставленными реестрами
                        скидывать в группу города
                    </p>
                </td>
            </tr>
            <tr>

            </tr>
            </thead>
            <tbody id="table_body">
            <th style="width: 20px;">#</th>
            <th>Номер накладной</th>
            <th>Отправитель</th>
            <th>Номер получателя</th>
            <th>Получатель</th>
            <th>Город</th>
            <th style="width: 300px;">Адрес</th>
            <th style="width: 50px;">Оплата</th>
            <th style="width: 150px;">Примечание</th>
            </tbody>
        </table>
    </div>
</div>
