@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/customslider.css')}}">
<style>

</style>
@endsection
@section('content')
<div class="container mt-5">
	<div class="row justify-content-center d-flex">
		<div class="col-md-8 h-100">

			<div class="card" id="betcard">
				<div class="card-header bg-white"><h5 id="betmatchheader" class="float-left">{{$result->fixture}}</h5> <span style="float:right;">Time: {{date("g:i A", strtotime($result->time))}}</span> </div>
				<div class="card-body">
						<p id="supportlabel">Participants: <span id="value">{{$count}}</span></p>
					<input type="range" min="1" max="100" value="{{$suppval}}" id="myRange" class="slider" disabled>
					<table class="table table-borderless" id="betoption">
						<tbody>
							<tr>
								<td id="firstteam">{{$result->team1}}</td>
								<td>Vs</td>
								<td id="secondteam">{{$result->team2}}</td>
							</tr>
							<tr>

							</tr>
							<tr>
								<td>{{$result->team1_point}}</td>
								<td>ဘယ်သူနိုင်မှာလဲ?</td>
								<td>{{$result->team2_point}}</td>
							</tr>
							<tr>
								<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="firstTeamBet">ရွေးမယ်</button></td>
								<td></td>
								<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="secondTeamBet">ရွေးမယ်</button></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="card-footer" style="visibility:hidden;">
					<p style="visibility: hidden;" id="mid">{{$result->id}}</p>
				</div>
			</div>

		</div>
	</div>
</div>
<!-- Trigger the modal with a button -->


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">နိုင်မှာသေချာလို့လား</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>

			</div>
			<div class="modal-body firstModal">
				<form action="{{route('trybet')}}" method="post">
					@csrf
					<div class="form-group">
						<label for="choosenteam">Choosen Team</label>
						<h4 id="choice"></h4>
						<input type="hidden" class="form-control" id="choosenteam" name="choosenteam">
						<input type="hidden" class="form-control" id="matchId" name="matchId">
						<input type="hidden" class="form-control" id="fixture", name="fixture">
					</div>
					<div class="form-group">
						<label for="betamount">Bet Amount</label>
						<input  class="form-control" id="betamount" placeholder="10" name="betamount" type="number" min="1" step="1" max="{{\Auth::user()->coin}}">
					</div>

					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>
@endsection
@section('js')
<script>
	//Slider JS
		var slider = document.getElementById("myRange");
		var x = slider.value;
		var color = "linear-gradient(90deg,	rgb(0, 0, 0)"+x+"%,	rgb(255, 0, 0)"+x+"%)";
		slider.style.background =color;
	// SLider Js
	//For First Team
	$(document).on("click", "#firstTeamBet", function () {
		var myBookId = $("#firstteam").text();
		var matchId = $("#mid").text();
		var fixture = $("#betmatchheader").text();
		$(".modal-body #matchId").val(matchId);
		$(".modal-body #fixture").val(fixture);
		$(".modal-body #choice").text( myBookId );
		$(".modal-body #choosenteam").val( myBookId );
	});
	$(document).on("click", "#secondTeamBet", function () {
		var myBookId = $("#secondteam").text();
		var matchId = $("#mid").text();
		var fixture = $("#betmatchheader").text();
		$(".modal-body #matchId").val(matchId);
		$(".modal-body #fixture").val(fixture);
		$(".modal-body #choice").text( myBookId );
		$(".modal-body #choosenteam").val( myBookId );
     // As pointed out in comments,
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
 });
</script>
@endsection
