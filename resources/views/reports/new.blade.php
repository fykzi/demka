@extends('layouts.app')

@section('content')


<div class="container">
        <div class="form-container">
            <h2 class="form-title">Создание новой заявки</h2>
            
            <form id="createRequestForm" action="http://localhost:8000/reports/new" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="car_plate" class="form-label">Номер автомобиля</label>
                    <input type="text" 
                           class="form-control form-control-lg" 
                           id="car_plate" 
                           name="car_plate" 
                           placeholder="А123БВ777"
                           pattern="[АВЕКМНОРСТУХABEKMHOPCTYX]\d{3}[АВЕКМНОРСТУХABEKMHOPCTYX]{2}\d{2,3}"
                           required
                           title="Введите номер в формате: А123БВ777">
                    <div class="form-text">Формат: буква, 3 цифры, 2 буквы, 2-3 цифры</div>
                </div>
                
                <div class="mb-4">
                    <label for="description" class="form-label">Описание проблемы</label>
                    <textarea class="form-control" 
                              id="description" 
                              name="description" 
                              rows="5" 
                              required
                              placeholder="Опишите нарешение"></textarea>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-submit">Создать заявку</button>
                </div>
            </form>
        </div>
    </div>
@endsection