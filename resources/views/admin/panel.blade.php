@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Управление заявками</h1>
    
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Список заявок</h5>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Дата</th>
                            <th>Ф.И.О.</th>
                            <th>Номер машины</th>
                            <th>Описание</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                            <tr>
                                <td>{{ $report['created_at'] }}</td>
                                <td>{{ $report['full_name'] }}</td>
                                <td>{{ $report['car_plate'] }}</td>
                                <td>{{ Str::limit($report['description'], 150) }}</td>
                                <td>
                                    <span class="badge 
                                        @if($report['status'] == 'новое') bg-primary
                                        @elseif($report['status'] == 'подтверждено') bg-success
                                        @else bg-danger
                                        @endif">
                                       {{ $report['status'] }}
                                    </span>
                                </td>
                                <td>
                                    @if($report['status'] == 'новое')
                                        <form action="{{ route('admin.approve', $report['id']) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Одобрить</button>
                                        </form>
                                        <form action="{{ route('admin.reject', $report['id']) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Отклонить</button>
                                        </form>
                                    @else
                                        <span class="text-muted">Действия недоступны</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Нет заявок</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection