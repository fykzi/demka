@extends('layouts.app')

@section('content')
    
    
    <div class="container">
        <h1>Мои нарушения</h1>
        <a href="http://localhost:8000/reports/new" class="btn btn-primary btn-submit" style="margin-bottom: 15px">
            <div>Подать новое заявление</div>
        </a>
        <div id="requests-list">

            @foreach($reports as $report)
            <div class="request-card">
                <div class="request-header">
                    <span class="car-number">{{ $report->car_plate }}</span>
                    <span class="request-date">{{ $report->created_at }}</span>
                    <span class="request-status
                        @if($report->status == 'новое') bg-primary
                        @elseif($report->status == 'подтверждено') bg-success
                        @else bg-danger
                        @endif" style="color: white">
                        {{ $report->status }}
                    </span>
                </div>
                <div class="request-description">
                    {{ $report->description }}
                </div>
            </div>
        @endforeach        

@endsection