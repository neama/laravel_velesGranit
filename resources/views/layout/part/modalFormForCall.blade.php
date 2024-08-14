<meta name="csrf-token" content="{{ csrf_token() }}">
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


