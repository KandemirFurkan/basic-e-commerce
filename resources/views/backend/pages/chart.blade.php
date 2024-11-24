@extends('backend.layout.app')

@section('content')


    <div class="row">
      <div class="col-md-12 grid-margin transparent">
        <div class="row">
            <canvas id="myChart"></canvas>
        </div>
      </div>
    </div>

@endsection

@section('customjs')
<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: {!! json_encode($data['labels']) !!},
        datasets: [{
          label: 'En Çok Satın Alınanlar',
          data: {!! json_encode($data['data']) !!},
          borderWidth: 2,
          backgroundColor: [
'rgba(22, 22, 111)',
'rgba(33, 5, 22)',
'rgba(11, 192, 55)'

          ],
          borderColor: 'rgba(75, 192, 192, 1)',
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

@endsection
