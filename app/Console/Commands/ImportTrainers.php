<?php

namespace App\Console\Commands;

use App\Models\Trainer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class ImportTrainers extends Command
{
    protected $signature = 'trainers:import {file : Путь к CSV-файлу (разделитель «;»)}';

    protected $description = 'Импорт тренеров из CSV: имя;стаж;цена;id специализации';

    public function handle(): int
    {
        $arg = $this->argument('file');
        $path = is_file($arg) ? $arg : base_path($arg);

        if (! is_file($path)) {
            $this->error("Файл не найден: {$arg}");

            return self::FAILURE;
        }

        $handle = fopen($path, 'r');
        $added = 0;
        $skipped = 0;
        $line = 0;

        while (($row = fgetcsv($handle, 0, ';')) !== false) {
            $line++;

            // убираем BOM, который Excel добавляет в начало UTF-8 файла
            if ($line === 1) {
                $row[0] = ltrim($row[0], "\xEF\xBB\xBF");
            }

            if ($row === [null] || count($row) < 4) {
                $this->warn("Строка {$line}: ожидалось 4 поля, пропущена.");
                $skipped++;

                continue;
            }

            [$name, $experience, $price, $specializationId] = array_map('trim', $row);

            $validator = Validator::make(
                [
                    'name'              => $name,
                    'experience'        => $experience,
                    'price'             => $price,
                    'specialization_id' => $specializationId,
                ],
                [
                    'name'              => ['required', 'string', 'min:3', 'max:120'],
                    'experience'        => ['required', 'integer', 'between:0,60'],
                    'price'             => ['required', 'numeric', 'between:1000,1000000'],
                    'specialization_id' => ['required', 'integer', 'exists:specializations,id'],
                ],
                [
                    'required' => 'поле «:attribute» пустое',
                    'integer'  => 'в поле «:attribute» нужно целое число',
                    'numeric'  => 'в поле «:attribute» нужно число',
                    'between'  => 'значение поля «:attribute» вне допустимых границ',
                    'exists'   => 'такой специализации не существует',
                    'min'      => 'поле «:attribute» слишком короткое',
                    'max'      => 'поле «:attribute» слишком длинное',
                ],
                [
                    'name'              => 'имя',
                    'experience'        => 'стаж',
                    'price'             => 'цена',
                    'specialization_id' => 'специализация',
                ]
            );

            if ($validator->fails()) {
                $this->warn("Строка {$line}: " . $validator->errors()->first());
                $skipped++;

                continue;
            }

            Trainer::create($validator->validated());
            $added++;
        }

        fclose($handle);

        $this->info("Итог: добавлено {$added}, пропущено {$skipped}.");

        return self::SUCCESS;
    }
}