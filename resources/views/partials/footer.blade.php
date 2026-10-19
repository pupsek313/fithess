<footer>
    &copy; {{ date('Y') }} Фитнес-клуб
    <br>
    Запросов к БД: {{ method_exists(DB::getFacadeRoot(), 'getQueryLog') ? count(DB::getQueryLog()) : 0 }}
</footer>