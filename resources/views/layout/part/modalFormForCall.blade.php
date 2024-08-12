<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }

    .phoneIconCall {
        color: red; /* Устанавливаем цвет иконки */
        font-size: 1.5rem; /* Устанавливаем размер иконки */
        animation: bounce 2s infinite; /* Применяем анимацию bounce */
    }

    #openModalPhoneCall {
        position: fixed; /* Фиксированное позиционирование */
        bottom: 20px; /* Расположить кнопку на расстоянии 20px от нижнего края */
        right: 20px; /* Расположить кнопку на расстоянии 20px от правого края */
        border-radius: 10px; /* Закругленные углы кнопки */
        box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* Тень для кнопки */
        padding: 10px 15px; /* Отступы внутри кнопки */
        display: flex; /* Используем flexbox для выравнивания содержимого */
        align-items: center; /* Вертикальное выравнивание содержимого */
        gap: 10px; /* Расстояние между иконкой и текстом */
        z-index: 1050; /* Убедитесь, что кнопка поверх всех элементов */
    }

    #openModalPhoneCall:hover {
        background-color: #0056b3; /* Цвет фона при наведении */
        color: #fff; /* Цвет текста при наведении */
    }

    .modal {
        z-index: 1040; /* Убедитесь, что модальное окно ниже кнопки, но поверх всех других элементов */
    }

    .modal-dialog {
        z-index: 1050; /* Убедитесь, что диалоговое окно модального окна поверх остальных элементов */
    }

</style>
<!-- Плавающая кнопка для запроса звонка -->
<button id="openModalPhoneCall" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    <div class="d-flex align-items-center">
        <i class="fa fa-phone fa-2x phoneIconCall"></i>
        <span class="ml-2">{{ __('Request a call') }}</span>
    </div>
</button>

<!-- Модальное окно -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Request a call') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="requestCallForm" class="send-call">
                    <div class="form-group">
                        <label for="fname">{{ __('Full Name') }}</label>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="{{ __('Enter your full name') }}">
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">{{ __('Phone Number') }}</label>
                        <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="{{ __('Enter your phone number') }}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary" onclick="$('#requestCallForm').submit();">{{ __('Submit') }}</button>
            </div>
        </div>
    </div>
</div>


