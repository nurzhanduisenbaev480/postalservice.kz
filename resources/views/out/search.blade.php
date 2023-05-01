@extends('layouts.search')

@section('content-search')
    <style>h2,h3{margin:0;font-weight:100;color:#fff;}
        .overHeadMain{background-color:#ffffff;
            width:100%;
            border:1px solid black;
            flex-direction:column;
            display: none;
        }
        .overHeadWrapper{display:flex;width:100%;flex-direction:column;background:rgba(36, 39, 214, 0.9);}.overHeadCloseBtn{position:relative;width:100%}.overHeadCloseBtn button{position:absolute;right:5px;top:5px;font-size:28px;outline:none;background:inherit;border:none;color:#fff;cursor:pointer}.overHeadCloseBtn button:hover{color:black}.overHeadContent{width:90%;margin:80px auto 80px}.overHeadTitle{display:flex;width:100%;align-items:center;color:#fff;font-size:20px;font-family:Arial,"sans-serif";border-bottom:1px solid rgba(53,45,102,0.9)}.overHeadTitle h2{margin:0 10px 5px 0;font-size:30px;}.overHeadClientInfo{display:flex;padding:10px 20px;justify-content:space-between}.overHeadFrom{width:49%;display:flex;flex-direction:column}div{font-size:18px;color:#fff;font-family:Arial,"sans-serif"}.overHeadFrom,.overHeadFromContent{display:flex;flex-direction:column}.overHeadFromItem{display:flex;margin:8px 0}.overHeadFromLabel{width:30%;padding:5px}.overHeadFromValue{color:black;width:50%;padding:8px;background:rgba(219,215,238,1)}.overHeadDates{display:flex}.overHeadDataDate,.overHeadDataDetail{width:30%}.overHeadDataDate{display:flex;flex-direction:column}.overHeadStartDate,.overHeadEndDate{display:flex;margin-bottom:10px}.overHeadStartDate h3,.overHeadEndDate h3{width:55%}.overHeadStartDate div{display:flex}.overHeadEndDate div{display:flex}.overHeadDateDay,.overHeadDateMonth,.overHeadDateYear{margin-right:5px;padding:8px;text-align:center;align-items:center;color:black;background:rgba(219,215,238,1)}.overHeadDateYear{width:40%}.overHeadDataDetail{display:flex;flex-direction:column}.overHeadProductMass{display:flex;margin-bottom:10px}.overHeadStatus{display:flex;margin-bottom:10px}.overHeadProductTitle{width:55%}.overHeadProductValue{margin-right:5px;padding:8px;display:flex;text-align:center;align-items:center;color:black;background:rgba(219,215,238,1)} h6{color:#fff;}</style>
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom gutter-b">
                <div class="alert alert-custom alert-white  gutter-b mb-0 pb-0" role="alert">
                    <div class="alert-text">
                        <!--begin::Logo-->
                        <p class="d-block py-20 text-center">
                            <a href="https://spot.spotlayer.com">
                                <img src="{{asset('public/assets/img/logo_ttc.jpeg')}}" alt="Spotlayer" style="max-width:150px">
                            </a>
                        </p>
                        <p class="mt-50 text-center">
                            <a href="https://transit-trade.com">Назад в Сайт</a>
                        </p>

                    </div>
                </div>
                <div class="card-header">
                    <div class="card-title">
                        <h5 class="card-label  text-center">Отслеживайте вашу накладную</h5>
                    </div>
                </div>
                <!--begin::Form-->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3">
                            </div>
                            <div class="col-xl-6">
                                <!--begin::Input-->
                                <div class="form-group">
                                    <label>Введите пожалуйста номер накладного</label>
                                    <input type="text" id="overhead_code" class="form-control form-control-solid form-control-lg" name="code" placeholder="Пример: SH0001">
                                </div>
                                <!--end::Input-->
                            </div>
                            <div class="col-xl-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overHeadMain">
                                    <div class="overHeadWrapper">
                                        <div class="overHeadCloseBtn">
                                            <button type="button" id="overHeadClose" onclick="close();">X</button>
                                        </div>
                                        <div class="overHeadContent">
                                            <div class="overHeadTitle">
                                                <h2>Номер накладного:</h2>
                                                <h2 class="overhead_code">115467</h2>
                                            </div>
                                            <div class="overHeadClientInfo">
                                                <div class="overHeadFrom">
                                                    <h3 class="overHeadFromTitle">Отправитель</h3>
                                                    <div class="overHeadFromContent">
                                                        <div class="overHeadFromItem">
                                                            <div class="overHeadFromLabel">Фамилия</div>
                                                            <div class="overHeadFromValue from_name">-</div>
                                                        </div>
                                                        <div class="overHeadFromItem">
                                                            <div class="overHeadFromLabel">Компания</div>
                                                            <div class="overHeadFromValue from_company">Pro Komfort</div>
                                                        </div>
                                                        <div class="overHeadFromItem">
                                                            <div class="overHeadFromLabel">Город</div>
                                                            <div class="overHeadFromValue from_city">Алматы</div>
                                                        </div>
                                                        <div class="overHeadFromItem">
                                                            <div class="overHeadFromLabel">Адрес</div>
                                                            <div class="overHeadFromValue from_address">Серикова 6</div>
                                                        </div>
                                                        <div class="overHeadFromItem">
                                                            <div class="overHeadFromLabel">Телефон</div>
                                                            <div class="overHeadFromValue from_phone">87072477192</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="overHeadFrom">
                                                    <h3 class="overHeadFromTitle">Получатель</h3>
                                                    <div class="overHeadFromContent">
                                                        <div class="overHeadFromItem">
                                                            <div class="overHeadFromLabel">Фамилия</div>
                                                            <div class="overHeadFromValue to_name">Наталья</div>
                                                        </div>
                                                        <div class="overHeadFromItem">
                                                            <div class="overHeadFromLabel">Компания</div>
                                                            <div class="overHeadFromValue to_company">-</div>
                                                        </div>
                                                        <div class="overHeadFromItem">
                                                            <div class="overHeadFromLabel">Город</div>
                                                            <div class="overHeadFromValue to_city">Нур-Султан</div>
                                                        </div>
                                                        <div class="overHeadFromItem">
                                                            <div class="overHeadFromLabel">Адрес</div>
                                                            <div class="overHeadFromValue to_address">Сейфуллина 13/1,кв53</div>
                                                        </div>
                                                        <div class="overHeadFromItem">
                                                            <div class="overHeadFromLabel">Телефон</div>
                                                            <div class="overHeadFromValue to_phone">87041718373</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="overHeadDates">
                                                <div class="overHeadDataDate">
                                                    <div class="overHeadStartDate">
                                                        <h3>Дата забора:</h3>
                                                        <div>
                                                            <div class="overHeadDateDay date_s">13</div>
                                                        </div>
                                                    </div>
                                                    <div class="overHeadEndDate">
                                                        <h3>Дата доставки:</h3>
                                                        <div>
                                                            <div class="overHeadDateDay date_e">19</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="overHeadDataDetail">
                                                    <div class="overHeadProductMass">
                                                        <h3 class="overHeadProductTitle">Вес доставки:</h3>
                                                        <div class="overHeadProductValue mass">44,6</div>
                                                    </div>
                                                    <div class="overHeadStatus">
                                                        <h3 class="overHeadProductTitle">Статус доставки:</h3>
                                                        <div class="overHeadProductValue status_over">В пути</div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--begin::Actions-->
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-xl-3">

                            </div>
                            <div class="col-xl-6">
                                <button type="button" class="btn btn-primary font-weight-bold mr-2" onclick="check()" id="submit_btn">Поиск</button>
                            </div>
                            <div class="col-xl-3"></div>
                        </div>
                    </div>
                    <!--end::Actions-->
                <!--end::Form-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>

    <script>
        $('#overHeadClose').click(function (){
            $('.overHeadMain').css('display','none');
        });
        function check(){
            let overhead_code = $("#overhead_code").val();
            console.log(overhead_code);
            $.ajax({
                url: '{{route('search.tracking2')}}',
                method: 'get',
                data: {overhead_code: overhead_code},
                success: function (result){
                    console.log(result);
                    let res = JSON.parse(result);
                    $('.overhead_code').text(res.overhead_code);
                    $('.from_name').text(res.from_name);
                    $('.from_company').text(res.from_company);
                    $('.from_city').text(res.from_city);
                    $('.from_address').text(res.from_address);
                    $('.from_phone').text(res.from_phone);
                    $('.to_name').text(res.to_name);
                    $('.to_company').text(res.to_company);
                    $('.to_city').text(res.to_city);
                    $('.to_address').text(res.to_address);
                    $('.to_phone').text(res.to_phone);
                    $('.date_s').text(res.date_s);
                    $('.date_e').text(res.date_e);
                    $('.mass').text(res.mass);
                    $('.status_over').text(res.status);
                    $('.overHeadMain').css('display','block');
                },
                error: function(error){
                    console.log(error);
                }
            });
        }
    </script>
@endsection
