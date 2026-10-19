<form method="POST" action="{{ $action }}" class="form">
    @csrf
    @isset($trainer)
        @method('PUT')
    @endisset

    <label>Имя
        <input type="text" name="name" value="{{ old('name', $trainer->name ?? '') }}">
    </label>

    <label>Специализация
        <select name="specialization_id">
            @foreach ($specializations as $specialization)
                <option value="{{ $specialization->id }}"
                    @selected(old('specialization_id', $trainer->specialization_id ?? '') == $specialization->id)>
                    {{ $specialization->name }}
                </option>
            @endforeach
        </select>
    </label>

    <label>Телефон
        <input type="text" name="phone" value="{{ old('phone', $trainer->phone ?? '') }}">
    </label>

    <label>Стаж, лет
        <input type="number" name="experience" min="0" value="{{ old('experience', $trainer->experience ?? '') }}">
    </label>

    <label>Цена, тг/мес.
        <input type="number" name="price" min="0" step="0.01" value="{{ old('price', $trainer->price ?? '') }}">
    </label>

    <label>О тренере
        <textarea name="bio" rows="5">{{ old('bio', $trainer->bio ?? '') }}</textarea>
    </label>

    <label class="check">
        <input type="checkbox" name="is_active" value="1"
               @checked(old() ? old('is_active') : ($trainer->is_active ?? true))>
        Активен
    </label>

    <div class="form-actions">
        <button type="submit">Сохранить</button>
        <a href="{{ route('admin.trainers.index') }}">Отмена</a>
    </div>
</form>