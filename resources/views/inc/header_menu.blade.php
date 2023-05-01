<div class="nav-holder main-menu">
    <nav>
        <ul class="no-list-style">
            <li>
                <a href="{{route('front.index')}}" class="act-link">Главная</a>
            </li>
            <li>
                <a href="#" class="act-link">О Нас</a>
            </li>
            <li>
                <a href="#">Клиентам<i class="fa fa-caret-down"></i></a>
                <!--second level -->
                <ul>
                    <li><a href="#">Расчитать стоимость</a></li>
                    <li><a href="#">Подать заявку</a></li>
                    <li><a href="#">Заключение договора</a></li>
                </ul>
                <!--second level end-->
            </li>
            <li>
                <a href="#">Контакты</a>
            </li>
            <li>

{{--                <a href="#" id="my_city" style="border-bottom: 1px dashed red;color:red;">Ваш город</a>--}}
                <select name="my_city_select" id="my_city_select">
                    <option value="0">---------</option>
                </select>
            </li>
        </ul>
    </nav>
</div>
