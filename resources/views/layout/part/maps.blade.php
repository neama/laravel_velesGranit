<style>
    .custom-font {
        font-family: 'Arial', sans-serif; /* Замените 'Arial' на нужный вам шрифт */
        font-size: 18px; /* Установите нужный размер шрифта */
    }
</style>


<div class="container">
<div class="row justify-content-center">
    <div class="custom-font_main_cat">
        {{__('Map')}}
    </div>
</div>
</div>

<div class="row">
        <div class="col-md-5 custom-font" >
            <h3>{{__('text_main_map_1')}}</h3>
            <p>{{__('text_main_map_2')}}</p>
            <p>{{__('text_main_map_3')}}</p>
            <h4>{{__('text_main_map_4')}}</h4>
            <p>{{__('text_main_map_5')}}</p>
            <p>{{__('text_main_map_6')}}</p>


        </div>
        <div class="col-md-7">
                <!-- Здесь карта Яндекса -->
                <div id="map" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>


    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script type="text/javascript">
        ymaps.ready(init);
        function init() {
            var myMap = new ymaps.Map("map", {
                center: [46.724, 28.55], // Координаты центра карты
                zoom: 8
            });

            var placemark1 = new ymaps.Placemark([47.064641735174405, 28.835605525521135], {
                balloonContent: '{{'Strada Doina 150, Chișinău'}}'
            });

            var placemark2 = new ymaps.Placemark([46.27498752322266, 28.202765096641794], {
                balloonContent: 'str. Ștefan Vodă 48, Cantemir'
            });

            myMap.geoObjects.add(placemark1);
            myMap.geoObjects.add(placemark2);
        }
    </script>
