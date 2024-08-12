<!-- Кнопка перемотки наверх -->
<button class="btn btn-primary" id="scrollToTopBtn" title="Вернуться наверх">
    <i class="fas fa-chevron-up"></i>
</button>
<style>
    #scrollToTopBtn {
        display: none; /* Скрыть кнопку по умолчанию */
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 100;
        background-color: #007bff; /* Цвет фона кнопки (Bootstrap primary) */
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        font-size: 20px;
        text-align: center;
    }

    #scrollToTopBtn:hover {
        background-color: #0056b3; /* Цвет фона при наведении (Bootstrap primary dark) */
    }
</style>
<script>
    // Получаем кнопку
    let mybutton = document.getElementById("scrollToTopBtn");

    // Когда пользователь прокручивает страницу на 20px вниз, показываем кнопку
    window.onscroll = function() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    };

    // При клике на кнопку перематываем страницу наверх
    function topFunction() {
        document.body.scrollTop = 0; // Для Safari
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    // Привязываем функцию к клику на кнопку
    document.getElementById("scrollToTopBtn").addEventListener("click", topFunction);

</script>
