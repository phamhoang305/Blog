
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600,700,800" rel="stylesheet">
	<link href="{{ asset('assets/utility/cssgradient/main.css') }}" rel="stylesheet" />
</head>
<body class="index" itemscope itemtype="">
	<div class="home-display__top">
		<div class="home-display__top-margin">
			<div id="waldo-tag-4650"></div>
		</div>
	</div>
	<header class="page-header header-app">
		<div class="header-app__background-transparent"></div>
		<div class="header-app__background-color js-header"></div>
	</header>
	<main class="js-body-content">
		<section class="panel-app">
			<section class="app-gradient">
				<div class="app-gradient__color">
					<div class="app-gradient__color-background js-background"></div>
					<div class="app-gradient__points js-drag"></div>
                </div>
			</section>
			<section class="app-color">
				<div class="row">
					<div class="col-xs-24 col-lg-8">
						<div class="app-color__picker js-picker"></div>
					</div>
					<div class="col-xs-24 col-md-12 col-lg-8">
						<div class="app-color__inputs js-controls"></div>
					</div>
					<div class="col-xs-24 col-md-12 col-lg-8">
						<div class="app-color__stops">
							<div class="app-color__stops-title">
								<div class="app-color__stop-color"></div>
								<div class="app-color__stop-hex">
									<h3>Hex</h3>
								</div>
								<div class="app-color__stop-position">
									<h3>Stop</h3>
								</div>
								<div class="app-color__stop-action">
									<h3>⊕</h3>
								</div>
							</div>
							<div class="js-stops"></div>
						</div>
					</div>
				</div>
			</section>
			<section class="app-options">
				<div class="row">
					<div class="col-xs-24">
						<div class="app-options__content">
							<div class="app-option">
								<button class="app-option__button app-option__button--linear js-button-linear"> <span class="app-option__button-icon"></span> Linear</button>
								<button class="app-option__button app-option__button--radial js-button-radial"> <span class="app-option__button-icon"></span> Radial</button>
							</div>
							<div class="app-option">
								<div class="app-option__angles">
									<div class="app-option__angle js-angle">
										<div class="app-option__angle-center js-pointer">
											<div class="app-option__angle-pointer"></div>
										</div>
									</div>
									<input class="app-option__input js-angle-input" value="90°">
								</div>
							</div>
							<div class="app-option">
								<input type="file" name="file" id="file" class="input-file js-upload">
								<label for="file">
									<svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
										<g stroke="#BBBFC5" stroke-width="2" fill="none" fill-rule="evenodd">
											<path d="M1 1h14v14H1z" />
											<path d="M1 9l3-3 9 9" />
											<path d="M8 10l3-3 4 4" />
										</g>
									</svg>Upload Image</label>
							</div>
							<div class="app-option">
								<div class="app-option__swatches">
									<div class="app-option__swatch js-swatch">
										<div class="app-option__swatch-color"></div>
									</div>
									<div class="app-option__swatch js-swatch">
										<div class="app-option__swatch-color"></div>
									</div>
									<div class="app-option__swatch js-swatch">
										<div class="app-option__swatch-color"></div>
									</div>
									<div class="app-option__swatch js-swatch">
										<div class="app-option__swatch-color"></div>
									</div>
									<div class="app-option__swatch js-swatch">
										<div class="app-option__swatch-color"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
			</section>
		</section>
		<section class="panel-code">
			<div class="row">
				<div class="col-xs-24 col-md-24">
					<section class="code-editor">
						<div class="code-editor__column">
							<div class="code-editor__column-tabs"></div>
							<div class="code-editor__column-numbers">1</div>
						</div>
						<div class="code-editor__block">
							<div class="code-editor__tabs">
								<div class="code-editor__tab is-active">CSS</div>
								<!-- <div class="code-editor__tab">SVG</div> -->
								<!-- <div class="code-editor__tab">Canvas</div> -->
								<div class="code-editor__compat">
									<label>
										<input type="checkbox" class="js-compat">
										<div class="compat__text">Max Compatibility <span>(IE6+)</span>
										</div>
										<div class="compat__checkbox"></div>
									</label>
								</div>
							</div>
							<div class="code-editor__input"> <code class="code-editor__input-code js-code" id="code"></code>
							</div>
						</div>
					</section>
					<section class="code-options">
						<button data-clipboard-target="#code" class="code-option__button js-copy">
							<div class="code-option__button-bg js-button-copy"></div>
							<svg class="code-option__button-svg" width="13" height="17" xmlns="http://www.w3.org/2000/svg">
								<g stroke="#ffffff" stroke-width="2" fill="none" fill-rule="evenodd">
									<path d="M5 5h7v11H5z" />
									<path d="M1 15V1h10" />
								</g>
							</svg> <span>Copy to Clipboard</span>
						</button>
					</section>
				</div>
			</div>
		</section>
		<div class="page-divider"></div>
	</main>
	<script src="{{ asset('assets/utility/cssgradient/main.js') }}"></script>
</body>
</html>
