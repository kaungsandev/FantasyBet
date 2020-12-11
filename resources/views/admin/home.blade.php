@extends('layouts.admin')
@section('content')
  <!-- Collapsable Card Example -->
  <div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
      <h6 class="m-0 font-weight-bold text-primary">Add New Match</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="collapseCardExample">
      <div class="card-body">
          <form action="{{route('fixture.store')}}">
            <div class="form-group">
                <label for="matchday">Matchday</label>
                <input type="number" name="matchday" id="matchday" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="homeTeam">Home Team</label>
                <input type="text" name="homeTeam" id="homeTeam" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="awayTeam">Away Team</label>
                <input type="text" name="awayTeam" id="awayTeam" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="time">Time</label>
                <input type="text" name="time" id="time" class="form-control" required>
            </div>
            <button class="form-control btn btn-primary" type="submit">Add Match</button>
        </form>
      </div>
    </div>
  </div>
@livewire('fixture-list')
@endsection