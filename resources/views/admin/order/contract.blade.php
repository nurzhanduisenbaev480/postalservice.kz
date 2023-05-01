@extends('layouts.app')
@section('subheader')

    <!--begin::Subheader-->
    <div class="py-2 subheader py-lg-6 subheader-solid" id="kt_subheader">
        <div class="flex-wrap container-fluid d-flex align-items-center justify-content-between flex-sm-nowrap">
            <!--begin::Info-->
            <div class="flex-wrap mr-1 d-flex align-items-center">
                <!--begin::Page Heading-->
                <div class="flex-wrap mr-5 d-flex align-items-baseline">
                    <!--begin::Page Title-->
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Создать договор</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->

                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection
@section('content-admin')
<div class="mx-auto col-lg-12">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contract_info">
                    <form action="{{route('admin.orders.contractCreate')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="contract_no">Номер договора</label>
                            <input type="text" name="contract_no" id="contract_no" class="form-control" placeholder="#123456">
                        </div>
                        <div class="form-group">
                            <label for="speed">Срочность</label>
                            <select name="speed" id="speed" class="form-control">
                                <option value="Экспресс">Экспресс</option>
                                <option value="Стандарт">Стандарт</option>
                            </select>
                        </div>
                        <hr>
                        <div class="select_tarif">
                            <h5>Укажите вес и цену </h5>
                            <div class="form-group">
                                <label for="mass">Вес(кг)</label>
                                <input type="text" name="mass" id="mass" class="form-control" value="0" placeholder="0.3кг">
                            </div>
                            <div class="form-group">
                                <label for="price">Цена за 1-зону(тг)</label>
                                <input type="text" name="price" id="price" class="form-control" value="0" placeholder="9999">
                            </div>
                            <div class="form-group">
                                <label for="price">Цена за 2-зону(тг)</label>
                                <input type="text" name="price" id="price" class="form-control" value="0" placeholder="9999">
                            </div>
                            <div class="form-group">
                                <label for="price">Цена за 3-зону(тг)</label>
                                <input type="text" name="price" id="price" class="form-control" value="0" placeholder="9999">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="company_name">Имя компаний</label>
                            <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Желательно на русском))">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('admin-script')
    <script>

    </script>
@endsection
