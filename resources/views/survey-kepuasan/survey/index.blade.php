@extends('igd.layouts.blank')

@section('title')
Survey Kepuasan - Medify
@endsection

@section('css')
	<style type="text/css">
		.form-control {
			font-size: 1.5rem;
		}
		.hide {
			visibility: hidden;
		}
		.stepwizard-step p {
            margin-top: 10px;
        }
        .stepwizard-row {
            display: table-row;
        }
        .stepwizard {
            display: table;
            width: 50%;
            position: relative;
        }
        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }
        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 4px;
            background-color: #ddd;
            z-order: 0;
        }
        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
            width: calc(100%/3);
        }
        .step {
            box-shadow: none;
            border: 1px solid transparent;
            background-color: #f4f4f4;
            color: #444;
            border-color: #ddd;
            display: inline-block;
            vertical-align: middle;
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }
        .step:hover {
            color: #444;
        }
        .step.active {
            background: #3c8dbc;
            border-color: #266ba5;
            color: white;
        }
	</style>
@endsection

@section('content')
<div id="page-container" class="main-content-boxed">
	<main id="main-container">
		<div class="bg-body-dark bg-pattern" style="background-image: url('{{ asset('assets/img/bg-pattern-inverse.png') }}');">
			<div class="row mx-0 justify-content-center">
				<div class="hero-static col-lg-9 col-xl-7">
					<div class="content content-full overflow-hidden">
						<div class="text-center">
							<!-- <img src="{{ asset('assets/img/logo-text2.png') }}" width="150"> -->
							<h1 class="h4 font-w700 mt-10 mb-10">Survey Kepuasan Pasien</h1>
						</div>
                        
						<form class="js-validation-signin" action="" method="post">
							<input type="hidden" name="" value="3" id="survey-counter">
							<div class="block block-themed block-rounded block-shadow">
								<div class="block-content">
									<div class="progress push" id="survey-progress">
										<div class="progress-bar" role="progressbar" id="progressbar" style="width:0%;">
											<span class="progress-bar-label" id="label"></span>
										</div>
									</div>

									<div class="setup-content" id="step-1" data-question="1">
										<div class="form-group row">
											<div class="col-12">
												<div class="form-material mt-0">
													<h3>1. My workload is manageable</h3>
													<input type="text" class="form-control form-control-lg" id="material-input-size-lg" name="material-input-size-lg" placeholder="Isikan jawaban Anda disini...">
												</div>
											</div>
											<div class="col-12 mt-20">
												<button type="button" class="btn btn-heros btn-square btn-primary nextBtn pull-right">
												Berikutnya
												</button>
											</div>
										</div>
									</div>

									<div class="setup-content" id="step-2" data-question="2">
										<div class="form-group row">
											<h2 class="col-12">2. How did you hear about our company?</h2>
											<div class="col-12">
												<div class="custom-control custom-checkbox mb-5">
													<label class="css-control css-control-lg css-control-primary css-radio">
														<input type="radio" class="css-control-input" name="radio-group12" checked="">
														<span class="css-control-indicator"></span> Google
													</label>
												</div>
												<div class="custom-control custom-checkbox mb-5">
													<label class="css-control css-control-lg css-control-primary css-radio">
														<input type="radio" class="css-control-input" name="radio-group12" checked="">
														<span class="css-control-indicator"></span> Google
													</label>
												</div>
												<div class="custom-control custom-checkbox mb-5">
													<label class="css-control css-control-lg css-control-primary css-radio">
														<input type="radio" class="css-control-input" name="radio-group12" checked="">
														<span class="css-control-indicator"></span> Google
													</label>
												</div>
											</div>
											<div class="col-12 mt-20">
												<button type="button" class="btn btn-heros btn-square btn-primary pull-left prevBtn">
													Sebelumnya
												</button>
												<button type="button" class="btn btn-heros btn-square btn-primary pull-right nextBtn">
													Berikutnya
												</button>
											</div>
										</div>
									</div>

									<div class="setup-content" id="step-3" data-question="3">
										<div class="form-group row" id="rating-ability-wrapper">
											<h2 class="col-12">3. How would you rate your ability to use the computer and access internet ?</h2>
											<div class="col-12">
												<input type="hidden" id="selected_rating" name="selected_rating" value="" required="required">
												<h2 class="bold rating-header" style="">
													<span class="selected-rating">0</span><small> / 5</small>
												</h2>
												<button type="button" class="btnrating btn btn-default" data-attr="1" id="rating-star-1">
													<i class="fa fa-star" aria-hidden="true"></i>
												</button>
												<button type="button" class="btnrating btn btn-default" data-attr="2" id="rating-star-2">
													<i class="fa fa-star" aria-hidden="true"></i>
												</button>
												<button type="button" class="btnrating btn btn-default" data-attr="3" id="rating-star-3">
													<i class="fa fa-star" aria-hidden="true"></i>
												</button>
												<button type="button" class="btnrating btn btn-default" data-attr="4" id="rating-star-4">
													<i class="fa fa-star" aria-hidden="true"></i>
												</button>
												<button type="button" class="btnrating btn btn-default" data-attr="5" id="rating-star-5">
													<i class="fa fa-star" aria-hidden="true"></i>
												</button>
											</div>
											<div class="col-12 mt-20">
												<button type="button" class="btn btn-heros btn-square btn-primary pull-left prevBtn">
													Sebelumnya
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
</div>
@endsection

@section('js')
	<script type="text/javascript">
		jQuery(document).ready(function($){
	    
			$(".btnrating").on('click',(function(e) {
				var previous_value = $("#selected_rating").val();
				var selected_value = $(this).attr("data-attr");

				$("#selected_rating").val(selected_value);
				
				$(".selected-rating").empty();
				$(".selected-rating").html(selected_value);
				
				for (i = 1; i <= selected_value; ++i) {
					$("#rating-star-"+i).toggleClass('btn-warning');
					$("#rating-star-"+i).toggleClass('btn-default');
				}
				
				for (ix = 1; ix <= previous_value; ++ix) {
					$("#rating-star-"+ix).toggleClass('btn-warning');
					$("#rating-star-"+ix).toggleClass('btn-default');
				}
			}));

			var target = $('#step-1'),
				allWells = $('.setup-content'),
				allNextBtn = $('.nextBtn'),
				allPrevBtn = $('.prevBtn');
			var question = $('#survey-counter').val(),
				questionTotal = 100 / (parseInt(question) - 1),
				progressbar = 0;

			console.log(questionTotal);
			$('#label').html('1/' + question);
			allWells.hide();
			target.show();
      
			allPrevBtn.click(function(){
				var curStep = $(this).closest(".setup-content")
				var curStepBtn = curStep.attr("id");
				var questionNumber = curStep.prev().data("question");
				
				progressbar = progressbar - questionTotal
				$('#label').html(questionNumber + '/' + question);
				allWells.hide();
				prevStepWizard = curStep.prev();
				prevStepWizard.show();

				document.getElementById("progressbar").style.width = progressbar + '%';
			});

			allNextBtn.click(function(){
				var curStep = $(this).closest(".setup-content");
				var curStepBtn = curStep.attr("id");
				var questionNumber = curStep.next().data("question");

				progressbar = progressbar + questionTotal
				$('#label').html(questionNumber + '/' + question);
				allWells.hide();
				nextStepWizard = curStep.next();
				nextStepWizard.show();

				document.getElementById("progressbar").style.width = progressbar + '%';
			});
		});
	</script>

@endsection
