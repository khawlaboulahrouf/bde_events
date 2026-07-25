@extends('layouts.app')

@section('content')

<style>
    .event-detail-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        background: #ffffff;
    }

    .event-hero {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 3rem 2.5rem;
        position: relative;
    }

    .info-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.2s ease;
    }

    .info-box:hover {
        border-color: #10b981;
        background: #f0fdf4;
    }

    .info-box-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: #ffffff;
        color: #10b981;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .btn-reserve {
        background: linear-gradient(135deg, #10b981, #059669);
        border: none;
        border-radius: 12px;
        padding: 0.8rem 2rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .btn-reserve:hover {
        background: linear-gradient(135deg, #059669, #047857);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    .btn-back {
        border-radius: 12px;
        padding: 0.8rem 1.5rem;
        font-weight: 500;
        background-color: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }

    .btn-back:hover {
        background-color: #e2e8f0;
        color: #1e293b;
    }

    .progress-thin {
        height: 8px;
        border-radius: 10px;
        background-color: #e2e8f0;
    }
</style>

<div class="row justify-content-center py-4">
    <div class="col-lg-9 col-md-10">

        <div class="card event-detail-card">

            <!-- Hero Header -->
            <div class="event-hero">
                <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                    <span class="badge bg-white bg-opacity-20 text-white backdrop-blur rounded-pill px-3 py-2 small">
                        <i class="bi bi-calendar-event me-1"></i> Événement BDE
                    </span>

                    @if($event->prix == 0)
                        <span class="badge bg-white text-success fw-bold px-3 py-2 fs-6 rounded-pill">
                            <i class="bi bi-tag-fill me-1"></i> Gratuit
                        </span>
                    @else
                        <span class="badge bg-dark text-white fw-bold px-3 py-2 fs-6 rounded-pill">
                            {{ $event->prix }} DH
                        </span>
                    @endif
                </div>

                <h2 class="fw-bold mb-0 text-white display-6">{{ $event->titre }}</h2>
            </div>

            <!-- Main Body -->
            <div class="card-body p-4 p-md-5">

                <!-- Description Section -->
                <div class="mb-5">
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="bi bi-text-paragraph text-success me-2"></i>À propos de cet événement
                    </h5>
                    <p class="text-secondary leading-relaxed fs-6 mb-0" style="white-space: pre-line;">{{ $event->description }}</p>
                </div>

                <!-- Info Cards Grid -->
                <div class="row g-3 mb-5">
                    <!-- Date -->
                    <div class="col-sm-6 col-md-4">
                        <div class="info-box">
                            <div class="info-box-icon">
                                <i class="bi bi-calendar3"></i>
                            </div>
                            <div>
                                <span class="text-muted small d-block">Date</span>
                                <strong class="text-dark">{{ $event->date }}</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Heure -->
                    <div class="col-sm-6 col-md-4">
                        <div class="info-box">
                            <div class="info-box-icon">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div>
                                <span class="text-muted small d-block">Heure</span>
                                <strong class="text-dark">{{ $event->heure }}</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Lieu -->
                    <div class="col-sm-12 col-md-4">
                        <div class="info-box">
                            <div class="info-box-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div>
                                <span class="text-muted small d-block">Lieu</span>
                                <strong class="text-dark text-truncate d-block" style="max-width: 150px;">{{ $event->lieu }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Places Availability Section -->
                @php
                    $restantes = $event->placesRestantes();
                    $percentage = $event->places > 0 ? ($restantes / $event->places) * 100 : 0;
                @endphp
                <div class="bg-light rounded-4 p-4 mb-4 border">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-semibold text-dark">
                            <i class="bi bi-people me-2 text-muted"></i>Disponibilité des places
                        </span>
                        <span class="fw-bold {{ $restantes > 0 ? 'text-success' : 'text-danger' }}">
                            {{ $restantes }} / {{ $event->places }} places restantes
                        </span>
                    </div>

                    <div class="progress progress-thin">
                        <div class="progress-bar {{ $restantes > 0 ? 'bg-success' : 'bg-danger' }}"
                             role="progressbar"
                             style="width: {{ $percentage }}%"></div>
                    </div>
                </div>

                <hr class="my-4 text-muted opacity-25">

                <!-- Actions Footer -->
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <a href="{{ route('events.index') }}" class="btn btn-back">
                        <i class="bi bi-arrow-left me-1"></i>
                        Retour aux événements
                    </a>

                    @if($event->placesRestantes() > 0)
                        <form action="{{ route('reservations.store', $event) }}" method="POST" class="mb-0">
                            @csrf
                            <button type="submit" class="btn btn-success btn-reserve text-white">
                                <i class="bi bi-ticket-perforated-fill me-2"></i>
                                Réserver ma place
                            </button>
                        </form>
                    @else
                        <button class="btn btn-danger btn-reserve text-white opacity-75" disabled>
                            <i class="bi bi-x-circle me-2"></i>
                            Événement complet
                        </button>
                    @endif
                </div>

            </div>

        </div>

    </div>
</div>

@endsection
