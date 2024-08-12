<h1 class="responsive-heading">{{ $currentPage }}</h1>

<style>
    .responsive-heading {
        color: black;
        font-size: 1.5rem; /* Базовый размер шрифта для крупных экранов */
        font-style: italic;
    }

    @media (max-width: 1200px) {
        .responsive-heading {
            font-size: 1.75rem; /* Размер шрифта для экранов до 1200px */
        }
    }

    @media (max-width: 992px) {
        .responsive-heading {
            font-size: 1.5rem; /* Размер шрифта для экранов до 992px */
        }
    }

    @media (max-width: 768px) {
        .responsive-heading {
            font-size: 1.25rem; /* Размер шрифта для экранов до 768px */
        }
    }

    @media (max-width: 576px) {
        .responsive-heading {
            font-size: 1rem; /* Размер шрифта для экранов до 576px */
        }
    }

</style>
