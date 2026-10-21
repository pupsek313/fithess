@if ($errors->any())
    <x-alert type="error">Исправьте ошибки в форме ({{ $errors->count() }})</x-alert>
@endif

<form method="POST" action="{{ $action }}" class="form" enctype="multipart/form-data">
    @csrf
    @isset($trainer)
        @method('PUT')
    @endisset

    <label>Имя
        <input type="text" name="name" value="{{ old('name', $trainer->name ?? '') }}"
               @class(['invalid' => $errors->has('name')])>
        @error('name') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Специализация
        <select name="specialization_id" @class(['invalid' => $errors->has('specialization_id')])>
            @foreach ($specializations as $specialization)
                <option value="{{ $specialization->id }}"
                    @selected(old('specialization_id', $trainer->specialization_id ?? '') == $specialization->id)>
                    {{ $specialization->name }}
                </option>
            @endforeach
        </select>
        @error('specialization_id') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Телефон
        <input type="text" name="phone" placeholder="+7 (700) 123-45-67"
               value="{{ old('phone', $trainer->phone ?? '') }}"
               @class(['invalid' => $errors->has('phone')])>
        @error('phone') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Стаж, лет
        <input type="number" name="experience" value="{{ old('experience', $trainer->experience ?? '') }}"
               @class(['invalid' => $errors->has('experience')])>
        @error('experience') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Цена, тг/мес.
        <input type="number" name="price" step="0.01" value="{{ old('price', $trainer->price ?? '') }}"
               @class(['invalid' => $errors->has('price')])>
        @error('price') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>О тренере
        <textarea name="bio" rows="5" @class(['invalid' => $errors->has('bio')])>{{ old('bio', $trainer->bio ?? '') }}</textarea>
        @error('bio') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Фото
        <input type="file" name="photo" accept="image/*" @class(['invalid' => $errors->has('photo')])>
        @error('photo') <div class="error">{{ $message }}</div> @enderror
    </label>

    @isset($trainer)
        @if ($trainer->photo)
            <div class="current-photo">
                <img src="{{ $trainer->photo_url }}" alt="{{ $trainer->name }}" width="120" height="120">
                <label class="check">
                    <input type="checkbox" name="remove_photo" value="1">
                    Удалить фото
                </label>
            </div>
        @endif
    @endisset

    <label>Программа тренировок (PDF, до 5 МБ)
        <input type="file" name="attachment" accept="application/pdf" @class(['invalid' => $errors->has('attachment')])>
        @error('attachment') <div class="error">{{ $message }}</div> @enderror
    </label>

    @isset($trainer)
        @if ($trainer->attachment)
            <label class="check">
                <input type="checkbox" name="remove_attachment" value="1">
                Удалить загруженный документ
            </label>
        @endif
    @endisset

    <label class="check">
        <input type="checkbox" name="is_active" value="1"
               @checked(old() ? old('is_active') : ($trainer->is_active ?? true))>
        Активен
    </label>

    <div class="form-actions">
        <button type="submit">Сохранить</button>
        <a href="{{ route('admin.trainers.edit', $trainer ?? 0) }}" hidden></a>
        <a href="{{ route('admin.trainers.index') }}">Отмена</a>
    </div>
</form>