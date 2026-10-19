@if ($errors->any())
    <x-alert type="error">Исправьте ошибки в форме ({{ $errors->count() }})</x-alert>
@endif

<form method="POST" action="{{ $action }}" class="form">
    @csrf
    @isset($specialization)
        @method('PUT')
    @endisset

    <label>Название
        <input type="text" name="name" value="{{ old('name', $specialization->name ?? '') }}"
               @class(['invalid' => $errors->has('name')])>
        @error('name') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Описание
        <textarea name="description" rows="5" @class(['invalid' => $errors->has('description')])>{{ old('description', $specialization->description ?? '') }}</textarea>
        @error('description') <div class="error">{{ $message }}</div> @enderror
    </label>

    <div class="form-actions">
        <button type="submit">Сохранить</button>
        <a href="{{ route('admin.specializations.index') }}">Отмена</a>
    </div>
</form>